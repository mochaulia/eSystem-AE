<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
        $this->menus_name = 'products';
        $this->load_model = 'products/products_model';
        $this->model = 'products_model';
        $this->join_user = 'id_creator';
        $this->title = 'Products';
    }

    /* DATA HANDLER
     */
    protected function data_create()
    {
        return array(
            'created_at' => time(),
            'id_creator' => user()->id,
            'id_client' => $this->input->post('client'),
            'name' => $this->input->post('name'),
            'pic_name' => $this->input->post('pic_name'),
            'teams' => $this->input->post('teams'),
            'thumbnail' => $this->input->post('thumbnail'),
            'description' => $this->input->post('description'),
            'years' => $this->input->post('years'),
            'tools' => $this->input->post('tools'),
            'workpack' => $this->input->post('workpack'),
            'status' => $this->input->post('status'),
            'status_haki' => $this->input->post('status_haki')
        );
    }

    protected function data_edit()
    {
        return array(
            'updated_at' => time(),
            'id_updater' => user()->id,
            'id_client' => $this->input->post('client'),
            'name' => $this->input->post('name'),
            'pic_name' => $this->input->post('pic_name'),
            'teams' => $this->input->post('teams'),
            'thumbnail' => $this->input->post('thumbnail'),
            'description' => $this->input->post('description'),
            'years' => $this->input->post('years'),
            'tools' => $this->input->post('tools'),
            'workpack' => $this->input->post('workpack'),
            'status' => $this->input->post('status'),
            'status_haki' => $this->input->post('status_haki')
        );
    }
    /* DATA HANDLER
     */

    public function index()
    {
        $this->privileges_check('read');
        $this->_index($this->title);
    }

    public function mine()
    {
        $this->privileges_check('read');
        $this->_index('My ' . $this->title);
    }

    /*
        AJAX METHOD
     */
    public function ajax_table($mine = null)
    {
        if (!$mine) {
            $this->privileges_check('read');
        }
        $this->load->model($this->load_model);
        $this->{$this->model}->order_by = array('id' => 'desc');
        $data['results'] = ($mine == 'mine')
            ? $this->{$this->model}->select(array($this->join_user => user()->id), false)
            : $this->{$this->model}->select();
        app('vnk')->view('_table', $data);
    }

    public function ajax_add($post = null)
    {
        $this->privileges_check('create');
        $this->load->model($this->load_model);
        if ($post == 'post') {
            if ($this->input->post('description')) {
                echo ($this->{$this->model}->insert($this->data_create())) ? 'success' : 'failed';
            } else {
                echo 'null';
            }
        } else {
            app('vnk')->view('_add_form');
        }
    }

    public function ajax_read()
    {
        $this->privileges_check('read');
        $this->load->model($this->load_model);
        $id = $_GET['id'];
        $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $id));
        app('vnk')->view('_read_form', $data);
    }

    public function ajax_edit($post = null)
    {
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $id = $this->input->post('id');
            if ($this->privileges_check('update', $this->is_mine($id))) {
                if ($this->input->post('description')) {
                    $where = array(
                        'id' => $id
                    );
                    echo ($this->{$this->model}->update($this->data_edit(), $where)) ? 'success' : 'failed';
                } else {
                    echo 'null';
                }
            }
        } else {
            $id = $_GET['id'];
            $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $id));
            app('vnk')->view('_edit_form', $data);
        }
    }

    public function ajax_delete($post = null)
    {
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $id = $this->input->post('id');
            if ($this->privileges_check('delete', $this->is_mine($id))) {
                $this->{$this->model}->delete(array('id' => $id));
            }
        } else {
            $id = $_GET['id'];
            $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $id));
            app('vnk')->view('_delete_confirm', $data);
        }
    }
    /*
        / AJAX METHOD
     */

    /*
        PROTECTED METHOD
     */
    protected function privileges_check($crud = 'have_access', $is_mine = false)
    {
        $ok = $this->privileges_model->is(user()->id, $crud, $this->menus_model->select(array('alias' => $this->menus_name))->id);
        if (is_admin() || $ok || $is_mine) {
            return true;
        } else {
            show_404();
        }
    }

    protected function is_mine($id)
    {
        $is_mine = $this->{$this->model}->select(array('id' => $id))->{$this->join_user} == user()->id;
        return $is_mine;
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
