<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        ci()->load->library('session');
    }

    public function index()
    {
        login_required();
        $data['title'] = lang('dashboard_heading');
        app('vnk')->view('s', $data);
    }
}
