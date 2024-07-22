<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "General Settings";
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
        }else if($ur_general_settings == '0'){
            header("location:dashboard.php");
            exit();
        }
        $selectpackunit = mysqli_query($link,"select * from login_admin");
        $rwselectpackunit = mysqli_fetch_array($selectpackunit);
        $action = "edit";
        $hsminwages = $rwselectpackunit['hsminwages'];
        $sminwages = $rwselectpackunit['sminwages'];
        $ssminwages = $rwselectpackunit['ssminwages'];
        $usminwages = $rwselectpackunit['usminwages'];
        $sgst = $rwselectpackunit['sgst'];
        $cgst = $rwselectpackunit['cgst'];
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
                            <div class="col-md-12 col-xs-12">
                              <h3 class="font-weight-bold"><?php echo $page_name; ?></h3>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="generalsettings_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                  <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="sgst">SGST Percentage</label>
                                          <input type="tel" class="form-control" id="sgst" name="sgst" placeholder="Enter SGST" value="<?php echo $sgst; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="cgst">CGST Percentage</label>
                                          <input type="tel" class="form-control" id="cgst" name="cgst" placeholder="Enter CGST" value="<?php echo $cgst; ?>">
                                        </div>
                                    </div>
                                  </div>
                                  <hr/>
                                  <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Wages Details</h4>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="hsminwages">High Skilled Minimum Basic</label>
                                          <input type="tel" class="form-control" id="hsminwages" name="hsminwages" placeholder="Enter High Skilled Minimum Basic" value="<?php echo $hsminwages; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="sminwages">Skilled Minimum Basic</label>
                                          <input type="tel" class="form-control" id="sminwages" name="sminwages" placeholder="Enter Skilled Minimum Basic" value="<?php echo $sminwages; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="ssminwages">Semi Skilled Minimum Basic</label>
                                          <input type="tel" class="form-control" id="ssminwages" name="ssminwages" placeholder="Enter Semi Skilled Minimum Basic" value="<?php echo $ssminwages; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="usminwages">Unskilled Minimum Basic</label>
                                          <input type="tel" class="form-control" id="usminwages" name="usminwages" placeholder="Enter Unskilled Minimum Basic" value="<?php echo $usminwages; ?>">
                                        </div>
                                    </div>
                                  </div>
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
  jQuery('#hsminwages,#sminwages,#ssminwages,#usminwages,#sgst,#cgst').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
    });
</script>
</body>
</html>