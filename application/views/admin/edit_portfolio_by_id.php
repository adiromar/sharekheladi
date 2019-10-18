<?php

foreach ($portfolio as $pkey => $pval) {
    $symb = $pval['symbol'];
    $price = $pval['price'];
    $kitta = $pval['kitta'];
    $pdate = $pval['purchased_date'];
    $id = $pval['id'];
}

?>

<form action="<?= base_url()?>post/update_portfolio" method="post">
      <div class="modal-body mdl-body2">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">

                  <div class="col-md-2 mt-4">
                    <label><b>Symbol:</b></label>
                  </div>
                  <div class="col-md-10 mt-4">

                    <select name="symbol" required>
                    <<option value="<?= $symb; ?>"><?= $symb; ?></option>
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
                        <label for=""><b>Price</b></label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" step="0.01" name="price" value="<?= $price ?>">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-2">
                        <label for=""><b>Kitta</b></label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="kitta" value="<?= $kitta; ?>">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-2">
                        <label for=""><b>Purchased Date</b></label>
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="purchased_date" class="datepicker" value="<?= $pdate; ?>">
                    </div>
                </div>

              </div>
          </div>
      </div>
      <div class="modal-footer">
      <<input type="hidden" name="id" value="<?= $id ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn_portfolio" value="Update">
      </div>

      </form>