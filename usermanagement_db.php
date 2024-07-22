<?php include_once 'inc/connection.php';
      $action = $_POST['action'];
      if($action == 'add'){
          $errors = "";
          if(!(isset($_POST["l_first_name"]) && trim($_POST["l_first_name"] != ""))){
              $errors .= "First Name Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_last_name"]) && trim($_POST["l_last_name"] != ""))){
              $errors .= "Last Name Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_user_name"]) && trim($_POST["l_user_name"] != ""))){
              $errors .= "User Name Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_email"]) && trim($_POST["l_email"] != ""))){
              $errors .= "Email Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_password"]) && trim($_POST["l_password"] != ""))){
              $errors .= "Password Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_type"]) && trim($_POST["l_type"] != ""))){
              $errors .= "Type Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_status"]) && trim($_POST["l_status"] != ""))){
              $errors .= "Status Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from login_user where l_user_name='".$_POST["l_user_name"]."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "User Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          
          if(isset($_POST['l_company'])){
              $l_company = 1;
          }else{
              $l_company = 0;
          }
          
          if(isset($_POST['l_department'])){
              $l_department = 1;
          }else{
              $l_department = 0;
          }
          
          if(isset($_POST['l_sub_department'])){
              $l_sub_department = 1;
          }else{
              $l_sub_department = 0;
          }
          
          if(isset($_POST['l_employee'])){
              $l_employee = 1;
          }else{
              $l_employee = 0;
          }
          
          if(isset($_POST['l_attendence_sheet'])){
              $l_attendence_sheet = 1;
          }else{
              $l_attendence_sheet = 0;
          }
          
          if(isset($_POST['l_monthly_report'])){
              $l_monthly_report = 1;
          }else{
              $l_monthly_report = 0;
          }
          
          if(isset($_POST['l_salary_sleep'])){
              $l_salary_sleep = 1;
          }else{
              $l_salary_sleep = 0;
          }
          
          if(isset($_POST['l_insuration_corporation'])){
              $l_insuration_corporation = 1;
          }else{
              $l_insuration_corporation = 0;
          }
          
          if(isset($_POST['l_invoice'])){
              $l_invoice = 1;
          }else{
              $l_invoice = 0;
          }
          
          if(isset($_POST['l_salary_register'])){
              $l_salary_register = 1;
          }else{
              $l_salary_register = 0;
          }
          
          if(isset($_POST['l_wadges'])){
              $l_wadges = 1;
          }else{
              $l_wadges = 0;
          }
          
          if(isset($_POST['l_billing_sheet'])){
              $l_billing_sheet = 1;
          }else{
              $l_billing_sheet = 0;
          }
          
          if(isset($_POST['l_general_settings'])){
              $l_general_settings = 1;
          }else{
              $l_general_settings = 0;
          }
          
          if(isset($_POST['l_download_excel_sheet'])){
              $l_download_excel_sheet = 1;
          }else{
              $l_download_excel_sheet = 0;
          }
          
          if(isset($_POST['l_monthly_salary_status'])){
              $l_monthly_salary_status = 1;
          }else{
              $l_monthly_salary_status = 0;
          }
            
          $update_qry = "INSERT INTO `login_user`(`l_first_name`, `l_last_name`, `l_user_name`, `l_email`, `l_password`, `l_company`, `l_department`, `l_sub_department`, `l_employee`, `l_attendence_sheet`, `l_monthly_report`, `l_salary_sleep`, `l_insuration_corporation`, `l_invoice`, `l_salary_register`,`l_wadges`,`l_billing_sheet`,`l_general_settings`,`l_type`,`l_download_excel_sheet`,`l_monthly_salary_status`,`l_status`) VALUES ('".$_POST['l_first_name']."','".$_POST['l_last_name']."','".$_POST['l_user_name']."','".$_POST['l_email']."','".$_POST['l_password']."','".$l_company."','".$l_department."','".$l_sub_department."','".$l_employee."','".$l_attendence_sheet."','".$l_monthly_report."','".$l_salary_sleep."','".$l_insuration_corporation."','".$l_invoice."','".$l_salary_register."','".$l_wadges."','".$l_billing_sheet."','".$l_general_settings."','".$_POST['l_type']."','".$l_download_excel_sheet."','".$l_monthly_salary_status."','".$_POST['l_status']."')";  
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>User ".ucfirst($_POST['l_user_name'])." Inserted Successfully.</div>";
          header("location:usermanagement.php");
          exit();

      }else if($action == 'edit'){
          $errors = "";

          if(!(isset($_POST["l_first_name"]) && trim($_POST["l_first_name"] != ""))){
              $errors .= "First Name Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_last_name"]) && trim($_POST["l_last_name"] != ""))){
              $errors .= "Last Name Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_user_name"]) && trim($_POST["l_user_name"] != ""))){
              $errors .= "User Name Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_email"]) && trim($_POST["l_email"] != ""))){
              $errors .= "Email Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_password"]) && trim($_POST["l_password"] != ""))){
              $errors .= "Password Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_type"]) && trim($_POST["l_type"] != ""))){
              $errors .= "Type Is Required.<br/>";
          }
          
          if(!(isset($_POST["l_status"]) && trim($_POST["l_status"] != ""))){
              $errors .= "Status Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from login_user where l_user_name='".$_POST["l_user_name"]."' and l_id!='".$_POST["id"]."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "User Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          
          if(isset($_POST['l_company'])){
              $l_company = 1;
          }else{
              $l_company = 0;
          }
          
          if(isset($_POST['l_department'])){
              $l_department = 1;
          }else{
              $l_department = 0;
          }
          
          if(isset($_POST['l_sub_department'])){
              $l_sub_department = 1;
          }else{
              $l_sub_department = 0;
          }
          
          if(isset($_POST['l_employee'])){
              $l_employee = 1;
          }else{
              $l_employee = 0;
          }
          
          if(isset($_POST['l_attendence_sheet'])){
              $l_attendence_sheet = 1;
          }else{
              $l_attendence_sheet = 0;
          }
          
          if(isset($_POST['l_monthly_report'])){
              $l_monthly_report = 1;
          }else{
              $l_monthly_report = 0;
          }
          
          if(isset($_POST['l_salary_sleep'])){
              $l_salary_sleep = 1;
          }else{
              $l_salary_sleep = 0;
          }
          
          if(isset($_POST['l_insuration_corporation'])){
              $l_insuration_corporation = 1;
          }else{
              $l_insuration_corporation = 0;
          }
          
          if(isset($_POST['l_invoice'])){
              $l_invoice = 1;
          }else{
              $l_invoice = 0;
          }
          
          if(isset($_POST['l_salary_register'])){
              $l_salary_register = 1;
          }else{
              $l_salary_register = 0;
          }
          
          if(isset($_POST['l_wadges'])){
              $l_wadges = 1;
          }else{
              $l_wadges = 0;
          }
          
          if(isset($_POST['l_billing_sheet'])){
              $l_billing_sheet = 1;
          }else{
              $l_billing_sheet = 0;
          }
          
          if(isset($_POST['l_general_settings'])){
              $l_general_settings = 1;
          }else{
              $l_general_settings = 0;
          }
          
          if(isset($_POST['l_download_excel_sheet'])){
              $l_download_excel_sheet = 1;
          }else{
              $l_download_excel_sheet = 0;
          }
          
          if(isset($_POST['l_monthly_salary_status'])){
              $l_monthly_salary_status = 1;
          }else{
              $l_monthly_salary_status = 0;
          }

          $update_qry = "UPDATE `login_user` SET `l_first_name`='".$_POST["l_first_name"]."',`l_last_name`='".$_POST["l_last_name"]."',`l_user_name`='".$_POST["l_user_name"]."',`l_email`='".$_POST["l_email"]."',`l_password`='".$_POST["l_password"]."',`l_company`='".$l_company."',`l_department`='".$l_department."',`l_sub_department`='".$l_sub_department."',`l_employee`='".$l_employee."',`l_attendence_sheet`='".$l_attendence_sheet."',`l_monthly_report`='".$l_monthly_report."',`l_salary_sleep`='".$l_salary_sleep."',`l_insuration_corporation`='".$l_insuration_corporation."',`l_invoice`='".$l_invoice."',l_salary_register='".$l_salary_register."',l_wadges='".$l_wadges."',l_billing_sheet='".$l_billing_sheet."',l_general_settings='".$l_general_settings."',l_type='".$_POST['l_type']."',l_download_excel_sheet='".$l_download_excel_sheet."',l_monthly_salary_status='".$l_monthly_salary_status."',l_status='".$_POST["l_status"]."' WHERE `l_id`='".$_POST["id"]."'";

          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>User ".ucfirst($_POST["l_user_name"])." Updated Successfully.</div>";
          header("location:usermanagement.php");
          exit();

      }else if($action == 'delete'){ 
          $update_qry = "delete from login_user where l_id='".$_POST["id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>User Deleted Successfully.</div>";
          echo "usermanagement.php";
      }else{
          $_SESSION["msg"] = "<div class='alert alert-danger'>Action not found.</div>";
          header("location:usermanagement.php");
          exit();
      }
?>