<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Messages_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tables = 'messages';
    }

    public function select($id)
    {
        $w = array(
            'id' => $id
        );
        return $this->db->get_where($this->tables, $w)->row();
    }

    public function inboxes()
    {
        $this->db->limit(20);
        $w = array(
            'id_to' => user()->id,
            'is_delete_to' => 0
        );
        return $this->db->order_by('id', 'desc')->get_where($this->tables, $w)->result();
    }

    public function sents()
    {
        $this->db->limit(20);
        $w = array(
            'id_from' => user()->id,
            'is_delete_from' => 0
        );
        return $this->db->order_by('id', 'desc')->get_where($this->tables, $w)->result();
    }

    public function read($id)
    {
        $w = array(
            'id' => $id
        );
        $r = $this->db->get_where($this->tables, $w)->row();
        if (is_object($r) && $r->id_to == user()->id) {
            $d = array(
                'is_read' => 1
            );
            $this->db->update($this->tables, $d, $w);
        }
        return $r;
    }

    public function send($d)
    {
        return $this->db->insert($this->tables, $d);
    }

    public function count_unread()
    {
        $w = array(
            'is_read' => 0,
            'id_to' => user()->id
        );
        return $this->db->get_where($this->tables, $w)->num_rows();
    }

    public function notif_unread()
    {
        $w = array(
            'is_read' => 0,
            'id_to' => user()->id
        );
        return $this->db->get_where($this->tables, $w)->result();
    }

    public function delete($id, $for)
    {
        $w = array(
            'id' => $id
        );
        if ($for === 'me') {
            $d = array(
                'is_delete_from' => 1
            );
            return $this->db->update($this->tables, $d, $w);
        } elseif ($for === 'all') {
            return $this->db->delete($this->tables, $w);
        }
    }

    public function trash($id)
    {
        $w = array(
            'id' => $id
        );
        $d = array(
            'is_delete_to' => 1
        );
        return $this->db->update($this->tables, $d, $w);
    }
}
