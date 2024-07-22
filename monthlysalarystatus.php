<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "Monthly Salary Status";
        include_once("inc/head.php");
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }

        $nmselectpackunit = 0;
        if(isset($_REQUEST['e_depart_id']) && isset($_REQUEST['e_sub_depart_id']) && isset($_REQUEST['e_month_id']) && isset($_REQUEST['e_year_id'])){
        	  $selectpackunit = mysqli_query($link,"select e.e_firstname,e.e_lastname,e.e_fathername,e.e_company_id, e.e_depart_id, e.e_sub_depart_id, e.e_id, ds.ds_m_id, ds.ds_salary, ds.ds_acc_no, ds.ds_acc_ifsc_no, ds.ds_proof, ds.ds_added_date from employee as e, download_salary as ds where 1&1 and e.e_company_id='".$_SESSION['company_id']."' and e.e_depart_id='".$_REQUEST['e_depart_id']."' and e.e_sub_depart_id='".$_REQUEST['e_sub_depart_id']."' and ds.ds_added_date='".$_REQUEST['e_year_id']."-".$_REQUEST['e_month_id']."-01' and e.e_id=ds.ds_m_id ORDER BY e.e_id DESC");
            $nmselectpackunit = mysqli_num_rows($selectpackunit);
        } 
?>
</head>
<body>
    <div class="container-scroller">
          <?php 
            include_once("inc/top-pan.php"); 
          ?>
          <div class="container-fluid page-body-wrapper">
              <div class="main-panel">
                  <div class="content-wrapper">
                      <div class="row">
                        <div class="col-md-12 mb-3">
                        	<form action="monthlysalarystatus.php" method="post">
		                          <div class="row">
		                            <div class="col-md-3 col-xs-12">
		                              <h3 class="font-weight-bold">Monthly Salary Status</h3>
		                            </div>
		                            <div class="col-md-2 col-xs-12">
		                              <div class="form-group mb-0">
                                    <select name="e_depart_id" id="e_depart_id" class="form-control">
                                      <option value="">Select Department</option>
                                      <?php $depart = mysqli_query($link,"select * from department where 1&1 and d_parent_id='0' and d_company_id='".$_SESSION['company_id']."' ORDER BY d_id DESC"); 
                                          while($rwdepart = mysqli_fetch_array($depart)){
                                      ?>
                                          <option value="<?php echo $rwdepart['d_id']; ?>" <?php if(isset($_REQUEST['e_depart_id']) && $_REQUEST['e_depart_id'] == $rwdepart['d_id']){echo 'selected';} ?>><?php echo $rwdepart['d_main']." ".$rwdepart['d_state']." ".$rwdepart['d_city']." ".$rwdepart['d_village']." ".$rwdepart['d_schema']; ?></option>
                                      <?php } ?>
                                    </select>
		                              </div>
		                            </div>
                                <div class="col-md-2 col-xs-12">
                                  <div class="form-group mb-0">
                                    <select name="e_sub_depart_id" id="e_sub_depart_id" class="form-control">
                                      <option value="">Select Sub Department</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                  <div class="form-group mb-0">
                                    <select name="e_month_id" id="e_month_id" class="form-control">
                                      <option value="">Select Month</option>
                                      <option value="1" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "1"){echo 'selected';} ?>>1</option>
                                      <option value="2" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "2"){echo 'selected';} ?>>2</option>
                                      <option value="3" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "3"){echo 'selected';} ?>>3</option>
                                      <option value="4" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "4"){echo 'selected';} ?>>4</option>
                                      <option value="5" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "5"){echo 'selected';} ?>>5</option>
                                      <option value="6" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "6"){echo 'selected';} ?>>6</option>
                                      <option value="7" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "7"){echo 'selected';} ?>>7</option>
                                      <option value="8" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "8"){echo 'selected';} ?>>8</option>
                                      <option value="9" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "9"){echo 'selected';} ?>>9</option>
                                      <option value="10" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "10"){echo 'selected';} ?>>10</option>
                                      <option value="11" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "11"){echo 'selected';} ?>>11</option>
                                      <option value="12" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "12"){echo 'selected';} ?>>12</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                  <div class="form-group mb-0">
                                    <select name="e_year_id" id="e_year_id" class="form-control">
                                      <option value="">Select Year</option>
                                      <?php for($i=date("Y");$i>=2005;$i--){ ?>
                                              <option value="<?php echo $i; ?>" <?php if(isset($_REQUEST['e_year_id']) && $_REQUEST['e_year_id'] == $i){echo 'selected';} ?>><?php echo $i; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
		                            <div class="col-md-1 col-xs-12">
		                              <div class="form-group mb-0">
		                              	<input type="submit" class="btn btn-primary" value="Go" id="search_btn">
		                              </div>
		                            </div>
		                          </div>
		                      </form>
                        </div>
                      </div>
                      <form id="change_profile" name="change_profile" action="monthlysalarystatus_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                          <div class="row">
                            <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                            <div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Name</th>
                                          <th>Salary</th>
                                          <th>Account No.</th>
                                          <th>RTGS / IFSC</th>
                                          <th>Proof</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if($nmselectpackunit > 0){ 
                                                while($rwselectpackunit = mysqli_fetch_array($selectpackunit)){
                                        ?>
                                                <tr></tr>
                                                  <td style="padding:15px"><?php echo $rwselectpackunit['e_firstname']." ".$rwselectpackunit['e_fathername']." ".$rwselectpackunit['e_lastname']; ?></td>
                                                  <td><?php echo number_format((float)$rwselectpackunit['ds_salary'], 2, '.', ''); ?></td>
                                                  <td><?php echo $rwselectpackunit['ds_acc_no']; ?></td>
                                                  <td><?php echo $rwselectpackunit['ds_acc_ifsc_no']; ?></td>
                                                  <td><input type="hidden" name="employee_id[]" value="<?php echo $rwselectpackunit['e_id']; ?>" /><input type="file" style="width: 50%;display: inline-block;" class="form-control" name="ea_emp_attendance_type<?php echo $rwselectpackunit['e_id']; ?>"/><input type="hidden" name="hidden_logo<?php echo $rwselectpackunit['e_id']; ?>" value="<?php echo $rwselectpackunit['ds_proof']; ?>">
                                                  <?php if($rwselectpackunit['ds_proof'] != ""){ ?>
                                                  <a href="<?php echo SITE_ROOT_FRONT."UploadImages/salarystatus/".$rwselectpackunit['ds_proof']; ?>" download><img src="<?php echo SITE_ROOT_FRONT."UploadImages/salarystatus/".$rwselectpackunit['ds_proof']; ?>" style="border-radius: 0;height: auto;width: 55px;"/></a>
                                                  <?php } ?>
                                                  </td>
                                                </tr>
                                                
                                        <?php }
                                              }else{ ?>
                                                <tr>
                                                  <td class="text-danger text-center" colspan="5">No Employee Found.</td>
                                                </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php if($nmselectpackunit > 0){ ?>
                              <input type="hidden" name="year" id="year" value="<?php echo $_REQUEST['e_year_id']; ?>">
                              <input type="hidden" name="month" id="month" value="<?php echo $_REQUEST['e_month_id']; ?>">
                              <input type="hidden" name="depart_id" id="depart_id" value="<?php echo $_REQUEST['e_depart_id']; ?>">
                              <input type="hidden" name="sub_depart_id" id="sub_depart_id" value="<?php echo $_REQUEST['e_sub_depart_id']; ?>">
                              <button type="submit" class="btn btn-primary mr-2" id="add_bottom" style="float: right">Submit</button>
                          <?php } ?>
                        </form>
                  </div>
                  <?php include_once("inc/footer.php"); ?>
              </div>
          </div>
    </div>
<?php include_once("js.php"); ?>
<?php if($nmselectpackunit > 0){ ?>
<script>
  jQuery(document).ready(function(){
    var e_depart_id = "<?php echo $_REQUEST['e_depart_id']; ?>";
    var e_sub_depart_id = "<?php echo $_REQUEST['e_sub_depart_id']; ?>";
    $.ajax({
      type:'post',
      url:base_url+'employee_db.php',
      data:"e_depart_id="+e_depart_id+"&action=get_sub_department&selecteddepart="+e_sub_depart_id,
      success:function(url){
        $("#e_sub_depart_id").html(url);
        return false;
      },
    });
  });
</script>
<?php } ?>
<script>
    jQuery(document).ready(function(){
        jQuery(document).on('change','#e_depart_id',function(){
            $.ajax({
                type:'post',
                url:base_url+'employee_db.php',
                data:"e_depart_id="+$(this).val()+"&action=get_sub_department&selecteddepart=",
                success:function(url){
                  $("#e_sub_depart_id").html(url);
                  jQuery("#e_depart_id").removeClass("error-border");
                  return false;
                },
            });
        });
        jQuery(document).on('change','#e_sub_depart_id',function(){
            jQuery("#e_sub_depart_id").removeClass("error-border");
        });
        jQuery(document).on('change','#e_month_id',function(){
            jQuery("#e_month_id").removeClass("error-border");
        });
        jQuery(document).on('change','#e_year_id',function(){
            jQuery("#e_year_id").removeClass("error-border");
        });
    });
</script>
</body>
</html>