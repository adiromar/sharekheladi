<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admins/index"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><?= $title?></li>
    </ul>
  </div>

  
	<div class="container" style="background-color: white;">
		<?php
        echo '<table class="table table-bordered table-striped">';
          echo '<tr>';
            echo '<th>SN</th>';
            echo '<th>Company Name</th>';
            // echo '<th>Symbol</th>';
            echo '<th>BV</th>';
            echo '<th>EPS</th>';
            echo '<th></th>';
          echo '</tr>';
      $i=1;
      foreach ($rec as $record => $rval) {
        
          echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$rval['company_id'].'</td>';
            // echo '<td>'.$rval['symbol'].'</td>';
            echo '<td>'.$rval['bv_value'].'</td>';
            echo '<td>'.$rval['eps_value'].'</td>';
            echo '<td><button class="btn btn-primary btn-sm">Edit</button></td>';
          echo '</tr>';
      $i++; }  ?>
	
</div>
</main>