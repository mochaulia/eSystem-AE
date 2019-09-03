<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
        $this->menus_name = 'news';
        $this->load_model = 'news/news_model';
        $this->model = 'news_model';
        $this->join_user = 'id_creator';
    }

    /* DATA HANDLER
     */
    protected function data_create()
    {
        return array(
            'created_at' => time(),
            'id_creator' => user()->id,
            'title' => $this->input->post('title'),
            'thumbnail' => $this->input->post('thumbnail'),
            'text' => $this->input->post('content'),
            'type' => $this->input->post('type'),
            'category' => $this->input->post('category'),
            'time' => $this->input->post('time'),
            'location' => $this->input->post('location')
        );
    }

    protected function data_edit()
    {
        return array(
            'updated_at' => time(),
            'id_updater' => user()->id,
            'title' => $this->input->post('title'),
            'thumbnail' => $this->input->post('thumbnail'),
            'text' => $this->input->post('content'),
            'type' => $this->input->post('type'),
            'category' => $this->input->post('category'),
            'time' => $this->input->post('time'),
            'location' => $this->input->post('location')
        );
    }
    /* DATA HANDLER
     */

    public function index()
    {
        $this->privileges_check('read');
        $this->_index('News/Event');
    }

    public function mine()
    {
        $this->_index('My News/Event');
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
            if ($this->input->post('content')) {
                echo ($this->{$this->model}->insert($this->data_create())) ? 'success' : 'failed';
            } else {
                echo 'null';
            }
        } else {
            app('vnk')->view('_add_form');
        }
    }

    public function ajax_edit($post = null)
    {
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $id = $this->input->post('id');
            if ($this->privileges_check('update', $this->is_mine($id))) {
                if ($this->input->post('content')) {
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
