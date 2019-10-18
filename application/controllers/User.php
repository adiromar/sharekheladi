<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function index(){
		$data['title'] = 'User Details';
		$data['user'] = $this->user_model->get_user_info();

		$this->load->view('includes/admin_header');
		$this->load->view('user/index', $data);
		$this->load->view('includes/admin_footer');
	}

	public function login(){
		if(isset($_POST['btnlogin']))
		{	
			$user_name = $this->input->post("username");
			$user_password = sha1($this->input->post("password"));

			// check for login criteria
			$login_condition = array(
				"user_name"=>$user_name,
				"user_password"=>$user_password, 
				"status"=>'Active');

			// print_r($login_condition);die;
			$user_data = $this->user_model->userLogin($login_condition);
			// print_r($user_data);die;
			if($user_data !== FALSE)
			{	
				$user_id = $user_data['id'];
				$user_name = $user_data['user_name'];
				$user_role = $user_data['user_role'];
				$status = $user_data['status'];

				// seting user info in session
				$this->session->set_userdata("user_id", $user_id);
				$this->session->set_userdata("user_name", $user_name);
				$this->session->set_userdata("status", $status);
				$this->session->set_userdata("user_role", $user_role);

				$this->session->set_userdata("islogin", 'Logged In');
				redirect('admin/dash');
			}else{
				$this->session->set_flashdata('login_error', '<b>Login Error!! </b>Username/Password not matched.');
				redirect(base_url(), $this->data);
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata("user_id");
		$this->session->unset_userdata("user_name");
		$this->session->unset_userdata("status");
		$this->session->sess_destroy();
		
		$this->session->set_flashdata('logout', '<b>You have Logged Out Successfully !!');
		redirect("pages/index");
	}

	public function add_new_user(){

		$this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required',
                        array('required' => 'You must provide a %s.')
                );
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required');

        if ($this->form_validation->run() == FALSE){
        	$data['title'] = 'User Details';
        	$this->session->set_flashdata('vali', '<b>Please Fill Out Required Field.');

            redirect('user/index');
        }else{
        	if(isset($_POST['btnsave'])){
        		$user_name = $this->input->post('user_name');
        		$password = $this->input->post('password');
        		$confirm_password = $this->input->post('confirm_password');
        		$email = $this->input->post('email');
        		$user_role = $this->input->post('user_role');
        		$user_status = $this->input->post('user_status');

        		$log_data = array(
					'user_name'=>$user_name,
					'user_role'=>$user_role,
			        'user_password' => sha1($password),
			        'email' => $email,
			        'status' => $user_status,
			    );

			    $d = $this->user_model->insertUser($log_data);
			if ($d == true){
				$this->session->set_flashdata('inserted', '<b> New User Successfully Added');
				redirect("user/index");
			}else{
				$this->session->set_flashdata('error', '<b>User Can Not Be Added.');
				redirect("user/index");
				}
			}

			$this->load->view('formsuccess');
		}
	}

		public function update_user(){

        // if ($this->form_validation->run() == FALSE){
        // 	$data['title'] = 'User Details';
        // 	$this->session->set_flashdata('vali', '<b>Please Fill Out Required Field.');

        //     redirect('user/index');
        // }else{
        	if(isset($_POST['btnsave'])){
        		$user_name = $this->input->post('user_name');
        		$password = $this->input->post('password');
        		$confirm_password = $this->input->post('confirm_password');
        		$email = $this->input->post('email');
        		$user_role = $this->input->post('user_role');
        		$user_status = $this->input->post('user_status');
				$id = $this->input->post('rec_id');
				
        		$log_data = array(
					'user_name'=>$user_name,
					'user_role'=>$user_role,
			        'user_password' => sha1($password),
			        'email' => $email,
			        'status' => $user_status,
			    );

			    $d = $this->user_model->update_user('user_login',$log_data, $id);
			if ($d == true){
				$this->session->set_flashdata('inserted', '<b> User Details Successfully Updated');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('error', '<b>Update Error');
				redirect($_SERVER['HTTP_REFERER']);
				}
			}
		// }
		redirect($_SERVER['HTTP_REFERER']);
	}	

} // end of class user


?>