<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
   <!--  <ul class="app-breadcrumb breadcrumb">
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
  endif;
    ?>

  </div>

  
	<div class="container pt-4 pl-3 pr-3 pb-3" style="background-color: white;">
	

	<div class="row col-md-12" style="border: 2px solid lightgrey;padding:8px;">

    <div class="col-md-5" style="border-right: 2px solid lightgrey;">
      <label>Add New Company:</label><br>
      <a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#companymodal">Add Company +</a>
    </div>

    <div class="col-md-7">
		<fieldset >
			<label><b>Import Company Details:</b></label>
		<form method="post" action="<?= base_url()?>post/import_company_details" enctype="multipart/form-data">
			<input type="file" name="file">	
			<input type="submit" name="importSubmit" class="btn btn-secondary" value="Import">
		</form>
  </fieldset>
  </div>
</div>


	<table class="table table-bordered table-striped mt-4">
		<thead class="thead-dark">
			<th>S.N</th>
			<th>Company Name</th>
			<th>Symbol</th>
			<th>Book Value</th>
			<th>EPS Value</th>
			<th>CAGR</th>
			<th>Com ID</th>
			<th>Sector ID</th>
			<th></th>
		</thead>
		<tbody>
			<?php $k = 1;
			foreach ($comp as $ckey => $cval) {
				echo '<tr>';
				echo '<td>'.$k.'</td>';
				echo '<td>'.$cval['company_name'].'</td>';
				echo '<td>'.$cval['symbol'].'</td>';
				echo '<td>'.$cval['book_value'].'</td>';
				echo '<td>'.$cval['eps_value'].'</td>';
				echo '<td>'.$cval['cagr'].'</td>';
				echo '<td>'.$cval['com_id'].'</td>';
				echo '<td>'.$cval['sector'].'</td>';
				echo '<td>
					<a href="?id='.$cval['id'].'" data-id="'.$cval['id'].'" data-name="'.$cval['company_name'].'" data-symbol="'.$cval['symbol'].'" data-share_price="'.$cval['share_price'].'" data-bv="'.$cval['book_value'].'" data-eps="'.$cval['eps_value'].'" data-cagr="'.$cval['cagr'].'" data-comid="'.$cval['com_id'].'" data-sector="'.$cval['sector'].'" data-beg_price="'.$cval['beg_price'].'" data-bpy="'.$cval['beg_price_year'].'" class="btn-modal"><i class="fa fa-pencil" data-toggle="modal" data-target="#update_company"></i></a>
          
					<a href="'.base_url().'admin/delete_record?tbl=company_info&&id='.$cval['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
				</td>';
				echo '</tr>';
			$k++; } ?>
		</tbody>
	</table>
	</div>


<!-- Company Modal -->
<div class="modal fade" id="update_company" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/update_company" method="post">
      <div class="modal-body mdl-body">
        

          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                    <label>Company Name:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="company_name" id="name">
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Company Symbol:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="text" name="symbol" id="symbol">
                  </div>
                  
                  <div class="col-md-4 mt-4">
                    <label>Company ID:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" min="0" name="com_id" id="comid">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Per Unit Share Price:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="share_price" id="share_price">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Beginning Price:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="beg_price" id="beg_price">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Beginning Price Year:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <select name="beg_price_year" id="bpy">
                  <?php 
                  foreach ($year as $yr => $yval) {
                    echo '<option>'.$yval['financial_year'].'</option>';
                  }
                  ?>
                    </select>
                    <!-- <input type="number" step="0.01" name="beg_price" class=""> -->
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Book Value:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="book_value" id="bv">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>EPS Value:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="eps_value" id="eps">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>CAGR (in %):</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="cagr" id="cagr">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Sector:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <select name="sector_id" id="sector">
                    <?php
                      echo '<option>--Select Sector--</option>';
                    foreach ($sector as $skey => $sval) {
                      echo '<option value='.$sval['sector_id'].'>'.$sval['sector_name'].'</option>';
                    }
                    ?>
                  </select>
                    <!-- <input type="text" name="sector_id" class=""> -->
                  </div>
                </div>
                
              </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <input type="hidden" name="id" value="" id="rec_id">
        <input type="submit" class="btn btn-primary" name="btnsave" value="Update">
      </div>

      </form>

    </div>
  </div>
</div>
<!-- update company modal ends  -->

<!-- add Company Modal -->
<div class="modal fade" id="companymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/add_company" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-4">
                    <label>Company Name:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="company_name" class="">
                  </div>
                  
                  <br/>

                  <div class="col-md-4 mt-4">
                    <label>Company Symbol:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="text" name="symbol" class="">
                  </div>
                  
                  <div class="col-md-4 mt-4">
                    <label>Company ID:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" min="0" name="com_id" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Per Unit Share Price:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="share_price" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Beginning Price:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="beg_price" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Beginning Price Year:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <select name="beg_price_year">
                  <?php 
                  foreach ($year as $yr => $yval) {
                    echo '<option>'.$yval['financial_year'].'</option>';
                  }
                  ?>
                    </select>
                    <!-- <input type="number" step="0.01" name="beg_price" class=""> -->
                  </div>
                  <div class="col-md-4 mt-4">
                    <label>Book Value:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="book_value" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>EPS Value:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="eps_value" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>CAGR (in %):</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <input type="number" step="0.01" name="cagr" class="">
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Sector:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <select name="sector_id">
                    <?php
                      echo '<option>--Select Sector--</option>';
                    foreach ($sector as $skey => $sval) {
                      echo '<option value='.$sval['sector_id'].'>'.$sval['sector_name'].'</option>';
                    }
                    ?>
                  </select>
                    <!-- <input type="text" name="sector_id" class=""> -->
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
<!-- company modal ends  -->
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).on("click", ".btn-modal", function () {
		
     var id = $(this).data('id');
     console.log("btn clicked: " + id);
     $(".modal-body .rec_id").html( id );

     // $('#addBookDialog').modal('show');
});

// edit record
// $(document).on('click', '.btn-modal', function(){  
//            var id = $(this).attr("id");  
//            console.log(id);
//            $.ajax({  
//                 url:"fetch.php",  
//                 method:"POST",  
//                 data:{id:id},  
//                 dataType:"json",  
//                 success:function(data){  
//                      $('#name').val(data.name);  
//                      $('#address').val(data.address);  
//                      $('#gender').val(data.gender);  
//                      $('#designation').val(data.designation);  
//                      $('#age').val(data.age);  
//                      $('#employee_id').val(data.id);  
//                      $('#insert').val("Update");  
//                      $('#add_data_Modal').modal('show');  
//                 }  
//            });  
//       });  

$('.btn-modal').on('click', function(e){
// $(".btn-modal").click(function(e) {
  e.preventDefault();
  var id = $(this).attr("data-id");
  var company = $(this).attr("data-name");
  var symbol = $(this).attr("data-symbol");
  var eps = $(this).attr("data-eps");
  var bv = $(this).attr("data-bv");
  var comid = $(this).attr("data-comid");
  var cagr = $(this).attr("data-cagr");
  var sector = $(this).attr("data-sector");
  var share = $(this).attr("data-share_price");
  var beg_price = $(this).attr("data-beg_price");
  var bpy = $(this).attr("data-bpy");
  // var name = $("#name").val(); 
    // alert(data);
    // $('#update_company').modal({show:true});
     // $('#update_company').show();

     $(".modal-body #name").val( company );
     $(".modal-body #symbol").val( symbol );
     $(".modal-body #eps").val( eps );
     $(".modal-body #bv").val( bv );
     $(".modal-body #comid").val( comid );
     $(".modal-body #share_price").val( share );
     $(".modal-body #cagr").val( cagr );
     $(".modal-body #sector").val( sector );
     $(".modal-body #beg_price").val( beg_price );
     $(".modal-body #bpy").val( bpy );

     $(".modal-footer #rec_id").val( id );
      $.ajax({
    type:'POST',
    data:data,
    url:'admin/ajax',
    success:function(data) {
      alert(data);
    }
  });
});
</script>