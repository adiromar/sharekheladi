<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>

<div>
<?php if($this->session->flashdata('inserted')):
    echo '<p class="alert alert-success"><b>'.$this->session->flashdata('inserted').'</b></p>';
  endif;
  if($this->session->flashdata('error')):
    echo '<p class="alert alert-danger"><b>'.$this->session->flashdata('error').'</b></p>';
  endif;
?>
</div>
  </div>

  
	<div class="container" style="background-color: white;">

	<div class="row"> 
    <div class="col-md-6 card-box-border">
      <h6>Company Names:</h6>
      <a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#companymodal">Add Company +</a>
      <a href="<?= base_url()?>admin/view-all-company" class="float-right btn btn-outline-success btn-sm">View All / Import</a>

      <hr>
      
      <?php $k=1;
      echo '<table class="table table-striped table-bordered">';
      echo '<tr>';
        echo '<th>S.N.</th>';
        echo '<th>Company Name</th>';
        echo '<th>Symbol</th>';
        echo '<th></th>';
      echo '</tr>';
      foreach ($comp as $com => $com_val) {
        echo '<tr>';
        echo '<td>'.$k.'</td>';
        echo '<td>'.$com_val['company_name'] .'</td>';
        echo '<td>'.$com_val['symbol'] .'</td>';
        echo '<td>

        <a href="'.base_url().'admin/delete_record?tbl=company_info&&id='.$com_val['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
        </li>';
        echo '</tr>';

      $k++; } 
      echo '</table>'; ?>
    </div>

    <div class="col-md-6 card-box-border">
      <h6>Sector Names:</h6>
      <a href="<?= base_url()?>admin/add_sector" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#exampleModalLong">Add Sector +</a>
      <a href="<?= base_url()?>admin/view-all-sector" class="float-right btn btn-outline-success btn-sm">View All / Import</a>
      <hr>
      
      <?php
      $k=1;
      echo '<table class="table table-striped table-bordered">';
      echo '<tr>';
        echo '<th>S.N.</th>';
        echo '<th>Sector Name</th>';
        echo '<th>Sector ID</th>';
        echo '<th></th>';
      echo '</tr>';
      foreach ($sector as $com => $com_val) {
        echo '<tr>';
        echo '<td>'.$k.'</td>';
        echo '<td>'.$com_val['sector_name'] .'</td>';
        echo '<td>'.$com_val['sector_id'] .'</td>';
        echo '<td>
        
        <a href="'.base_url().'admin/delete_record?tbl=sector_details&&id='.$com_val['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
        </li>';
        echo '</tr>';

      $k++; } 
      echo '</table>'; ?>
    </div>

  </div>
  <hr>


  <div class="clearfix"></div>
    <div class="row"> 
    <div class="col-md-6 card-box-border">
      <h5>Safety Values:</h5>
      <?php 
      if($constant == true){ ?>
        <a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#bv_value">Add +</a>

     <?php }else{ ?>
<a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#bv_value">Add +</a>
      <?php } ?>
      
      <!-- <a href="<?= base_url()?>admin/view-all-constant" class="float-right btn btn-outline-success btn-sm">View All / Import</a> -->
      <hr>

      <?php
      $k=1;
      echo '<table class="table table-striped table-bordered">';
      echo '<tr>';
        echo '<th>S.N.</th>';
        echo '<th>Sector</th>';
        echo '<th>P/E Ratio</th>';
        echo '<th>Desirable P/B Ratio</th>';
        echo '<th>EPS vs P/E</th>';
        echo '<th></th>';
      echo '</tr>';
      foreach ($constant as $com => $com_val) {
        echo '<tr>';
        echo '<td>'.$k.'</td>';
        echo '<td>'.$com_val['sector_id'] .'</td>';
        echo '<td>'.$com_val['pe_ratio'] .'</td>';
        echo '<td>'.$com_val['desirable_pb_ratio'] .'</td>';
        echo '<td>'.$com_val['eps_vs_pe'] .'</td>';
        echo '<td>
        <span><a href="'.base_url().'admin/delete_record?tbl=safety_value&&id='.$com_val['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a></span>
        </li>';
        echo '</tr>';
        // <span><a href="#"><i class="fa fa-pencil" data-toggle="modal" data-target="#safety" data-id="'.$com['id'].'"></i> </a></span>
        
      $k++; } 
      echo '</table>'; ?>

    </div>
  </div>

</div> <!-- container ends -->



<!-- 
======================================================================================================
                                MODAL FORMS STARTS FROM HERE
======================================================================================================
 -->



<!-- sector modal Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Sector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/add_sector" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                    <label>Sector Name:</label>
                  </div>
                  <div class="col-md-8">
                    <!-- <input type="text" name="sector_name" class=""> -->
                    <select name="sector_name" id="sector_tbl">
                        <option value="" data-group="none">--Select--</option>
                        <option value="Commercial Banks" data-group="c1">Commercial Banks</option>
                        <option value="Corporate Debenture" data-group="c2">Corporate Debenture</option>
                        <option value="Development Banks" data-group="d1">Development Banks</option>
                        <option value="Finance" data-group="f1">Finance</option>
                        <option value="Hydro Power" data-group="h1">Hydro Power</option>
                        <option value="Hotels" data-group="h2">Hotels</option>
                        <option value="Life Insurance" data-group="l1">Life Insurance</option>
                        <option value="Microfinance" data-group="m1">Microfinance</option>
                        <option value="Mutual Fund" data-group="m2">Mutual Fund</option>
                        <option value="Manufacturing And Processing" data-group="m3">Manufacturing And Processing</option>
                        <option value="Non Life Insurance" data-group="n1">Non Life Insurance</option>
                        <option value="Preferred Stock" data-group="p1">Preferred Stock</option>
                        <option value="Tradings" data-group="t1">Tradings</option>
                        <option value="Others" data-group="oth">Others</option>
                    </select>
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Sector ID:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" min="1" max="1000" name="sector_id" class="">

                    <!-- <select name="sector_id">
                      <option id="sector_tbl_id"></option>
                    </select> -->
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Desired Price Variable:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="desired_price_variable" placeholder=" Value of x">
                  </div>
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
<!-- sector modal ends  -->

<!-- Company Modal -->
<div class="modal fade" id="companymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/add_company" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                    <label>Company Name:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="company_name" class="">
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Company Symbol:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="text" name="symbol" class="">
                  </div>
                  
                  <div class="col-md-4 mt-4">
                    <label>Company ID:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" min="0" name="com_id" class="">
                  </div>
      
                  <div class="col-md-4 mt-4">
                    <label>Per Unit Share Price:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="share_price" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Beginning Price:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="beg_price" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Beginning Price Year:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <select name="beg_price_year">
                  <?php 
                  foreach ($year as $yr => $yval) {
                    echo '<option>'.$yval['financial_year'].'</option>';
                  }
                  ?>
                    </select>
                    <!-- <input type="number" step="0.01" name="beg_price" class=""> -->
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Book Value:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="book_value" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>EPS Value:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="eps_value" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>CAGR (in %):</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="cagr" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Sector:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <select name="sector_id">
                    <?php
                      echo '<option>--Select Sector--</option>';
                    foreach ($sector as $skey => $sval) {
                      echo '<option value='.$sval['sector_id'].'>'.$sval['sector_name'].'</option>';
                    }
                    ?>
                  </select>
                    <!-- <input type="text" name="sector_id" class=""> -->
                  </div>
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
<!-- company modal ends  -->


<!-- Bsafety value Modal -->
<div class="modal fade" id="bv_value" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Safety Values</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/add_safety_value" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                  <label for="">Sector</label>
                  </div>
                  <div class="col-md-8">
                  <select name="sector_id">
                    <?php
                      echo '<option>--Select Sector--</option>';
                    foreach ($sector as $skey => $sval) {
                      echo '<option value='.$sval['sector_id'].'>'.$sval['sector_name'].'</option>';
                    }
                    ?>
                  </select>
                  </div>
                  
                  <div class="col-md-4">
                    <label>P/E Ratio:</label>
                  </div>
                  <div class="col-md-8">
                    <!-- <select name="company_name">
                    <?php
                      echo '<option value="">Select Company</option>';
                      foreach ($comp as $ckey => $cval) {
                        echo '<option value='.$cval['symbol'].'>'.$cval['company_name'].'</option>';
                      }
                    ?>
                  </select> -->
                    <input type="number" step="0.01" name="pe_ratio" class="">
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Desirable PB Ratio:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="desirable_pb_ratio" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>EPS Vs P/E:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="eps_vs_pe" class="">
                  </div>
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
<!-- safety value modal ends  -->


<!-- safety value Modal for update-->
<div class="modal fade" id="safety" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Safety Values</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<?php 
$saf_id = $constant[0]['id'];

?>
      
      <form action="<?= base_url()?>post/update_safety_value" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                    <label>P/E Ratio:</label>
                  </div>
                  <div class="col-md-8">
                    <!-- <select name="company_name">
                    <?php
                      echo '<option value="">Select Company</option>';
                      foreach ($comp as $ckey => $cval) {
                        echo '<option value='.$cval['symbol'].'>'.$cval['company_name'].'</option>';
                      }
                    ?>
                  </select> -->
                    <input type="number" step="0.01" name="pe_ratio" value="<?= $constant[0]['pe_ratio'] ?>">
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Desirable PB Ratio:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="desirable_pb_ratio" value="<?= $constant[0]['desirable_pb_ratio'] ?>">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>EPS Vs P/E:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="eps_vs_pe" value="<?= $constant[0]['eps_vs_pe'] ?>">
                  </div>
                </div>
                
              </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="safety_id" value="<?= $saf_id ?>">
        <input type="submit" class="btn btn-primary" name="btnsave" value="Update">
      </div>

      </form>

    </div>
  </div>
</div>
<!-- Bv value modal ends  -->
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
//   $('#sector_tbl').on('change', function() {
    
//   // var fromVal1 = $(this).val();
//   var grp = $(this).attr('data-group');
//   console.log(grp);
//   alert(grp);
//     // $('#sector_tbl_id option').each(function(){ //FOR EVERY SECOND OPTION
//     //     if($(this).val() == fromVal1) { //CHECK IF IT IS EQUAL TO THE FIRST SELECTED CHOICE
//     //     $(this).attr('disabled', 'disabled'); //IF IT IS, HIDE IT
//     //     // alert($(this).val());
//     //      } else {
//     //     $(this).removeAttr('disabled'); //OTHERWISE SHOW IT, INCASE HIDDEN FROM PREVIOUS CHOICE
//     //        }
//     //   });
// });

  $("#sector_tbl").change(function() {
  var selectedItem = $(this).val();
  var abc = $('option:selected',this).data("group");
  // alert(abc);
  
  $('#sector_tbl_id').html(abc);
});

</script>