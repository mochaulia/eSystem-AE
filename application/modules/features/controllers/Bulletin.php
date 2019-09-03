<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bulletin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bulletin_model', 'bulletin');
    }

    public function index()
    {
        app('vnk')->view('features/bulletin/s');
    }

    public function youtube($post = null)
    {
        if (!is_admin()) {
            show_404();
        } else {
            if ($post == 'post') {
                $data = array(
                    'url' => $this->input->post('url'),
                    'updated_by' => user()->id
                );
                $where = array('id' => 1);
                echo ($this->bulletin->update_youtube($data, $where)) ? 'success' : 'failed';
            } else {
                $data['title'] = 'YouTube Playlist';
                app('vnk')->view('features/bulletin/youtube_input', $data);
            }
        }

    }

    public function ajax_flash_news()
    {
        app('vnk')->view('features/bulletin/_flash_news');
    }

    public function ajax_news_update()
    {
        app('vnk')->view('features/bulletin/_news_update');
    }

    public function ajax_news_categories($ke)
    {
        $data['ke'] = 'categories' . $ke;
        app('vnk')->view('features/bulletin/_news_by_categories', $data);
    }

    public function ajax_youtube()
    {
        app('vnk')->view('features/bulletin/_youtube');
    }

    public function ajax_apps()
    {
        app('vnk')->view('features/bulletin/_apps');
    }

    public function ajax_running_text()
    {
        app('vnk')->view('features/bulletin/_running_text');
    }
}
