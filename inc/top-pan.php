<?php
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
}else{
    header("location:index.php");
    exit;
}
?>
<nav class="navbar col-lg-12 col-12 p-0 d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-5" href="<?php echo SITE_ROOT_FRONT."dashboard.php";?>"><img src="<?php echo SITE_ROOT_FRONT;?>img/ram-logo.png" class="mr-2" alt="Ram Construction"/></a>
      <a class="navbar-brand brand-logo-mini" href="<?php echo SITE_ROOT_FRONT."dashboard.php";?>"><img src="<?php echo SITE_ROOT_FRONT;?>img/small_logo.png" alt="Ram Construction"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center top_nav" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <button type="button" class="companypopup" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#companypopup"><?php if(isset($_SESSION['company_logo']) && $_SESSION['company_logo'] != ""){echo "<img src='".SITE_ROOT_FRONT."UploadImages/company/".$_SESSION['company_logo']."' style='width:170px'/>"; ?> <i class="mdi mdi-menu-down"></i><?php }else if(isset($_SESSION['company_name']) && $_SESSION['company_name'] != ""){echo ucfirst($_SESSION['company_name']).'<i class="mdi mdi-menu-down"></i>'; } ?></button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <?php echo "Welcome <b>".substr(ucfirst($_SESSION[$user_project_name]), 0, 3)."...</b>"; ?> <i class="mdi mdi-menu-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item <?php if($page_name == "Edit Profile"){echo "active";} ?>" href="<?php echo SITE_ROOT_FRONT;?>profile_edit.php">
                <i class="ti-settings text-primary"></i>
                Profile
              </a>
              <?php if(isset($_SESSION["i_m_admin"]) && $_SESSION["i_m_admin"] == "true"){ ?>
              <a class="dropdown-item <?php if($page_name == "User Management"){echo "active";} ?>" href="<?php echo SITE_ROOT_FRONT;?>usermanagement.php">
                <i class="ti-user text-primary"></i>
                User Management
              </a>
              <?php } ?>
              <a class="dropdown-item" href="<?php echo SITE_ROOT_FRONT;?>logout.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light p-0 px-5 sub_menu">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item <?php if($page_name == "Dashboard"){echo "active";} ?>">
                  <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>dashboard.php">Dashboard</a>
                </li>
                <?php if($ur_company != '0'){ ?>
                <li class="nav-item <?php if($page_name == "Company" || $page_name == "Add Company" || $page_name == "Edit Company"){echo "active";} ?>">
                  <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>company.php">Company</a>
                </li>
                <?php } ?>
                <?php if($ur_department != '0'){ ?>
                <li class="nav-item dropdown <?php if($page_name == "Department" || $page_name == "Add Department" || $page_name == "Edit Department"){echo "active";} ?>">
                  <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>department.php">Department</a>
                </li>
                <?php } ?>
                <?php if($ur_employee != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "Employee" || $page_name == "Add Employee" || $page_name == "Edit Employee"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>employee.php">Employee</a>
                    </li>
                <?php } ?>
                <?php if($ur_attendence_sheet != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "Attendance Sheet"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>attendancesheet.php">Attendance Sheet</a>
                    </li>
                <?php } ?>
                <?php if($ur_monthly_report != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "Monthly Report"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>monthlyreport.php">Monthly Report</a>
                    </li>
                <?php } ?>
                <?php if($ur_salary_sleep != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "Salary Slip"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>salaryslip.php">Salary Slip</a>
                    </li>
                <?php } ?>
                <?php if($ur_insuration_corporation != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "Insurance Corporation"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>insurancecorporation.php">Insurance Corporation</a>
                    </li>
                <?php } ?>
                <?php if($ur_invoice != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "Invoice" || $page_name == "Add Invoice" || $page_name == "Edit Invoice"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>invoice.php">Invoice</a>
                    </li>
                <?php } ?>
                <?php if($ur_salary_register != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "Salary Register"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>salaryregister.php">Salary Register</a>
                    </li>
                <?php } ?>
                <?php if($ur_wadges != '0' || $ur_billing_sheet != '0'){ ?>
                    <li class="nav-item dropdown <?php if($page_name == "Wages"){echo "active";} ?>">
                      <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdownMenuLink6" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Wages
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink6">
                          <?php if($ur_wadges != '0'){ ?>
                            <a class="dropdown-item <?php if($page_name == "Wages"){echo "active";} ?>" href="<?php echo SITE_ROOT_FRONT;?>wages.php">Wages</a>
                          <?php } ?>
                          <?php if($ur_billing_sheet != '0'){ ?>
                            <a class="dropdown-item <?php if($page_name == "Billing Sheet"){echo "active";} ?>" href="<?php echo SITE_ROOT_FRONT;?>billingsheet.php">Billing Sheet</a>
                          <?php } ?>
                      </div>
                    </li>
                <?php } ?>
                <?php if($ur_general_settings != '0'){ ?>
                    <li class="nav-item <?php if($page_name == "General Settings"){echo "active";} ?>">
                      <a class="nav-link" href="<?php echo SITE_ROOT_FRONT;?>generalsettings.php">General Settings</a>
                    </li>
                <?php } ?>
              </ul>
            </div>
</nav>
<div class="modal" id="companypopup">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Company</h4>
      </div>
      <div class="modal-body">
        <?php $selectcompany = mysqli_query($link,"select * from company"); 
              if(mysqli_num_rows($selectcompany)>0){
                  echo "<ul>";
                  while($rwselectcompany = mysqli_fetch_array($selectcompany)){
                      echo "<li data-id='".$rwselectcompany['c_id']."' data-title='".$rwselectcompany['c_name']."'>".$rwselectcompany['c_name']."</li>";
                  }
                  echo "</ul>";
                  if($ur_company != '0'){echo "<div class='company_error'><a href='company_add.php'>Add New Company</a></div>";}
              }else{
                  echo "<div class='company_error'>You have not any company added. please <a href='company_add.php'>click here</a> and add the company first and choose the company.</div>";
              }
        ?>
      </div>
    </div>
  </div>
</div>