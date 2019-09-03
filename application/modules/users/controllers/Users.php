<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
    }

    /*
        USER METHOD
     */
    public function index()
    {
        $this->load->model('majors/majors_model');
        $this->load->model('units/units_model');
        $data['title'] = lang('index_heading');
        app('vnk')->view('s', $data);
    }
    /*
        / USER METHOD
     */

    /*
        AJAX METHOD
     */
    public function ajax_table()
    {
        $this->load->model('majors/majors_model');
        app('vnk')->view('_table');
    }

    public function ajax_activator()
    {
		// user have must be admin
        admin_required();
        $active = (int)$this->input->post('active');
        $activator = ((bool)$active) ? 'activate' : 'deactivate';
        app('ion_auth')->$activator($this->input->post('id_user'));
    }

    public function ajax_create()
    {
		// user have must be admin
        admin_required();
        $username = $this->input->post('username');
        $email = strtolower($this->input->post('email'));
        $password = config_item('create_user_by_admin_password');
        if (username_available($username) && email_available($email) && !empty($this->input->post('username'))) {
            $additional_data = array(
                'first_name' => explode(' ', $this->input->post('full_name'), 2)[0],
                'last_name' => explode(' ', $this->input->post('full_name'), 2)[1],
                'phone' => $this->input->post('phone'),
                'gender' => $this->input->post('gender'),
                'secondary_email' => $this->input->post('secondary_email'),
                'id_major' => $this->input->post('major'),
                'id_unit' => $this->input->post('unit'),
                'phone' => $this->input->post('phone'),
                'home_address' => $this->input->post('home_address'),
            );
            $role = $this->input->post('role');
            header('Content-Type:application/json; charset=UTF-8');
            echo json_encode(app('ion_auth')->register($username, $password, $email, $additional_data, array($role)));
        }
    }

    public function ajax_edit($post = null)
    {
        // user have must be admin
        admin_required();
        if ($post == 'post') {
            $id = $this->input->post('user_id');
            $username = $this->input->post('username');
            $email = strtolower($this->input->post('email'));
            $changing_username = $this->input->post('username') != user($id)->username;
            $check_username = ($changing_username)
                ? (username_available($username))
                : true;
            $changing_email = $this->input->post('email') != user($id)->email;
            $check_email = ($changing_email)
                ? (email_available($email))
                : true;
            if ($check_username && $check_email) {
                $role = $this->input->post('role');
                app('ion_auth')->remove_from_group(null, $id);
                app('ion_auth')->add_to_group(array($role), $id);
                $data = array(
                    'email' => $email,
                    'username' => $username,
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'gender' => $this->input->post('gender'),
                    'secondary_email' => $this->input->post('secondary_email'),
                    'id_major' => $this->input->post('major'),
                    'id_unit' => $this->input->post('unit'),
                    'phone' => $this->input->post('phone'),
                    'home_address' => $this->input->post('home_address'),
                );
                echo (app('ion_auth')->update($id, $data)) ? 'true' : 'false';
            }
        } else {
            $this->load->model('majors/majors_model');
            $this->load->model('units/units_model');
            $data['user'] = user($_GET['user_id']);
            app('vnk')->view('_edit_form', $data);
        }
    }

    public function ajax_privileges($post = null)
    {
        // user have must be admin
        admin_required();
        if ($post == 'post') {
            $user_id = $this->input->post('user_id');
            $this->privileges_model->reset_user_menu($user_id);
            foreach ($this->menus_model->select() as $menu) {
                $crud = array();
                $actors = array('create', 'read', 'update', 'delete');
                foreach ($actors as $actor) {
                    // echo "$menu->name $actor";
                    (!empty($this->input->post('menu_' . $actor . $menu->id)))
                        ? $crud[$actor] = 1
                        : $crud[$actor] = 0;
                    // echo " $crud[$actor]\n";
                }
                $this->privileges_model->add_to_menu($menu->id, $user_id, $crud);
            }
        } else {
            $data['menus'] = $this->menus_model->select();
            $data['user'] = user($_GET['user_id']);
            app('vnk')->view('_privileges_edit', $data);
        }
    }

    public function ajax_delete($post = null)
    {
        // user have must be admin
        admin_required();
        if ($post == 'post') {
            $id = $this->input->post('user_id');
            app('ion_auth')->delete_user($id);
        } else {
            $data['user'] = user($_GET['user_id']);
            app('vnk')->view('_delete_confirm', $data);
        }
    }
    /*
        / AJAX METHOD
     */
}
