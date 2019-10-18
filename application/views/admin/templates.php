<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    
  </div>

  
	<div class="container" style="background-color: white;">
		
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Company</th>
				<td><a href="<?= base_url()?>admin/template_company" class="btn btn-default">Download</a></td>
			</tr>
			<tr>
				<th>Sector</th>
				<td><a href="<?= base_url()?>company_template.csv" class="btn btn-default">Download</a></td>
			</tr>
		</thead>
	</table>

	</div>
</main>