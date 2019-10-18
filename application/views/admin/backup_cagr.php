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

  
	<div class="" style="background-color: white;padding: 12px">
		

      <div class="col-md-12 col-lg-12 col-md-12">
      <h6>Benefit Details :</h6>
      <a href="<?= base_url()?>admin/add_sector" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#bd-example-modal-lg">Add CAGR +</a>

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
        echo '<th>Share Price</th>';
        echo '<th>Initial Price</th>';
        echo '<th>Dividend (%)</th>';
        echo '<th>Bonus (%)</th>';
        echo '<th>Bonus Gain</th>';
        echo '<th>Dividend Gain</th>';
        echo '<th>EV at M.P.</th>';
        echo '<th>EV at Constant</th>';
        echo '<th>CAGR (%) M.P.</th>';
        echo '<th>CAGR (%) Constant</th>';

        echo '<th></th>';
      echo '</tr>';
      foreach ($cagr as $com => $com_val) {
        echo '<tr>';
        echo '<td>'.$k.'</td>';
        echo '<td>'.$com_val['company_name'] .'</td>';
        echo '<td>'.$com_val['symbol'] .'</td>';

        $get_price = $this->admin_model->get_price($com_val['symbol']);
        $beg_price = 0;
        $beg_price = $get_price[0]['beg_price'];
        $share_price = $get_price[0]['share_price'];

        $get = $this->admin_model->get_cagr_data($com_val['id']);
        $f_year=$div=$bon='';
        
        if(!empty($get)){
        $cc= $gain_year=array('');
        $f_bg1=$f_dg1=0;
        foreach ($get as $gkey => $gval) {
          $f_year .= '-' . $gval['financial_year'] . '<br>';
          $div .= $gval['dividend'] . '<br>';
          $bon .= $gval['bonus'] . '<br>';
          $cc[] = $gval['financial_year'];

          $bon_1 = ($gval['bonus']/100);
          $bg1 = 100+(100*$bon_1);
          // $bg2 = $bg1 + ($bg1 * $gval['bonus']);
          $gain_year[] = $gval['financial_year']; 
          $div1 = ($get[0]['dividend']/100);
          $dg1 = ($beg_price*100)*$div1;
        }
      }
        // echo '<pre>';
        // print_r($gain_year);
        // echo count($cc);
        $num_year = count($cc);
        // echo '<pre>';
        // echo "no of year : " . $num_year . '<br>';
        // echo $bon_1;
        echo "<br>Bonus on year 0 is: " . $bg1 . '<br>';
        echo "Dividend on year 0 is:" . $div1;

        $f_bg1 .= $bg1 . '<br>';
        $f_dg1 .= $dg1 . '<br>';
        for ($n=1; $n < $num_year-1; $n++) { 
          // $bg1 = $bg1 + ($bg1 * $gval['bonus']);
          $bg1 = $bg1 + ($bg1 * $bon_1);
          $f_bg1 .= number_format(round($bg1),0) . '<br>';

          $dg1 = $bg1 * $gval['dividend'];
          $f_dg1 .= number_format(round($dg1),0) . '<br>';
          $sum_dg += $dg1;
          // echo "bonus on year". $n . 'is - ' . $bg1 . '<br>';
          // echo "Dividend on year". $n . 'is - ' . $dg1;
        }
        // die;
        $get_mp = $this->admin_model->get_marketprice($com_val['symbol']);

        $end_value = ($bg1*$get_mp[0]['market_price'])+($sum_dg);
        $end_value_c = ($bg1*100)+($sum_dg);
        $initial = (100*$beg_price);
        $cagr = (($end_value/$initial)**(1/($num_year-1)) -1);
        $cagr_c = (($end_value_c/$initial)**(1/($num_year-1)) -1);
        $cagr_per = ($cagr*100);
        $cagr_c_per = ($cagr_c*100);
        echo '<td>'.$f_year .'</td>';
        echo '<td>'.$share_price .'</td>';
        echo '<td>'.$beg_price .'</td>';
        echo '<td>'.$div .'</td>';
        echo '<td>'.$bon .'</td>';
        
        echo '<td>'.$f_bg1 .'</td>';
        echo '<td>'.$f_dg1 .'</td>';
        echo '<td>'.number_format($end_value,2) .'</td>';
        echo '<td>'.number_format($end_value_c,2) .'</td>';

        if (is_infinite($cagr_per)){
          echo '<td>-</td>';
        }else{
          echo '<td>'.number_format(round($cagr_per),0) .' %</td>';
        }
        if (is_infinite($cagr_c_per)){
          echo '<td>-</td>';
        }else{
          echo '<td>'.number_format(round($cagr_c_per),0) .' %</td>';
        }
        echo '<td>
        <a class="btn btn-outline-primary btn-sm" name="fid" data-id="'.$com_val['id'].'" onclick="launch_view_modal('.$com_val['id'].')"><i class="fa fa-pencil"></i></a>

        <a href="'.base_url().'admin/delete_record?tbl=cagr_main_tbl&&tbl2=cagr_data_tbl&&id='.$com_val['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
        </li>';
        echo '</tr>';

      $k++; } 
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

                  <div class="col-md-2 mt-4">
                    <label>Symbol:</label>
                  </div>
                  <div class="col-md-10 mt-4">

                    <select name="symbol" required>
                      <option value="">--Select--</option>
                      <?php
                      foreach ($symbol as $skey => $sval) {
                        $val = $this->admin_model->check_inserted_rec('cagr_main_tbl', $sval['symbol']);

                        if($val[0]['symbol'] == $sval['symbol']){
                          echo '<option value="'.$sval['symbol'].'" disabled>'.$sval['symbol']. ' - ' .$sval['company_name'] .'</option>';
                        }else{
                          echo '<option value="'.$sval['symbol'].'" >'.$sval['symbol']. ' - ' .$sval['company_name'] .'</option>';
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
                      
                      <td><input type="number" name="dividend[]"></td>
                      <!-- <td><input type="number" name="dividend_gain[]"></td> -->
                      <td><input type="number" name="bonus[]"></td>
                      <!-- <td><input type="number" name="bonus_gain[]"></td> -->
                      </tr>

                      <?php }  ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('.add_field').on('click', function(e){
      e.preventDefault();
      alert("append");

     $('.add_after_me:first-child').clone(true).appendTo('.tbl').find('input').val('').focus();
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