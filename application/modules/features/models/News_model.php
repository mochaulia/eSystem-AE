<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tables = 'news';
        $this->order_by = array();
        $this->limit = null;
        $this->start = null;
    }

    public function select($w = array(), $unique = true)
    {
        if ($this->order_by) {
            $key = first_index_arr($this->order_by);
            $this->db->order_by($key, $this->order_by[$key]);
        }
        if ($this->limit && $this->start) {
            $this->db->limit($this->limit, $this->start);
        } elseif ($this->limit && !$this->start) {
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

    public function search($q)
    {
        $this->db->order_by('id', 'desc');
        $this->db->like('title', $q);
        $this->db->or_like('text', $q);
        return $this->db->get($this->tables)->result();
    }

    public function by_category($cat)
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit(8);
        $this->db->where('category', $cat);
        return $this->db->get($this->tables)->result();
    }

    public function categories_top()
    {
        $this->db->distinct();
        $this->db->order_by('category', 'asc');
        $this->db->where('(`category` = "akademik" OR `category` = "himpunanmahasiswa" OR `category` = "kemahasiswaan")');
        $this->db->select('category');
        return $this->db->get($this->tables)->result();
    }

    public function categories_bottom()
    {
        $this->db->distinct();
        $this->db->order_by('category', 'asc');
        $this->db->where('category !=', 'lainnya');
        $this->db->where('category !=', 'himpunanmahasiswa');
        $this->db->where('category !=', 'kemahasiswaan');
        $this->db->where('category !=', 'akademik');
        $this->db->select('category');
        return $this->db->get($this->tables)->result();
    }
}
