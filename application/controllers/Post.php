<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('post_model');
		$this->load->library('form_validation');
		$this->load->helper('file');
		$this->load->helper('url');
	}

	public function add_sector(){
		if($this->input->post('btnsave')){
			$sector_name = $this->input->post('sector_name');
			$sector_id = $this->input->post('sector_id');
			$desired_price_variable = $this->input->post('desired_price_variable');

			$sec_data = array(
			        'sector_name'=>$sector_name,
			        'sector_id' => $sector_id,
			        'desired_price_variable' => $desired_price_variable
			    );
			$insert = $this->db->insert('sector_details',$sec_data);

			if($insert == true){
				$this->session->set_flashdata('inserted', 'Sector Details Inserted.');
				redirect ('admin/dash');
			}else{
				$this->session->set_flashdata('error', 'Sector Details Inserted.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function add_company(){
		if($this->input->post('btnsave')){
			$com_id = $this->input->post('com_id');
			$company_name = $this->input->post('company_name');
			$symbol = $this->input->post('symbol');
			$book_value = $this->input->post('book_value');
			$eps_value = $this->input->post('eps_value');
			$cagr = $this->input->post('cagr');
			$sector_id = $this->input->post('sector_id');
			$share_price = $this->input->post('share_price');
			$beg_price = $this->input->post('beg_price');
			$beg_price_year = $this->input->post('beg_price_year');

			$c_data = array(
					'com_id'=>$com_id,
			        'company_name'=>$company_name,
			        'symbol' => $symbol,
			        'share_price' => $share_price,
			        'book_value' => $book_value,
			        'eps_value' => $eps_value,
			        'cagr' => $cagr,
			        'sector' => $sector_id,
			        'beg_price' => $beg_price,
			        'beg_price_year' => $beg_price_year,
			    );
			$insert = $this->db->insert('company_info',$c_data);

			if($insert == true){
				$this->session->set_flashdata('inserted', 'Company Details Inserted.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// add safety value

	public function add_safety_value(){
		if($this->input->post('btnsave')){

			if(empty($this->input->post('btnsave')) ){
				$this->session->set_flashdata('error', 'Please Select a Choice.');
				redirect ('admin/dash');
			}else{
			$sector = $this->input->post('sector_id');
			$pe_ratio = $this->input->post('pe_ratio');
			$desirable_pb_ratio = $this->input->post('desirable_pb_ratio');
			$eps_vs_pe = $this->input->post('eps_vs_pe');

			$c_data = array(
					'sector_id' => $sector,
			        'pe_ratio'=>$pe_ratio,
			        'desirable_pb_ratio' => $desirable_pb_ratio,
			        'eps_vs_pe' => $eps_vs_pe
			    );
			$insert = $this->db->insert('safety_value',$c_data);

			if($insert == true){
				$this->session->set_flashdata('inserted', 'Safety Details Inserted.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			}
		  }
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

// import 
	public function import_company_details(){

		if($this->input->post('importSubmit')){
			$insertCount = $updateCount = $rowCount = $notAddCount = 0;

			$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

				if(in_array($_FILES['file']['type'],$mimes)){

					if(is_uploaded_file($_FILES['file']['tmp_name'])){
						$this->load->library('CSVReader');
                    
                    	// Parse data from CSV file
                    	$csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            
                            // Prepare data for DB insertion
                            $memData = array(
                            	'com_id' => $row['com_id'],
                                'company_name' => $row['company_name'],
                                'symbol' => $row['symbol'],
                                'share_price' => $row['share_price'],
                                'book_value' => $row['book_value'],
                                'eps_value' => $row['eps_value'],
                                'cagr' => $row['cagr'],
                                'sector' => $row['sector'],
                            );

                            $con = $row['symbol'];
                            $prevCount = $this->admin_model->check_company_record($con);
                            
                                // Insert member data
                                $insert = $this->admin_model->insert('company_info', $memData);
                                if($insert){
                                    $insertCount++;
                                }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Details imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
				}else{
					redirect($_SERVER['HTTP_REFERER']);
				}
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			} // end of mime check
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		} //
	} // end of function

	// inport sector details
	public function import_sector_details(){

		if($this->input->post('importSubmit')){
			$insertCount = $updateCount = $rowCount = $notAddCount = 0;

			$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

				if(in_array($_FILES['file']['type'],$mimes)){

					if(is_uploaded_file($_FILES['file']['tmp_name'])){
						$this->load->library('CSVReader');
                    
                    	// Parse data from CSV file
                    	$csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                    	
                        foreach($csvData as $row){ $rowCount++;
                            
                            // Prepare data for DB insertion
                            $secData = array(
                                'sector_name' => $row['sector_name'],
                                'sector_id' => $row['sector_id'],
                                'desired_price_variable' => $row['desired_price_variable']
                            );

                            $con1 = $row['sector_name'];
                            $con2 = $row['sector_id'];
                            $k=0;
                            $prevCount = $this->admin_model->check_condition($con1, $con2);
                            echo '<pre>';
                            // var_dump($prevCount);
                            if($prevCount == true){
                            	// echo "proceed update";die;

                            	foreach ($prevCount as $pkey => $pval) {
                            		$s_id = $pval['id'];

                            		$insert = $this->post_model->update_db('sector_details', $secData, $s_id);
                            	}
                            }else{
                            	$insert = $this->post_model->insert_form('sector_details', $secData);
                            }
                                // Insert member data
                                // $insert = $this->admin_model->insert('sector_details', $secData);
                                // if($insert){
                                //     $insertCount++;
                                // }
                                // echo "submitted";
                        }
                        
                        // Status message with imported data count
                        // $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        // $successMsg = 'Details imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        // $this->session->set_userdata('success_msg', $successMsg);
                        $this->session->set_flashdata('inserted', 'Manual Details Inserted.');
						redirect ('admin/view-all-sector');
                    }
				}else{
					redirect($_SERVER['HTTP_REFERER']);
				}
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			} // end of mime check
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		} //
	} // end of function


	// update safety value
	public function update_safety_value(){
		$pe_ratio = $this->input->post('pe_ratio');
		$desirable_pb_ratio = $this->input->post('desirable_pb_ratio');
		$eps_vs_pe = $this->input->post('eps_vs_pe');
		$id = $this->input->post('safety_id');

		$c_data = array(
			    'pe_ratio'=>$pe_ratio,
			    'desirable_pb_ratio' => $desirable_pb_ratio,
			    'eps_vs_pe' => $eps_vs_pe
			    );
		$update_safety = $this->post_model->update_db('safety_value',$c_data, $id);

		if($update_safety == true){
			$this->session->set_flashdata('inserted', 'Update Successful.');
			redirect ('admin/dash');
		}else{
			$this->session->set_flashdata('inserted', 'Error in Update.');
			redirect ('admin/dash');
		}
	}

	public function update_company(){
		if($this->input->post('btnsave')){
			$com_id = $this->input->post('com_id');
			$company_name = $this->input->post('company_name');
			$symbol = $this->input->post('symbol');
			$book_value = $this->input->post('book_value');
			$eps_value = $this->input->post('eps_value');
			$cagr = $this->input->post('cagr');
			$sector_id = $this->input->post('sector_id');
			$share_price = $this->input->post('share_price');
			$beg_price = $this->input->post('beg_price');
			$beg_price_year = $this->input->post('beg_price_year');
			$id = $this->input->post('id');

			$c_data = array(
					'com_id'=>$com_id,
			        'company_name'=>$company_name,
			        'symbol' => $symbol,
			        'share_price' => $share_price,
			        'book_value' => $book_value,
			        'eps_value' => $eps_value,
			        'cagr' => $cagr,
			        'sector' => $sector_id,
			        'beg_price' => $beg_price,
			        'beg_price_year' => $beg_price_year
			    );
			// echo $id;
			// print_r($c_data);die;
			$update = $this->post_model->update_record_by_id('company_info',$c_data, $id);

			if($update == true){
				$this->session->set_flashdata('inserted', 'Company Details Updated.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('error', 'Something went wrong.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// update sector
	public function update_sector(){
		if($this->input->post('btnsave')){
			$sector_name = $this->input->post('sector_name');
			$sector_id = $this->input->post('sector_id');
			$desired_price_variable = $this->input->post('desired_price_variable');
			$id = $this->input->post('rec_id');

			$sec_data = array(
			        'sector_name'=>$sector_name,
			        'sector_id' => $sector_id,
			        'desired_price_variable' => $desired_price_variable
			    );
			$update = $this->post_model->update_record_by_id('sector_details',$sec_data, $id);

			if($update == true){
				$this->session->set_flashdata('inserted', 'Sector Details Updated.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('error', 'Something went wrong.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

		public function insert_year(){
		if($this->input->post('btnsave') && !empty($this->input->post('financial_year'))){
			$financial_year = $this->input->post('financial_year');
			$status = $this->input->post('status');

			$sec_data = array(
			        'financial_year' => $financial_year,
			        'status' => $status
			    );

			$insert = $this->post_model->insert_form('financial_year',$sec_data);

			if($insert == true){
				$this->session->set_flashdata('inserted', 'Financial year Details Inserted.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('error', 'Duplicate Entry. Please Try Again.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('error', 'Please Select Financial Year');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function insert_cagr(){
		if($this->input->post('btnsave')){
			$symbol = $this->input->post('symbol');
			$year = $this->input->post('year');
			
			$dividend = $this->input->post('dividend');
			// $dividend_gain = $this->input->post('dividend_gain');
			$bonus = $this->input->post('bonus');
			// $bonus_gain = $this->input->post('bonus_gain');
			$count = count($dividend);

			$company_inf = $this->post_model->get_company_name_by_symbol($symbol);
			$company_name = $company_inf[0]['company_name'];
			
			$c_data = array(
						'company_name' => $company_name,
						'symbol'=> $symbol,
			);

			$insert = $this->post_model->insert_form('cagr_main_tbl',$c_data);
			$result = $this->post_model->get_inserted_primary_data_id('cagr_main_tbl')->row();
			$primary_data_id = $result->id;

			for ($i=0; $i < $count; $i++) { 

				if (!empty($dividend[$i]) || !empty($bonus[$i])){
					
					$co_data = array(
						'cagr_com_id'=>$primary_data_id,
				        'financial_year'=>$year[$i],
				        'dividend' => $dividend[$i],
				        // 'dividend_gain' => $dividend_gain[$i],
				        'bonus' => $bonus[$i],
				        // 'bonus_gain' => $bonus_gain[$i],
				    );

				    // print_r($co_data);die;
				$insert_m = $this->post_model->insert_form('cagr_data_tbl',$co_data);
				}
			}
			
			if($insert == true){
				$this->session->set_flashdata('inserted', 'CAGR Details Inserted.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('error', 'Duplicate Entry Exists.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// update cagr records
	public function update_cagr(){
		if($this->input->post('btnupdate')){
			$id = $this->input->post('id');
			$symbol = $this->input->post('symbol');
			$year = $this->input->post('year');
			
			$dividend = $this->input->post('dividend');
			// $dividend_gain = $this->input->post('dividend_gain');
			$bonus = $this->input->post('bonus');
			// $bonus_gain = $this->input->post('bonus_gain');
			$rec_id = $this->input->post('rec_id');
			$count = count($year);

			$company_inf = $this->post_model->get_company_name_by_symbol($symbol);
			$company_name = $company_inf[0]['company_name'];
			
			// update company details
			$share_price = $this->input->post('paid_up_capital');
			$beg_price = $this->input->post('beg_price');
			$cc_id = $this->input->post('companyid');
			$comp_data = array(
				'share_price' => $share_price,
				'beg_price'=> $beg_price,
			);
			$update_comp = $this->post_model->update_record_by_id('company_info',$comp_data, $cc_id);

			$c_data = array(
				'company_name' => $company_name,
				'symbol'=> $symbol,
			);

			$update = $this->post_model->update_record_by_id('cagr_main_tbl',$c_data, $id);

			for ($i=0; $i < $count; $i++) { 

				// if (!empty($dividend[$i]) || !empty($bonus[$i])){
					
					$co_data = array(
						// 'cagr_com_id'=>$id,
				        'financial_year'=>$year[$i],
				        // 'dividend_gain' => $dividend_gain[$i],
				        'dividend' => $dividend[$i],
				        'bonus' => $bonus[$i],
				    );

				// print_r($co_data);die;
				$update_data = $this->post_model->update_record_by_id('cagr_data_tbl',$co_data, $rec_id[$i]);
				// }

			}
			
			if($this->input->post('years') || $this->input->post('dividend2') || $this->input->post('bonus2')){
				$year2 = $this->input->post('years');
				// $beg_price2 = $this->input->post('beg_price2');
				$dividend2 = $this->input->post('dividend2');
				$bonus2 = $this->input->post('bonus2');
				$countj = count($year2);

				for ($j=0; $j < $countj; $j++) {
					if (!empty($dividend2[$j]) || !empty($bonus2[$j])){ 
				$new_data = array(
						'cagr_com_id'=>$id,
				        'financial_year'=>$year2[$j],
				        // 'beg_price' => $beg_price2[$j],
				        'dividend' => $dividend2[$j],
				        'bonus' => $bonus2[$j],
				    );

				    // print_r($co_data);die;
				$insert_new = $this->post_model->insert_form('cagr_data_tbl',$new_data);
					}
			   }
			}

			if($update == true){
				$this->session->set_flashdata('inserted', 'CAGR Details Updated.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('error', 'Update Failed.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// insert portfolio
	public function insert_portfolio(){
		if($this->input->post('btn_portfolio')){

			$user_id = $this->session->userdata('user_id');

			$symbol = $this->input->post('symbol');
			$price = $this->input->post('price');
			$kitta = $this->input->post('kitta');
			$total = $price * $kitta;
			$purchased_date = $this->input->post('purchased_date');

			$c_data = array(
			        'symbol' => $symbol,
			        'price' => $price,
			        'kitta' => $kitta,
			        'total' => $total,
			        'purchased_date' => $purchased_date,
			        'user_id' => $user_id,
			    );
			$insert = $this->post_model->insert_form('portfolio',$c_data);

			if($insert == true){
				$this->session->set_flashdata('inserted', 'Portfolio Details Inserted.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// update portfolio
	public function update_portfolio(){
		if($this->input->post('btn_portfolio')){

			$user_id = $this->session->userdata('user_id');
			$id = $this->input->post('id');
			$symbol = $this->input->post('symbol');
			$price = $this->input->post('price');
			$kitta = $this->input->post('kitta');
			$total = $price * $kitta;
			$purchased_date = $this->input->post('purchased_date');

			$c_data = array(
			        'symbol' => $symbol,
			        'price' => $price,
			        'kitta' => $kitta,
			        'total' => $total,
			        'purchased_date' => $purchased_date,
			    );
			$update = $this->post_model->update_record_by_id('portfolio',$c_data, $id);

			if($update == true){
				$this->session->set_flashdata('inserted', 'Portfolio Details Updated.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function import_benefit(){
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		if($this->input->post('importSubmit')){
			$insertCount = $updateCount = $rowCount = $notAddCount = 0;

			$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
			
				if(in_array($_FILES['file']['type'],$mimes)){
					
					if(is_uploaded_file($_FILES['file']['tmp_name'])){
						$this->load->library('CSVReader');
                    
                    	// Parse data from CSV file
                    	$csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                    	
                        foreach($csvData as $row){ $rowCount++;
                            
                            // Prepare data for DB insertion
                            $secData = array(
                                'symbol' => $row['symbol'],
							);
							// preparing for the company symbol 
                            $con1 = $row['symbol'];
                            $k=0;
							$prevCount = $this->admin_model->check_condition_benefit($con1);
							
							// echo '<pre>';
							// print_r($prevCount);
                            // var_dump($prevCount);
                            if($prevCount == true){
                            	// echo "proceed update";die;
								$p_id = $prevCount[0]['id'];

                            	foreach ($prevCount as $pkey => $pval) {
                            		$s_id = $pval['id'];

									// $update = $this->post_model->update_db('cagr_data_tbl', $secData, $s_id)
									
									$secData2 = array(
										'financial_year' => $row['financial_year'],
										'cagr_com_id' => $s_id,
										'dividend' => $row['dividend'],
										'bonus' => $row['bonus'],
									);
	
									$insert2 = $this->post_model->insert_form('cagr_data_tbl', $secData2);
                            	}
                            }else{
								$insert = $this->post_model->insert_form('cagr_main_tbl', $secData);
								$last_id = $this->db->insert_id();

								$result = $this->post_model->get_inserted_primary_data_id('cagr_main_tbl');
								$primary_data_id = $result->id;


								$secData2 = array(
									'financial_year' => $row['financial_year'],
									'cagr_com_id' => $last_id,
									'dividend' => $row['dividend'],
									'bonus' => $row['bonus'],
								);

								$insert2 = $this->post_model->insert_form('cagr_data_tbl', $secData2);
                            }
                        }
                        
                        $this->session->set_flashdata('inserted', 'Benefit Details Inserted.');
						redirect ('admin/add_benefit');
                    }
				}else{
					redirect($_SERVER['HTTP_REFERER']);
				}
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			} // end of mime check
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		} //
	} // end of function
}