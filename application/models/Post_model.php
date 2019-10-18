<?php

class Post_model extends CI_Model
{

	public function __construct(){

		$this->load->database();
	}
	
	public function insert_form($tablename , $data){

		if ($this->db->insert($tablename, $data)) {
			return true;
		}else{
			return false;
		}
	}

	public function update_record($tablename , $data, $symbol){
		$this->db->where('symbol', $symbol);
		$this->db->update($tablename ,$data);
		return true;
	}

	public function update_record_by_id($tablename , $data, $id){
		$this->db->where('id', $id);
		
		if ($this->db->update($tablename ,$data)) {
			return true;
		}else{
			return false;
		}
	}
	
	public function update_cagr_data_record_by_id($tablename , $data, $id, $rec_id){
		$this->db->where('cagr_com_id', $rec_id);
		$this->db->where('id', $id);
		$this->db->update($tablename ,$data);
		return true;
	}

	public function update_db($tablename , $data, $id){
		$this->db->where('id', $id);
		$this->db->update($tablename ,$data);
		return true;
	}

	public function get_marketinfo(){
		date_default_timezone_set('Asia/Kathmandu');
		$now = date('Y-m-d');

		$this->db->select('*');
		$this->db->where('inserted_date like', $now . '%');
		$query = $this->db->get('shareinfo'); 
		if ($query->row_array() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_marketinfo_normal(){

		$this->db->select('*');
		// $this->db->where('inserted_date like', $now . '%');
		$query = $this->db->get('shareinfo'); 
		if ($query->row_array() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function insert_live_in_db($data){
		$tbl_name = 'shareinfo';
		if ($this->db->insert($tbl_name, $data)) {
			return true;
		}else{
			return false;
		}
	}

	public function check_duplicate($val){
		$this->db->select('*');
		$this->db->where('symbol', $val);
		$query = $this->db->get('shareinfo'); 
		if ($query->row_array() > 0){
			return $query->num_rows();
		}else{
			return false;
		}
	}

	public function get_inserted_primary_data_id($table){

		// $this->db->select('id');
		// $this->db->order_by('id', 'DESC');
		// $query = $this->db->get($table);
		// if ($query->num_rows() > 0){
		// 	return $query->result_array();
		// }else{
		// 	return false;
		// }
	}

	public function get_company_name_by_symbol($symbol, $table = 'company_info'){

		$this->db->select('company_name');
		$this->db->where('symbol', $symbol);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}

}