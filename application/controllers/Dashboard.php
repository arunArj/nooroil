<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		$this->data['page_title'] = 'Dashboard';		
		$this->load->model('model_recipe');
		
	}

	public function index()
	{
		$this->data['total_recipes'] = $this->model_recipe->countTotalRecipes();
		$this->data['total_records'] = $this->model_recipe->countTotalUserdata();

		
		$this->render_template('dashboard', $this->data);
	}
}