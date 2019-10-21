<?php

$sym = $get[0]['symbol'];
$name = $get[0]['company_name'];
$id = $get[0]['id'];
$com = $this->admin_model->get_dynamic_info_by_symbol('company_info', $sym);

$puc = $com[0]['share_price'];
$beg_price = $com[0]['beg_price'];
$cc_id = $com[0]['id'];

// print_r($get_data);
?>
<form action="<?= base_url()?>post/update_cagr" method="post">
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">

                  <div class="col-md-2 mt-4">
                    <label>Symbol:</label>
                  </div>
                  <div class="col-md-10 mt-4">

                    <select name="symbol" required>
                      <option value="<?= $sym ?>"><?= $sym . ' - ' . $name ?></option>
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
                  
                  <div class="col-md-2">
                      <label for="">Paid Up Capital</label>
                  </div>
                  <div class="col-md-10">
                  <input type="number" step="0.01" name="paid_up_capital" value="<?= $puc; ?>">
                  </div>

                  <div class="col-md-2">
                      <label for="">Beginning Price</label>
                  </div>

                  <div class="col-md-10">
                  <input type="number" step="0.01" name="beg_price" value="<?= $beg_price; ?>">
                  <input type="hidden" name="companyid" value="<?= $cc_id; ?>">
                  </div>
                  <!-- <div class="col-md-2">
                      <label>Initial Price:</label>
                      
                  </div>
                  <div class="col-md-9">
                    <input type="number" step="0.01" name="initial_price" value="">
                  </div> -->



                  <table class="table tbl table-bordered table-striped table-responsive tbl_append pt-4">
                  	<thead>
                    <tr>
                      <th>Year</th>
                      
                      <th>Dividend</th>
                      <!-- <th>Dividend Gain</th> -->
                      <th>Bonus</th>
                      <!-- <th>Bonus Gain</th> -->
                    </tr>
                    </thead>
                    <tbody class="append-here">

                      <?php $k=1;$div = $bon = $rec_id = array('');
                      foreach ($year as $key => $yr) { 
                      	foreach ($get_data as $gkey => $gval) {
                      		$div[] = $gval['dividend'];
                      		$bon[] = $gval['bonus'];
                      		$rec_id[] = $gval['id'];
                      	// }
                      	// echo '<pre>';
                      	// print_r($div);die;
                      		// echo $gval['dividend'];
                      	?>
                        
                      <!-- <tr class="add_after_me" id="add_after_me">
                      <td><input type="text" name="year[]" value="<?= $yr['financial_year']?>" readonly></td>

                      <td><input type="number" name="dividend[]" value=""></td>
                      <td><input type="number" name="bonus[]" value=""></td>
                      <input type="hidden" name="rec_id[]" value="<?= $rec_id[$k] ?>">
                      </tr> -->

                      <?php  } $k++; }  ?>
                      

                      <?php
                      foreach ($get_data as $gkey => $gval) {
                      	echo '<tr>';
                      	echo '<td><input type="text" name="year[]" value="'.$gval['financial_year'].'"></td>';
                        
                      	echo '<td><input type="number" step="0.01" name="dividend[]" value="'.$gval['dividend'].'"></td>';
                        // echo '<td><input type="text" name="dividend_gain[]" value="'.$gval['dividend_gain'].'"></td>';
                      	echo '<td><input type="number" step="0.01" name="bonus[]" value="'.$gval['bonus'].'"></td>';
                        // echo '<td><input type="text" name="bonus_gain[]" value="'.$gval['bonus_gain'].'"></td>';
                      	echo '<input type="hidden" name="rec_id[]" value="'.$gval['id'].'">';
                      	echo '</td>';
                      }


                      ?>
                    	<td><a href="#" class="add_form"><i class="fa fa-plus"></i></a></td>
                    </tbody>
                  </table>
                </div>
                
              </div>
          </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit" class="btn btn-primary" name="btnupdate" value="Update">
      </div>

<!-- <table style="display: none;">
	<tbody class="add_after_me2">
		
	<tr>
		<td><input type="text" name="years[]"></td>
		<td><input type="number" step="0.01" name="dividend2[]"></td>
		<td><input type="number" step="0.01" name="bonus2[]"></td>
    <td><a href="#" class="rem_form"><i class="fa fa-minus"></i></a></td>
	</tr>

</tbody>
</table> -->

 <script type="text/javascript">
 	$(document).ready(function () { 
      var count = 1;
      $('.add_form').on('click', function(e){
      e.preventDefault();
      // alert(count);
      var $wrap = '<tbody class="app-body'+count+'"><tr>\
        <td><input type="text" name="years[]"></td>\
    <td><input type="number" step="0.01" name="dividend2[]"></td>\
    <td><input type="number" step="0.01" name="bonus2[]"></td>\
    <td><a href="#" class="rem_form'+count+'"><i class="fa fa-minus"></i></a></td>\
  </tr>\
</tbody>';

     $($wrap).clone().appendTo('.tbl_append').find('input:text').val('').focus();

     var rem = '.rem_form' + count;
     var body = '.app-body' + count;
     $(rem).on('click', function(e){
      e.preventDefault();
      // alert("remove next");
     $(body).remove(); // closest or last
    });
     count++;
  });


    
});
 </script>

 <!-- <td><input type="number" step="0.01" name="beg_price2[]" placeholder="asd"></td>\ -->