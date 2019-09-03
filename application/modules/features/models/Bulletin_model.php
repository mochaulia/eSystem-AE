<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bulletin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function all_news()
    {
        $all = $this->db->get('news');
        return $all->result();
    }

    public function flash_news()
    {
        $this->db->where('type', 'flashnews');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $q = $this->db->get('news');
        return $q->row();
    }

    public function news_update()
    {
        $this->db->where('type !=', 'flashnews');
        $this->db->order_by('id', 'desc');
        $this->db->limit(4);
        $q = $this->all_news();
        return $q;
    }

    public function category($category)
    {
        $this->db->where('category', $category);
        $this->db->order_by('id', 'desc');
        $this->db->limit(2);
        $this->db->limit(15);
        $q = $this->all_news();
        return $q;
    }

    public function running_text()
    {
        $this->db->where('type', 'flashnews');
        $this->db->order_by('id', 'desc');
        $q = $this->db->get('news');
        return $q->result();
    }

    public function youtube()
    {
        $q = $this->db->get('youtube');
        return $q->row();

    }

    public function update_youtube($d, $w)
    {
        return $this->db->update('youtube', $d, $w);
    }

    public function categories1()
    {
        return array(
            'Internal' => 'internal',
            'Kemahasiswaan' => 'kemahasiswaan',
            'HIMA' => 'himpunanmahasiswa',
            'Seminar' => 'seminar',
            'Lainnya' => 'lainnya',
        );
    }

    public function categories2()
    {
        return array(
            'Akademik' => 'akademik',
            'Lomba' => 'lomba',
            'General' => 'general',
            'Beasiswa' => 'beasiswa',
            'Lowongan Kerja' => 'loker',
        );
    }
}
