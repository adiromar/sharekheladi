

    <!-- ##### Hero Area Start ##### -->
<?php

error_reporting('false');
?>
    <section class="features-area bg-gray section-padding-100-0" id="scroll-div">
        <div class="container" >
            <div class="row align-items-end">
                <div class="col-12 col-sm-6 col-lg-12">
                    <div class="single-features-area mb-100 wow fadeInUp" data-wow-delay="100ms">
                        <div class="section-heading">
                            <div class="line"></div>
                            <h2>Status Of Company</h2>
        <?php if($fetch == true){ ?>
            <!-- <h5 class="float-right btn-sm mb-2 glow_btn">Market Live</h5> -->
        <?php  }else{ ?>
            <h5 class="float-right btn-sm mb-2 btn btn-secondary" style="color: #fff;">Market Closed</h5>
        <?php  } ?>

        <table class="table table-bordered table-striped table-hover" border="1" >
        <thead class="thead-dark" >
            <th>S.N.</th>
            <th>Company Name</th>
            <th>BV</th> <!-- Manually -->
            <th>EPS</th> <!-- Manually -->
            <th>Market value</th> <!-- live m.p. -->
            <th>PB Ratio</th> <!-- = mp/bv -->
            <th>PE Ratio</th> <!-- = mp/eps -->
            <th>Safe Value</th>
            <th>Consumer Surplus</th>
            <th>CAGR</th>
            <th>cagr m.p</th>
            <th>Recommendation to sell</th>
            <th>Recommendation to buy</th>
        </thead>
        <tbody>
            <?php $i=1;
            $pb=$pe=$bv_value=$eps_value=$emp=0;
            if($fetch == true){
            foreach ($fetch as $fval) {
                $symbol = $fval['symbol'];
                $cons = $this->admin_model->get_eps_bv($fval['symbol']);
                $cagr = $cons[0]['cagr'];

                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$fval['symbol'].'</td>';

                $mp = str_replace(',', '', $fval['market_price']);
                if(empty($cons[0]['book_value'])){
                    echo '<td>0</td>';
                    echo '<td>0</td>';
                }else{
                    $bv_value = $cons[0]['book_value'];
                    $eps_value = $cons[0]['eps_value'];
                    echo '<td>'.$bv_value.'</td>';
                    echo '<td>'.$eps_value.'</td>';
                }
                
                echo '<td>'.$fval['market_price'].'</td>';

                $pb = @($fval['market_price'] / $bv_value);
                $pe = @($fval['market_price'] / $eps_value);

                if(empty($cons[0]['book_value'])){
                    echo '<td>0</td>';
                    echo '<td>0</td>';
                }else{
                    echo '<td>'.number_format($pb, 2, '.', '');'</td>';
                    echo '<td>'.number_format($pe, 2, '.', '');'</td>';
                }
                
                $sec = $this->admin_model->get_sector_id($fval['symbol']);
                $sec_name = $sec[0]['sector'];

                $dpvar = $this->admin_model->get_desired_price($sec_name);
                $dpv = $dpvar[0]['desired_price_variable'];

                $cal = $eps_value * $bv_value;
                $desired = sqrt($cal);
                echo '<td>'.number_format($desired, 2, '.', '').'</td>';
                $surplus = $desired - $mp;
                echo '<td>'.number_format($surplus, 2, '.', '').'</td>';
                echo '<td>'.number_format($cagr, 2, '.', '').'</td>';

                // $get_cagr = $this->admin_model->fetch_cagr($fval['symbol']);
                

                // check for conditions
                $status_ckh = 0;
                if($surplus > 0){
                    $status_ckh++;
                }if($pb <= 1.5){
                    $status_ckh++;
                }if($pe <= 15){
                    $status_ckh++;
                }if($cagr > 9.5 && $cagr < 15){
                    $status_ckh++;
                }

                // echo $status_ckh;

                if($status_ckh == 0){
                    echo '<td><button type="button" class="btn btn-secondary btn-sm" aria-disabled="true">N/A</button></td>';
                }elseif($status_ckh == 1){
                    echo '<td><button type="button" class="btn btn-info btn-sm" aria-disabled="true">Minimal Investment</button></td>';
                }elseif($status_ckh > 1 && $status_ckh < 4){
                    echo '<td><button type="button" class="btn btn-info btn-sm" aria-disabled="true">Possible Investment</button></td>';
                }elseif($status_ckh == 4){
                    echo '<td><button type="button" class="btn btn-success btn-sm" aria-disabled="true">Best Investment</button></td>';
                }

                // if($bv_value == 0){
                //     echo '<td><button class="btn btn-info btn-sm">-</button></td>';
                // }
                // else if ($desired >= $fval['market_price']){
                //     echo '<td><button class="btn btn-primary btn-sm">Possible Investment</button></td>';
                // }else{
                //     echo '<td><button class="btn btn-danger btn-sm">Not Recommended</button></td>';
                // }
                echo '</tr>';
                unset($pb);
            $i++; 
            $bv_value=$eps_value=0; } 
        }else{
            $this->load->view('pages/offline_data');
            // echo '<tr><td colspan="9" style="text-align: center;color: red">Market Unavailable</td></tr>';
        }
            ?>
        
        </tbody>
    </table>

    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    

    <!-- ##### Newsletter Area Start ###### -->
    <section class="newsletter-area section-padding-100 bg-img jarallax" style="background-image: url(<?= base_url()?>assets_front/img/bg-img/6.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-lg-8">
                    <div class="nl-content text-center">
                        <h2>Subscribe to our newsletter</h2>
                        <form action="#" method="post">
                            <input type="email" name="nl-email" id="nlemail" placeholder="Your e-mail">
                            <button type="submit">Subscribe</button>
                        </form>
                        <p>Curabitur elit turpis, maximus quis ullamcorper sed, maximus eu neque. Cras ultrices erat nec auctor blandit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<style>
/* .tbl_header {
  padding: 10px 16px;
  background: #555;
  color: #f1f1f1;
} */

/* .content {
  padding: 16px;
} */

/* .sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 105px;
} */

table thead tr{
    display:block;
}

table th,table td{
    width:100px;
}


table  tbody{
  display:block;
  height: 500px;
  overflow:auto;
}
</style>
<!-- sticky table -->
    <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("tbl_header");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>