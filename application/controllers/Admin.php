<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
        $this->load->model('post_model');
		$this->load->library('form_validation');
		$this->load->helper('file');
        
	}

	public function dash(){
		$data['title'] = 'Dashboard';
        $limit = '5'; // fetch limited record

        $data['comp'] = $this->admin_model->get_dynamic_info('company_info', $limit);
        $data['sector'] = $this->admin_model->get_dynamic_info('sector_details', $limit);
        $data['constant'] = $this->admin_model->get_rec();
        $data['year'] = $this->admin_model->get_dynamic_info('financial_year', '9000');

		$this->load->view('includes/admin_header');
		$this->load->view('admin/dash', $data);
		$this->load->view('includes/admin_footer');
	}

	// public function import_csv(){
	// 	$data['title'] = 'Import Company Info';
	// 	$this->load->view('includes/admin_header');
	// 	$this->load->view('admin/import_csv', $data);
	// 	$this->load->view('includes/admin_footer');
	// }

	public function view_a(){
		$data['title'] = 'View';
		$data['rec'] = $this->admin_model->get_rec();
		$this->load->view('includes/admin_header');
		$this->load->view('admin/view_a', $data);
		$this->load->view('includes/admin_footer');
	}

    public function add_company(){
        $data['title'] = 'Add Company Details';
        $this->load->view('includes/admin_header');
        $this->load->view('admin/add_company', $data);
        $this->load->view('includes/admin_footer');
    }

	public function import(){
        $data = array();
        $memData = array();

        // If import request is submitted, then proceed
        if($this->input->post('importSubmit')){

                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

				if(in_array($_FILES['file']['type'],$mimes)){
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            
                            // Prepare data for DB insertion
                            $memData = array(
                                'company_name' => $row['name'],
                                'symbol' => $row['symbol'],
                                'b_value' => $row['b_value'],
                                'eps_value' => $row['eps_value'],
                            );
                            // print_r($memData);
                            // print_r($memData);die;
                            // Check whether symbol already exists in the database
                            // $con = array(
                            //     'where' => array(
                            //         'symbol' => $row['symbol']
                            //     ),
                            //     'returnType' => 'count'
                            // );
                            $con = $row['symbol'];
                            $prevCount = $this->admin_model->getRows($con);
                            
                            // if($prevCount > 0){
                            //     // Update member data
                            //     $condition = array('symbol' => $row['symbol']);
                            //     $update = $this->admin_model->update($memData, $condition);
                                
                            //     if($update){
                            //         $updateCount++;
                            //     }
                            // }else{

                                // Insert member data
                                $insert = $this->admin_model->insert($memData);
                                if($insert){
                                    $insertCount++;
                                }
                            // }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                	echo "fil not uploaded";
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
            	echo "Invalid file, please select only CSV file.";die;
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }else{
        	echo "form not submitted";
        }
        // redirect('admin/import_csv');
    }

    public function test_upload(){
    	$data = array(
    		'company_name' => 'adml',
    		'symbol' => 'ads',
    		'b_value' => '34',
    		'eps_value' => '43'
    	);
    	$insert = $this->db->insert('manual_value', $data);
    }

    public function delete_record(){
        $tbl = $_GET['tbl'];
        $id = $_GET['id'];
        

        $del =$this->admin_model->delete_record($tbl, $id);

        if($del == true){

            if($_GET['tbl2'] == 'cagr_data_tbl'){
                $tbl2 = $_GET['tbl2'];
                $del2 =$this->admin_model->delete_record_mul_tbl($tbl2, $id);
            }

            $this->session->set_flashdata('inserted', 'Successfully Deleted Record.');
            // header('Location: ' . $_SERVER['HTTP_REFERER']);
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', 'Could not delete record.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // view admin pages part

    public function view_all_company(){
        $data['title'] = 'View Company Details';
        $limit = '5000'; // fetch limited record
        $data['comp'] = $this->admin_model->get_dynamic_info('company_info', $limit);
        $data['sector'] = $this->admin_model->get_dynamic_info('sector_details', $limit);
        $data['year'] = $this->admin_model->get_dynamic_info('financial_year', '9000');
        
        $this->load->view('includes/admin_header');
        $this->load->view('admin/view_all_company', $data);
        $this->load->view('includes/admin_footer');
        
    }

    public function view_all_sector(){
        $data['title'] = 'View Sector Details';
        $limit = '5000'; // fetch limited record
        $data['sector'] = $this->admin_model->get_dynamic_info('sector_details', $limit);

        $this->load->view('includes/admin_header');
        $this->load->view('admin/view_all_sector', $data);
        $this->load->view('includes/admin_footer');
        
    }

    public function templates(){
        $data['title'] = 'Download csv templates';

        $this->load->view('includes/admin_header');
        $this->load->view('admin/templates', $data);
        $this->load->view('includes/admin_footer');
        
    }

    public function add_benefit(){
        $data['title'] = 'Add Benefit';
        $data['sector'] = $this->admin_model->get_dynamic_info('sector_details', '9000');
        $data['symbol'] = $this->admin_model->get_dynamic_info('company_info', '9000');
        $data['cagr'] = $this->admin_model->get_dynamic_info('cagr_main_tbl', '9000');
        $data['year'] = $this->admin_model->get_dynamic_info('financial_year', '9000');

        $this->load->view('includes/admin_header');
        $this->load->view('admin/add_cagr', $data);
        $this->load->view('includes/admin_footer');
    }

    public function add_benefit2(){
        $data['title'] = 'Add Benefit 2';
        $data['sector'] = $this->admin_model->get_dynamic_info('sector_details', '9000');
        $data['symbol'] = $this->admin_model->get_dynamic_info('company_info', '9000');
        $data['cagr'] = $this->admin_model->get_benefit_info('cagr_data_tbl', '9000');
        $data['year'] = $this->admin_model->get_dynamic_info('financial_year', '9000');

        $this->load->view('includes/admin_header');
        $this->load->view('admin/add_cagr2', $data);
        $this->load->view('includes/admin_footer');
    }

    public function financial_year(){
        $data['title'] = 'Configure Financial Year';
        $data['year'] = $this->admin_model->get_dynamic_info('financial_year', '9000');

        $this->load->view('includes/admin_header');
        $this->load->view('admin/financial_year', $data);
        $this->load->view('includes/admin_footer');
        
    }

      public function download($fileName = NULL) {  
      // echo "here";die; 
           if ($fileName) {
            $file = realpath ( "download" ) . "\\" . $fileName;

            // check file exists    
            if (file_exists ( $file )) {
             // get file content
             $data = file_get_contents ( $file );
             //force download
             force_download ( $fileName, $data );
            } else {
             // Redirect to base url
             redirect ( base_url () );
            }
           }else{
            echo "no file";
           }
          }

    public function fetch_cagr_by_id(){
        $tid = $_POST['id'];  
        $data['symbol'] = $this->admin_model->get_dynamic_info('company_info', '9000');
        $data['year'] = $this->admin_model->get_dynamic_info('financial_year', '9000');

        // single record fetch
        $data['get'] = $this->admin_model->get_dynamic_info_by_id('cagr_main_tbl', $tid);
        $data['get_data'] = $this->admin_model->get_cagr_data($tid);

        $this->load->view('admin/edit_cagr_by_id', $data);
    } 

    // portfolio details
    public function portfolio(){
        $data['title'] = 'Portfolio Details';
        $data['user_id'] = $this->session->userdata('user_id');

        $data['symbol'] = $this->admin_model->get_dynamic_info('company_info', '9000');
        $data['portfolio'] = $this->admin_model->get_portfolio_details($data['user_id']);

        $this->load->view('includes/admin_header');
        $this->load->view('admin/portfolio', $data);
        $this->load->view('includes/admin_footer');
    }

    public function fetch_portfolio_by_id(){
        $tid = $_POST['id']; 
        // echo $tid;
        $data['symbol'] = $this->admin_model->get_dynamic_info('company_info', '9000'); 
        $data['portfolio'] = $this->admin_model->get_dynamic_info_by_id('portfolio', $tid);

        $this->load->view('admin/edit_portfolio_by_id', $data);
    } 
    
 
}