<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cplusplus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
		
	public function index()
	{
		$data['title'] = 'Apa itu C++ ?';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('cplusplus/index',$data);
		$this->load->view('templates/user_footer');
	}

	public function ide()
	{
		$data['title'] = 'Apa itu IDE ?';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('cplusplus/ide',$data);
		$this->load->view('templates/user_footer');
	}

	public function hello()
	{
		$data['title'] = 'Hello World !';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('cplusplus/hello',$data);
		$this->load->view('templates/user_footer');
	}

	public function kata()
	{
		$data['title'] = 'Mencetak Sebuah Kata';
		$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
		$this->load->view('templates/user_header',$data);
		$this->load->view('templates/user_sidebar',$data);
		$this->load->view('templates/user_topbar',$data);
		$this->load->view('cplusplus/kata',$data);
		$this->load->view('templates/user_footer');
	}

	public function compiler()
		{
			$data['title'] = 'Compiler';
			$data['petugas'] = $this->db->get_where('petugas',['nama' => $this->session->userdata('nama')])->row_array();
			$this->load->view('templates/user_header',$data);
			$this->load->view('templates/user_sidebar',$data);
			$this->load->view('templates/user_topbar',$data);
			$this->load->view('cplusplus/compiler',$data);
			$this->load->view('templates/user_footer');
			$this->load->view('templates/code_mirror');;
		}		

	public function t_ajax()
	{
		$this->load->model('tutorial_m');
	}
}