<?php 

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
}

class Admin_Controller extends MY_Controller 
{
	var $permission = array();

	public function __construct() 
	{
		parent::__construct();

		$group_data = array();
		if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
		}
		else {
			$user_id = $this->session->userdata('id');
		}
	}

	public function logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == TRUE) {
			redirect('recipe/list/', 'refresh');
		}
	}

	public function not_logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == FALSE) {
			redirect('auth/login', 'refresh');
		}
	}

	public function render_template($page = null, $data = array())
	{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/header_menu',$data);
		$this->load->view('templates/side_menubar',$data);
		$this->load->view($page, $data);
		$this->load->view('templates/footer',$data);
	}
	public function check_admin()
	{
		$session_data = $this->session->userdata();

		if($session_data['role'] != 'admin') {
			redirect('auth/login', 'refresh');
		}
	}

		
	
}