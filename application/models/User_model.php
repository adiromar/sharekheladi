<?php

class User_model extends CI_Model
{

	public function __construct(){

		$this->load->database();
	}

	public function userLogin($login_condition)
	{
		$result_set = $this->db->get_where("user_login",$login_condition);
		if($result_set->num_rows() > 0)
		{
			return $result_set->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	public function insertUser($log_data)
	{
		if($this->db->insert("user_login", $log_data)){
			return TRUE;
		}else{
			return False;
		}
	}
	
	public function update_user($tablename, $log_data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($tablename ,$log_data);
		return true;
	}

	public function get_user_info(){
		$query = $this->db->get('user_login');
		return $query->result_array();
	}

	public function get_user_info_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('user_login');
		return $query->result_array();
	}
} // end of class user model

?>