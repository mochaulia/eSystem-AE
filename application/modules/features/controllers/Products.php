<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('features/products_model');        
        $this->navbar_active = 'products';
    }

    public function index()
    {
        $data['no_foot'] = true;
        $data['title'] = 'Products';
        app('vnk')->view('products/s', $data);
    }

    public function search()
    {
        if (!$this->input->get('v')) {
            show_404();
        }
        $data['heading'] = 'Results:';
        $data['title'] = $this->input->get('v');
        $data['no_foot'] = true;
        $data['query'] = $this->products_model->search($this->input->get('v'));
        app('vnk')->view('products/cs', $data);
    }

    public function ajax_slider()
    {
        $this->products_model->limit = 5;
        $this->products_model->order_by = array('id' => 'desc');
        $data['slider_products'] = $this->products_model->select();
        app('vnk')->view('products/_slider', $data);
    }

    public function ajax_column() {
        $this->products_model->order_by = array('id' => 'desc');
        $data['products'] = $this->products_model->select();
        app('vnk')->view('products/_content', $data);
    }

    public function ajax_read()
    {
        $this->load->model('clients/clients_model');   
        $data['product'] = $this->products_model->select(array('id' => $this->input->get('id')));
        app('vnk')->view('products/_modal', $data);
    }
}
