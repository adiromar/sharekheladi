<?php

include_once('simple_html_dom.php');
   // create HTML DOM
	$htmlContent  = file_get_html('file:///C:/xampp/htdocs/mining/live.html');

    $DOM = new DOMDocument();
    $DOM->loadHTML($htmlContent);

    $tables = $DOM->getElementsByTagName('table');

    $Header = $tables->item(0)->getElementsByTagName('td');
    $Detail = $DOM->getElementsByTagName('td');

    // Get header name of the table
    foreach($Header as $NodeHeader) 
    {
        $s[] = trim($NodeHeader->textContent);
    }
    echo '<pre>';
    // print_r($s);die;

    $t = array_slice($s, 11);
    $chk = array_chunk($t, 11);
    // $splice = array_splice($chk, 2);
    // echo '<pre>';
    // print_r($chk);

    $keys = $value = array();
    foreach ($chk as $key => $val) {
        $keys[] = $val[1];
        $value[] = $val[2];
    }
    $comb = array_combine($keys, $value);
    // print_r($comb);

    foreach ($comb as $ckey => $cval) {
    	$dataa = array(
    		'symbol' => $ckey,
    		'market_price' => $cval
    	);

    	// echo $dataa['symbol'];die;
    	$check = $this->post_model->check_duplicate($dataa['symbol']);
    	if ($check > 0){
    		// update query

    	}else{
    		// insert query
    		$ins = $this->post_model->insert_live_in_db($dataa);
    	}

    	
    }
    
    // $json_data = json_encode($comb);
    // echo $encode_data;

    // $ins = $this->post_model->insert_json_in_db($json_data);
?>
<table class="table table-border" border="1">
	<thead>
		<tr>
			<th>sn</th>
			<th>symbol</th>
			<th>Market Price</th>
			
			<th>volume</th>
			<th>previous</th>
			<th>closing</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$k = 1;
		foreach ($comb as $key => $val) { ?>
		<tr>
			<td><?= $k; ?></td>
			<td><?= $key ?></td>
			<td><?= $val ?></td>
			
		</tr>

	<?php $k++; } ?>
	</tbody>
</table>








<?php
die;
    // echo $html;
    // get news block
    foreach($html->find('table') as $article) {
        // get title
        $item['title'] = trim($article->find('td', 0)->plaintext);
        // get details
        // $item['details'] = trim($article->find('p', 0)->plaintext);
        // get intro
        // $item['diggs'] = trim($article->find('li a strong', 0)->plaintext);

        $ret[] = $item;
    }
    
    // clean up memory
    $html->clear();
    unset($html);

    echo "Result is:";
    return $ret;

?>