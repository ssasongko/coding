<?php

function is_logged_in()
{
	$ci = get_instance();
	if(!$ci->session->userdata('username'))
	{
		redirect('auth');
	}
	else
	{
		$role_id = $ci->session->userdata('role_id');
		$menu = $ci->uri->segment(1);


		$q = $ci->db->get_where('user_menu',['menu' => $menu])->row_array();
		$m = $q['id'];

		$u = $ci->db->get_where('user_access_menu',[
			'role_id' => $role_id,
			'menu_id' => $m
		]);

		if($u->num_rows()<1){
			redirect('auth/blocked');
		}
	}
}