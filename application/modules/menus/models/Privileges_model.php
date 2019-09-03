<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privileges_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tables = 'users_menus';
    }

    public function reset_user_menu($user_id)
    {
        $w = array(
            'user_id' => $user_id
        );
        $this->db->delete($this->tables, $w);
    }

    public function add_to_menu($menu_id, $user_id, $crud = array())
    {
        $d = array(
            'menu_id' => $menu_id,
            'user_id' => $user_id,
            'is_create' => $crud['create'],
            'is_read' => $crud['read'],
            'is_update' => $crud['update'],
            'is_delete' => $crud['delete'],
        );

        $this->db->insert($this->tables, $d);
    }

    public function is($user_id, $crud, $menu_id)
    {
        $w = array(
            'menu_id' => $menu_id,
            'user_id' => $user_id,
        );
        $q = $this->db->get_where($this->tables, $w);
        if ($q->num_rows() == 1) {
            $r = $q->row();
            if ($crud == 'have_access') {
                return (bool)$r->is_create || 
                       (bool)$r->is_read ||
                       (bool)$r->is_update ||
                       (bool)$r->is_delete;
            }
            $crud = 'is_' . $crud;
            return (bool)$r->$crud;
        }
        return false;
    }
}
