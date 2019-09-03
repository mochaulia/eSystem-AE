<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tables = 'gallery';
        $this->order_by = array();
        $this->limit = null;
        $this->start = null;
    }

    public function insert($d = array())
    {
        return $this->db->insert($this->tables, $d);
    }

    public function select($w = array(), $unique = true)
    {
        if ($this->order_by) {
            $key = first_index_arr($this->order_by);
            $this->db->order_by($key, $this->order_by[$key]);
        }
        if ($this->limit && $this->start) {
            $this->db->limit($this->limit, $this->start);
        }
        elseif ($this->limit && !$this->start) {
            $this->db->limit($this->limit);
        }
        if ($w) {
            $q = $this->db->get_where($this->tables, $w);
            if ($q->num_rows() == 1 && $unique) {
                return $q->row();
            }
        } else {
            $q = $this->db->get($this->tables);
        }
        return $q->result();
    }

    public function update($d = array(), $w = array())
    {
        $this->db->update($this->tables, $d, $w);
    }

    public function delete($w = array())
    {
        $this->db->delete($this->tables, $w);
    }
}
