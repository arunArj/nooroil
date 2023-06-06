<?php 

class Model_recipe extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
  


	public function getRegisterdData($db_name,$length,$start)
	{
		
		$this->db->limit($length,$start);
		
        $employees = $this->db->get($db_name);
		return $employees->result();
	}
	
	
	public function getUserdata($country)
	{
		if($country=='bahrain'){
			$user = $this->db->get("recipe");
		}
        
		return $user->result();
	}
	public function country_exists($key)
	{
		$this->db->where('name',$key);
		$query = $this->db->get('country_list');
		
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	public function totalRegistration()
	{
		$query = $this->db->select("COUNT(*) as num")->get("recipe");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
	}
	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('recipe');
			
			return ($delete == true) ? true : false;
		}
	}
	public function getRecipeData($id)
	{
		if($id) {
			$sql = "SELECT * FROM `recipe` WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('recipe', $data);
			return ($update == true) ? true : false;
		}
	}
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('recipe', $data);
			return ($insert == true) ? true : false;
		}
	}
	public function getAllRegisterdData()
	{	
				
        $employees = $this->db->get('recipe');
		return $employees->result();
	}
	public function countTotalRecipes()
	{
		$sql = "SELECT * FROM `recipe`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	public function countTotalUserdata()
	{
		$sql = "SELECT * FROM `user_data`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	public function create_customer($data)
	{
		if($data) {
			$insert = $this->db->insert('user_data', $data);
			return ($insert == true) ? true : false;
		}
	}


}
?>