<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
		
	public function index()
	{
		$data['title'] = 'My Profile';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/user_footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profil';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();

		$this->form_validation->set_rules('nama','nama','required|trim',[
			'required' => 'nama jangan kosong'
		]);

		if ($this->form_validation->run() == false) {
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('user/edit',$data);
		$this->load->view('templates/user_footer');
		}
		else{
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');

			// cek jika ada gambar di upload
			$gambarupload = $_FILES['image']['name'];
			if($gambarupload){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profil/';

				$this->load->library('upload',$config);

				if($this->upload->do_upload('image'))
				{
					$gambarlama = $data['petugas']['gambar'];
					if($gambarlama != 'default.jpg'){
						unlink(FCPATH . 'assets/img/profil/' . $gambarlama);
					}
					$gambarbaru = $this->upload->data('file_name');
					$this->db->set('gambar',$gambarbaru);
				}
				else
				{
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('nama',$nama);
			$this->db->where('username', $username);
			$this->db->update('petugas');

			$this->session->set_flashdata('message','<div class="alert alert-success">berhasil diubah</div>');
			redirect('user');
		}
	}	
}