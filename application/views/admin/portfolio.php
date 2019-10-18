<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    <style>
        .arrow-red{
            color: red;
            font-size: 30px;
        }
        .arrow-grn{
            color: green;
            font-size: 30px;
        }
    </style>


    <?php if($this->session->flashdata('inserted')):
    echo '<p class="alert alert-success"><b>'.$this->session->flashdata('inserted').'</b></p>';
  endif;
  if($this->session->flashdata('error')):
    echo '<p class="alert alert-danger"><b>'.$this->session->flashdata('error').'</b></p>';
  endif;
?>
  </div>

  
	<div class="container" style="background-color: white;padding: 8px;">
		<a href="#" data-toggle="modal" data-target="#bd-example-modal-lg" class="btn btn-info btn-sm">+ Add Your Portfolio</a>
	
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Symbol</th>
                <th>Price</th>
                <th>Kitta</th>
                <th>Date</th>
                <th>Total</th>
                <th>Today's Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $k =1;
            if (!empty($portfolio)){
            foreach ($portfolio as $pk => $pval) {
                echo '<tr>';
                echo '<td>'.$k.'</td>';
                echo '<td>'.$pval['symbol'].'</td>';
                echo '<td>'.$pval['price'].'</td>';
                echo '<td>'.$pval['kitta'].'</td>';
                echo '<td>'.$pval['total'].'</td>';
                echo '<td>'.$pval['total'].'</td>';

                $lat_price = $this->admin_model->get_marketprice($pval['symbol']);
                $todays_price = $lat_price[0]['market_price'];
                echo '<td>'.$todays_price.'</td>';

                // checking if status is good
                if($pval['price'] > $todays_price){
                    echo '<td><i class="fa fa-arrow-circle-down arrow-red"></i></td>';
                }elseif($pval['price'] == $todays_price){
                    echo '<td class="arrow-grn"><i class="fa fa-equals arrow-grn"></i>No Change</td>';
                }else{
                    echo '<td><i class="fa fa-arrow-circle-up arrow-grn"></i></td>';
                }
                // edit / delete
                echo '<td>
                        <a href="" class="icon-blue"><i class="fa fa-pencil"></i></a>
                        <a href="'.base_url().'admin/delete_record?tbl=portfolio&&id='.$pval['id'].'" onclick="return check_del();" class="icon-red"><i class="fa fa-trash"></i></a>
                    </td>';
                echo '</tr>';
            $k++; } 
            }else{
                echo '<tr>';
                    echo '<td colspan="8">No Portfolio Found</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>


<!-- Portfolio Modal -->
<div class="modal fade" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="min-width: 1050px;background-color: #d4d6d7;right:120px;">
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
        <input type="submit" class="btn btn-primary" name="btn_portfolio" value="save">
      </div>

      </form>
    </div>
  </div>
</div>
<!-- Portfolio modal ends  -->

<script>
 $.fn.datepicker.defaults.format = "mm/dd/yyyy";
$('.datepicker').datepicker({
    startDate: '-3d'
});   
</script>
	</div>
</main>