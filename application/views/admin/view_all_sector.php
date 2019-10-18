<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    <!-- <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admins/index"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><?= $title?></li>
    </ul> -->

    <?php if(!empty($success_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    </div>
    <?php } if(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
    <?php }
    if($this->session->flashdata('inserted')):
    echo '<p class="alert alert-success"><b>'.$this->session->flashdata('inserted').'</b></p>';
  endif; 
  if($this->session->flashdata('error')):
    echo '<p class="alert alert-danger"><b>'.$this->session->flashdata('error').'</b></p>';
  endif;?>

  </div>

  
	<div class="container pt-4 pl-3 pr-3 pb-3" style="background-color: white;">
	

	<div class="row col-md-12" style="border: 2px solid lightgrey;padding:8px;">
		<div class="col-md-5" style="border-right: 2px solid lightgrey;">
      		<label>Add New Sector:</label><br>
      		<a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#new_sector_modal">Add Sector +</a>
    	</div>

		<div class="col-md-7">
		<fieldset >
			<label><b>Import Sector Details:</b></label>
		<form method="post" action="<?= base_url()?>post/import_sector_details" enctype="multipart/form-data">
			<input type="file" name="file">	
			<input type="submit" name="importSubmit" class="btn btn-secondary" value="Import">
		</form></fieldset>
		</div>
	</div>


	<table class="table table-bordered table-striped mt-4">
		<thead class="thead-dark">
			<th>S.N</th>
			<th>Sector Name</th>
			<th>Sector ID</th>
			<th>Desired Price Variable</th>
			<th></th>
		</thead>
		<tbody>
			<?php $k = 1;
			foreach ($sector as $ckey => $cval) {
				echo '<tr>';
				echo '<td>'.$k.'</td>';
				echo '<td>'.$cval['sector_name'].'</td>';
				echo '<td>'.$cval['sector_id'].'</td>';
				echo '<td>'.$cval['desired_price_variable'].'</td>';
				echo '<td>
					<a href="?id='.$cval['id'].'" data-id="'.$cval['id'].'" data-name="'.$cval['sector_name'].'" data-sectorid="'.$cval['sector_id'].'" data-dpv="'.$cval['desired_price_variable'].'" class="btn-modal"><i class="fa fa-pencil" data-toggle="modal" data-target="#update_sector"></i></a>

					<a href="'.base_url().'admin/delete_record?tbl=sector_details&&id='.$cval['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
				</td>';
				echo '</tr>';
			$k++; } ?>
		</tbody>
	</table>
	</div>

<!-- Add sector Modal -->
<div class="modal fade" id="new_sector_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Sector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/add_sector" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                    <label>Sector Name:</label>
                  </div>
                  <div class="col-md-8">
                    <!-- <input type="text" name="sector_name" class=""> -->
                    <select name="sector_name" id="sector_tbl">
                        <option value="" data-group="none">--Select--</option>
                        <option value="Commercial Banks" data-group="c1">Commercial Banks</option>
                        <option value="Corporate Debenture" data-group="c2">Corporate Debenture</option>
                        <option value="Development Banks" data-group="d1">Development Banks</option>
                        <option value="Finance" data-group="f1">Finance</option>
                        <option value="Hydro Power" data-group="h1">Hydro Power</option>
                        <option value="Hotels" data-group="h2">Hotels</option>
                        <option value="Life Insurance" data-group="l1">Life Insurance</option>
                        <option value="Microfinance" data-group="m1">Microfinance</option>
                        <option value="Mutual Fund" data-group="m2">Mutual Fund</option>
                        <option value="Manufacturing And Processing" data-group="m3">Manufacturing And Processing</option>
                        <option value="Non Life Insurance" data-group="n1">Non Life Insurance</option>
                        <option value="Preferred Stock" data-group="p1">Preferred Stock</option>
                        <option value="Tradings" data-group="t1">Tradings</option>
                        <option value="Others" data-group="oth">Others</option>
                    </select>
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Sector ID:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" min="1" max="1000" name="sector_id" class="">

                    <!-- <select name="sector_id">
                      <option id="sector_tbl_id"></option>
                    </select> -->
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Desired Price Variable:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="desired_price_variable" placeholder=" Value of x">
                  </div>
                </div>
                
              </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btnsave" value="save">
      </div>

      </form>

    </div>
  </div>
</div>
<!-- sector modal ends  -->

<!-- Update Modal -->
<div class="modal fade" id="update_sector" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Sector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/update_sector" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                    <label>Sector Name:</label>
                  </div>
                  <div class="col-md-8">
                    <!-- <input type="text" name="sector_name" class=""> -->
                    <select name="sector_name" id="sector_tbl">
                        <option value="" data-group="none">--Select--</option>
                        <option value="Commercial Banks" data-group="c1">Commercial Banks</option>
                        <option value="Corporate Debenture" data-group="c2">Corporate Debenture</option>
                        <option value="Development Banks" data-group="d1">Development Banks</option>
                        <option value="Finance" data-group="f1">Finance</option>
                        <option value="Hydro Power" data-group="h1">Hydro Power</option>
                        <option value="Hotels" data-group="h2">Hotels</option>
                        <option value="Life Insurance" data-group="l1">Life Insurance</option>
                        <option value="Microfinance" data-group="m1">Microfinance</option>
                        <option value="Mutual Fund" data-group="m2">Mutual Fund</option>
                        <option value="Manufacturing And Processing" data-group="m3">Manufacturing And Processing</option>
                        <option value="Non Life Insurance" data-group="n1">Non Life Insurance</option>
                        <option value="Preferred Stock" data-group="p1">Preferred Stock</option>
                        <option value="Tradings" data-group="t1">Tradings</option>
                        <option value="Others" data-group="oth">Others</option>
                    </select>
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Sector ID:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" min="1" max="1000" name="sector_id" id="sector_id">

                    <!-- <select name="sector_id">
                      <option id="sector_tbl_id"></option>
                    </select> -->
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Desired Price Variable:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="desired_price_variable" placeholder=" Value of x" id="dpv">
                  </div>
                </div>
                
              </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="rec_id" id="rec_id">
        <input type="submit" class="btn btn-primary" name="btnsave" value="Update">
      </div>

      </form>

    </div>
  </div>
</div>
<!-- sector modal ends  -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$('.btn-modal').on('click', function(e){
// $(".btn-modal").click(function(e) {
  e.preventDefault();
  var id = $(this).attr("data-id");
  var name = $(this).attr("data-name");
  var sectorid = $(this).attr("data-sectorid");
  var dpv = $(this).attr("data-dpv");

     $(".modal-body #sector_tbl").val( name );
     $(".modal-body #sector_id").val( sectorid );
     $(".modal-body #dpv").val( dpv );

     $(".modal-footer #rec_id").val( id );
});
</script>
</main>