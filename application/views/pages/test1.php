<?php


// echo "here";
error_reporting('false');

?>

<div class="" style="background-color: white;padding: 12px;">
		
<table class="table table-bordered table-striped table-hover" border="1">
        <thead class="thead-dark">
            <th>S.N.</th>
            <th>Company Name</th>
            <th>BV</th> <!-- Manually -->
            <th>EPS</th> <!-- Manually -->
            <th>Market value</th> <!-- live m.p. -->
            <th>PB Ratio</th> <!-- = mp/bv -->
            <th>PE Ratio</th> <!-- = mp/eps -->
            <th>Desired Price</th>
            <th>Consumer Surplus</th>
            <th>CAGR</th>
            <th>cagr m.p</th>
            <th>Status</th>
        </thead>
        <tbody>
        <?php $this->load->view('pages/offline_data'); ?>
        </tbody>
        </table>
  
    </div>