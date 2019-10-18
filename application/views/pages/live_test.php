<style type="text/css">
	table{
		border-collapse: collapse;
		width: 100%;
	}
	thead{
		color: #fff;
		background-color: grey;
	}

	tr:nth-child(even) {background-color: #f2f2f2;}
</style>

	<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Lorem Ipsum</h1>
        <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple's marketing pages.</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

<div class="cotainer pl-4 pr-4">
	<fieldset><h3>Live Market</h3></fieldset>
<?php
include_once('simple_html_dom.php');

    $htmlContent  = file_get_html('file:///C:/xampp/htdocs/mining/live.html');
    echo $htmlContent;
?>

</div>