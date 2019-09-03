<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['no_foot'] = true;
        $data['title'] = 'Automation Engineering';
        app('vnk')->view('s', $data);
    }
}
