<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menus_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tables = 'menus';
    }

    public function select($where = array())
    {
        if ($where) {
            $q = $this->db->get_where($this->tables, $where);
            if ($q->num_rows() == 1) {
                return $q->row();
            }
        } else {
            $q = $this->db->get($this->tables);
        }
        return $q->result();        
    }
}
