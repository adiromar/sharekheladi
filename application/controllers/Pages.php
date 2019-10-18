<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
		$this->load->model('admin_model');
	}

	public function index()
	{	
		$data['fetch'] = $this->post_model->get_marketinfo();

		// if(empty($data['fetch'])){
		$data['fetch1'] = $this->post_model->get_marketinfo_normal();
		// }
		

		$this->load->view('templates/header_new');
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer_new');
	}

	public function live_test(){
		$this->load->view('templates/header');
		$this->load->view('pages/live_test');
		$this->load->view('templates/footer');
	}

	public function test(){
		$this->load->view('templates/header');
		$this->load->view('pages/test');
		$this->load->view('templates/footer');
	}

	public function view_list(){
		$data['fetch'] = $this->post_model->get_marketinfo();
		
		$this->load->view('templates/header');
		$this->load->view('pages/view_list', $data);
		$this->load->view('templates/footer');
	}

	public function myportfolio(){
		$data['user_id'] = $this->session->userdata('user_id');

        $data['symbol'] = $this->admin_model->get_dynamic_info('company_info', '9000');
        $data['portfolio'] = $this->admin_model->get_portfolio_details($data['user_id']);
		
		$this->load->view('templates/header_new');
		$this->load->view('pages/myportfolio', $data);
		$this->load->view('templates/footer_new');
	}

	public function cagr_test(){

		$data['symbol'] = $this->admin_model->get_dynamic_info('company_info', '9000');
        $data['cagr'] = $this->admin_model->get_dynamic_info('cagr_main_tbl', '9000');
		$data['year'] = $this->admin_model->get_dynamic_info('financial_year', '9000');
		
		$this->load->view('templates/header_new');
		$this->load->view('pages/test1', $data);
		$this->load->view('templates/footer_new');
	}
}
