<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Messages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
        $this->load->model('messages_model', 'messages');
    }

    public function index()
    {
        redirect('message/inbox');
    }

    public function inbox()
    {
        $data['title'] = 'Inbox';
        app('vnk')->view('s', $data);
    }

    public function sents()
    {
        $data['title'] = 'Sent';
        app('vnk')->view('s', $data);
    }

    public function ajax_get($sel)
    {
        if ($sel == 'inbox') {
            $data['inboxes'] = $this->messages->inboxes();
            $data['mine'] = false;
        } elseif ($sel == 'sents') {
            $data['inboxes'] = $this->messages->sents();
            $data['mine'] = true;
        }
        app('vnk')->view('_msg', $data);
    }

    public function ajax_read()
    {
        $msg = $this->messages->read($this->input->get('id'));
        if (is_object($msg)) {
            $from_me = $msg->id_from == user()->id;
            $for_me = $msg->id_to == user()->id;
            if (!$from_me && !$for_me) {
                echo 'Denied';
            } else {
                $data['msg'] = $msg;
                $data['mine'] = $from_me;
                app('vnk')->view('_read', $data);
            }
        } else {
            echo "not found";
        }
    }

    public function ajax_reply_for()
    {
        $data['msg'] = $this->messages->read($this->input->get('id'));
        $data['mine'] = $data['msg']->id_from == user()->id;
        app('vnk')->view('_replyfor', $data);
    }

    public function ajax_create()
    {
        $data['header'] = 'Compose Message';
        if ($this->input->get('reply_for') && $this->input->get('id_to')) {
            $data['reply_for'] = $this->input->get('reply_for');
            $data['id_to'] = $this->input->get('id_to');
            $data['header'] = 'Reply Message';
        }
        app('vnk')->view('_create', $data);
    }

    public function ajax_post($reply = null)
    {
        if ($this->input->post('text')) {
            $data = array(
                'id_to' => $this->input->post('id_to'),
                'id_from' => user()->id,
                'subject' => $this->input->post('subject'),
                'text' => $this->input->post('text')
            );
            if ($reply == 'reply') {
                $data['reply_for'] = $this->input->post('reply_for');
            }
            echo ($this->messages->send($data)) ? 'sent' : 'failed';
        } else {
            echo 'null';
        }
    }

    public function ajax_delete($post = null)
    {
        if ($post == 'delete') {
            echo ($this->messages->delete(
                $this->input->post('id'),
                $this->input->post('for')
            )) ?
                'success' : 'failed';
        }
        elseif ($post == 'trash') {
            echo ($this->messages->trash(
                $this->input->post('id')
            )) ?
                'success' : 'failed';
        } else {
            $id = $this->input->get('id');
            $msg = $this->messages->select($id);
            $data['id'] = $id;
            $data['mine'] = $msg->id_from == user()->id;
            app('vnk')->view('_delete_form', $data);
        }
    }

    public function ajax_count_unread()
    {
        echo $this->messages->count_unread();
    }

    public function ajax_notif_unread()
    {
        $data['messages'] = $this->messages->notif_unread();
        app('vnk')->view('_notif', $data);
    }

    public function json_users()
    {
        $users = array();
        foreach (users() as $user) {
            if ($user->id != user()->id) {
                $users[] = array(
                    'id' => $user->id,
                    'email' => $user->email
                );
            }
        }
        header('Content-Type:application/json; charset=UTF-8');
        echo json_encode($users);
        exit();
    }
}
