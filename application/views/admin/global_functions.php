<?php

// global function 
function cagr_calculation(){
    $get_price = $this->admin_model->get_price($fval['symbol']);
                $beg_price = 0;
                $beg_price = $get_price[0]['beg_price'];
                $share_price = $get_price[0]['share_price'];
                $get = $this->admin_model->get_cagr_data($fval['id']);
                $f_year=$div=$bon='';

                if(!empty($get)){
                    $cc= $gain_year=array('');
                    $f_bg1=$f_dg1=0;
                                  
                    $end_value=$end_value_c=0;
                    foreach ($get as $gkey => $gval) {
                      $f_year .= '-' . $gval['financial_year'] . '<br>';
                      $div .= $gval['dividend'] . '<br>';
                      $bon .= $gval['bonus'] . '<br>';
                      $cc[] = $gval['financial_year'];
            
                      $bon_1 = ($gval['bonus']/100);
                      $bg1 = (100+(100*$bon_1));
                      // $bg2 = $bg1 + ($bg1 * $gval['bonus']);
                      $gain_year[] = $gval['financial_year']; 
                      $div1 = ($get[0]['dividend']/100);
                      $dg1 = ($beg_price*100)*$div1;
            
                      $bon_arr[] = $gval['bonus'];
                      $div_arr[] = $gval['dividend'];
                    }
                  }
                  $num_year = count($cc);
                  $f_bg1 .= $bg1 . '<br>';
        $f_dg1 .= $dg1 . '<br>';
        for ($n=1; $n < $num_year-1; $n++) { 
          $bon_pr = $bon_arr[$n] / 100;
          $div_pr = $bon_arr[$n] / 100;
          // $bg1 = $bg1 + ($bg1 * $gval['bonus']);
          $bg1 = $bg1 + ($bg1 * $bon_pr);
          // echo $bg1;
          $f_bg1 .= number_format(round($bg1),0) . '<br>';

          $dg1 = $bg1 * $div_arr[$n];
          $f_dg1 .= number_format(round($dg1),0) . '<br>';
          $sum_dg += $dg1;
          // echo "bonus on year". $n . 'is - ' . $bg1 . '<br>';
          // echo "Dividend on year". $n . 'is - ' . $dg1;
        }
        $get_mp = $this->admin_model->get_marketprice($fval['symbol']);
        
        $end_value = ($bg1*$mp)+($sum_dg);
        $end_value_c = ($bg1*100)+($sum_dg);
        $initial = (100*$beg_price);
        $cagr = (($end_value/$initial)**(1/($num_year-1)) -1);
        $cagr_c = (($end_value_c/$initial)**(1/($num_year-1)) -1);
        $cagr_per = ($cagr*100);
        $cagr_c_per = ($cagr_c*100);
        if (is_infinite($cagr_per)){
            echo '<td>-</td>';
          }else{
            echo '<td>'.number_format(round($cagr_per),0) .' %</td>';
          }

}




?>