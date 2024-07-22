<?php include_once 'inc/connection.php';
      $action = $_POST['action'];
      $target_dir = "UploadImages/company/";
      if($action == 'add'){
          $errors = "";
          if(!(isset($_POST["c_name"]) && trim($_POST["c_name"] != ""))){
              $errors .= "Name Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from company where c_name='".$_POST["c_name"]."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          if ($_FILES["c_logo"]["size"] > 0) {
            $img1 = basename($_FILES["c_logo"]["name"]);
            $target_file = $target_dir . $img1;
            move_uploaded_file($_FILES["c_logo"]["tmp_name"], $target_file);            
          }else{
            $img1 = $_POST['hidden_logo'];
          }


          $update_qry = "INSERT INTO `company`(`c_logo`, `c_name`, `c_email`, `c_address`, `c_phone`, `c_gst_no`, `c_bank_name`, `c_branch_name`, `c_bank_acc_no`, `c_ifsc_rtgs_code`, `c_pf_code`, `c_ecis_code`, `c_trrn_no`, `c_ecr_id`, `c_lin_no`, `c_establishment`,`c_owner`,`c_user_id`,`c_user_type_id`) VALUES ('".$img1."','".$_POST['c_name']."','".$_POST['c_email']."','".$_POST['c_address']."','".$_POST['c_phone']."','".$_POST['c_gst_no']."','".$_POST['c_bank_name']."','".$_POST['c_branch_name']."','".$_POST['c_bank_acc_no']."','".$_POST['c_ifsc_rtgs_code']."','".$_POST['c_pf_code']."','".$_POST['c_ecis_code']."','".$_POST['c_trrn_no']."','".$_POST['c_ecr_id']."','".$_POST['c_lin_no']."','".$_POST['c_establishment']."','".$_POST['c_owner']."','".$_POST['c_user_id']."','".$_POST['c_user_type_id']."')";  
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Company ".ucfirst($_POST['uname'])." Inserted Successfully.</div>";
          header("location:company.php");
          exit();

      }else if($action == 'edit'){
          $errors = "";

          if(!(isset($_POST["c_name"]) && trim($_POST["c_name"] != ""))){
              $errors .= "Name Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from company where c_name='".$_POST["c_name"]."' and c_id!='".$_POST["id"]."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          if ($_FILES["c_logo"]["size"] > 0) {
            $img1 = basename($_FILES["c_logo"]["name"]);
            $target_file = $target_dir . $img1;
            move_uploaded_file($_FILES["c_logo"]["tmp_name"], $target_file);            
          }else{
            $img1 = $_POST['hidden_logo'];
          }

          $update_qry = "UPDATE `company` SET `c_logo`='".$img1."',`c_name`='".$_POST["c_name"]."',`c_email`='".$_POST["c_email"]."',`c_address`='".$_POST["c_address"]."',`c_phone`='".$_POST["c_phone"]."',`c_gst_no`='".$_POST["c_gst_no"]."',`c_bank_name`='".$_POST["c_bank_name"]."',`c_branch_name`='".$_POST["c_branch_name"]."',`c_bank_acc_no`='".$_POST["c_bank_acc_no"]."',`c_ifsc_rtgs_code`='".$_POST["c_ifsc_rtgs_code"]."',`c_pf_code`='".$_POST["c_pf_code"]."',`c_ecis_code`='".$_POST["c_ecis_code"]."',`c_trrn_no`='".$_POST["c_trrn_no"]."',`c_ecr_id`='".$_POST["c_ecr_id"]."',`c_lin_no`='".$_POST["c_lin_no"]."',c_establishment='".$_POST['c_establishment']."',c_owner='".$_POST['c_owner']."',c_user_id='".$_POST['c_user_id']."',c_user_type_id='".$_POST['c_user_type_id']."' WHERE `c_id`='".$_POST["id"]."'";

          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Company ".ucfirst($_POST["uname"])." Updated Successfully.</div>";
          header("location:company.php");
          exit();

      }else if($action == 'delete'){ 
          $update_qry = "delete from company where c_id='".$_POST["id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Company Deleted Successfully.</div>";
          echo "company.php";
      }else{
          $_SESSION["msg"] = "<div class='alert alert-danger'>Action not found.</div>";
          header("location:company.php");
          exit();
      }
?>