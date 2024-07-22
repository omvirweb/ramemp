<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "Dashboard";
        include_once("inc/head.php");
        
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }
?>
</head>
<body>
    <div>
        <?php 
            include_once("inc/top-pan.php"); 
        ?>
        <div class="container-fluid page-body-wrapper">
          <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin mb-3">
                  <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                      <h3 class="font-weight-bold">Welcome <?php echo ucfirst($_SESSION['company_name']); ?></h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 grid-margin transparent mb-3">
                  <div class="row">
                    <div class="col-md-2 mb-4 stretch-card transparent">
                      <div class="card card-tale">
                        <div class="card-body">
                          <p class="mb-4">Number of Company</p>
                          <p class="fs-30 mb-2"><?php $selectcompany = mysqli_query($link,"select * from company"); echo mysqli_num_rows($selectcompany); ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 mb-4 stretch-card transparent">
                      <div class="card card-dark-blue">
                        <div class="card-body">
                          <p class="mb-4">Number of Department</p>
                          <p class="fs-30 mb-2"><?php if(isset($_SESSION['company_id']) && $_SESSION['company_id'] != ""){$selectdepartment = mysqli_query($link,"select * from department where d_company_id='".$_SESSION['company_id']."' and d_parent_id='0'"); echo mysqli_num_rows($selectdepartment);}else{echo "0";} ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 mb-4 stretch-card transparent">
                      <div class="card card-dark-blue" style="background: #bbcf9c;">
                        <div class="card-body">
                          <p class="mb-4">Number of Sub Department</p>
                          <p class="fs-30 mb-2"><?php if(isset($_SESSION['company_id']) && $_SESSION['company_id'] != ""){$selectdepartment = mysqli_query($link,"select * from department where d_company_id='".$_SESSION['company_id']."' and d_parent_id!='0'"); echo mysqli_num_rows($selectdepartment);}else{echo "0";} ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 mb-4 stretch-card transparent">
                      <div class="card card-light-blue">
                        <div class="card-body">
                          <p class="mb-4">Number of Employee</p>
                          <p class="fs-30 mb-2"><?php if(isset($_SESSION['company_id']) && $_SESSION['company_id'] != ""){$selectemployee = mysqli_query($link,"select * from employee where e_company_id='".$_SESSION['company_id']."'"); echo mysqli_num_rows($selectemployee);}else{echo "0";} ?></p>
                        </div>
                      </div>
                    </div>
                    <?php if($ur_download_excel_sheet != '0'){ ?>
                    <div class="col-md-2 mb-4 stretch-card transparent">
                      <div class="card card-tale" style="background: #c09edfc4;">
                        <div class="card-body">
                            <a href="downloadsalaryslip.php" style="text-decoration: none;color: #fff;">
                              <p class="fs-30 mb-2" style="text-align:center"><svg style="font-size: 75px;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="white" d="M11 9c0 1.66-1.34 3-3 3s-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3m3 11H2v-2c0-2.21 2.69-4 6-4s6 1.79 6 4m8-6v2h-9v-2m9-4v2h-9V8m9-4v2h-9V4Z"/></svg></p>
                              <p class="mb-0" style="text-align:center;font-size: 16px;">Download Excel For Salary</p>
                            </a>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if($ur_monthly_salary_status != '0'){ ?>
                    <div class="col-md-2 mb-4 stretch-card transparent">
                      <div class="card card-dark-blue" style="background: #418db1a8;">
                        <div class="card-body">
                            <a href="monthlysalarystatus.php" style="text-decoration: none;color: #fff;">
                              <p class="fs-30 mb-2" style="text-align:center"><svg style="font-size: 75px;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="white" fill-rule="evenodd" d="M7.999 1a.75.75 0 0 1 .715.521L12 11.79l1.286-4.018A.75.75 0 0 1 14 7.25h1.25a.75.75 0 0 1 0 1.5h-.703l-1.833 5.729a.75.75 0 0 1-1.428 0L8.005 4.226l-2.29 7.25a.75.75 0 0 1-1.42.03L3.031 8.03l-.07.208a.75.75 0 0 1-.711.513H.75a.75.75 0 0 1 0-1.5h.96l.578-1.737a.75.75 0 0 1 1.417-.02L4.95 8.919l2.335-7.394A.75.75 0 0 1 7.999 1" clip-rule="evenodd"/></svg></p>
                              <p class="mb-0" style="text-align:center;font-size: 16px;">Monthly Salary Status</p>
                            </a>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php include_once("inc/footer.php"); ?>
          </div>
        </div>
      </div>
<?php include_once("js.php"); ?>
</body>
</html>