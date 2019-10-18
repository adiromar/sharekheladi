<?php

class Admin_model extends CI_Model
{

	public function __construct(){

		$this->load->database();
	}

	public function getRows($data){
		$this->db->where('symbol', $data);
		$this->db->from('safety_value');
		$query = $this->db->get();

		return $query->result_array();
	}

    public function check_company_record($data, $tbl = 'company_info'){
        $this->db->where('symbol', $data);
        $query = $this->db->get($tbl);

        return $query->result_array();
    }

    public function check_condition($con1, $con2){
        $this->db->where('sector_name', $con1);
        $this->db->or_where('sector_id', $con2);
        $this->db->from('sector_details');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function check_condition_benefit($sym){
      $this->db->where('symbol', $sym);
      $this->db->from('cagr_main_tbl');
      $query = $this->db->get();

      return $query->result_array();
  }

  public function check_condition_2($sym){
    $this->db->where('cagr_com_id', $sym);
    $this->db->from('cagr_data_tbl');
    $query = $this->db->get();

    return $query->result_array();
}

	public function insert($table, $data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Insert member data
            $insert = $this->db->insert($table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    // update csv
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update('safety_value', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    // get record of companies
    public function get_rec(){
		$this->db->from('safety_value');
		$query = $this->db->get();

		return $query->result_array();
	}

    public function get_dynamic_info($tbl, $limit){
        // $this->db->where('symbol', $data);
        $this->db->limit($limit);
        $query = $this->db->get($tbl);

        return $query->result_array();
    }

    public function get_benefit_info($tbl, $limit){
      $this->db->group_by('cagr_com_id');
      $this->db->limit($limit);
      $query = $this->db->get($tbl);

      return $query->result_array();
  }

    public function get_dynamic_info_by_id($tbl, $id){
        $this->db->where('id', $id);
        $query = $this->db->get($tbl);

        return $query->result_array();
    }

    public function get_dynamic_info_by_symbol($tbl, $symbol){
      $this->db->where('symbol', $symbol);
      $query = $this->db->get($tbl);

      return $query->result_array();
  }

    public function get_sector_info($tbl){
        // $this->db->where('symbol', $data);
        $this->db->from($tbl);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_constant($cons, $tbl = 'safety_value'){
        $this->db->where('company_id', $cons);
        $this->db->from($tbl);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_eps_bv($cons, $tbl = 'company_info'){
        $this->db->where('symbol', $cons);
        $this->db->from($tbl);
        $query = $this->db->get();

        return $query->result_array();
    }

    // delete record
    public function delete_record($tbl_name, $id){
        $this->db->where("id",$id);
        $this->db->delete($tbl_name);
        return $this->db->affected_rows();
    }

    public function delete_record_mul_tbl($tbl_name, $id){
        $this->db->where("cagr_com_id",$id);
        $this->db->delete($tbl_name);
        return $this->db->affected_rows();
    }

     public function get_sector_id($symbol){
        $this->db->select('sector');
        $this->db->where('symbol', $symbol);
        $query = $this->db->get('company_info');

        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }

    public function get_desired_price($id){
        $this->db->select('desired_price_variable');
        $this->db->where('sector_id', $id);
        $query = $this->db->get('sector_details');

        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }

    public function get_cagr_data($id){
        $this->db->select('*');
        $this->db->where('cagr_com_id', $id);
        $query = $this->db->get('cagr_data_tbl');

        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }

    public function check_inserted_rec($tbl, $sym){
        $this->db->select('symbol');
        $this->db->where('symbol', $sym);
        $query = $this->db->get($tbl);

        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }

    public function check_inserted_portfolio($tbl, $sym,$user){
      $this->db->select('symbol');
      $this->db->where('symbol', $sym);
      $this->db->where('user_id', $user);
      $query = $this->db->get($tbl);

      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return 0;
      }
  }

    public function get_price($symbol){
        $this->db->select('beg_price,share_price');
        $this->db->where('symbol', $symbol);
        $query = $this->db->get('company_info');

        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }

    public function get_marketprice($symbol){
        $this->db->select('market_price');
        $this->db->where('symbol', $symbol);
        $query = $this->db->get('shareinfo');

        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }
    
    // portfolio calculations
    public function get_portfolio_details($user_id){
      $this->db->select('*');
      $this->db->where('user_id', $user_id);
      $query = $this->db->get('portfolio');

      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return 0;
      }
  }

  public function get_cagr_info_by_symbol($sym){
    $this->db->select('id');
    $this->db->where('symbol', $sym);
    $query = $this->db->get('cagr_main_tbl');

    if($query->num_rows() > 0){
      return $query->result_array();
    }else{
      return 0;
      }
    }
    
}