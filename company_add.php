<!DOCTYPE html>
<html>
<head>
<?php
        if (isset ($_REQUEST['id']) ) {  
            $page_name = "Edit Company";
        }else{
            $page_name = "Add Company";
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
            $c_user_id = '-1';
            $c_user_type_id = '-1';
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
            $c_user_id = $_SESSION['ist_admin'];
            $c_user_type_id = $ur_type;
        }
        
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }else if($ur_company == '0'){ 
            header("location:dashboard.php");
            exit();
        }
 
        if (isset ($_REQUEST['id']) ) { 
            $selectpackunit = mysqli_query($link,"select * from company where c_id='".$_REQUEST['id']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
            $action = "edit";
            $id = $_REQUEST['id'];
            $c_logo = $rwselectpackunit['c_logo'];
            $c_name = $rwselectpackunit['c_name'];
            $c_email = $rwselectpackunit['c_email'];
            $c_address = $rwselectpackunit['c_address'];
            $c_phone = $rwselectpackunit['c_phone'];
            $c_gst_no = $rwselectpackunit['c_gst_no'];
            $c_bank_name = $rwselectpackunit['c_bank_name'];
            $c_branch_name = $rwselectpackunit['c_branch_name'];
            $c_bank_acc_no = $rwselectpackunit['c_bank_acc_no'];
            $c_ifsc_rtgs_code = $rwselectpackunit['c_ifsc_rtgs_code'];
            $c_pf_code = $rwselectpackunit['c_pf_code'];
            $c_ecis_code = $rwselectpackunit['c_ecis_code'];
            $c_trrn_no = $rwselectpackunit['c_trrn_no'];
            $c_ecr_id = $rwselectpackunit['c_ecr_id'];
            $c_lin_no = $rwselectpackunit['c_lin_no'];
            $c_establishment = $rwselectpackunit['c_establishment'];
            $c_owner = $rwselectpackunit['c_owner'];
        }else{
            $action = "add";
            $id = "";
            $c_logo = "";
            $c_name = "";
            $c_email = "";
            $c_address = "";
            $c_phone = "";
            $c_gst_no = "";
            $c_bank_name = "";
            $c_branch_name = "";
            $c_bank_acc_no = "";
            $c_ifsc_rtgs_code = "";
            $c_pf_code = "";
            $c_ecis_code = "";
            $c_trrn_no = "";
            $c_ecr_id = "";
            $c_lin_no = "";
            $c_establishment = "";
            $c_owner = "";
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
                              <a class="btn btn-primary" href="company.php">Back</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="company_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_name">Name <span>*</span></label>
                                          <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter Name" value="<?php echo $c_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_phone">Phone </label>
                                          <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Enter Phone" value="<?php echo $c_phone; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_logo">Logo </label>
                                          <input type="file" class="form-control"  id="c_logo" name="c_logo">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <?php if($c_logo != ""){ ?>
                                                  <img src="<?php echo SITE_ROOT_FRONT; ?>UploadImages/company/<?php echo $c_logo; ?>" style="width:75px">
                                                  <input type="hidden" name="hidden_logo" value="<?php echo $c_logo; ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_email">Email </label>
                                            <input type="email" class="form-control" id="c_email" name="c_email" placeholder="Enter Email" value="<?php echo $c_email; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_address">Address </label>
                                            <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Enter Address" value="<?php echo $c_address; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_establishment">Establishment </label>
                                            <input type="text" class="form-control" id="c_establishment" name="c_establishment" placeholder="Enter Establishment" value="<?php echo $c_establishment; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_owner">Owner </label>
                                            <input type="text" class="form-control" id="c_owner" name="c_owner" placeholder="Enter Owner" value="<?php echo $c_owner; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_gst_no">GST No </label>
                                            <input type="text" class="form-control" id="c_gst_no" name="c_gst_no" placeholder="Enter GST No." value="<?php echo $c_gst_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_pf_code">PF Code </label>
                                            <input type="text" class="form-control" id="c_pf_code" name="c_pf_code" placeholder="Enter PF Code" value="<?php echo $c_pf_code; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_ecis_code">ECIS Code </label>
                                            <input type="text" class="form-control" id="c_ecis_code" name="c_ecis_code" placeholder="Enter ECIS Code" value="<?php echo $c_ecis_code; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_trrn_no">TRNN No </label>
                                            <input type="text" class="form-control" id="c_trrn_no" name="c_trrn_no" placeholder="Enter TRNN No" value="<?php echo $c_trrn_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_ecr_id">ECR Code </label>
                                            <input type="text" class="form-control" id="c_ecr_id" name="c_ecr_id" placeholder="Enter ECR Code" value="<?php echo $c_ecr_id; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="c_lin_no">LIN No </label>
                                            <input type="text" class="form-control" id="c_lin_no" name="c_lin_no" placeholder="Enter LIN No" value="<?php echo $c_lin_no; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Bank Details</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_bank_name">Bank Name</label>
                                          <input type="text" class="form-control" id="c_bank_name" name="c_bank_name" placeholder="Enter Bank Name" value="<?php echo $c_bank_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_branch_name">Branch Name</label>
                                          <input type="text" class="form-control" id="c_branch_name" name="c_branch_name" placeholder="Enter Branch Name" value="<?php echo $c_branch_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_bank_acc_no">Bank Account Number</label>
                                          <input type="text" class="form-control" id="c_bank_acc_no" name="c_bank_acc_no" placeholder="Enter Bank Account Number" value="<?php echo $c_bank_acc_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="c_ifsc_rtgs_code">RTGS / IFSC Code</label>
                                          <input type="text" class="form-control" id="c_ifsc_rtgs_code" name="c_ifsc_rtgs_code" placeholder="Enter RTGS / IFSC Code" value="<?php echo $c_ifsc_rtgs_code; ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="c_user_id" id="c_user_id" value="<?php echo $c_user_id; ?>">
                                <input type="hidden" name="c_user_type_id" id="c_user_type_id" value="<?php echo $c_user_type_id; ?>">
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
    jQuery('#c_logo,#c_name,#c_email,#c_address,#c_phone,#c_gst_no,#c_bank_name,#c_branch_name,#c_bank_acc_no,#c_ifsc_rtgs_code,#c_pf_code,#c_ecis_code,#c_trrn_no,#c_ecr_id,#c_lin_no,#c_establishment,#c_owner').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
    });
    jQuery("#add_bottom").click(function () {
        lfg = 1;
        var c_name = jQuery.trim(jQuery("#c_name").val());
        if (c_name == "") {
            lfg = 0;
            jQuery("#c_name").addClass("error-border");
            jQuery("#c_name").focus();
            return false;
        }
    });
</script>
</body>
</html>