<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	private function _login()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// func get_where[nama db,apa yang di where kan]
		// row_array() sebagai mendapat 1 baris database yang dipilih
		$petugas = $this->db->get_where('petugas',['username' => $username])->row_array();

		// $user = $this->db->get_where('user',['email' => $email])->row_array();
	
		if($petugas)
		{
			if(password_verify($password,$petugas['password']))
			{
				$data = [
					'username' => $petugas['username'],
					'nama' => $petugas['nama'],
					'role_id' => $petugas['role_id']
				];
				
				$this->session->set_userdata($data);				

				if($petugas['role_id'] == 1)
				{
					redirect('admin');
				}
				else if ($petugas['role_id'] == 2) {
					redirect('operator');
				}
				{	
					redirect('pegawai');
				}
			}
			else
			{
				$this->session->set_flashdata('message','<div class="alert alert-danger">Password salah</div>');
				redirect('auth');	
			}
		}
		else
		{
				// Jika Tidak ada
			$this->session->set_flashdata('message','<div class="alert alert-danger">Username tidak ter-registrasi</div>');
			redirect('auth');
		}
	}

	// Untuk Memanggil Default Load
	// Untuk Login Page


	public function index()
	{
		if($this->session->userdata('username')){
			redirect('pegawai');
		}		
		
		$this->form_validation->set_rules('username','Username','trim|required',[
			'required' => "username dibutuhkan"
		]);
		$this->form_validation->set_rules('password','Password','trim|required',[
			'required' => "password dibutuhkan"
		]);

		if($this->form_validation->run() == false) {
			$data['title'] = 'codingan | login';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		}
		else{
			// Validasi
			$this->_login();
		}
	}

	public function registration()
	{
		$this->form_validation->set_rules('name','Name','required|trim',[
			'required' => "nama dibutuhkan"
		]);
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[petugas.username]',[
			'is_unique' => "Username telah digunakan, coba yang lain",
			'required' => "username dibutuhkan",
		]);		
		$this->form_validation->set_rules('password1','Password','required|trim|min_length[5]|matches[password2]',[
			'matches' => 'password tidak sama.',
			'min_length' => 'password minimal 5 karakter.',
			'required' => "password harus diisi"
		]);
		$this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');


		if($this->form_validation->run() == false)
		{
			$data['title'] = "codingan | register";
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		}
		else{
			$data = [
				'nama' => htmlspecialchars($this->input->post('name',true)),
				'username' => htmlspecialchars($this->input->post('username',true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'gambar' => 'default.jpg',
				'date_created' => time(),
				'status' => 1
			];

			$this->db->insert('petugas',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success">Data telah tersimpan, silahkan login.</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('username');

		$this->session->set_flashdata('message','<div class="alert alert-success">Logout ok</div>');
		redirect('auth');
	}

	public function blocked()
	{	
		$data['title'] = "Blocked";
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/404');
		$this->load->view('templates/user_footer');
	}
}
 