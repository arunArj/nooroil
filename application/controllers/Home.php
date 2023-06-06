<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_recipe');
		$this->load->helper('security');
        $this->load->library('encryption');
		
	}
	public function en()
	{
		$recipe_data = $this->model_recipe->getAllRegisterdData();
		$data['recipes_data'] = $recipe_data;		

		$this->load->view('front/landing_er',$data);

	}
	public function ar()
	{
		$recipe_data = $this->model_recipe->getAllRegisterdData();
		$data['recipes_data'] = $recipe_data;
		$this->load->view('front/landing_ar',$data);

	}
	public function recipe($id)
	{
		$data['recipe_data'] = $this->model_recipe->getRecipeData($id);
	if(!$data['recipe_data']){
	    show_404();
	    exit;
	}

		$this->load->view('front/single_en',$data);
	}
	public function recipe_ar($id)
	{
		$data['recipe_data'] = $this->model_recipe->getRecipeData($id);
		if(!$data['recipe_data']){
    	    show_404();
    	    exit;
	    }

		$this->load->view('front/single_ar',$data);
	}
	public function createUser()
	{
		$lang = $this->input->post('lang');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('country', 'Contry', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');       
        
    
        if ($this->form_validation->run() == TRUE) {

            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'location' => $this->input->post('country'),
                'mobile' => $this->input->post('mobile'),
            );
            $data = $this->security->xss_clean($data);
            $encryptedData =array(
                'name' => $this->encryption->encrypt($data['name']),
                'email' => $this->encryption->encrypt($data['email']),
                'location' => $this->encryption->encrypt($data['location']),
                'mobile' => $this->encryption->encrypt($data['mobile']),
            );
            $create = $this->model_recipe->create_customer( $encryptedData);
            if($create) {
                if($lang == 'eng'){
                    
                    $this->session->set_flashdata('success', 'Thank you....');
                    redirect('en', 'refresh');
                }
                else{
                    
                    $this->session->set_flashdata('success', 'شكرا لك.');
                    redirect('ar', 'refresh');
                }
                
                
            }
            else {
                if($lang == 'eng'){
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('en', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('errors', 'حدث خطأ');
                    redirect('ar', 'refresh');
                }
                
                
            }
        }
        else {
            
            $recipe_data = $this->model_recipe->getAllRegisterdData();
			$data['recipes_data'] = $recipe_data;		

			$this->load->view('front/landing_er',$data);
        }
	}
}