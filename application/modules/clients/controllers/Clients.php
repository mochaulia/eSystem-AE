<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
        $this->menus_name = 'clients';
        $this->load_model = 'clients/clients_model';
        $this->model = 'clients_model';
        $this->title = 'Clients';
        $this->img_path = 'app/clients/';
        $this->upload_path = './' . config_item('images_path') . $this->img_path;
    }

    /* DATA HANDLER
     */
    protected function data_create($logo)
    {
        return array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'logo' => $logo,
        );
    }

    protected function data_edit()
    {
        return array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
        );
    }
    /* DATA HANDLER
     */

    public function index()
    {
        $this->privileges_check('read');
        $this->_index($this->title);
    }

    /*
        AJAX METHOD
     */
    public function ajax_table()
    {
        $this->privileges_check('read');
        $this->load->model($this->load_model);
        $this->{$this->model}->order_by = array('id' => 'desc');
        $data['results'] = $this->{$this->model}->select();
        app('vnk')->view('_table', $data);
    }

    public function ajax_add($post = null)
    {
        $this->privileges_check('create');
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $upload_config['upload_path'] = $this->upload_path;
            $upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
            $upload_config['encrypt_name'] = true;
            $upload_config['max_size'] = 5120;
            $this->load->library('upload', $upload_config);
            if ($this->upload->do_upload('logo')) {
                $file = $this->upload->data();
                $this->load->library('image_lib');
                $resize_config['image_library'] = 'gd2';
                $resize_config['source_image'] = $this->upload_path . $file['file_name'];
                $resize_config['quality'] = '90%';
                $resize_config['maintain_ratio'] = true;
                $resize_config['width'] = 720;
                $resize_config['height'] = 480;
                $resize_config['new_image'] = $this->upload_path . $file['file_name'];
                $this->load->library('image_lib', $resize_config);
                if ($this->image_lib->resize()) {
                    echo ($this->{$this->model}->insert($this->data_create($this->img_path . $file['file_name']))) ? 'created' : 'failed';
                } else {
                    echo $this->image_lib->display_errors();
                }
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            app('vnk')->view('_add_form');
        }
    }

    public function ajax_edit($post = null)
    {
        $this->privileges_check('update');
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $where = array(
                'id' => $this->input->post('id')
            );
            echo ($this->{$this->model}->update($this->data_edit(), $where)) ? 'updated' : 'failed';
        } else {
            $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $this->input->get('id')));
            app('vnk')->view('_edit_form', $data);
        }
    }

    public function ajax_delete($post = null)
    {
        $this->privileges_check('delete');
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $where = array(
                'id' => $this->input->post('id')
            );
            echo ($this->{$this->model}->delete($where)) ? 'deleted' : 'failed';
        } else {
            $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $this->input->get('id')));
            app('vnk')->view('_delete_confirm', $data);
        }
    }

    public function ajax_edit_image($post = null)
    {
        $this->privileges_check('update');
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $file_name_temp = $this->{$this->model}->select(array('id' => $this->input->post('id')))->logo;
            $file_name = explode('.', substr($file_name_temp, 10))[0];
            $upload_config['overwrite'] = true;
            $upload_config['file_name'] = $file_name;
            $upload_config['upload_path'] = $this->upload_path;
            $upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
            $upload_config['max_size'] = 5120;
            $this->load->library('upload', $upload_config);
            if ($this->upload->do_upload('logo')) {
                $file = $this->upload->data();
                $this->load->library('image_lib');
                $resize_config['image_library'] = 'gd2';
                $resize_config['source_image'] = $this->upload_path . $file['file_name'];
                $resize_config['quality'] = '90%';
                $resize_config['maintain_ratio'] = true;
                $resize_config['width'] = 720;
                $resize_config['height'] = 480;
                $resize_config['new_image'] = $this->upload_path . $file['file_name'];
                $this->load->library('image_lib', $resize_config);
                if ($this->image_lib->resize()) {
                    $data = array(
                        'logo' => $this->img_path . $file['file_name']
                    );
                    $where = array(
                        'id' => $this->input->post('id')
                    );
                    echo ($this->{$this->model}->update($data, $where)) ? 'updated' : 'failed';
                } else {
                    echo $this->image_lib->display_errors();
                }
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $this->input->get('id')));
            app('vnk')->view('_edit_image_form', $data);
        }
    }
    /*
        / AJAX METHOD
     */

    /*
        PROTECTED METHOD
     */
    protected function privileges_check($crud = 'have_access')
    {
        $ok = $this->privileges_model->is(user()->id, $crud, $this->menus_model->select(array('alias' => $this->menus_name))->id);
        if (is_admin() || $ok) {
            return true;
        } else {
            show_404();
        }
    }

    protected function _index($title)
    {
        $data['title'] = $title;
        app('vnk')->view('s', $data);
    }
    /*
        / PROTECTED METHOD
     */
}
