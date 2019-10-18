<main class="app-content">
	<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>

 <?php if($this->session->flashdata('inserted')):
    echo '<p class="alert alert-success"><b>'.$this->session->flashdata('inserted').'</b></p>';
  endif;
  if($this->session->flashdata('error')):
    echo '<p class="alert alert-danger"><b>'.$this->session->flashdata('error').'</b></p>';
  endif;
?>
  </div>


	<div class="container" style="background-color: white;padding: 12px">
		
    <div class="col-md-12 col-lg-12 col-md-12">
      <h6>Financial Year :</h6>
      <a href="<?= base_url()?>admin/add_sector" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#bd-year-modal-lg">Add New Year +</a>

      <hr>
      
      <?php
      $k=1;
      echo '<table class="table table-striped table-bordered">';
      echo '<tr>';
        echo '<th>S.N.</th>';
        echo '<th>Financial Year</th>';
        echo '<th>Status</th>';
        echo '<th></th>';
      echo '</tr>';
      foreach ($year as $com => $com_val) {
        $st = $com_val['status'];
        if($st == '1'){
          $status = 'Enabled';
        }else{
          $status = 'Disabled';
        }
        echo '<tr>';
        echo '<td>'.$k.'</td>';
        echo '<td>'.$com_val['financial_year'] .'</td>';
        echo '<td>'.$status .'</td>';
        echo '<td>
        
        <a href="'.base_url().'admin/delete_record?tbl=financial_year&&id='.$com_val['id'].'" onclick="return check_del();" style="color: #e86c6c;"><i class="fa fa-trash"></i> </a>
        </li>';
        echo '</tr>';

      $k++; } 
      echo '</table>'; ?>
    </div>
	

  </div>


  <!-- financil year Modal -->
<div class="modal fade" id="bd-year-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header mdl-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Configure Financial Year:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url()?>post/insert_year" method="post">
      <div class="modal-body mdl-body">
        
          <div class="row">
              <div class="col-md-12"> 
                <div class="row">

                  <div class="col-md-4 mt-4">
                    <label>Financial Year:</label>
                  </div>
                  <div class="col-md-8 mt-4">
                    <select name="financial_year">
                      <option value="">--select--</option>
                      <option value="2069/70">2069/70</option>
                        <option value="2070/71">2070/71</option>
                        <option value="2071/72">2071/72</option>
                        <option value="2072/73">2072/73</option>
                        <option value="2073/74">2073/74</option>
                        <option value="2074/75">2074/75</option>
                        <option value="2075/76">2075/76</option>
                        <option value="2076/77">2076/77</option>

                        <option value="2077/78">2077/78</option>
                        <option value="2078/79">2078/79</option>
                        <option value="2079/80">2079/80</option>
                        <option value="2080/81">2080/81</option>
                        <option value="2081/82">2081/82</option>
                    </select>
                    
                  </div>

                  <div class="col-md-4 mt-4">
                    <label>Status:</label>
                  </div>
                  <div class="col-md-6 mt-4">
                      <label><input type="radio" name="status" value="1" checked> Enable</label><br/>
                      <label><input type="radio" name="status" value="0"> Disable</label>
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
<!-- cagr modal ends  -->
</main>