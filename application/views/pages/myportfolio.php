<style>
        .arrow-red{
            color: red;
            font-size: 30px;
        }
        .arrow-grn{
            color: green;
            font-size: 30px;
        }
        .icon-red{
            color: red;
        }
        .icon-blue{
            color: blue;
        }
    </style>

<div class="container pt-5">
<?php if($this->session->flashdata('inserted')):
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>'.$this->session->flashdata('inserted').'</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  endif;
  if($this->session->flashdata('error')):
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>'.$this->session->flashdata('error').'</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  endif;
?>

<a href="#" data-toggle="modal" data-target="#portfolio-lg" class="btn btn-info btn-sm add_link">+ Add Your Portfolio</a>
	
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Symbol</th>
                <th>Price</th>
                <th>Kitta</th>
                <th>Total</th>
                <th>Today's Price</th>
                <th>Diff.</th>
                <th>Purchased Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $k =1;
            if (!empty($portfolio)){
              $tot_price=$tot_kitta=$g_tot=$g_diff=0;
            foreach ($portfolio as $pk => $pval) {
                $tot_price += $pval['price'];
                $tot_kitta += $pval['kitta'];
                $g_tot += $tot_price * $tot_kitta;
                
                echo '<tr>';
                echo '<td>'.$k.'</td>';
                echo '<td>'.$pval['symbol'].'</td>';
                echo '<td>'.$pval['price'].'</td>';
                echo '<td>'.$pval['kitta'].'</td>';
                echo '<td>'.$pval['total'].'</td>';

                $lat_price = $this->admin_model->get_marketprice($pval['symbol']);
                $todays_price = $lat_price[0]['market_price'];
                $diff = $todays_price - $pval['price'];
                $g_diff += $diff;

                echo '<td>'.$todays_price.'</td>';
                echo '<td>'.number_format($diff, 2).'</td>';
                echo '<td>'.$pval['purchased_date'].'</td>';
                // checking if status is good
                if($pval['price'] > $todays_price){
                    echo '<td><i class="fa fa-arrow-circle-down arrow-red"></i></td>';
                }elseif($pval['price'] == $todays_price){
                    echo '<td><i class="fa fa-equals arrow-grn"></i>No Change</td>';
                }else{
                    echo '<td><i class="fa fa-arrow-circle-up arrow-grn"></i></td>';
                }
                echo '<td>
                        <a class="icon-blue" name="fid" data-id="'.$pval['id'].'" onclick="launch_view_modal('.$pval['id'].')"><i class="fa fa-pencil"></i></a>
                        <a href="'.base_url().'admin/delete_record?tbl=portfolio&&id='.$pval['id'].'" onclick="return check_del();" class="icon-red"><i class="fa fa-trash"></i></a>
                    </td>';
                echo '</tr>';
            $k++; } 
            echo '<tr>';
                echo '<td><b>Total: </b></td>';
                echo '<td></td>';
                echo '<td><b>'.$tot_price.'</b></td>';
                echo '<td><b>'.$tot_kitta.'</b></td>';
                echo '<td><b>'.$g_tot.'</b></td>';
                echo '<td></td>';
                echo '<td><b>'.$g_diff.'</b></td>';
            echo '<tr>';
            }else{
                echo '<tr>';
                    echo '<td colspan="8">No Portfolio Found</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Portfolio Modal -->
<div class="modal fade" id="portfolio-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background-color: #f9f7f7;">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Portfolio Details:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/insert_portfolio" method="post">
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
                        $val = $this->admin_model->check_inserted_portfolio('portfolio', $sval['symbol'], $user_id);

                        if($val[0]['symbol'] == $sval['symbol']){
                          echo '<option value="'.$sval['symbol'].'" disabled>'.$sval['symbol']. ' - ' .$sval['company_name'] .'</option>';
                        }else{
                          echo '<option value="'.$sval['symbol'].'" >'.$sval['symbol']. ' - ' .$sval['company_name'] .'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>

                </div>

                <div class="row mt-4">
                    <div class="col-md-2">
                        <label for="">Price</label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" step="0.01" name="price">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-2">
                        <label for="">Kitta</label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="kitta">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-2">
                        <label for="">Purchased Date</label>
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="purchased_date" class="datepicker">
                    </div>
                </div>

              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn_portfolio" value="Insert">
      </div>

      </form>
    </div>
  </div>
</div>
<!-- Portfolio modal ends  -->

<!-- Edit Modal -->
<button style="display: none" type="button" class="btn btn-primary" id="click_it1" data-toggle="modal" data-target="#view-modal">View modal</button>

<div class="modal fade bd-example-modal-lg" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content pt-1 pl-2 pr-2 pb-5" style="background-color: #d4d6d7;min-width: 1050px;right: 250px;">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Portfolio Details:</h5>
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
<script>
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
          url: "<?= base_url(); ?>admin/fetch_portfolio_by_id",
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
</div>