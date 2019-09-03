<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Academic_schedule extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
        $this->menus_name = 'academic_schedule';
        $this->load_model = 'academic_schedule/academic_schedule_model';
        $this->model = 'academic_schedule_model';
        $this->title = 'Academic Schedule';
    }

    /* DATA HANDLER
     */
    protected function data_create()
    {
        return array(
            'id_academic_year' => $this->input->post('year'),
            'id_class' => $this->input->post('class'),
            'absen' => $this->input->post('absen'),
            'subject' => $this->input->post('subject'),
            'description' => $this->input->post('description'),
            'start' => $this->input->post('startDate'),
            'end' => $this->input->post('endDate'),
            'color' => $this->input->post('color'),
        );
    }

    protected function data_edit()
    {
        return array(
            'id_academic_year' => $this->input->post('year'),
            'id_class' => $this->input->post('class'),
            'absen' => $this->input->post('absen'),
            'subject' => $this->input->post('subject'),
            'description' => $this->input->post('description'),
            'color' => $this->input->post('color'),
        );
    }
    /* /DATA HANDLER
     */

    public function index()
    {
        $this->privileges_check('read');
        $this->load->model($this->load_model);
        $this->_index($this->title);
    }

    /*
        AJAX METHOD
     */
    public function ajax_calendar()
    {
        $this->privileges_check('read');
        app('vnk')->view('_calendar');
    }

    public function ajax_get_events()
    {
        $this->privileges_check('read');
        $this->load->model($this->load_model);
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
        );
        if ($this->input->get('year')) {
            $where['id_academic_year'] = $this->input->get('year');
        }
        if ($this->input->get('class')) {
            $where['id_class'] = $this->input->get('class');
        }
        $events_temp = (array)$this->{$this->model}->select($where);
        $events = array();
        if (isset($events_temp['id'])) {
            $events[0] = array(
                'id' => $events_temp['id'],
                'title' => strtoupper($this->{$this->model}->classes($events_temp['id_class'])->name) . '-' . strtoupper($events_temp['absen']) . ': ' . strtoupper($events_temp['subject']),
                'start' => $events_temp['start'],
                'end' => $events_temp['end'],
                'color' => $events_temp['color'],
            );
        } else {
            foreach ($events_temp as $event) {
                $events[] = array(
                    'id' => $event->id,
                    'title' => strtoupper($this->{$this->model}->classes($event->id_class)->name) . '-' . strtoupper($event->absen) . ': ' . strtoupper($event->subject),
                    'start' => $event->start,
                    'end' => $event->end,
                    'color' => $event->color,
                );
            }
        }
        header('Content-Type:application/json; charset=UTF-8');
        echo json_encode(array('events' => $events));
        exit();
    }

    public function ajax_add($post = null)
    {
        $this->privileges_check('create');
        $this->load->model($this->load_model);
        if ($post == 'post') {
            echo ($this->{$this->model}->insert($this->data_create())) ? 'success' : 'failed';
        } else {
            app('vnk')->view('_add_form');
        }
    }

    public function ajax_edit($post = null)
    {
        $this->privileges_check('update');
        $this->load->model($this->load_model);
        if ($post == 'post') {
            $id = $this->input->post('id');
            $where = array(
                'id' => $id
            );
            echo ($this->{$this->model}->update($this->data_edit(), $where)) ? 'success' : 'failed';
        } else {
            $id = $_GET['id'];
            $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $id));
            app('vnk')->view('_edit_form', $data);
        }
    }

    public function ajax_drag_events()
    {
        $this->privileges_check('update');
        $this->load->model($this->load_model);
        $data = array(
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
        );
        $where = array(
            'id' => $this->input->post('id')
        );
        echo ($this->{$this->model}->update($data, $where)) ? 'updated' : 'failed';
    }

    public function ajax_delete_events()
    {
        $this->privileges_check('delete');
        $this->load->model($this->load_model);
        $where = array(
            'id' => $this->input->post('id')
        );
        echo ($this->{$this->model}->delete($where)) ? 'deleted' : 'failed';
    }

    public function ajax_add_comp($sel)
    {
        if (explode('_', $sel)[1] == 'post') {
            $this->load->model($this->load_model);
            $d = array(
                'name' => $this->input->post('name_comp'),
                'description' => $this->input->post('description')
            );
            echo $this->{$this->model}->add_comp(explode('_', $sel)[0], $d);
        } else {
            app('vnk')->view('_' . explode('_', $sel)[0]);
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
