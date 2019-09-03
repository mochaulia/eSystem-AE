<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms_usage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('features/rooms_model');
        $this->load->model('rooms/room_renting_model');
        $this->navbar_active = 'rooms_usage';
    }

    public function index()
    {
        $data['no_foot'] = true;
        $data['title'] = 'Rooms Usage';
        app('vnk')->view('rooms_usage/s', $data);
    }

    public function ajax_calendar()
    {
        app('vnk')->view('rooms_usage/_calendar');
    }

    public function ajax_get_events()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $startdt = new DateTime('now');
        $startdt->setTimestamp($start);
        $start_format = $startdt->format('Y-m-d H:i:s');
        $enddt = new DateTime('now');
        $enddt->setTimestamp($end);
        $end_format = $enddt->format('Y-m-d H:i:s');
        $where = array(
            'start >=' => $start_format,
            'end <=' => $end_format,
            'approved' => 1
        );
        $events_temp = (array)$this->room_renting_model->select($where, false);
        foreach ($events_temp as $event) {
            $events[] = array(
                'id' => $event->id,
                'title' => $this->rooms_model->select(array('id' => $event->id_room))->name .
                    '~' . user($event->id_user)->first_name . ' ' . user($event->id_user)->last_name .
                    '~' . $event->name .
                    '~' . $event->start .
                    '~' . $event->end,
                'start' => $event->start,
                'end' => $event->end,
                'color' => random_color(),
                'id_user' => $event->id_user,
            );
        }
        header('Content-Type:application/json; charset=UTF-8');
        echo json_encode(array('events' => ($events) ? $events : null));
        exit();
    }
}
