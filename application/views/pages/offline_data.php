<?php

$fetch1 = $this->post_model->get_marketinfo_normal();
// echo '<pre>';
// print_r($fetch1);
            $i=1;
            
            if($fetch1 == true){
                $end_value=$end_value_c=$sum_dg=$beg_price=$share_price=0;
                $f_bg1=0;
                $pb=$pe=$bv_value=$eps_value=$emp=$cagr=$cagr_per=0;
            foreach ($fetch1 as $fval) {
                $symbol = $fval['symbol'];
                $cons = $this->admin_model->get_eps_bv($fval['symbol']);
                $cagrr = $cons[0]['cagr'];

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
                // echo '<td>'.number_format($cagrr, 2, '.', '').'</td>';

// -------------------------- cagr calculation real time --------------------

                $cagr_tbl_id = $this->admin_model->get_cagr_info_by_symbol($fval['symbol']);
                $cgr_tbl_id = $cagr_tbl_id[0]['id'];
                $get = $this->admin_model->get_cagr_data($cgr_tbl_id);
                $f_year=$div=$bon='';

                if(!empty($get)){
                    $get_price = $this->admin_model->get_price($fval['symbol']);
                    // $beg_price = 0;
                    $beg_price = $get_price[0]['beg_price'];
                    $share_price = $get_price[0]['share_price'];

                    $cc= $gain_year=array('');
                    // $f_bg1=$f_dg1=0;
                                  
                    // $end_value=$end_value_c=0;
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
                  $sum_dg += $dg1;
// echo 'sum dg: '.$sum_dg;
                  $num_year = count($cc);
                  $num_yr = $num_year -1;

        $f_bg1 .= $bg1 . '<br>';
        $f_dg1 .= $dg1 . '<br>';
        for ($n=1; $n < $num_year-1; $n++) { 
          $bon_pr = $bon_arr[$n] / 100;
          $div_pr = $div_arr[$n] / 100;
          // $bg1 = $bg1 + ($bg1 * $gval['bonus']);
          $prv_bon[] = round($bg1);
          $prev_bg = $bg1;
          $bg1 = $bg1 + ($bg1 * $bon_pr);
          // echo $bg1;
          $f_bg1 .= number_format(round($bg1),0) . '<br>';

        //   $dg1 = $bg1 * $div_arr[$n];
        //   $dg1 = ($prev_bg * $share_price) * $div_pr;
          $dg1 = ($prv_bon[$n-1] * $beg_price) * $div_pr;
          $f_dg1 .= number_format(round($dg1),0) . '<br>';
          $sum_dg += $dg1;
          // echo "bonus on year". $n . 'is - ' . $bg1 . '<br>';
          // echo "Dividend on year". $n . 'is - ' . $dg1;
        }
        $get_mp = $this->admin_model->get_marketprice($fval['symbol']);
        $gmp = $get_mp[0]['market_price'];
        
        $end_value = (round($bg1)*$gmp)+($sum_dg);
        $end_value_c = (round($bg1)*100)+($sum_dg);
        $initial = ($share_price*$beg_price);
        $cagr = (($end_value/$initial)**(1/($num_yr)) -1);
        $cagr_c = (($end_value_c/$initial)**(1/($num_yr)) -1);
        $cagr_per = ($cagr*100);
        $cagr_c_per = ($cagr_c*100);
    // }
        if (is_infinite($cagr_per)){
            echo '<td>-</td>';
          }elseif(is_nan($cagr_per)){
            echo '<td>-</td>';
          }else{
            echo '<td>'.number_format(round($cagr_per),0) .' %</td>';
          }
          echo '<td>'.$f_bg1.'</td>';
          echo '<td>'.$f_dg1.'</td>';
                // check for conditions
                $status_ckh = 0;
                if($surplus > 0){
                    $status_ckh++;
                }if($pb <= 1.5){
                    $status_ckh++;
                }if($pe <= 15){
                    $status_ckh++;
                }if($cagr_per > 9.5 && $cagr_per < 15){
                    $status_ckh++;
                }

                // echo $status_ckh;

                if($status_ckh == 0){
                    echo '<td><button class="btn btn-secondary btn-sm">N/A</button></td>';
                }elseif($status_ckh == 1){
                    echo '<td><button class="btn btn-danger btn-sm">Minimal Investment</button></td>';
                }elseif($status_ckh > 1 && $status_ckh < 4){
                    echo '<td><button class="btn btn-info btn-sm">Possible Investment</button></td>';
                }elseif($status_ckh == 4){
                    echo '<td><button class="btn btn-success btn-sm">Best Investment</button></td>';
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
            
            $bv_value=$eps_value=$f_bg1=$f_dg1=$cagr=$end_value=$end_value_c=$cc=0;
        $get_price=$get=$cagr_per=$bg1=$dg1=$sum_dg=$initial=$num_year=$beg_price=$share_price=0; 
        $i++; 
    } 
        }else{
            echo '<tr><td colspan="9" style="text-align: center;color: red">Market Unavailable</td></tr>';
        }
?>