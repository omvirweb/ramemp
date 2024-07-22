<!DOCTYPE html>
<html>
<head>
<?php
        if (isset ($_REQUEST['id']) ) {  
            $page_name = "Edit Department";
        }else{
            $page_name = "Add Department";
        }
        include_once("inc/head.php");
        if(isset($_SESSION["i_m_admin"]) && $_SESSION["i_m_admin"] == "true"){
            $ur_company = 1;
            $ur_department = 1;
            $ur_sub_department = 1;
            $ur_employee = 1;
            $ur_attendence_sheet = 1;
            $ur_monthly_report = 1;
            $ur_salary_sleep = 1;
            $ur_insuration_corporation = 1;
            $ur_invoice = 1;
            $ur_salary_register = 1;
            $ur_wadges = 1;
            $ur_billing_sheet = 1;
            $ur_general_settings = 1;
            $ur_type = '-1';
            $ur_download_excel_sheet = '1';
            $ur_monthly_salary_status = '1';
        }else if(isset($_SESSION["i_m_admin"]) && $_SESSION["i_m_admin"] == "false"){
            $selectuser = mysqli_query($link,"select * from login_user where l_id='".$_SESSION['ist_admin']."'");
            $rwselectuser = mysqli_fetch_array($selectuser);
            $ur_company = $rwselectuser['l_company'];
            $ur_department = $rwselectuser['l_department'];
            $ur_sub_department = $rwselectuser['l_sub_department'];
            $ur_employee = $rwselectuser['l_employee'];
            $ur_attendence_sheet = $rwselectuser['l_attendence_sheet'];
            $ur_monthly_report = $rwselectuser['l_monthly_report'];
            $ur_salary_sleep = $rwselectuser['l_salary_sleep'];
            $ur_insuration_corporation = $rwselectuser['l_insuration_corporation'];
            $ur_invoice = $rwselectuser['l_invoice'];
            $ur_salary_register = $rwselectuser['l_salary_register'];
            $ur_wadges = $rwselectuser['l_wadges'];
            $ur_billing_sheet = $rwselectuser['l_billing_sheet'];
            $ur_general_settings = $rwselectuser['l_general_settings'];
            $ur_type = $rwselectuser['l_type'];
            $ur_download_excel_sheet = $rwselectuser['l_download_excel_sheet'];
            $ur_monthly_salary_status = $rwselectuser['l_monthly_salary_status'];
        }
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }else if($ur_department == '0'){
            header("location:dashboard.php");
            exit();
        }
 
        if (isset ($_REQUEST['id']) ) { 
            $selectpackunit = mysqli_query($link,"select * from department where d_id='".$_REQUEST['id']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
            $action = "edit";
            $id = $_REQUEST['id'];
            $d_main = $rwselectpackunit['d_main'];
            $d_jem_portal_no = $rwselectpackunit['d_jem_portal_no'];
            $d_state = $rwselectpackunit['d_state'];
            $d_city = $rwselectpackunit['d_city'];
            $d_village = $rwselectpackunit['d_village'];
            $d_schema = $rwselectpackunit['d_schema'];
            $d_sitename = $rwselectpackunit['d_sitename'];
        }else{
            $action = "add";
            $id = "";
            $d_main = "";
            $d_jem_portal_no = "";
            $d_state = "";
            $d_city = "";
            $d_village = "";
            $d_schema = "";
            $d_sitename = "";
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
                          <div class="row">
                            <div class="col-md-10 col-xs-12">
                              <h3 class="font-weight-bold"><?php echo $page_name; ?></h3>
                            </div>
                            <div class="col-md-2 col-xs-12 text-right">
                              <a class="btn btn-primary" href="department.php">Back</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="department_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_main">Department Name <span>*</span></label>
                                          <input type="text" class="form-control" id="d_main" name="d_main" placeholder="Enter Department Name" value="<?php echo $d_main; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12" style="display:none">
                                        <div class="form-group">
                                          <label for="d_jem_portal_no">Gem Portal <span>*</span></label>
                                          <input type="text" class="form-control" id="d_jem_portal_no" name="d_jem_portal_no" placeholder="Enter Gem Portal" value="<?php echo $d_jem_portal_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_state">State</label>
                                          <input type="text" class="form-control" id="d_state" name="d_state" placeholder="Enter State" value="<?php echo $d_state; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_city">City</label>
                                          <input type="text" class="form-control" id="d_city" name="d_city" placeholder="Enter City" value="<?php echo $d_city; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_village">Village</label>
                                          <input type="text" class="form-control" id="d_village" name="d_village" placeholder="Enter Village " value="<?php echo $d_village; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_schema">Schema</label>
                                          <input type="text" class="form-control" id="d_schema" name="d_schema" placeholder="Enter Schema" value="<?php echo $d_schema; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_sitename">Site Name</label>
                                          <input type="text" class="form-control" id="d_sitename" name="d_sitename" placeholder="Enter Site Name" value="<?php echo $d_sitename; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Sub Department</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_sub_main">Sub Department Name <span>*</span></label>
                                          <input type="text" class="form-control" id="d_sub_main" name="d_sub_main" placeholder="Enter Sub Department Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_sub_jem_portal_no">Gem Portal</label>
                                          <input type="text" class="form-control" id="d_sub_jem_portal_no" name="d_sub_jem_portal_no" placeholder="Enter Gem Portal">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_sub_state">State</label>
                                          <input type="text" class="form-control" id="d_sub_state" name="d_sub_state" placeholder="Enter State">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_sub_city">City</label>
                                          <input type="text" class="form-control" id="d_sub_city" name="d_sub_city" placeholder="Enter City">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_sub_village">Village</label>
                                          <input type="text" class="form-control" id="d_sub_village" name="d_sub_village" placeholder="Enter Village">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="d_sub_schema">Schema</label>
                                          <input type="text" class="form-control" id="d_sub_schema" name="d_sub_schema" placeholder="Enter Schema">
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                          <label style="display: block;">&nbsp;</label>
                                          <a href="javascript:void(0);" class="btn btn-primary add_item">+</a>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="item_details">
                                    <?php if($id != ""){$m=1;
                                          $selectitemdetails = mysqli_query($link,"select * from department where d_parent_id='".$id."'"); 
                                          $nmselectitemdetails = mysqli_num_rows($selectitemdetails);
                                          while($rwselectitemdetails = mysqli_fetch_array($selectitemdetails)){
                                    ?>
                                    <div class="row del_<?php echo $m; ?>">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="d_sub_ori_main[]" value="<?php echo $rwselectitemdetails['d_main']; ?>">
                                                <input type="text" class="form-control d_sub_main" name="d_sub_main[]" value="<?php echo $rwselectitemdetails['d_main']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control d_sub_jem_portal_no" name="d_sub_jem_portal_no[]" value="<?php echo $rwselectitemdetails['d_jem_portal_no']; ?>" placeholder="Enter Gem Portal">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control d_sub_state" name="d_sub_state[]" value="<?php echo $rwselectitemdetails['d_state']; ?>" placeholder="Enter State">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control d_sub_city" name="d_sub_city[]" value="<?php echo $rwselectitemdetails['d_city']; ?>" placeholder="Enter City">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control d_sub_village" name="d_sub_village[]" value="<?php echo $rwselectitemdetails['d_village']; ?>" placeholder="Enter Village">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control d_sub_schema" name="d_sub_schema[]" value="<?php echo $rwselectitemdetails['d_schema']; ?>" placeholder="Enter Schema">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <a href="javascript:void(0);" data-id="<?php echo $m; ?>" data-title="<?php echo $rwselectitemdetails['d_id']; ?>" class="btn btn-danger remove_item_fetch">-</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $m++; } } ?>
                                </div>
                                <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-primary mr-2" id="add_bottom" disabled="disabled">Submit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <?php include_once("inc/footer.php"); ?>
              </div>
        </div>
    </div>
<?php include_once("js.php"); ?>
<script>
    jQuery('#d_main,#d_parent_id,#d_jem_portal_no,#d_state,#d_city,#d_village,#d_schema,#d_sitename,.d_sub_main,.d_sub_jem_portal_no,.d_sub_state,.d_sub_city,.d_sub_village,.d_sub_schema').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
    });
    jQuery("#add_bottom").click(function () {
        lfg = 1;
        var d_main = jQuery.trim(jQuery("#d_main").val());
        var d_jem_portal_no = jQuery.trim(jQuery("#d_jem_portal_no").val());
        if (d_main == "") {
            lfg = 0;
            jQuery("#d_main").addClass("error-border");
            jQuery("#d_main").focus();
            return false;
        }
    });
    jQuery(document).ready(function(){
        var actiondata = "<?php echo $action; ?>";
        if(actiondata == "edit"){
            var i = "<?php echo $nmselectitemdetails+1; ?>";
        }else{
            var i = 1;
        }
        jQuery(document).on('click','.add_item',function(){
            var d_sub_main = jQuery("#d_sub_main").val();
            var d_sub_jem_portal_no = jQuery("#d_sub_jem_portal_no").val();
            var d_sub_state = jQuery("#d_sub_state").val();
            var d_sub_city = jQuery("#d_sub_city").val();
            var d_sub_village = jQuery("#d_sub_village").val();
            var d_sub_schema = jQuery("#d_sub_schema").val();
            jQuery("#d_sub_main").removeClass("error-border");
            if(d_sub_main == ""){
                jQuery("#d_sub_main").addClass("error-border");
                jQuery("#d_sub_main").focus();
                return false;
            }else{
                jQuery(".item_details").append('<div class="row del_'+i+'"><div class="col-md-4 col-sm-12"><div class="form-group"><input type="text" class="form-control d_sub_main" name="d_sub_main[]" value="'+d_sub_main+'"></div></div><div class="col-md-4 col-sm-12"><div class="form-group"><input type="text" class="form-control d_sub_jem_portal_no" name="d_sub_jem_portal_no[]" value="'+d_sub_jem_portal_no+'" placeholder="Enter Gem Portal"></div></div><div class="col-md-4 col-sm-12"><div class="form-group"><input type="text" class="form-control d_sub_state" name="d_sub_state[]" value="'+d_sub_state+'" placeholder="Enter State"></div></div><div class="col-md-4 col-sm-12"><div class="form-group"><input type="text" class="form-control d_sub_city" name="d_sub_city[]" value="'+d_sub_city+'" placeholder="Enter City"></div></div><div class="col-md-4 col-sm-12"><div class="form-group"><input type="text" class="form-control d_sub_village" name="d_sub_village[]" value="'+d_sub_village+'" placeholder="Enter Village"></div></div><div class="col-md-3 col-sm-12"><div class="form-group"><input type="text" class="form-control d_sub_schema" name="d_sub_schema[]" value="'+d_sub_schema+'" placeholder="Enter Schema"></div></div><div class="col-md-1 col-sm-12"><div class="form-group"><a href="javascript:void(0);" data-id="'+i+'" class="btn btn-danger remove_item">-</a></div></div></div>');
                jQuery("#d_sub_main").val("");
                jQuery("#d_sub_jem_portal_no").val("");
                jQuery("#d_sub_state").val("");
                jQuery("#d_sub_city").val("");
                jQuery("#d_sub_village").val("");
                jQuery("#d_sub_schema").val("");
                jQuery("#add_bottom").removeAttr('disabled');
                i++;
            }
        });

        jQuery(document).on('click','.remove_item',function(){
            var del_id = jQuery(this).data("id");
            jQuery(".del_"+del_id).remove();
            jQuery("#add_bottom").removeAttr('disabled');
        });
        jQuery(document).on('click','.remove_item_fetch',function(){
            var dataid = jQuery(this).data("title");
            if (confirm("Are you sure you want to delete this sub department?") == true) {
                $.ajax({
                  type:'post',
                  url:base_url+'department_db.php',
                  data:"action=deletesub&id="+dataid,
                  success:function(url){
                    window.location.href = url;
                    return false;
                  },
                });
            }
        });
    });
</script>
</body>
</html>