<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Inventarisir';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/user_footer');
	}

	public function generate()
	{
		$data['title'] = 'Generate Laporan';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('admin/generate',$data);
		$this->load->view('templates/user_footer');
	}	

	public function access()
	{
		$data['title'] = "Access";
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$data['menu'] = $this->db->get('petugas')->result_array();
		$data['dika'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->result_array();

		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('admin/access',$data);
		$this->load->view('templates/user_footer');		
	}

	public function edit_akses(){
		$data['title'] = "Edit Access";
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$data['terpilih'] = $this->db->get_where('petugas',['id' => $this->uri->segment(3)])->result_array();

		$this->form_validation->set_rules('nomor','Nomor','required');

		if($this->form_validation->run() == false){
			$this->load->view('templates/user_header',$data);
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('templates/user_topbar',$data);
			$this->load->view('admin/edit_akses',$data);
			$this->load->view('templates/user_footer');	
		}
		else{
			$data = [
				'role_id' => $this->input->post('hak')
			];
			$this->db->where('username',$this->input->post('nomor'));
			$this->db->update('petugas',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success">Hak akses telah diganti, akun yang di edit harus di Logout</div>');
			redirect('admin/access');
		}
	}		
}