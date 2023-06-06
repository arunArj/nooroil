<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
		$this->load->helper('security');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{

		$this->logged_in();

		$this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$username_exists = $this->model_auth->check_username($this->security->xss_clean($this->input->post('username')));
           	if($username_exists == TRUE) {
           		$login = $this->model_auth->login($this->security->xss_clean($this->input->post('username')), $this->security->xss_clean($this->input->post('password')));

           		if($login) {

           			$logged_in_sess = array(
           				'id' => $login['id'],
				        'username'  => $login['username'],
				        'logged_in' => TRUE
					);
                    $this->session->set_userdata($logged_in_sess);        				
           					
           				redirect('dashboard', 'refresh');        				
           				
				
           		}
           		else {
           			$this->data['errors'] = 'Incorrect username/password combination';
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
           		$this->data['errors'] = 'User Name does not exists';

           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('login');
        }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
