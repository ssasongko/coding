<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();


		$this->form_validation->set_rules('menu','Menu','required|is_unique[user_menu.menu]',[
			'required' => 'data gagal ditambahkan',
			'is_unique' => 'tidak boleh menggunakan nama <b>Menu</b> yang sama atau telah ada'
		]);


		if($this->form_validation->run() == false)
		{
			$this->load->view('templates/user_header',$data);
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('templates/user_topbar',$data);
			$this->load->view('menu/index',$data);
			$this->load->view('templates/user_footer');
		}
		else{
			$this->db->insert('user_menu',['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message','<div class="alert alert-success">Menu tertambahkan </div>');
			redirect('menu');
		}
	}

	public function peminjaman(){

		$data['title'] = 'Peminjaman';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
	
		
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('menu/peminjaman',$data);
		$this->load->view('templates/user_footer');
	}
}