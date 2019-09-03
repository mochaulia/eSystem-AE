<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_required();
        $this->menus_name = 'gallery';
        $this->model_name = 'gallery/gallery_model';
        $this->model = 'gallery_model';
        $this->join_user = 'uploaded_by';
    }

    /* 
        CONVENTIONAL HTTP METHOD
     */
    public function index()
    {
        // access checking required
        $this->privileges_check('read');
        // view handler
        $this->_index('Gallery');
    }

    public function mine()
    {
        $this->_index('My Gallery');
    }

    public function add($post = null)
    {
        // access checking required
        $this->privileges_check('create');
        // load model
        $this->load->model($this->model_name);
        if ($post == 'post') {
            $upload_config['upload_path'] = './' . config_item('images_path') . config_item('gallery_path');
            $upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
            $upload_config['encrypt_name'] = true;
            $upload_config['max_size'] = 3096;
            $upload_config['max_width'] = 1920;
            $upload_config['max_height'] = 1080;
            $this->load->library('upload', $upload_config);
            if ($this->upload->do_upload('image')) {
                $file = $this->upload->data();
                $this->load->library('image_lib');
                if (config_item('gallery_watermark')) {
                    $wm_config['source_image'] = './' . config_item('images_path') . config_item('gallery_path') . $file["file_name"];
                    $wm_config['wm_text'] = config_item('site_name');
                    $wm_config['wm_type'] = 'text';
                    $wm_config['wm_font_path'] = './system/fonts/texb.ttf';
                    $wm_config['wm_font_size'] = '16';
                    $wm_config['wm_font_color'] = 'ffffff';
                    $wm_config['wm_vrt_alignment'] = 'top';
                    $wm_config['wm_hor_alignment'] = 'left';
                    $wm_config['wm_padding'] = '20';
                    $this->image_lib->initialize($wm_config);
                    if (!$this->image_lib->watermark()) {
                        echo $this->image_lib->display_errors();
                    }
                }
                $resize_config['image_library'] = 'gd2';
                $resize_config['source_image'] = './' . config_item('images_path') . config_item('gallery_path') . $file["file_name"];
                $resize_config['quality'] = '80%';
                $resize_config['maintain_ratio'] = true;
                $resize_config['width'] = 480;
                $resize_config['height'] = 360;
                $resize_config['new_image'] = './' . config_item('images_path') . config_item('gallery_path') . $file["file_name"];
                $this->image_lib->initialize($resize_config);
                if ($this->image_lib->resize()) {
                    $data = array(
                        'uploaded_by' => user()->id,
                        'uploaded_at' => time(),
                        'alt' => $this->input->post('alt'),
                        'path' => config_item('gallery_path') . $file["file_name"]
                    );
                    $this->{$this->model}->insert($data);
                    redirect('gallery/mine');
                } else {
                    echo $this->image_lib->display_errors();
                }
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            // view handler
            $data['title'] = 'Upload Gallery';
            app('vnk')->view('add', $data);
        }
    }
    /*
        / CONVENTIONAL HTTP METHOD
     */


    /*
        AJAX METHOD
     */
    public function ajax_div() // this method is ajax of index
    {
        $this->privileges_check('read');
        $this->load->model($this->model_name);
        $this->{$this->model}->order_by = array('id' => 'desc');
        $data['galleries'] = $this->{$this->model}->select();
        app('vnk')->view('_div', $data);
    }

    public function ajax_div_mine($modal = false)
    {
        $this->load->model($this->model_name);
        $this->{$this->model}->order_by = array('id' => 'desc');
        $data['galleries'] = $this->{$this->model}->select(array($this->join_user => user()->id), false);
        if (!$modal) {
            app('vnk')->view('_div', $data);
        } else {
            app('vnk')->view('_div_modal', $data);
        }
    }

    public function ajax_edit($post = null)
    {
        $this->load->model($this->model_name);
        if ($post == 'post') {
            $gallery_id = $this->input->post('gallery_id');
            if ($this->privileges_check('update', $this->is_mine($gallery_id))) {
                $data = array(
                    'alt' => $this->input->post('alt')
                );
                $where = array(
                    'id' => $gallery_id
                );
                $this->{$this->model}->update($data, $where);
            }
        } else {
            $gallery_id = $_GET['gallery_id'];
            $data['gallery'] = $this->{$this->model}->select(array('id' => $gallery_id));
            app('vnk')->view('_edit_form', $data);
        }
    }

    public function ajax_delete($post = null)
    {
        $this->load->model($this->model_name);
        if ($post == 'post') {
            $gallery_id = $this->input->post('gallery_id');
            if ($this->privileges_check('delete', $this->is_mine($gallery_id))) {
                $this->{$this->model}->delete(array('id' => $gallery_id));
            }
        } else {
            $gallery_id = $_GET['gallery_id'];
            $data['gallery'] = $this->{$this->model}->select(array('id' => $gallery_id));
            app('vnk')->view('_delete_confirm', $data);
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
