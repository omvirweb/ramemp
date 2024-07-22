<!DOCTYPE html>
<html>
<head>
<?php
        if (isset ($_REQUEST['id']) ) {  
            $page_name = "Edit User";
        }else{
            $page_name = "Add User";
        }
        include_once("inc/head.php");
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }
 
        if (isset ($_REQUEST['id']) ) { 
            $selectpackunit = mysqli_query($link,"select * from login_user where l_id='".$_REQUEST['id']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
            $action = "edit";
            $id = $_REQUEST['id'];
            $l_first_name = $rwselectpackunit['l_first_name'];
            $l_last_name = $rwselectpackunit['l_last_name'];
            $l_user_name = $rwselectpackunit['l_user_name'];
            $l_email = $rwselectpackunit['l_email'];
            $l_password = $rwselectpackunit['l_password'];
            $l_company = $rwselectpackunit['l_company'];
            $l_department = $rwselectpackunit['l_department'];
            $l_sub_department = $rwselectpackunit['l_sub_department'];
            $l_employee = $rwselectpackunit['l_employee'];
            $l_attendence_sheet = $rwselectpackunit['l_attendence_sheet'];
            $l_monthly_report = $rwselectpackunit['l_monthly_report'];
            $l_salary_sleep = $rwselectpackunit['l_salary_sleep'];
            $l_insuration_corporation = $rwselectpackunit['l_insuration_corporation'];
            $l_invoice = $rwselectpackunit['l_invoice'];
            $l_salary_register = $rwselectpackunit['l_salary_register'];
            $l_wadges = $rwselectpackunit['l_wadges'];
            $l_billing_sheet = $rwselectpackunit['l_billing_sheet'];
            $l_general_settings = $rwselectpackunit['l_general_settings'];
            $l_type = $rwselectpackunit['l_type'];
            $l_download_excel_sheet = $rwselectpackunit['l_download_excel_sheet'];
            $l_monthly_salary_status = $rwselectpackunit['l_monthly_salary_status'];
            $l_status = $rwselectpackunit['l_status'];
        }else{
            $action = "add";
            $id = "";
            $l_first_name = "";
            $l_last_name = "";
            $l_user_name = "";
            $l_email = "";
            $l_password = "";
            $l_company = "";
            $l_department = "";
            $l_sub_department = "";
            $l_employee = "";
            $l_attendence_sheet = "";
            $l_monthly_report = "";
            $l_salary_sleep = "";
            $l_insuration_corporation = "";
            $l_invoice = "";
            $l_salary_register = "";
            $l_wadges = "";
            $l_billing_sheet = "";
            $l_general_settings = "";
            $l_type = "";
            $l_download_excel_sheet = "";
            $l_monthly_salary_status = "";
            $l_status = "";
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
                              <a class="btn btn-primary" href="usermanagement.php">Back</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="usermanagement_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_name">First Name <span>*</span></label>
                                          <input type="text" class="form-control" id="l_first_name" name="l_first_name" placeholder="Enter First Name" value="<?php echo $l_first_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="l_last_name">Last Name <span>*</span></label>
                                          <input type="text" class="form-control" id="l_last_name" name="l_last_name" placeholder="Enter Last Name" value="<?php echo $l_last_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_email">User Name <span>*</span> </label>
                                            <input type="text" class="form-control" id="l_user_name" name="l_user_name" placeholder="Enter User Name" value="<?php echo $l_user_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="l_email">Email <span>*</span></label>
                                            <input type="email" class="form-control" id="l_email" name="l_email" placeholder="Enter Email Address" value="<?php echo $l_email; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="l_password">Password <span>*</span> </label>
                                            <input type="text" class="form-control" id="l_password" name="l_password" placeholder="Enter Password" value="<?php echo $l_password; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="l_type">Type <span>*</span></label>
                                            <select class="form-control" id="l_type" name="l_type">
                                                <option value="">Select Type</option>
                                                <option value="0" <?php if($l_type==0){echo "selected";} ?>>Staff</option>
                                                <option value="1" <?php if($l_type==1){echo "selected";} ?>>Manager</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="l_type">Status <span>*</span></label>
                                            <select class="form-control" id="l_status" name="l_status">
                                                <option value="">Select Status</option>
                                                <option value="0" <?php if($l_status==0){echo "selected";} ?>>Active</option>
                                                <option value="1" <?php if($l_status==1){echo "selected";} ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Roles Details</h4><br/>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_download_excel_sheet" name="l_download_excel_sheet" value="1" <?php if($l_download_excel_sheet=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_download_excel_sheet">Download Excel Sheet </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_monthly_salary_status" name="l_monthly_salary_status" value="1" <?php if($l_monthly_salary_status=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_monthly_salary_status">Monthly Salary Status </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_company" name="l_company" value="1" <?php if($l_company=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_company">Company </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_department" name="l_department" value="1" <?php if($l_department=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_department">Department </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_sub_department" name="l_sub_department" value="1" <?php if($l_sub_department=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_sub_department">Sub Department </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_employee" name="l_employee" value="1" <?php if($l_employee=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_employee">Employee </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_attendence_sheet" name="l_attendence_sheet" value="1" <?php if($l_attendence_sheet=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_attendence_sheet">Attendence Sheet </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_monthly_report" name="l_monthly_report" value="1" <?php if($l_monthly_report=="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_monthly_report">Monthly Report </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_salary_sleep" name="l_salary_sleep" value="1" <?php if($l_salary_sleep =="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_salary_sleep">Salary Slip </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_insuration_corporation" name="l_insuration_corporation" value="1" <?php if($l_insuration_corporation =="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_insuration_corporation">Insuration Corporation</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_invoice" name="l_invoice" value="1" <?php if($l_invoice =="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_invoice">Invoice</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_salary_register" name="l_salary_register" value="1" <?php if($l_salary_register =="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_salary_register">Salary Register</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_wadges" name="l_wadges" value="1" <?php if($l_wadges =="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_wadges">Wadges</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_billing_sheet" name="l_billing_sheet" value="1" <?php if($l_billing_sheet =="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_billing_sheet">Billing Sheets</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="l_general_settings" name="l_general_settings" value="1" <?php if($l_general_settings =="1"){echo"checked";} ?> style="margin-right:15px">
                                            <label for="l_general_settings">General Settings</label>
                                            
                                        </div>
                                    </div>
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
    jQuery('#l_first_name,#l_last_name,#l_user_name,#l_email,#l_password,#l_company,#l_department,#l_sub_department,#l_employee,#l_attendence_sheet,#l_monthly_report,#l_salary_sleep,#l_insuration_corporation,#l_invoice,#l_salary_register,#l_wadges,#l_billing_sheet,#l_general_settings,#l_type,#l_download_excel_sheet,#l_monthly_salary_status,#l_status').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
        jQuery("#l_first_name").removeClass("error-border");
        jQuery("#l_last_name").removeClass("error-border");
        jQuery("#l_user_name").removeClass("error-border");
        jQuery("#l_email").removeClass("error-border");
        jQuery("#l_password").removeClass("error-border");
        jQuery("#l_type").removeClass("error-border");
        jQuery("#l_status").removeClass("error-border");
    });
    jQuery("#add_bottom").click(function () {
        lfg = 1;
        var l_first_name = jQuery.trim(jQuery("#l_first_name").val());
        if (l_first_name == "") {
            lfg = 0;
            jQuery("#l_first_name").addClass("error-border");
            jQuery("#l_first_name").focus();
            return false;
        }
        var l_last_name = jQuery.trim(jQuery("#l_last_name").val());
        if (l_last_name == "") {
            lfg = 0;
            jQuery("#l_last_name").addClass("error-border");
            jQuery("#l_last_name").focus();
            return false;
        }
        var l_user_name = jQuery.trim(jQuery("#l_user_name").val());
        if (l_user_name == "") {
            lfg = 0;
            jQuery("#l_user_name").addClass("error-border");
            jQuery("#l_user_name").focus();
            return false;
        }
        var l_email = jQuery.trim(jQuery("#l_email").val());
        if (l_email == "") {
            lfg = 0;
            jQuery("#l_email").addClass("error-border");
            jQuery("#l_email").focus();
            return false;
        }
        var l_password = jQuery.trim(jQuery("#l_password").val());
        if (l_password == "") {
            lfg = 0;
            jQuery("#l_password").addClass("error-border");
            jQuery("#l_password").focus();
            return false;
        }
        var l_type = jQuery.trim(jQuery("#l_type").val());
        if (l_type == "") {
            lfg = 0;
            jQuery("#l_type").addClass("error-border");
            jQuery("#l_type").focus();
            return false;
        }
        var l_status = jQuery.trim(jQuery("#l_status").val());
        if (l_status == "") {
            lfg = 0;
            jQuery("#l_status").addClass("error-border");
            jQuery("#l_status").focus();
            return false;
        }
    });
</script>
</body>
</html>