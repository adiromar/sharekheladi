<?php

include_once('simple_html_dom.php');
   // create HTML DOM
	$html = file_get_html('file:///C:/xampp/htdocs/mining/live.html');
    // $html = file_get_html('http://localhost:8080/mining/original.php')->plaintext;
    // echo $html;

    $rows = explode("\n",$html);
    echo '<pre>';
	// print_r($rows);die;
	$s = array();
	foreach($rows as $row) {
	    $s[] = $row;
	}
	echo '<pre>';
	// echo $s[12];echo $s[13];
	// $t = array_slice($s, 11);
	$chk = array_chunk($s, 11);
	print_r($s);
	// echo count($chk);
	echo '</pre>';
?>
<table class="table table-border" border="1">
	<thead>
		<tr>
			<th>sn</th>
			<th>symbol</th>
			<th>LTP</th>
			<th>LTV</th>
			<th>Points change </th>
			<th>% change</th>
			<th>open</th>
			<th>high</th>
			<th>low</th>
			<th>volume</th>
			<th>previous</th>
			<th>closing</th>
		</tr>
	</thead>
	<tbody>
		<?php 

		foreach ($chk as $key => $val) { ?>
		<tr>
			<td><?= $val[0] ?></td>
			<td><?= $val[1] ?></td>
			<td><?= $val[2] ?></td>
			<td><?= $val[3] ?></td>
			<td><?= $val[4] ?></td>
			<td><?= $val[5] ?></td>
			<td><?= $val[6] ?></td>
			<td><?= $val[7] ?></td>
			<td><?= $val[8] ?></td>
			<td><?= $val[9] ?></td>
			<td><?= $val[10] ?></td>
			<!-- <td><?= $val[11] ?></td> -->
		</tr>
	<?php
	
	?>
	<?php } ?>
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