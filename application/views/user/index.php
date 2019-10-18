<main class="app-content">
		<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>

<div>
<?php if($this->session->flashdata('inserted')):
    echo '<p class="alert alert-success"><b>'.$this->session->flashdata('inserted').'</b></p>';
  endif;
  if($this->session->flashdata('error')):
    echo '<p class="alert alert-danger"><b>'.$this->session->flashdata('error').'</b></p>';
  endif;

  if($this->session->flashdata('vali')):
    echo '<p class="alert alert-warning"><b>'.$this->session->flashdata('vali').'</b></p>';
  endif;
?>
</div>
  </div>

  <div class="container pt-4 pb-4" style="background-color: white;">

  <a href="<?= base_url()?>user/new_user" class="btn btn-success btn-sm" data-toggle="modal" data-target="#newuser">+ Add New User</a>
	
<div class="row pl-3 pt-2">
	<table class="table table-bordered table-responsive table-hover table-striped">
		<thead class="thead-light">
			<tr>
				<th>S.N.</th>
				<th>User Name</th>
				<th>Email</th>
				<th>User Role</th>
        <th>Status</th>
				<th></th>
			</tr>
		</thead>
    <tbody>
      <?php $k = 1;
foreach ($user as $ukey => $uval) {
      echo '<tr>';
        echo '<td>'.$k.'</td>';
        echo '<td>'.$uval['user_name'].'</td>';
        echo '<td>'.$uval['email'].'</td>';
        echo '<td>'.$uval['user_role'].'</td>';
        echo '<td>'.$uval['status'].'</td>';
        echo '<td>
          <a href="" data-id="'.$uval['id'].'" data-user_name="'.$uval['user_name'].'" data-email="'.$uval['email'].'" data-user_role="'.$uval['user_role'].'" data-status="'.$uval['status'].'" class="btn-modal"><i class="fa fa-pencil" data-toggle="modal" data-target="#update_user"></i></a>

          <a href="'.base_url().'admin/delete_record?tbl=user_login&&id='.$uval['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
        </td>';
      echo '</tr>';

$k++; } ?>
    </tbody>
	</table>
</div>

  </div>
</main>


<!-- User Modal -->
<div class="modal fade" id="newuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?php echo validation_errors(); ?>
      <form action="<?= base_url()?>user/add_new_user" method="post">
      <div class="modal-body mdl-body">
        
          

          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-5">
                    <label>User Name:<span class="req_cls">*</span></label>
                  </div>
                  <div class="col-md-7">
                    <input type="text" name="user_name" autocomplete="off" required>
                  </div>
                  
                  <br/>

                  <div class="col-md-5 mt-4">
                    <label>Email:</label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <input type="email" name="email" class="">
                  </div>

                  <div class="col-md-5 mt-4">
                    <label>User Password:<span class="req_cls">*</span></label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <input type="password" name="password" class="" id="pass" minlength="6" required>
                  </div>

                  <div class="col-md-5 mt-4">
                    <label>Confirm Password:<span class="req_cls">*</span></label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <input type="password" name="confirm_password" class="" minlength="6" id="confirm_pass" required>
                  </div>
                  
    <div class="registrationFormAlert col-md-12" id="divCheckPasswordMatch"></div>

                  <div class="col-md-5 mt-4">
                    <label>User Role:</label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <select name="user_role" required>
                    	<option value="">--Choose--</option>
                    	<option value="Admin">Admin</option>
                    	<option value="Contributor">Contributor</option>
                    	<option value="User">User</option>
                  	</select>
                    <!-- <input type="text" name="sector_id" class=""> -->
                  </div>

                  <div class="col-md-5 mt-4">
                    <label>User Status:</label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <select name="user_status" required>
                    	<option value="Inactive">--Choose--</option>
                    	<option value="Inactive">Inactive</option>
                    	<option value="Active">Active</option>
                    	<option value="Suspended">Suspended</option>
                  	</select>
                    <!-- <input type="text" name="sector_id" class=""> -->
                  </div>
                </div>
                
              </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="btnsave" value="Add User" id="btnsave">
      </div>

      </form>

    </div>
  </div>
</div> 

<!-- update User Modal -->
<div class="modal fade" id="update_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?php echo validation_errors(); ?>
      <form action="<?= base_url()?>user/update_user" method="post">
      <div class="modal-body mdl-body">
        
          

          <div class="row">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-5">
                    <label>User Name:<span class="req_cls">*</span></label>
                  </div>
                  <div class="col-md-7">
                    <input type="text" name="user_name" autocomplete="off" id="user_name" required>
                  </div>
                  
                  <br/>

                  <div class="col-md-5 mt-4">
                    <label>Email:</label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <input type="email" name="email" id="email">
                  </div>

                  <div class="col-md-5 mt-4">
                    <label>User Password:<span class="req_cls">*</span></label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <input type="password" name="password" class="" id="passs" minlength="6" required>
                  </div>

                  <div class="col-md-5 mt-4">
                    <label>Confirm Password:<span class="req_cls">*</span></label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <input type="password" name="confirm_password" class="" id="confirm_passs" minlength="6" required>
                  </div>
                  
    <div class="registrationFormAlert col-md-12" id="divCheckPasswordMatchs"></div>

                  <div class="col-md-5 mt-4">
                    <label>User Role:</label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <select name="user_role" id="user_role" required>
                      <option value="">--Choose--</option>
                      <option value="Admin">Admin</option>
                      <option value="Contributor">Contributor</option>
                      <option value="User">User</option>
                    </select>
                    <!-- <input type="text" name="sector_id" class=""> -->
                  </div>

                  <div class="col-md-5 mt-4">
                    <label>User Status:</label>
                  </div>
                  <div class="col-md-7 mt-4">
                    <select name="user_status" id="status" required>
                      <option value="Inactive">--Choose--</option>
                      <option value="Inactive">Inactive</option>
                      <option value="Active">Active</option>
                      <option value="Suspended">Suspended</option>
                    </select>
                    <!-- <input type="text" name="sector_id" class=""> -->
                  </div>
                </div>
                
              </div>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="rec_id" id="rec_id">
        <input type="submit" class="btn btn-success" name="btnsave" value="Update User" id="btnsave2">
      </div>

      </form>

    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// 	$(document).ready(function(){
//     $('#pass2').focusout(function(){
//         var pass = $('#pass').val();
//         var pass2 = $('#confirm_pass').val();
//         if(pass != pass2){
//             alert('the passwords didn\'t match!');
//         }

//     });
// });

// check for password match
  function checkPasswordMatch() {
    var password = $("#pass").val();
    var confirmPassword = $("#confirm_pass").val();

    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<p style='color: red;'><i class='fa fa-times-circle'></i> Passwords do not match!</p>");
        // document.getElementById("#btnsave").disabled = true;
        $('#btnsave').attr('disabled','disabled');
    }else{
        $("#divCheckPasswordMatch").html("<p style='color: green;'><i class='fa fa-check-circle'></i> Passwords matched.</p>");
        $('#btnsave').removeAttr('disabled');
      }
}

function checkPasswordMatch2() {
    var password = $("#passs").val();
    var confirmPassword = $("#confirm_passs").val();

    if (password != confirmPassword){
        $("#divCheckPasswordMatchs").html("<p style='color: red;'><i class='fa fa-times-circle'></i> Passwords do not match!</p>");
        // document.getElementById("#btnsave").disabled = true;
        $('#btnsave2').attr('disabled','disabled');
    }else{
        $("#divCheckPasswordMatchs").html("<p style='color: green;'><i class='fa fa-check-circle'></i> Passwords matched.</p>");
        $('#btnsave2').removeAttr('disabled');
      }
}

$(document).ready(function () {
   $("#confirm_pass").keyup(checkPasswordMatch);
   $("#confirm_passs").keyup(checkPasswordMatch2);
});


$('.btn-modal').on('click', function(e){
// $(".btn-modal").click(function(e) {
  e.preventDefault();
  var id = $(this).attr("data-id");
  var name = $(this).attr("data-user_name");
  var email = $(this).attr("data-email");
  var user_role = $(this).attr("data-user_role");
  var status = $(this).attr("data-status");

     $(".modal-body #user_name").val( name );
     $(".modal-body #email").val( email );
     $(".modal-body #user_role").val( user_role );
     $(".modal-body #status").val( status );

     $(".modal-footer #rec_id").val( id );
});
</script>
<!-- sector modal ends  -->

