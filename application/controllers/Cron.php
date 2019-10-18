<?php if (! defined('BASEPATH')) {
 exit('No direct script access allowed');
}
class Cron extends CI_Controller
{

 public function __construct()
 {
   parent::__construct();
   // if (!$this->input->is_cli_request()) {
   // show_error('Direct access is not allowed');
   // }

   $this->load->database();
   $this->load->model('post_model');
 }

 public function run()
 {
 
    $this->load->library('CronRunner');
    $cron = new CronRunner();
    $cron->run();
 }

 public function insert(){
 	date_default_timezone_set('Asia/Kathmandu');
 	$now = date('Y-m-d H:i:s');

 	$data = array(
    		'test_name' => 'ADBL',
    		'test_status' => 'Active',
    		'date' => $now
    	);
    	$insert = $this->db->insert('cron_test', $data);

    	if ($insert == true){
    		echo "Insert Success";
    	}else{
    		echo "Insert Error";
    	}
 }

public function insert_live(){
	error_reporting(0);
	include_once('simple_html_dom.php');
   // create HTML DOM
	$htmlContent  = file_get_html('http://www.nepalstock.com/stocklive');

    $DOM = new DOMDocument();
    $DOM->loadHTML($htmlContent);

    $tables = $DOM->getElementsByTagName('table');

    $Header = $tables->item(0)->getElementsByTagName('td');
    $Detail = $DOM->getElementsByTagName('td');

    // Get header name of the table
    foreach($Header as $NodeHeader) 
    {
        $s[] = trim($NodeHeader->textContent);
    }
    // echo '<pre>';
    // print_r($s);die;

    $t = array_slice($s, 11);
    $chk = array_chunk($t, 11);
    // $splice = array_splice($chk, 2);
    // echo '<pre>';
    // print_r($chk);

    $keys = $value = array();
    foreach ($chk as $key => $val) {
        $keys[] = $val[1];
        $value[] = $val[2];
    }
    $comb = array_combine($keys, $value);
    // print_r($comb);
    date_default_timezone_set('Asia/Kathmandu');
 	$now = date('Y-m-d H:i:s');

    if (!empty($comb)){
    foreach ($comb as $ckey => $cval) {
        $a = str_replace(',', '', $ckey);
        $b = str_replace(',', '', $cval);

    	$live_data = array(
    		'symbol' => $a,
    		'market_price' => $b,
    		'inserted_date' => $now
    	);

        $check = $this->post_model->check_duplicate($live_data['symbol']);
        if ($check > 0){
            // update query

            $upd = $this->post_model->update_record('shareinfo' , $live_data, $live_data['symbol']);
        }else{
            $ins = $this->db->insert('shareinfo' , $live_data);
        }

    	}

        } // end of array check
	}

} // end of class

?>