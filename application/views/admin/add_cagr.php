<?php
error_reporting('false');
?>


<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    
  <?php if($this->session->flashdata('inserted')):
    echo '<p class="alert alert-success"><b>'.$this->session->flashdata('inserted').'</b></p>';
  endif;
  if($this->session->flashdata('error')):
    echo '<p class="alert alert-danger"><b>'.$this->session->flashdata('error').'</b></p>';
  endif;
?>

  </div>

	<div class="" style="background-color: white;padding: 12px;">
		

      <div class="col-md-12 col-lg-12 col-md-12">
      <h6>Benefit Details :</h6>
      <a href="<?= base_url()?>admin/add_sector" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#bd-example-modal-lg">Add CAGR +</a>
      <a class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#upload-benefit">Upload</a>
      
      <a href="<?= base_url()?>admin/financial_year" class="btn btn-warning btn-sm float-right">Configure F. Year +</a>
      <hr>
      
      <?php
      $k=1;
      echo '<table class="table table-striped table-bordered table-responsive">';
      echo '<tr>';
        echo '<th>S.N.</th>';
        echo '<th>Company Name</th>';
        echo '<th>Symbol</th>';
        echo '<th>Fin. Year</th>';
        echo '<th>Paid Up Value</th>';
        echo '<th>Initial Price</th>';
        echo '<th>Bonus (%)</th>';
        echo '<th>Dividend (%)</th>';
        
        echo '<th>Bonus Gain</th>';
        echo '<th>Dividend Gain</th>';
        echo '<th>EV at M.P.</th>';
        echo '<th>EV at Constant</th>';
        echo '<th>CAGR (%) M.P.</th>';
        echo '<th>CAGR (%) Constant</th>';

        echo '<th></th>';
      echo '</tr>';
      $end_value=$end_value_c=$bg1=0;
      foreach ($cagr as $com => $com_val) {
        echo '<tr>';
        echo '<td>'.$k.'</td>';
        echo '<td>'.$com_val['company_name'] .'</td>';
        echo '<td>'.$com_val['symbol'] .'</td>';
        // unset($cagr_per);
        // echo "initial cagr " . $cagr_per . '<br>';
        // echo "end value " . $end_value . '<br>';
        // get price
        $get_price = $this->admin_model->get_price($com_val['symbol']);
        $beg_price = 0;
        $beg_price = $get_price[0]['beg_price'];
        $share_price = $get_price[0]['share_price'];

        $get = $this->admin_model->get_cagr_data($com_val['id']);
        $f_year=$div=$bon='';
        
        if(!empty($get)){
        $cc= $gain_year=array('');
        $f_bg1=$f_dg1=$bg1=$dg1=0;
                      
        // $end_value=$end_value_c=0;
        $div1=$bon_1=0;
        foreach ($get as $gkey => $gval) {
          $f_year .= '-' . $gval['financial_year'] . '<br>';
          $div .= $gval['dividend'] . '<br>';
          $bon .= $gval['bonus'] . '<br>';
          $cc[] = $gval['financial_year'];

          // bonus for year 1
          $bon_1 = ($get[0]['bonus']/100);
          $bg1 = (100+(100*$bon_1));
          // echo $bg1;
          // $bg2 = $bg1 + ($bg1 * $gval['bonus']);
          $gain_year[] = $gval['financial_year'];
          
          // dividend for year 1
          $div1 = ($get[0]['dividend']/100);
          $dg1 = ($beg_price*100)*$div1;
          
          $bon_arr[] = $gval['bonus'];
          $div_arr[] = $gval['dividend'];
        }
      }
        $sum_dg += $dg1;
        // echo '<pre>';  
        // print_r($bg1);
        // echo count($cc);
        $num_year = count($cc);
        $num_yr = $num_year -1;
        // echo '<pre>';
        // echo "no of year : " . $num_year . '<br>';
        // echo $bon_1;
        // echo "<br>Bonus on year 0 is: " . $bg1 . '<br>';
        // echo "Dividend on year 0 is:" . $dg1;

        $f_bg1 .= round($bg1) . '<br>';
        $f_dg1 .= round($dg1) . '<br>';
        // echo ' Bonus Gain: ' . $bg1 . '<br>';
        // echo ' Dividend Gain: ' . $dg1 . '<br>';
        
        for ($n=1; $n < $num_yr; $n++) { 
          $bon_pr = $bon_arr[$n] / 100;
          $div_pr = $div_arr[$n] / 100;

          // $bg1 = $bg1 + ($bg1 * $gval['bonus']);
          // echo '<pre>';
          // echo 'Prev: ' . $bg1;
          
          $prv_bon[] = round($bg1); 
          $prev_bg = $bg1;
          $bg1 = $bg1 + ($bg1 * $bon_pr);
          // echo ' Bonus Gain: ' . $bg1;
          $f_bg1 .= number_format(round($bg1),0) . '<br>';
          $final_bg = $bg1;
          // $dg1 = $bg1 * $div_arr[$n];
          // echo $prv_bon;
          $dg1 = ($prv_bon[$n-1] * $beg_price) * $div_pr;

          $f_dg1 .= number_format(round($dg1),0) . '<br>';
          $sum_dg += $dg1;
          // $prv_bon .= round($bg1) . '<br>';
          // echo "bonus on year". $n . 'is - ' . $bg1 . '<br>';
          // echo ">>" . $prv_bon[$n-1];
          // echo $div_pr;
          // echo " Dividend on year". $n . 'is - ' . $dg1 . '<br>';
          
        }
        // echo '<pre>';
        // print_r($prv_bon);
        // echo '</pre>';
        $bon_arr=$div_arr=array('');
          // echo '<pre>';
          // echo $sum_dg;
          // echo '</pre>';
        // die;
        $get_mp = $this->admin_model->get_marketprice($com_val['symbol']);
        $gmp = $get_mp[0]['market_price'];

        $end_value = (round($bg1)*$gmp)+($sum_dg);
        $end_value_c = (round($bg1)*100)+($sum_dg);
        $initial = ($share_price*$beg_price);
        // $cagr = (($end_value/$initial)**(1/($num_yr)) -1);

        $cagr = pow(($end_value/$initial), (1/$num_yr)) -1;
        // echo 'initial ' . $initial;
        
        // echo "cagr " . $cagr;

        $cagr_c = ($end_value_c/$initial);
        // $cagr_cc = ($cagr_c**(1/($num_yr)) -1);
        $cagr_cc = pow($cagr_c, (1/$num_yr))-1;
        $y = ($cagr_c -1);
        $cagr_per = ($cagr*100);
        // echo 'ending cagr:' . $cagr_per; 
        // echo 'ending ev:' . $end_value; 

        $cagr_c_per = ($cagr_cc*100);
        echo '<td>'.$f_year.'</td>';
        echo '<td>'.$share_price.'</td>';
        echo '<td>'.$beg_price.'</td>';
        echo '<td>'.$bon.'</td>';
        echo '<td>'.$div.'</td>';
        
        echo '<td>'.$f_bg1 .'</td>';
        echo '<td>'.$f_dg1 .'</td>';
        // $f_bg1=$f_dg1=0;
        // echo '<td>'.$prv_bon .'</td>';
        echo '<td>'.round($end_value) .'</td>';
        echo '<td>'.round($end_value_c) .'</td>';

        // check if number is infinite
        if (is_infinite($cagr_per)){
          echo '<td>-</td>';
        }elseif (is_nan($cagr_per)){
          echo '<td>-</td>';
        }else{
          echo '<td>'.number_format(round($cagr_per),0) .' %</td>';
        }

        if (is_infinite($cagr_c_per)){
          echo '<td>-</td>';
        }elseif (is_nan($cagr_c_per)){
          echo '<td>-</td>';
        }else{
          echo '<td>'.number_format(round($cagr_c_per),0) .' %</td>';
        }
        
        echo '<td>
        <a class="btn btn-outline-primary btn-sm" name="fid" data-id="'.$com_val['id'].'" onclick="launch_view_modal('.$com_val['id'].')"><i class="fa fa-pencil"></i></a>

        <a href="'.base_url().'admin/delete_record?tbl=cagr_main_tbl&&tbl2=cagr_data_tbl&&id='.$com_val['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
        </li>';
        echo '</tr>';
        
      unset($prv_bon);unset($div_arr);unset($bon_arr);unset($sum_dg);unset($cagr);
      unset($end_value);
      $cagr_per=0;
      $num_year=$num_yr=$beg_price=$initial=0;
      $k++; $bg1=$dg1=$sum_dg=0;
      $bon=$div='';
      $f_bg1=$f_dg1=0;
    } 
      echo '</table>'; ?>
    </div>

  </div>


<!-- cagr Modal -->
<div class="modal fade" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="min-width: 1050px;background-color: #d4d6d7;right:120px;">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Benefit Details:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/insert_cagr" method="post">
      <div class="modal-body mdl-body2">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
            
                  <div class="col-md-1 mt-4">
                    <label>Sector:</label>
                  </div>
                  <div class="col-md-10 mt-4">
                    <select id="sectorid">
                     <option value="">Select</option> 
                     <?php
                      foreach ($sector as $skey => $scval) {
                        echo '<option value='.$scval['sector_id'].'>'.$scval['sector_name'].'</option>';
                      }
                      ?>
                    </select>
                    
                    <label for="" class="ml-4">Symbol</label>
                    <select name="symbol" id="symbol" required>
                      <option value="">--Select--</option>
                      <?php
                      foreach ($symbol as $skey => $sval) {
                        $val = $this->admin_model->check_inserted_rec('cagr_main_tbl', $sval['symbol']);

                        if($val[0]['symbol'] == $sval['symbol']){
                          // echo '<option data-sid="'.$sval['sector'].'" value="'.$sval['symbol'].'" disabled>'.$sval['symbol']. ' - ' .$sval['company_name'] .'</option>';
                        }else{
                          echo '<option data-sid="'.$sval['sector'].'" value="'.$sval['symbol'].'" >'.$sval['symbol']. ' - ' .$sval['company_name'] .'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <table class="table tbl table-bordered table-striped table-responsive">
                    <tr>
                      <th>Year</th>
                      <th>Dividend</th>
                      <!-- <th>Dividend Gain</th> -->
                      <th>Bonus</th>
                      <!-- <th>Bonus Gain</th> -->
                    </tr>
                    
                      <?php 
                      foreach ($year as $key => $yr) { ?>
                        
                      <tr class="add_after_me" id="add_after_me">
                      <td><input type="text" name="year[]" value="<?= $yr['financial_year']?>" readonly></td>
                      <td><input type="number" step="0.01" name="dividend[]"></td>
                      <!-- <td><input type="number" name="dividend_gain[]"></td> -->
                      <td><input type="number" step="0.01" name="bonus[]"></td>
                      <!-- <td><input type="number" name="bonus_gain[]"></td> -->
                      </tr>

                      <?php } ?>
                      <!-- <td><a href="#" class="btn btn-secondary add_field">+</a></td> -->
                    
                  </table>
                </div>
                
              </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btnsave" value="save">
      </div>

      </form>

    </div>
  </div>
</div>
<!-- cagr modal ends  -->

<!-- Edit Modal -->
<button style="display: none" type="button" class="btn btn-primary" id="click_it1" data-toggle="modal" data-target="#view-modal">View modal</button>

<div class="modal fade bd-example-modal-lg" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content pt-1 pl-2 pr-2 pb-5" style="background-color: #d4d6d7;min-width: 1050px;right: 250px;">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Benefit Details:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body mdl-body2 mdl-response">
        
      </div>

    </div>
  </div>
</div>
<!-- Edit modal  -->

<!-- Upload Modal -->
<button style="display: none" type="button" class="btn btn-primary" data-toggle="modal" data-target="#upload-benefit">View modal</button>

<div class="modal fade bd-example-modal-lg" id="upload-benefit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content pt-1 pl-2 pr-2 pb-5" style="background-color: #d4d6d7;min-width: 1050px;right: 250px;">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Benefit Details:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body mdl-body2 mdl-response">
      <form action="<?= base_url()?>/post/import_benefit" method="post" enctype="multipart/form-data">
      <div class="col-md-12">
        <label for="">Upload</label>
        <input type="file" name="file">
      </div>
        
        <div class="col-md-12 mt-4">
          <input type="submit" name="importSubmit" value="Submit" class="btn btn-primary btn-sm">
        </div>
        
      </form>
      </div>

    </div>
  </div>
</div>
<!-- Upload benefit modal  -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('.add_field').on('click', function(e){
      e.preventDefault();
      // alert("append");

     $('.add_after_me:first-child').clone(true).appendTo('.tbl').find('input').val('').focus();
    });


    // change values on change sector
    $('#sectorid').on('change', function(e){
      e.preventDefault();

      sector = $(this).val();
      // alert(sector);
      $('#symbol option').each(function(){ //FOR EVERY SECOND OPTION
    if($(this).attr('data-sid') == sector) { //CHECK IF IT IS EQUAL TO THE FIRST SELECTED CHOICE
    // alert("matched");
        // $(this).attr('disabled', 'disabled'); 
        $(this).removeAttr('disabled');
          $(this).show();
        //alert($(this).val());
    } else {
      thisAttr = $(this).attr('disabled', 'disabled');
        if(thisAttr = "disabled") {
          $(this).hide();
        }
        // $(this).removeAttr('disabled');
    }
});

    });
});

    // view all modal
    $('#view-modal').modal({ show: false});
    function launch_view_modal(id){
      
      var values = {
        'id' : id
      };
      // alert(id);
      $('#click_it1').click();
      
       $.ajax({
          type: "POST",
          url: "<?= base_url(); ?>admin/fetch_cagr_by_id",
          // dataType: 'JSON',
          data: values,
          success: function(resp){
            // $('#click_it').click();
        // $('#compose-modals').modal("show");
        $(".mdl-response").html(resp);
        // $(".sss").html(resp);
        console.log(resp);
           },
    });
 }
  </script>
</main>