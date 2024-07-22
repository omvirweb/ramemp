<!DOCTYPE html>
<html>
<head>
<?php
        if (isset ($_REQUEST['id']) ) {  
            $page_name = "Edit Employee";
        }else{
            $page_name = "Add Employee";
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
        }else if($ur_employee == '0'){
            header("location:dashboard.php");
            exit();
        }
        if (isset ($_REQUEST['id']) ) { 
            $selectpackunit = mysqli_query($link,"select * from employee where e_id='".$_REQUEST['id']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
            $action = "edit";
            $id = $_REQUEST['id'];
            $e_photo = $rwselectpackunit['e_photo'];
            $e_wedge = $rwselectpackunit['e_wedge'];
            $e_fullwedge = $rwselectpackunit['e_fullwedge'];
            $e_code_employee = $rwselectpackunit['e_id'];
            $e_depart_id = $rwselectpackunit['e_depart_id'];
            $e_sub_depart_id = $rwselectpackunit['e_sub_depart_id'];
            $e_current_office_name_address = $rwselectpackunit['e_current_office_name_address'];
            $e_current_designation = $rwselectpackunit['e_current_designation'];
            $e_firstname = $rwselectpackunit['e_firstname'];
            $e_lastname = $rwselectpackunit['e_lastname'];
            $e_mothername = $rwselectpackunit['e_mothername'];
            $e_fathername = $rwselectpackunit['e_fathername'];
            $e_emergency_mo_no = $rwselectpackunit['e_emergency_mo_no'];
            $e_gender = $rwselectpackunit['e_gender'];
            $e_marriage = $rwselectpackunit['e_marriage'];
            $e_birthdate = $rwselectpackunit['e_birthdate'];
            $e_mobile_no = $rwselectpackunit['e_mobile_no'];
            $e_email = $rwselectpackunit['e_email'];
            $e_atthar_no = $rwselectpackunit['e_atthar_no'];
            $e_pan_no = $rwselectpackunit['e_pan_no'];
            $e_esic_no = $rwselectpackunit['e_esic_no'];
            $e_uan_no = $rwselectpackunit['e_uan_no'];
            $e_bank_name = $rwselectpackunit['e_bank_name'];
            $e_branch_name = $rwselectpackunit['e_branch_name'];
            $e_acc_no = $rwselectpackunit['e_acc_no'];
            $e_ifsc_code = $rwselectpackunit['e_ifsc_code'];
            $e_postal_address = $rwselectpackunit['e_postal_address'];
            $e_pincode = $rwselectpackunit['e_pincode'];
            $e_education1 = $rwselectpackunit['e_education1'];
            $e_year1 = $rwselectpackunit['e_year1'];
            $e_grade1 = $rwselectpackunit['e_grade1'];
            $e_education2 = $rwselectpackunit['e_education2'];
            $e_year2 = $rwselectpackunit['e_year2'];
            $e_grade2 = $rwselectpackunit['e_grade2'];
            $e_education3 = $rwselectpackunit['e_education3'];
            $e_year3 = $rwselectpackunit['e_year3'];
            $e_grade3 = $rwselectpackunit['e_grade3'];
            $e_education4 = $rwselectpackunit['e_education4'];
            $e_year4 = $rwselectpackunit['e_year4'];
            $e_grade4 = $rwselectpackunit['e_grade4'];
            $e_exp_com1 = $rwselectpackunit['e_exp_com1'];
            $e_exp_des1 = $rwselectpackunit['e_exp_des1'];
            $e_exp_sal1 = $rwselectpackunit['e_exp_sal1'];
            $e_exp_time1 = $rwselectpackunit['e_exp_time1'];
            $e_exp_com2 = $rwselectpackunit['e_exp_com2'];
            $e_exp_des2 = $rwselectpackunit['e_exp_des2'];
            $e_exp_sal2 = $rwselectpackunit['e_exp_sal2'];
            $e_exp_time2 = $rwselectpackunit['e_exp_time2'];
            $e_exp_com3 = $rwselectpackunit['e_exp_com3'];
            $e_exp_des3 = $rwselectpackunit['e_exp_des3'];
            $e_exp_sal3 = $rwselectpackunit['e_exp_sal3'];
            $e_exp_time3 = $rwselectpackunit['e_exp_time3'];
            $e_exp_com4 = $rwselectpackunit['e_exp_com4'];
            $e_exp_des4 = $rwselectpackunit['e_exp_des4'];
            $e_exp_sal4 = $rwselectpackunit['e_exp_sal4'];
            $e_exp_time4 = $rwselectpackunit['e_exp_time4'];
            $e_other_details = $rwselectpackunit['e_other_details'];
            $e_da = $rwselectpackunit['e_da'];
            $e_actual_hra = $rwselectpackunit['e_actual_hra'];
            $e_medical_allow = $rwselectpackunit['e_medical_allow'];
            $e_convey_allow = $rwselectpackunit['e_convey_allow'];
            $e_edu_allow = $rwselectpackunit['e_edu_allow'];
            $e_other_allow = $rwselectpackunit['e_other_allow'];
            $e_earning_hra = $rwselectpackunit['e_earning_hra'];
            $e_earning_medical = $rwselectpackunit['e_earning_medical'];
            $e_earning_conveyance = $rwselectpackunit['e_earning_conveyance'];
            $e_earning_sta_bonus = $rwselectpackunit['e_earning_sta_bonus'];
            $e_earning_leave_enc = $rwselectpackunit['e_earning_leave_enc'];
            $e_earning_gratuity = $rwselectpackunit['e_earning_gratuity'];
            $e_earning_spe_a = $rwselectpackunit['e_earning_spe_a'];
            $e_earning_pro_inc_attn_bonus = $rwselectpackunit['e_earning_pro_inc_attn_bonus'];
            $e_earning_ot_amount = $rwselectpackunit['e_earning_ot_amount'];
            $e_pt = $rwselectpackunit['e_pt'];
            $e_pf = $rwselectpackunit['e_pf'];
            $e_esi = $rwselectpackunit['e_esi'];
            $e_lwf = $rwselectpackunit['e_lwf'];
            $e_tds = $rwselectpackunit['e_tds'];
            $e_advance = $rwselectpackunit['e_advance'];
            $e_loan_ins = $rwselectpackunit['e_loan_ins'];
            $e_canteen = $rwselectpackunit['e_canteen'];
            $e_oth_ded = $rwselectpackunit['e_oth_ded'];
            $e_facility_time_safety_exp = $rwselectpackunit['e_facility_time_safety_exp'];
            $e_emp_contribution = $rwselectpackunit['e_emp_contribution'];
            $e_epf = $rwselectpackunit['e_epf'];
            $e_fpf = $rwselectpackunit['e_fpf'];
            $e_abry_pf = $rwselectpackunit['e_abry_pf'];
            $e_timeloss = $rwselectpackunit['e_timeloss'];
            $e_admin_wedge = $rwselectpackunit['e_admin_wedge'];
            $e_bonus_wedge = $rwselectpackunit['e_bonus_wedge'];
            $e_travel_wedge = $rwselectpackunit['e_travel_wedge'];
            $e_other_wedge = $rwselectpackunit['e_other_wedge'];
            $e_incometax = $rwselectpackunit['e_incometax'];
            $e_insurance = $rwselectpackunit['e_insurance'];
            $e_epfo = $rwselectpackunit['e_epfo'];
            $e_admin_epfo = $rwselectpackunit['e_admin_epfo'];
            $e_admin_esic = $rwselectpackunit['e_admin_esic'];
            $e_register_date = $rwselectpackunit['e_register_date'];
            $e_service_charge = $rwselectpackunit['e_service_charge'];
        }else{
            $selectemployee2 = mysqli_query($link,"select MAX(e_id) as total from employee");
            $rwselectemployee2 = mysqli_fetch_array($selectemployee2);
            
            $totalval = $rwselectemployee2['total'] + 1;
            
            $action = "add";
            $id = "";
            $e_photo = "";
            $e_wedge = "";
            $e_fullwedge = "";
            $e_code_employee = $totalval;
            $e_depart_id = "";
            $e_sub_depart_id = "";
            $e_current_office_name_address = "";
            $e_current_designation = "";
            $e_firstname = "";
            $e_lastname = "";
            $e_mothername = "";
            $e_fathername = "";
            $e_emergency_mo_no = "";
            $e_gender = "";
            $e_marriage = "";
            $e_birthdate = "";
            $e_mobile_no = "";
            $e_email = "";
            $e_atthar_no = "";
            $e_pan_no = "";
            $e_esic_no = "";
            $e_uan_no = "";
            $e_bank_name = "";
            $e_branch_name = "";
            $e_acc_no = "";
            $e_ifsc_code = "";
            $e_postal_address = "";
            $e_pincode = "";
            $e_education1 = "";
            $e_year1 = "";
            $e_grade1 = "";
            $e_education2 = "";
            $e_year2 = "";
            $e_grade2 = "";
            $e_education3 = "";
            $e_year3 = "";
            $e_grade3 = "";
            $e_education4 = "";
            $e_year4 = "";
            $e_grade4 = "";
            $e_exp_com1 = "";
            $e_exp_des1 = "";
            $e_exp_sal1 = "";
            $e_exp_time1 = "";
            $e_exp_com2 = "";
            $e_exp_des2 = "";
            $e_exp_sal2 = "";
            $e_exp_time2 = "";
            $e_exp_com3 = "";
            $e_exp_des3 = "";
            $e_exp_sal3 = "";
            $e_exp_time3 = "";
            $e_exp_com4 = "";
            $e_exp_des4 = "";
            $e_exp_sal4 = "";
            $e_exp_time4 = "";
            $e_other_details = "";
            $e_da = "0";
            $e_actual_hra = "0";
            $e_medical_allow = "0";
            $e_convey_allow = "0";
            $e_edu_allow = "0";
            $e_other_allow = "0";
            $e_earning_hra = "0";
            $e_earning_medical = "0";
            $e_earning_conveyance = "0";
            $e_earning_sta_bonus = "0";
            $e_earning_leave_enc = "0";
            $e_earning_gratuity = "0";
            $e_earning_spe_a = "0";
            $e_earning_pro_inc_attn_bonus = "0";
            $e_earning_ot_amount = "0";
            $e_pt = "0";
            $e_pf = "12";
            $e_esi = "0.75";
            $e_lwf = "0";
            $e_tds = "0";
            $e_advance = "0";
            $e_loan_ins = "0";
            $e_canteen = "0";
            $e_oth_ded = "0";
            $e_facility_time_safety_exp = "0";
            $e_emp_contribution = "3.25";
            $e_epf = "0";
            $e_fpf = "0";
            $e_abry_pf = "0";
            $e_timeloss = "0";
            $e_admin_wedge = "0";
            $e_bonus_wedge = "8.33";
            $e_travel_wedge = "0";
            $e_other_wedge = "0";
            $e_incometax = "0";
            $e_insurance = "0";
            $e_epfo = "13";
            $e_admin_epfo = "0";
            $e_admin_esic = "0";
            $e_register_date = date('Y-m-d');
            $e_service_charge = "0";
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
                              <a class="btn btn-primary" href="employee.php">Back</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="employee_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_code_employee">Employee Code </label>
                                            <input type="text" class="form-control" id="e_code_employee" name="e_code_employee" placeholder="Enter Employee Code" value="<?php echo $e_code_employee; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_mobile_no">Mobile <span>*</span></label>
                                          <input type="text" class="form-control" id="e_mobile_no" name="e_mobile_no" placeholder="Enter Mobile" value="<?php echo $e_mobile_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_photo">Photo </label>
                                          <input type="file" class="form-control"  id="e_photo" name="e_photo">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <?php if($e_photo != ""){ ?>
                                                  <img src="<?php echo SITE_ROOT_FRONT; ?>UploadImages/employee/<?php echo $e_photo; ?>" style="width:75px">
                                                  <input type="hidden" name="hidden_logo" value="<?php echo $e_photo; ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_firstname">First Name <span>*</span></label>
                                          <input type="text" class="form-control" id="e_firstname" name="e_firstname" placeholder="Enter First Name" value="<?php echo $e_firstname; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_mothername">Father Name <span>*</span></label>
                                            <input type="text" class="form-control" id="e_fathername" name="e_fathername" placeholder="Enter Father Name" value="<?php echo $e_fathername; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_lastname">Last Name <span>*</span></label>
                                          <input type="text" class="form-control" id="e_lastname" name="e_lastname" placeholder="Enter Last Name" value="<?php echo $e_lastname; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_mothername">Mother Name </label>
                                            <input type="text" class="form-control" id="e_mothername" name="e_mothername" placeholder="Enter Mother Name" value="<?php echo $e_mothername; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_wedge">Per Day Wedge</label>
                                            <input type="text" class="form-control" id="e_wedge" name="e_wedge" placeholder="Enter Wedge" value="<?php echo $e_wedge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_fullwedge">Full Month Wedge</label>
                                            <input type="text" class="form-control" id="e_fullwedge" name="e_fullwedge" placeholder="Enter Full Month Wedge" value="<?php echo $e_fullwedge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_depart_id">Department <span>*</span></label>
                                            <select class="form-control" id="e_depart_id" name="e_depart_id">
                                                <option value="">Select Department</option>
                                                <?php $depart = mysqli_query($link,"select * from department where 1&1 and d_parent_id='0' and d_company_id='".$_SESSION['company_id']."' ORDER BY d_id DESC"); 
                                                	  while($rwdepart = mysqli_fetch_array($depart)){
                                                ?>
                                                		<option value="<?php echo $rwdepart['d_id']; ?>" <?php if($e_depart_id == $rwdepart['d_id']){echo "selected";} ?>><?php echo $rwdepart['d_main']." ".$rwdepart['d_state']." ".$rwdepart['d_city']." ".$rwdepart['d_village']." ".$rwdepart['d_schema']; ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_sub_depart_id">Sub Department <span>*</span></label>
                                            <select class="form-control" id="e_sub_depart_id" name="e_sub_depart_id">
                                                <option value="">Sub Department</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_email">Email </label>
                                            <input type="email" class="form-control" id="e_email" name="e_email" placeholder="Enter Email" value="<?php echo $e_email; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_atthar_no">Aadhar No. </label>
                                            <input type="text" class="form-control" id="e_atthar_no" name="e_atthar_no" placeholder="Enter Aadhar No." value="<?php echo $e_atthar_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_pan_no">Pan No </label>
                                            <input type="text" class="form-control" id="e_pan_no" name="e_pan_no" placeholder="Enter Pan No." value="<?php echo $e_pan_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_esic_no">ECIS No </label>
                                            <input type="text" class="form-control" id="e_esic_no" name="e_esic_no" placeholder="Enter ECIS No" value="<?php echo $e_esic_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_uan_no">UAN No </label>
                                            <input type="text" class="form-control" id="e_uan_no" name="e_uan_no" placeholder="Enter UAN No" value="<?php echo $e_uan_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_emergency_mo_no">Emergency Mobile No.</label>
                                            <input type="text" class="form-control" id="e_emergency_mo_no" name="e_emergency_mo_no" placeholder="Enter Emergency Mobile No." value="<?php echo $e_emergency_mo_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_gender">Gender <span>*</span></label>
                                            <select class="form-control" id="e_gender" name="e_gender">
                                                <option value="">Select Gender</option>
                                                <option value="0" <?php if($e_gender == "0"){echo "selected";} ?>>Male</option>
                                                <option value="1" <?php if($e_gender == "1"){echo "selected";} ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_marriage">Marital Detail <span>*</span></label>
                                            <select class="form-control" id="e_marriage" name="e_marriage">
                                                <option value="">Select Marital Detail</option>
                                                <option value="0" <?php if($e_marriage == "0"){echo "selected";} ?>>Unmarried</option>
                                                <option value="1" <?php if($e_marriage == "1"){echo "selected";} ?>>Married</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_birthdate">Birthdate </label>
                                            <input type="date" class="form-control" id="e_birthdate" name="e_birthdate" placeholder="Select Birthdate" value="<?php echo $e_birthdate; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_current_office_name_address">Current Office Name/Address</label>
                                            <input type="text" class="form-control" id="e_current_office_name_address" name="e_current_office_name_address" placeholder="Enter Current Office Name/Address" value="<?php echo $e_current_office_name_address; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_current_designation">Current Designation</label>
                                            <input type="text" class="form-control" id="e_current_designation" name="e_current_designation" placeholder="Enter Current Designation" value="<?php echo $e_current_designation; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="e_register_date">Joining Date <span>*</span> </label>
                                            <input type="date" class="form-control" id="e_register_date" name="e_register_date" placeholder="Select Register Date" value="<?php echo $e_register_date; ?>">
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
                                          <label for="e_bank_name">Bank Name</label>
                                          <input type="text" class="form-control" id="e_bank_name" name="e_bank_name" placeholder="Enter Bank Name" value="<?php echo $e_bank_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_branch_name">Branch Name</label>
                                          <input type="text" class="form-control" id="e_branch_name" name="e_branch_name" placeholder="Enter Branch Name" value="<?php echo $e_branch_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_acc_no">Bank Account Number</label>
                                          <div class="bank_ac_no">
                                            <?php 
                                            if(isset($e_acc_no) && $e_acc_no != ""){
                                                $banknumber = str_split($e_acc_no);
                                                $ba1 = $banknumber[0];
                                                $ba2 = $banknumber[1];
                                                $ba3 = $banknumber[2];
                                                $ba4 = $banknumber[3];
                                                $ba5 = $banknumber[4];
                                                $ba6 = $banknumber[5];
                                                $ba7 = $banknumber[6];
                                                $ba8 = $banknumber[7];
                                                $ba9 = $banknumber[8];
                                                $ba10 = $banknumber[9];
                                                $ba11 = $banknumber[10];
                                                $ba12 = $banknumber[11];
                                                $ba13 = $banknumber[12];
                                                $ba14 = $banknumber[13];
                                                $ba15 = $banknumber[14];
                                                $ba16 = $banknumber[15];
                                                $ba17 = $banknumber[16];
                                                $ba18 = $banknumber[17];
                                            }else{
                                                $ba1 = "";
                                                $ba2 = "";
                                                $ba3 = "";
                                                $ba4 = "";
                                                $ba5 = "";
                                                $ba6 = "";
                                                $ba7 = "";
                                                $ba8 = "";
                                                $ba9 = "";
                                                $ba10 = "";
                                                $ba11 = "";
                                                $ba12 = "";
                                                $ba13 = "";
                                                $ba14 = "";
                                                $ba15 = "";
                                                $ba16 = "";
                                                $ba17 = "";
                                                $ba18 = "";
                                            }
                                              
                                              
                                            ?>
                                            <input type="text" class="form-control" id="e_acc_no1" name="e_acc_no1" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba1; ?>">
                                            <input type="text" class="form-control" id="e_acc_no2" name="e_acc_no2" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba2; ?>">
                                            <input type="text" class="form-control" id="e_acc_no3" name="e_acc_no3" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba3; ?>">
                                            <input type="text" class="form-control" id="e_acc_no4" name="e_acc_no4" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba4; ?>">
                                            <input type="text" class="form-control" id="e_acc_no5" name="e_acc_no5" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba5; ?>">
                                            <input type="text" class="form-control" id="e_acc_no6" name="e_acc_no6" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba6; ?>">
                                            <input type="text" class="form-control" id="e_acc_no7" name="e_acc_no7" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba7; ?>">
                                            <input type="text" class="form-control" id="e_acc_no8" name="e_acc_no8" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba8; ?>">
                                            <input type="text" class="form-control" id="e_acc_no9" name="e_acc_no9" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba9; ?>">
                                            <input type="text" class="form-control" id="e_acc_no10" name="e_acc_no10" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba10; ?>">
                                            <input type="text" class="form-control" id="e_acc_no11" name="e_acc_no11" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba11; ?>">
                                            <input type="text" class="form-control" id="e_acc_no12" name="e_acc_no12" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba12; ?>">
                                            <input type="text" class="form-control" id="e_acc_no13" name="e_acc_no13" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba13; ?>">
                                            <input type="text" class="form-control" id="e_acc_no14" name="e_acc_no14" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba14; ?>">
                                            <input type="text" class="form-control" id="e_acc_no15" name="e_acc_no15" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba15; ?>">
                                            <input type="text" class="form-control" id="e_acc_no16" name="e_acc_no16" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba16; ?>">
                                            <input type="text" class="form-control" id="e_acc_no17" name="e_acc_no17" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba17; ?>">
                                            <input type="text" class="form-control" id="e_acc_no18" name="e_acc_no18" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo $ba18; ?>">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_ifsc_code">RTGS / IFSC Code</label>
                                          <div class="bank_ifsc_no">
                                              <?php 
                                            if(isset($e_ifsc_code) && $e_ifsc_code != ""){
                                                $bankifsc = str_split($e_ifsc_code);
                                                $ifsc1 = $bankifsc[0];
                                                $ifsc2 = $bankifsc[1];
                                                $ifsc3 = $bankifsc[2];
                                                $ifsc4 = $bankifsc[3];
                                                $ifsc5 = $bankifsc[4];
                                                $ifsc6 = $bankifsc[5];
                                                $ifsc7 = $bankifsc[6];
                                                $ifsc8 = $bankifsc[7];
                                                $ifsc9 = $bankifsc[8];
                                                $ifsc10 = $bankifsc[9];
                                                $ifsc11 = $bankifsc[10];
                                                $ifsc12 = $bankifsc[11];
                                            }else{
                                                $ifsc1 = "";
                                                $ifsc2 = "";
                                                $ifsc3 = "";
                                                $ifsc4 = "";
                                                $ifsc5 = "";
                                                $ifsc6 = "";
                                                $ifsc7 = "";
                                                $ifsc8 = "";
                                                $ifsc9 = "";
                                                $ifsc10 = "";
                                                $ifsc11 = "";
                                                $ifsc12 = "";
                                            }
                                              
                                              
                                            ?>
                                                <input type="text" class="form-control" id="e_ifsc_code1" name="e_ifsc_code1" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc1; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code2" name="e_ifsc_code2" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc2; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code3" name="e_ifsc_code3" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc3; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code4" name="e_ifsc_code4" maxlength="1" ooninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc4; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code5" name="e_ifsc_code5" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc5; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code6" name="e_ifsc_code6" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc6; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code7" name="e_ifsc_code7" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc7; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code8" name="e_ifsc_code8" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc8; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code9" name="e_ifsc_code9" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc9; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code10" name="e_ifsc_code10" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc10; ?>">
                                                <input type="text" class="form-control" id="e_ifsc_code11" name="e_ifsc_code11" maxlength="1" oninput="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');" value="<?php echo $ifsc11; ?>">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_postal_address">Postal Address</label>
                                          <input type="text" class="form-control" id="e_postal_address" name="e_postal_address" placeholder="Enter Postal Address" value="<?php echo $e_postal_address; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_pincode">Pincode</label>
                                          <input type="text" class="form-control" id="e_pincode" name="e_pincode" placeholder="Enter Pincode" value="<?php echo $e_pincode; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Salary Slip Details</h4>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_da">D.A.</label>
                                          <input type="text" class="form-control" id="e_da" name="e_da" placeholder="Enter D.A." value="<?php echo $e_da; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_actual_hra">Actual H.R.A.</label>
                                          <input type="text" class="form-control" id="e_actual_hra" name="e_actual_hra" placeholder="Enter Actual H.R.A." value="<?php echo $e_actual_hra; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_medical_allow">Medical Allow.</label>
                                          <input type="text" class="form-control" id="e_medical_allow" name="e_medical_allow" placeholder="Enter Medical Allow." value="<?php echo $e_medical_allow; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_convey_allow">Convey. Allow.</label>
                                          <input type="text" class="form-control" id="e_convey_allow" name="e_convey_allow" placeholder="Enter Convey. Allow." value="<?php echo $e_convey_allow; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_edu_allow">Edu. Allow.</label>
                                          <input type="text" class="form-control" id="e_edu_allow" name="e_edu_allow" placeholder="Enter Edu. Allow." value="<?php echo $e_edu_allow; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_other_allow">Other Allow</label>
                                          <input type="text" class="form-control" id="e_other_allow" name="e_other_allow" placeholder="Enter Other Allow" value="<?php echo $e_other_allow; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_hra">Earning H.R.A.</label>
                                          <input type="text" class="form-control" id="e_earning_hra" name="e_earning_hra" placeholder="Enter Earning H.R.A." value="<?php echo $e_earning_hra; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_medical">Earning Medical</label>
                                          <input type="text" class="form-control" id="e_earning_medical" name="e_earning_medical" placeholder="Enter Earning Medical" value="<?php echo $e_earning_medical; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_conveyance">Earning Conveyance</label>
                                          <input type="text" class="form-control" id="e_earning_conveyance" name="e_earning_conveyance" placeholder="Enter Earning Conveyance" value="<?php echo $e_earning_conveyance; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_sta_bonus">Earning Sta. Bonus</label>
                                          <input type="text" class="form-control" id="e_earning_sta_bonus" name="e_earning_sta_bonus" placeholder="Enter Earning Sta. Bonus" value="<?php echo $e_earning_sta_bonus; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_leave_enc">Earning Leave Enc.</label>
                                          <input type="text" class="form-control" id="e_earning_leave_enc" name="e_earning_leave_enc" placeholder="Enter Earning Leave Enc." value="<?php echo $e_earning_leave_enc; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_gratuity">Earning Gratuity</label>
                                          <input type="text" class="form-control" id="e_earning_gratuity" name="e_earning_gratuity" placeholder="Enter Earning Gratuity" value="<?php echo $e_earning_gratuity; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_spe_a">Earning Spe. A</label>
                                          <input type="text" class="form-control" id="e_earning_spe_a" name="e_earning_spe_a" placeholder="Enter Earning Spe. A" value="<?php echo $e_earning_spe_a; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_pro_inc_attn_bonus">Earning Pro. Inc./Attn. Bonus</label>
                                          <input type="text" class="form-control" id="e_earning_pro_inc_attn_bonus" name="e_earning_pro_inc_attn_bonus" placeholder="Enter Earning Pro. Inc./Attn. Bonus" value="<?php echo $e_earning_pro_inc_attn_bonus; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_earning_ot_amount">Earning OT Amount</label>
                                          <input type="text" class="form-control" id="e_earning_ot_amount" name="e_earning_ot_amount" placeholder="Enter Earning OT Amount" value="<?php echo $e_earning_ot_amount; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Deductions Details</h4>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_pt">PT</label>
                                          <input type="text" class="form-control" id="e_pt" name="e_pt" placeholder="Enter PT" value="<?php echo $e_pt; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_pf">PF (%)</label>
                                          <input type="text" class="form-control" id="e_pf" name="e_pf" placeholder="Enter PF" value="<?php echo $e_pf; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_esi">Employee Contribution (%)</label>
                                          <input type="text" class="form-control" id="e_esi" name="e_esi" placeholder="Enter Employee Contribution" value="<?php echo $e_esi; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_lwf">LWF</label>
                                          <input type="text" class="form-control" id="e_lwf" name="e_lwf" placeholder="Enter LWF" value="<?php echo $e_lwf; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_tds">TDS</label>
                                          <input type="text" class="form-control" id="e_tds" name="e_tds" placeholder="Enter TDS" value="<?php echo $e_tds; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_advance">Advance</label>
                                          <input type="text" class="form-control" id="e_advance" name="e_advance" placeholder="Enter Advance" value="<?php echo $e_advance; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_loan_ins">Loan Ins.</label>
                                          <input type="text" class="form-control" id="e_loan_ins" name="e_loan_ins" placeholder="Enter TDS" value="<?php echo $e_loan_ins; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_canteen">Canteen</label>
                                          <input type="text" class="form-control" id="e_canteen" name="e_canteen" placeholder="Enter Canteen" value="<?php echo $e_canteen; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_oth_ded">Oth. Ded.</label>
                                          <input type="text" class="form-control" id="e_oth_ded" name="e_oth_ded" placeholder="Enter Oth. Ded." value="<?php echo $e_oth_ded; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_facility_time_safety_exp">Facility / Time / Safety Exp. (%)</label>
                                          <input type="text" class="form-control" id="e_facility_time_safety_exp" name="e_facility_time_safety_exp" placeholder="Enter Facility / Time / Safety Exp." value="<?php echo $e_facility_time_safety_exp; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Employe Contribution Details</h4>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_emp_contribution">Employer Contribution (%)</label>
                                          <input type="text" class="form-control" id="e_emp_contribution" name="e_emp_contribution" placeholder="Enter Employer Contribution" value="<?php echo $e_emp_contribution; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_epf">Employee EPF (%)</label>
                                          <input type="text" class="form-control" id="e_epf" name="e_epf" placeholder="Enter Employee EPF" value="<?php echo $e_epf; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_fpf">Employee FPF (%)</label>
                                          <input type="text" class="form-control" id="e_fpf" name="e_fpf" placeholder="Enter Employee FPF" value="<?php echo $e_fpf; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_abry_pf">Employee ABRY PF (%)</label>
                                          <input type="text" class="form-control" id="e_abry_pf" name="e_abry_pf" placeholder="Enter Employee ABRY PF" value="<?php echo $e_abry_pf; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_timeloss">Employee Time Loss (%)</label>
                                          <input type="text" class="form-control" id="e_timeloss" name="e_timeloss" placeholder="Enter Employee Time Loss" value="<?php echo $e_timeloss; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_service_charge">Employee Service Charge (%)</label>
                                          <input type="text" class="form-control" id="e_service_charge" name="e_service_charge" placeholder="Enter Employee Service Charge" value="<?php echo $e_service_charge; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Wage Details</h4>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_admin_wedge">Admin Wage (%)</label>
                                          <input type="text" class="form-control" id="e_admin_wedge" name="e_admin_wedge" placeholder="Enter Admin Wage" value="<?php echo $e_admin_wedge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_bonus_wedge">Bonus Wage (%)</label>
                                          <input type="text" class="form-control" id="e_bonus_wedge" name="e_bonus_wedge" placeholder="Enter Bonus Wage" value="<?php echo $e_bonus_wedge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_travel_wedge">Travel Wage (%)</label>
                                          <input type="text" class="form-control" id="e_travel_wedge" name="e_travel_wedge" placeholder="Enter Travel Wage" value="<?php echo $e_travel_wedge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_other_wedge">Other Wage (%)</label>
                                          <input type="text" class="form-control" id="e_other_wedge" name="e_other_wedge" placeholder="Enter Other Wage" value="<?php echo $e_other_wedge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_incometax">Income Tax (%)</label>
                                          <input type="text" class="form-control" id="e_incometax" name="e_incometax" placeholder="Enter Income Tax" value="<?php echo $e_incometax; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_insurance">Insurance (%)</label>
                                          <input type="text" class="form-control" id="e_insurance" name="e_insurance" placeholder="Enter Insurance" value="<?php echo $e_insurance; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_epfo">EPFO (%)</label>
                                          <input type="text" class="form-control" id="e_epfo" name="e_epfo" placeholder="Enter EPFO" value="<?php echo $e_epfo; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_admin_epfo">Admin EPFO (%)</label>
                                          <input type="text" class="form-control" id="e_admin_epfo" name="e_admin_epfo" placeholder="Enter Admin EPFO" value="<?php echo $e_admin_epfo; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_admin_esic">Admin ESIC Charge (%)</label>
                                          <input type="text" class="form-control" id="e_admin_esic" name="e_admin_esic" placeholder="Enter Admin ESIC Charge" value="<?php echo $e_admin_esic; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Education Details</h4>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_education1">Education 1</label>
                                          <input type="text" class="form-control" id="e_education1" name="e_education1" placeholder="Enter Education 1" value="<?php echo $e_education1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_year1">Passing Year 1</label>
                                          <input type="text" class="form-control" id="e_year1" name="e_year1" placeholder="Enter Education 1" value="<?php echo $e_year1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_grade1">Percentage/Grade 1</label>
                                          <input type="text" class="form-control" id="e_grade1" name="e_grade1" placeholder="Enter Percentage/Grade 1" value="<?php echo $e_grade1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_education2">Education 2</label>
                                          <input type="text" class="form-control" id="e_education2" name="e_education2" placeholder="Enter Education 2" value="<?php echo $e_education2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_year2">Passing Year 2</label>
                                          <input type="text" class="form-control" id="e_year2" name="e_year2" placeholder="Enter Education 2" value="<?php echo $e_year2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_grade2">Percentage/Grade 2</label>
                                          <input type="text" class="form-control" id="e_grade2" name="e_grade2" placeholder="Enter Percentage/Grade 2" value="<?php echo $e_grade2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_education3">Education 3</label>
                                          <input type="text" class="form-control" id="e_education3" name="e_education3" placeholder="Enter Education 3" value="<?php echo $e_education3; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_year3">Passing Year 3</label>
                                          <input type="text" class="form-control" id="e_year3" name="e_year3" placeholder="Enter Education 3" value="<?php echo $e_year3; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_grade3">Percentage/Grade 3</label>
                                          <input type="text" class="form-control" id="e_grade3" name="e_grade3" placeholder="Enter Percentage/Grade 3" value="<?php echo $e_grade3; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_education4">Education 4</label>
                                          <input type="text" class="form-control" id="e_education4" name="e_education4" placeholder="Enter Education 4" value="<?php echo $e_education4; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_year4">Passing Year 4</label>
                                          <input type="text" class="form-control" id="e_year4" name="e_year4" placeholder="Enter Education 4" value="<?php echo $e_year4; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_grade4">Percentage/Grade 4</label>
                                          <input type="text" class="form-control" id="e_grade4" name="e_grade4" placeholder="Enter Percentage/Grade 4" value="<?php echo $e_grade4; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Experience Details</h4>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_com1">Company Name 1</label>
                                          <input type="text" class="form-control" id="e_exp_com1" name="e_exp_com1" placeholder="Enter Company Name 1" value="<?php echo $e_exp_com1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_des1">Designation 1</label>
                                          <input type="text" class="form-control" id="e_exp_des1" name="e_exp_des1" placeholder="Enter Designation 1" value="<?php echo $e_exp_des1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_sal1">Salary 1</label>
                                          <input type="text" class="form-control" id="e_exp_sal1" name="e_exp_sal1" placeholder="Enter Salary 1" value="<?php echo $e_exp_sal1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_time1">Total Experience 1</label>
                                          <input type="text" class="form-control" id="e_exp_time1" name="e_exp_time1" placeholder="Enter Total Experience 1" value="<?php echo $e_exp_time1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_com2">Company Name 2</label>
                                          <input type="text" class="form-control" id="e_exp_com2" name="e_exp_com2" placeholder="Enter Company Name 2" value="<?php echo $e_exp_com2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_des2">Designation 2</label>
                                          <input type="text" class="form-control" id="e_exp_des2" name="e_exp_des2" placeholder="Enter Designation 2" value="<?php echo $e_exp_des2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_sal2">Salary 2</label>
                                          <input type="text" class="form-control" id="e_exp_sal2" name="e_exp_sal2" placeholder="Enter Salary 2" value="<?php echo $e_exp_sal2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_time2">Total Experience 2</label>
                                          <input type="text" class="form-control" id="e_exp_time2" name="e_exp_time2" placeholder="Enter Total Experience 2" value="<?php echo $e_exp_time2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_com3">Company Name 3</label>
                                          <input type="text" class="form-control" id="e_exp_com3" name="e_exp_com3" placeholder="Enter Company Name 3" value="<?php echo $e_exp_com3; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_des3">Designation 3</label>
                                          <input type="text" class="form-control" id="e_exp_des3" name="e_exp_des3" placeholder="Enter Designation 3" value="<?php echo $e_exp_des3; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_sal3">Salary 3</label>
                                          <input type="text" class="form-control" id="e_exp_sal3" name="e_exp_sal3" placeholder="Enter Salary 3" value="<?php echo $e_exp_sal3; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_time3">Total Experience 3</label>
                                          <input type="text" class="form-control" id="e_exp_time3" name="e_exp_time3" placeholder="Enter Total Experience 3" value="<?php echo $e_exp_time3; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_com4">Company Name 4</label>
                                          <input type="text" class="form-control" id="e_exp_com4" name="e_exp_com4" placeholder="Enter Company Name 4" value="<?php echo $e_exp_com4; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_des4">Designation 4</label>
                                          <input type="text" class="form-control" id="e_exp_des4" name="e_exp_des4" placeholder="Enter Designation 4" value="<?php echo $e_exp_des4; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_sal4">Salary 4</label>
                                          <input type="text" class="form-control" id="e_exp_sal4" name="e_exp_sal4" placeholder="Enter Salary 4" value="<?php echo $e_exp_sal4; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="e_exp_time4">Total Experience 4</label>
                                          <input type="text" class="form-control" id="e_exp_time4" name="e_exp_time4" placeholder="Enter Total Experience 4" value="<?php echo $e_exp_time4; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Other Details</h4>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                          <textarea class="form-control" rows="15" id="e_other_details" name="e_other_details" placeholder="Enter Other Details"><?php echo $e_other_details; ?></textarea>
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
<?php if($action == "edit"){ ?>
<script>
	jQuery(document).ready(function(){
		var e_depart_id = "<?php echo $e_depart_id; ?>";
		var e_sub_depart_id = "<?php echo $e_sub_depart_id; ?>";
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
    jQuery('#e_service_charge,#e_photo,#e_wedge,#e_fullwedge,#e_code_employee,#e_depart_id,#e_sub_depart_id,#e_current_office_name_address,#e_current_designation,#e_firstname,#e_lastname,#e_mothername,#e_fathername,#e_emergency_mo_no,#e_gender,#e_marriage,#e_birthdate,#e_mobile_no,#e_email,#e_atthar_no,#e_pan_no,#e_esic_no,#e_uan_no,#e_bank_name,#e_branch_name,#e_acc_no1,#e_acc_no2,#e_acc_no3,#e_acc_no4,#e_acc_no5,#e_acc_no6,#e_acc_no7,#e_acc_no8,#e_acc_no9,#e_acc_no10,#e_acc_no11,#e_acc_no12,#e_acc_no13,#e_acc_no14,#e_acc_no15,#e_acc_no16,#e_acc_no17,#e_acc_no18,#e_ifsc_code1,#e_ifsc_code2,#e_ifsc_code3,#e_ifsc_code4,#e_ifsc_code5,#e_ifsc_code6,#e_ifsc_code7,#e_ifsc_code8,#e_ifsc_code9,#e_ifsc_code10,#e_ifsc_code11,#e_postal_address,#e_pincode,#e_education1,#e_year1,#e_grade1,#e_education2,#e_year2,#e_grade2,#e_education3,#e_year3,#e_grade3,#e_education4,#e_year4,#e_grade4,#e_exp_com1,#e_exp_des1,#e_exp_sal1,#e_exp_time1,#e_exp_com2, #e_exp_des2,#e_exp_sal2,#e_exp_time2,#e_exp_com3,#e_exp_des3,#e_exp_sal3,#e_exp_time3,#e_exp_com4,#e_exp_des4,#e_exp_sal4,#e_exp_time4,#e_other_details,#e_pt,#e_pf,#e_esi,#e_register_date,#e_da,#e_actual_hra,#e_medical_allow,#e_convey_allow,#e_edu_allow,#e_other_allow,#e_earning_hra,#e_earning_medical,#e_earning_conveyance,#e_earning_sta_bonus,#e_earning_leave_enc,#e_earning_gratuity,#e_earning_spe_a,#e_earning_pro_inc_attn_bonus,#e_earning_ot_amount,#e_lwf,#e_tds,#e_advance,#e_loan_ins,#e_canteen,#_oth_ded,#e_facility_time_safety_exp,#e_emp_contribution,#e_epf,#e_fpf,#e_abry_pf,#e_timeloss,#e_admin_wedge,#e_bonus_wedge,#e_travel_wedge,#e_other_wedge,#e_incometax,#e_insurance,#e_epfo,#e_admin_epfo,#e_admin_esic').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
        jQuery("#e_firstname").removeClass("error-border");
        jQuery("#e_fathername").removeClass("error-border");
        jQuery("#e_lastname").removeClass("error-border");
        jQuery("#e_mobile_no").removeClass("error-border");
        jQuery("#e_depart_id").removeClass("error-border");
        jQuery("#e_gender").removeClass("error-border");
        jQuery("#e_marriage").removeClass("error-border");
        jQuery("#e_register_date").removeClass("error-border");
    });
    jQuery("#e_depart_id").change(function () {
    	$.ajax({
			type:'post',
			url:base_url+'employee_db.php',
			data:"e_depart_id="+$(this).val()+"&action=get_sub_department&selecteddepart=",
			success:function(url){
				$("#e_sub_depart_id").html(url);
				return false;
			},
		});
    });
    jQuery("#e_acc_no1").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no2").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no3").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no4").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no5").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no6").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no7").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no8").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no9").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no10").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no11").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no12").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no13").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no14").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no15").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no16").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_acc_no17").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code1").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code2").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code3").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code4").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code5").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code6").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code7").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code8").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code9").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    jQuery("#e_ifsc_code10").keyup(function () {
        if (this.value.length == this.maxLength) {
          jQuery(this).next('input').focus();
        }
    });
    
    jQuery("#add_bottom").click(function () {
        lfg = 1;
        var e_firstname = jQuery.trim(jQuery("#e_firstname").val());
        var e_fathername = jQuery.trim(jQuery("#e_fathername").val());
        var e_lastname = jQuery.trim(jQuery("#e_lastname").val());
        var e_mobile_no = jQuery.trim(jQuery("#e_mobile_no").val());
        var e_depart_id = jQuery.trim(jQuery("#e_depart_id").val());
        var e_gender = jQuery.trim(jQuery("#e_gender").val());
        var e_marriage = jQuery.trim(jQuery("#e_marriage").val());
        var e_register_date = jQuery.trim(jQuery("#e_register_date").val());
        if (e_firstname == "") {
            lfg = 0;
            jQuery("#e_firstname").addClass("error-border");
            jQuery("#e_firstname").focus();
            return false;
        }else if (e_fathername == "") {
            lfg = 0;
            jQuery("#e_fathername").addClass("error-border");
            jQuery("#e_fathername").focus();
            return false;
        }else if (e_lastname == "") {
            lfg = 0;
            jQuery("#e_lastname").addClass("error-border");
            jQuery("#e_lastname").focus();
            return false;
        }else if (e_mobile_no == "") {
            lfg = 0;
            jQuery("#e_mobile_no").addClass("error-border");
            jQuery("#e_mobile_no").focus();
            return false;
        }else if (e_depart_id == "") {
            lfg = 0;
            jQuery("#e_depart_id").addClass("error-border");
            jQuery("#e_depart_id").focus();
            return false;
        }else if (e_gender == "") {
            lfg = 0;
            jQuery("#e_gender").addClass("error-border");
            jQuery("#e_gender").focus();
            return false;
        }else if (e_marriage == "") {
            lfg = 0;
            jQuery("#e_marriage").addClass("error-border");
            jQuery("#e_marriage").focus();
            return false;
        }else if (e_register_date == "") {
            lfg = 0;
            jQuery("#e_register_date").addClass("error-border");
            jQuery("#e_register_date").focus();
            return false;
        }
    });
</script>
</body>
</html>