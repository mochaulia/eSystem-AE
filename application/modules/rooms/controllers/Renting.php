<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renting extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
        $this->menus_name = 'room_renting';
        $this->load_model = 'rooms/room_renting_model';
        $this->model = 'room_renting_model';
        $this->title = 'Booking Room';
        $this->join_user = 'id_user';
    }

    /* DATA HANDLER
     */
    protected function checking_date()
    {
        $this->load->model($this->load_model);
        $where = array(
            'id_room' => $this->input->post('room'),
            'start >=' => $this->input->post('start'),
            'end <=' => $this->input->post('end'),
            'approved' => 1
        );
        $renting = $this->{$this->model}->select($where);
        return (count($renting) > 0) ? false : true;
    }

    protected function data_create($approval_letter = null)
    {
        $data = array(
            'id_user' => user()->id,
            'id_room' => $this->input->post('room'),
            'category' => $this->input->post('category'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'approval_letter' => $approval_letter,
            'note' => $this->input->post('note')
        );
        if ($approval_letter) {
            $data['approval_letter'] = $approval_letter;
        }
        return $data;
    }

    protected function data_edit()
    {

    }
    /* /DATA HANDLER
     */

    public function index()
    {
        $this->privileges_check('read');
        $this->load->model('rooms/rooms_model');
        $this->load->model($this->load_model);
        $this->_index($this->title);
    }

    /*
        AJAX METHOD
     */
    public function ajax_calendar()
    {
        $this->privileges_check('read');
        app('vnk')->view('renting/_calendar');
    }

    public function ajax_get_events()
    {
        $this->privileges_check('read');
        $this->load->model($this->load_model);
        $this->load->model('rooms/rooms_model');
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
        if ($this->input->get('my') !== '') {
            $where['id_user'] = user()->id;
        }
        if ($this->input->get('status') !== '') {
            if ($this->input->get('status') == 'pending') {
                $where['has_read'] = 0;
                $where['approved'] = 9;
            } else if ($this->input->get('status') == 'noaction') {
                $where['has_read'] = 1;
                $where['approved'] = 9;
            } else if ($this->input->get('status') == 'denied') {
                $where['has_read'] = 1;
                $where['approved'] = 0;
            } else if ($this->input->get('status') == 'approved') {
                $where['has_read'] = 1;
                $where['approved'] = 1;
            }
        }
        if ($this->input->get('room') !== '') {
            $where['id_room'] = $this->input->get('room');
        }
        $events_temp = (array)$this->{$this->model}->select($where, false);
        foreach ($events_temp as $event) {
            if ($event->approved == 9) {
                $s = 'Waiting';
            } else if ($event->approved == 0) {
                $s = 'Denied';
            } else if ($event->approved == 1) {
                $s = 'Approved';
            }
            $events[] = array(
                'id' => $event->id,
                'title' => $this->rooms_model->select(array('id' => $event->id_room))->name .
                    '~' . user($event->id_user)->first_name . ' ' . user($event->id_user)->last_name .
                    '~' . $event->name .
                    '~' . $event->start .
                    '~' . $event->end .
                    '~' . $s,
                'start' => $event->start,
                'end' => $event->end,
                'color' => random_color(),
                'id_user' => $event->id_user,
            );
        }
        header('Content-Type:application/json; charset=UTF-8');
        echo json_encode(array('events' => $events));
        exit();
    }

    public function ajax_add($post = null)
    {
        $this->privileges_check('create');
        $this->load->model($this->load_model);
        $this->load->model('rooms/rooms_model');
        if ($post == 'post') {

            $upload_path = 'files/room_renting/';
            if ($this->checking_date()) {
                if ($this->input->post('app_letter')) {
                    $upload_config['upload_path'] = './assets/' . $upload_path;
                    $upload_config['allowed_types'] = 'pdf|docx|jpg|jpeg|png';
                    $upload_config['encrypt_name'] = true;
                    $upload_config['max_size'] = 5120;
                    $this->load->library('upload', $upload_config);
                    if ($this->upload->do_upload('app_letter')) {
                        $file = $this->upload->data();
                        echo ($this->{$this->model}->insert($this->data_create($upload_path . $file['file_name']))) ? 'sent' : 'failed';
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    echo ($this->{$this->model}->insert($this->data_create())) ? 'sent' : 'failed';
                }
            } else {
                echo 'Room has been taken.';
            }
        } else {
            app('vnk')->view('renting/_add_form');
        }
    }

    public function ajax_read($post = null)
    {
        $this->privileges_check('read');
        $this->load->model($this->load_model);
        $this->load->model('rooms/rooms_model');
        if ($post == 'post') {
            $data = array(
                'approved' => $this->input->post('approved')
            );
            $where = array(
                'id' => $this->input->post('id')
            );
            echo ($this->{$this->model}->update($data, $where)) ? 'updated' : 'failed';
        } else {
            $id = $_GET['id'];
            if (is_admin() && ($this->{$this->model}->select(array('id' => $id))->has_read == 0)) {
                $data = array(
                    'has_read' => 1
                );
                $where = array(
                    'id' => $id
                );
                $this->{$this->model}->update($data, $where);
            }
            $meter_temp = 1;
            $meter_temp_c = 'danger';
            $meter_temp_s = 'Sent';
            if ($this->{$this->model}->select(array('id' => $id))->has_read == 1) {
                $meter_temp += 1;
                $meter_temp_c = 'warning';
                $meter_temp_s = 'Read by Admin';
            }
            if ($this->{$this->model}->select(array('id' => $id))->approved != 9) {
                $meter_temp += 1;
                $meter_temp_c = 'success';
                $meter_temp_s = 'Replied';
            }
            $data['meter_f'] = round(($meter_temp / 3) * 100);
            $data['meter_c'] = $meter_temp_c;
            $data['meter_s'] = $meter_temp_s;
            $data[$this->menus_name] = $this->{$this->model}->select(array('id' => $id));
            app('vnk')->view('renting/_read_form', $data);
        }
    }

    public function ajax_approval_note_keyup()
    {
        if (is_admin()) {
            $this->load->model($this->load_model);
            $data = array(
                'approval_note' => $this->input->post('note'),
            );
            $where = array(
                'id' => $this->input->post('id')
            );
            echo ($this->{$this->model}->update($data, $where)) ? 'updated' : 'failed';
        }
    }

    public function ajax_delete_events()
    {
        $this->load->model($this->load_model);
        $id = $this->input->post('id');
        if ($this->privileges_check('delete', $this->is_mine($id))) {
            $where = array(
                'id' => $id
            );
            echo ($this->{$this->model}->delete($where)) ? 'deleted' : 'failed';
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
        app('vnk')->view('renting/s', $data);
    }
    /*
        / PROTECTED METHOD
     */

    public function ajax_count_pending()
    {
        $this->load->model($this->load_model);
        $where = array(
            'has_read' => 0,
            'approved' => 9
        );
        echo count($this->{$this->model}->select($where));
    }
}
