<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('features/rooms_model');        
        $this->navbar_active = 'rooms';
    }

    public function index()
    {
        $data['no_foot'] = true;
        $data['title'] = 'Rooms';
        app('vnk')->view('rooms/s', $data);
    }

    public function search()
    {
        if (!$this->input->get('v')) {
            show_404();
        }
        $data['heading'] = 'Results:';
        $data['title'] = $this->input->get('v');
        $data['no_foot'] = true;
        $data['query'] = $this->rooms_model->search($this->input->get('v'));
        app('vnk')->view('rooms/cs', $data);
    }

    public function ajax_slider($all = null)
    {
        if (!$all) {
            $this->rooms_model->limit = 5;
        }
        $this->rooms_model->order_by = array('id' => 'desc');
        $data['sliders'] = $this->rooms_model->select();
        app('vnk')->view('rooms/_slider', $data);
    }

    public function ajax_column() {
        $this->rooms_model->order_by = array('id' => 'desc');
        $data['rooms'] = $this->rooms_model->select();
        app('vnk')->view('rooms/_content', $data);
    }

    public function ajax_read()
    {
        $data['room'] = $this->rooms_model->select(array('id' => $this->input->get('id')));
        app('vnk')->view('rooms/_modal', $data);
    }
}
