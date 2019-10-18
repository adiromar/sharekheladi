<?php

?>

<!-- <main> -->
<div class="container pt-5 mx-auto mt-4">
	<h4>Market Info</h4>
	<table class="table table-bordered table-hover" border="1">
		<thead class="table-primary">
			<th>sn</th>
			<th>code</th>
			<th>BV</th> <!-- Manually -->
			<th>EPS</th> <!-- Manually -->
			<th>Market value</th> <!-- live m.p. -->
			<th>PB</th> <!-- = mp/bv -->
			<th>PE</th> <!-- = mp/eps -->
		</thead>
		<tbody>
			<?php $i=1;
			$pb=$pe=$bv_value=$eps_value=$emp=0;
			foreach ($fetch as $fval) {
				$symbol = $fval['symbol'];
				$cons = $this->admin_model->get_constant($fval['symbol']);
				// echo '<pre>';
				// print_r($cons);
				// echo '</pre>';

				echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.$fval['symbol'].'</td>';

				
				if(empty($cons[0]['bv_value'])){
					echo '<td>0</td>';
					echo '<td>0</td>';
				}else{
					$bv_value = $cons[0]['bv_value'];
					$eps_value = $cons[0]['eps_value'];
					echo '<td>'.$bv_value.'</td>';
					echo '<td>'.$eps_value.'</td>';
				}
				
				echo '<td>'.$fval['market_price'].'</td>';

				$pb = @($fval['market_price'] / $bv_value);
				$pe = @($fval['market_price'] / $eps_value);

				if(empty($cons[0]['bv_value'])){
					echo '<td>'.$fval['market_price'].'</td>';
					echo '<td>'.$fval['market_price'].'</td>';
				}else{
					echo '<td>'.number_format($pb, 2, '.', '');'</td>';
					echo '<td>'.number_format($pe, 2, '.', '');'</td>';
				}
				

				echo '</tr>';
				unset($pb);
			$i++; } 
			?>
		</tbody>
	</table>
</div>
<!-- </main> -->


