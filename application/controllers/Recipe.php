<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Recipe';
		$this->load->model('model_recipe');
        $this->load->library('encryption');
        $this->load->helper('security');
		
	}
	public function list()
	{
		
		$this->render_template('recipe/index', $this->data);
	}
	public function fetchRecord()
    {
	
		$db_name = 'recipe';
		$draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");

        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'en_name',
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        

        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {   
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            } 
            $this->db->group_end();
        }
		$rdata = $this->model_recipe->getRegisterdData($db_name,$length,$start);
		// echo "<pre>";
		// print_r($rdata);
		// exit();


        $data = array();
		$no = $start+1;
        foreach($rdata as $rows)
        {

            $buttons = '';
            $buttons .= ' <a href="'.base_url('recipe/update/'.$rows->id).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$rows->id.')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            $data[]= array(
				$no,
                $rows->en_name,
                $buttons,
            ); 
			$no++;
        }
        //$total_employees = $this->totalEmployees();
		$total_employees = $this->model_recipe->totalRegistration();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function remove()
    {
        

        $parti_id = $this->input->post('parti_id');

        $response = array();
        if($parti_id) {
            $delete = $this->model_recipe->remove($parti_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
    }
    public function update($id)
    {
        

        if(!$id) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Manage Recipe';

        $this->form_validation->set_rules('recipe_name', 'First Name', 'trim|required');
        
    
        if ($this->form_validation->run() == TRUE) { 
            $data = array(
                    'en_name' => $this->input->post('recipe_name'),
                    'en_country' => $this->input->post('country'),
                    'en_kcal' => $this->input->post('calories'),
                    'en_cooking_time' => $this->input->post('cooking_time'),
                    'en_n_people' => $this->input->post('num_of_people'),
                    'en_ingredients' => $this->input->post('ingredients'),
                    'en_instruction' => $this->input->post('instruction'),
                    'en_notes' => $this->input->post('note'),
                    'ar_name' => $this->input->post('ar_recipe_name'),
                    'ar_country' => $this->input->post('ar_country'),
                    'ar_kcal' => $this->input->post('ar_calories'),
                    'ar_cooking_time' => $this->input->post('ar_cooking_time'),
                    'ar_n_people' => $this->input->post('ar_num_of_people'),
                    'ar_ingredients' => $this->input->post('ar_ingredients'),
                    'ar_instruction' => $this->input->post('ar_instruction'), 
                    'ar_notes' => $this->input->post('ar_note')

                );
            $data = $this->security->xss_clean($data);
            
            if($_FILES['recipe_images']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_recipe->update($upload_image, $id);
            }
            if($_FILES['pdf_upload']['size'] > 0) {
                $upload_image = $this->upload_file();
                $upload_image = array('pdf' => $upload_image);
                
                $this->model_recipe->update($upload_image, $id);
            }
            if($_FILES['pdf_upload_arabic']['size'] > 0) {
                $upload_image = $this->upload_file_arabic();
                $upload_image = array('pdf_arabic' => $upload_image);
                
                $this->model_recipe->update($upload_image, $id);
            }
            
            $update = $this->model_recipe->update($data, $id);
            
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('recipe/update/'.$id, 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('recipe/update/'.$id, 'refresh');
            }
        }
        else {
            // false case
            
            $result = array();
            $recipe_data = $this->model_recipe->getRecipeData($id);
                      

            // echo "<pre>";
            // print_r($p_data);
            // exit();
            
            $this->data['order_data'] = $recipe_data;      

            $this->render_template('recipe/edit', $this->data);
        }
    }
    public function upload_image()
    {
        
        $config['upload_path'] = 'assets/images/recipe_images';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('recipe_images'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['recipe_images']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }
    public function upload_file()
    {        
         
        $config['upload_path'] = 'assets/images/recipe_pdf';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '10000000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('pdf_upload'))
        {
            // echo "error";
            // exit();
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['pdf_upload']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }             
        
    }
    public function upload_file_arabic()
    {        
         
        $config['upload_path'] = 'assets/images/recipe_pdf';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '10000000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('pdf_upload_arabic'))
        {
            // echo "error";
            // exit();
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['pdf_upload_arabic']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }             
        
    }
    public function create()
    {        
        // echo "hii";
        // exit();
        $upload_image = "";
        $upload_file = "";
        $this->form_validation->set_rules('recipe_name', 'First Name', 'trim|required');       
        
    
        if ($this->form_validation->run() == TRUE) {
            // true case
            $upload_image = $this->upload_image();
            $upload_file = $this->upload_file();

            $data = array(
                'en_name' => $this->input->post('recipe_name'),
                'en_country' => $this->input->post('country'),
                'en_kcal' => $this->input->post('calories'),
                'en_cooking_time' => $this->input->post('cooking_time'),
                'en_n_people' => $this->input->post('num_of_people'),
                'en_ingredients' => $this->input->post('ingredients'),
                'en_instruction' => $this->input->post('instruction'),
                'en_notes' => $this->input->post('note'),
                'ar_name' => $this->input->post('ar_recipe_name'),
                'ar_country' => $this->input->post('ar_country'),
                'ar_kcal' => $this->input->post('ar_calories'),
                'ar_cooking_time' => $this->input->post('ar_cooking_time'),
                'ar_n_people' => $this->input->post('ar_num_of_people'),
                'ar_ingredients' => $this->input->post('ar_ingredients'),
                'ar_instruction' => $this->input->post('ar_instruction'), 
                'ar_notes' => $this->input->post('ar_note'),
                'image' => $upload_image,
                'pdf' => $upload_file
            );
         $data = $this->security->xss_clean($data);
            $create = $this->model_recipe->create($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('recipe/list', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('recipe/create', 'refresh');
            }
        }
        else {
            
            $this->render_template('recipe/create', $this->data);
        }
    }
    
    // ############ User Data ###########################

    public function userData()
    {
        $this->data['page_title'] = 'Data';
        
        $this->render_template('recipe/user_data', $this->data);
    }
    public function fetchRecordUser()
    {

    
        $db_name = 'user_data';
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");

        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'name',
            1=>'email',
            2=>'location',
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        

        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {   
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            } 
            $this->db->group_end();
        }
        $rdata = $this->model_recipe->getRegisterdData($db_name,$length,$start);


        $data = array();
        $no = $start+1;
        foreach($rdata as $rows)
        {

            $email = '';
            $email .= ' <a href="mailto:'.$this->encryption->decrypt($rows->email).'">'.$this->encryption->decrypt($rows->email).'</a>';
            
            $data[]= array(
                $no,
                $this->encryption->decrypt($rows->name),
                $email,
                $this->encryption->decrypt($rows->mobile),
                $this->encryption->decrypt($rows->location),
                $rows->added_on,
            ); 
            $no++;
        }
        //$total_employees = $this->totalEmployees();
        $total_employees = $this->model_recipe->totalRegistration();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

}