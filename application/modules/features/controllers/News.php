<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('features/news_model');
        $this->navbar_active = 'news';
    }

    public function index()
    {
        $data['title'] = 'News';
        $data['no_foot'] = true;
        app('vnk')->view('news/s', $data);
    }

    public function read()
    {
        if (!$this->input->get('v')) {
            show_404();
        }
        $data['no_foot'] = true;
        $news = $this->news_model->select(array(
            'id' => url_decode($this->input->get('v'))
        ));
        $data['title'] = $news->title;
        $data['news'] = $news;
        app('vnk')->view('news/p', $data);
    }

    public function category()
    {
        if (!$this->input->get('v')) {
            show_404();
        }
        $data['heading'] = 'Category:';
        $data['title'] = $this->input->get('v');
        $data['no_foot'] = true;
        $this->news_model->order_by = array('id' => 'desc');
        $data['query'] = $this->news_model->select(array(
            'category' => $this->input->get('v')
        ), false);
        app('vnk')->view('news/cs', $data);
    }

    public function search()
    {
        if (!$this->input->get('v')) {
            show_404();
        }
        $data['heading'] = 'Query:';
        $data['title'] = $this->input->get('v');
        $data['no_foot'] = true;
        $data['query'] = $this->news_model->search($this->input->get('v'));
        app('vnk')->view('news/cs', $data);
    }

    public function ajax_slider()
    {
        $this->news_model->order_by = array('id' => 'desc');
        $this->news_model->limit = 3;
        $data['slider_news'] = $this->news_model->select(array(
            'type' => 'general',
            'thumbnail !=' => ''
        ));
        app('vnk')->view('news/_slider', $data);
    }

    public function ajax_trending()
    {
        $this->news_model->order_by = array('id' => 'desc');
        $this->news_model->limit = 6;
        $data['main_news'] = $this->news_model->select(array(
            'type !=' => 'flashnews',
        ));
        app('vnk')->view('news/_trending', $data);
    }

    public function ajax_latest()
    {
        $this->news_model->order_by = array('id' => 'desc');
        $this->news_model->start = 6;
        $this->news_model->limit = 3;
        $data['latest_w_carousel'] = $this->news_model->select(array(
            'type !=' => 'flashnews',
        ));
        $this->news_model->order_by = array('id' => 'desc');
        $this->news_model->start = 9;
        $this->news_model->limit = 10;
        $data['latest'] = $this->news_model->select(array(
            'type !=' => 'flashnews',
        ));
        app('vnk')->view('news/_latest', $data);
    }

    public function ajax_categories_top()
    {
        app('vnk')->view('news/_categories_top');
    }

    public function ajax_categories_bottom()
    {
        app('vnk')->view('news/_categories_bottom');
    }

    public function ajax_related()
    {
        $this->news_model->order_by = array('id' => 'desc');
        $this->news_model->limit = 4;
        $data['related'] = $this->news_model->select(array(
            'id !=' => $this->input->get('id'),
            'category' => $this->input->get('category')
        ), false);
        app('vnk')->view('news/_related', $data);
    }
}
