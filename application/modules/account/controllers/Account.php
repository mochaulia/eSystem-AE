<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		login_required();
	}

	public function change_password()
	{
		$data['title'] = lang('change_password_heading');
		app('vnk')->view('change_password', $data);
	}

	public function edit_profile()
	{
		$this->load->model('majors/majors_model');
		$this->load->model('units/units_model');
		$data['title'] = lang('edit_profile_heading');		
		app('vnk')->view('edit_profile', $data);
	}

	public function logout()
	{
		redirect('auth/logout', 'refresh');
	}

	/*
		AJAX METHOD
	 */
	public function ajax_change_password()
	{
		$notif = array();
		$email = user()->email;
		$old = $this->input->post('old_password');
		$new = $this->input->post('new_password');
		if (app('ion_auth')->change_password($email, $old, $new)) {
			$this->session->set_flashdata('message', app('ion_auth')->messages(false));
			$notif = array(
				'title' => 'Success',
				'text' => $this->session->flashdata('message'),
				'type' => 'success',
			);
		} else {
			$this->session->set_flashdata('message', app('ion_auth')->errors(false));
			$notif = array(
				'title' => 'Failed',
				'text' => $this->session->flashdata('message'),
				'type' => 'warning',
			);
		}
		header('Content-Type:application/json; charset=UTF-8');
		echo json_encode($notif);
	}

	public function ajax_edit_profile()
	{
		$id = user()->id;
		$username = user()->username;
		$email = user()->email;
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'gender' => $this->input->post('gender'),
			'secondary_email' => $this->input->post('secondary_email'),
			'id_major' => $this->input->post('major'),
			'id_unit' => $this->input->post('unit'),
			'phone' => $this->input->post('phone'),
			'home_address' => $this->input->post('home_address'),
		);
		app('ion_auth')->update($id, $data);
	}

	public function ajax_change_ava()
	{
		$upload_config['upload_path'] = './' . config_item('images_path') . config_item('avatar_path');
		$upload_config['allowed_types'] = '*';
		$upload_config['max_size'] = 2048;
		$upload_config['file_name'] = 'avatar' . user()->id . '.jpg';
		$upload_config['overwrite'] = true;
		$this->load->library('upload', $upload_config);
		if ($this->upload->do_upload('croppedAva')) {
			$file = $this->upload->data();
			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = './' . config_item('images_path') . config_item('avatar_path') . $file["file_name"];
			$image_config['maintain_ratio'] = false;
			$image_config['quality'] = '60%';
			$image_config['width'] = 200;
			$image_config['height'] = 200;
			$image_config['new_image'] = './' . config_item('images_path') . config_item('avatar_path') . $file["file_name"];
			$this->load->library('image_lib', $image_config);
			$this->image_lib->resize();
			$data = array(
				'avatar' => config_item('avatar_path') . $file["file_name"],
			);
			app('ion_auth')->update(user()->id, $data);
			echo $file["file_name"];
		} else {
			echo $this->upload->display_errors();
		}
	}
	/*
		/ AJAX METHOD
	 */
}
