<?php   include_once 'inc/connection.php';
        $errors = "";

        if ($_SESSION["i_m_admin"] == "true") { 
              if(!(isset($_POST["admin_name"]) && trim($_POST["admin_name"] != ""))){
                  $errors .= "User Name Is Required.<br/>";
              }

              if(!(isset($_POST["admin_pass"]) && trim($_POST["admin_pass"] != ""))){
                  $errors .= "Password Is Required.<br/>";
              }

              if(!(isset($_POST["admin_email"]) && trim($_POST["admin_email"] != ""))){
                  $errors .= "Email Address Is Required.<br/>";
              }

              $selectunitname = mysqli_query($link,"select * from login_admin where admin_name='".$_POST["admin_name"]."' and admin_pass='".$_POST["admin_pass"]."' and admin_email='".$_POST["admin_email"]."' and id!='".$_POST["id"]."'");
              if(mysqli_num_rows($selectunitname)>0){
                  $errors .= "Admin User Already Exists.<br/>";
              }

              if(isset($errors) && $errors != ""){
                  $finalmsg = rtrim($errors,"<br/>");
                  $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
                  header("location:".$_SERVER['HTTP_REFERER']);
                  exit();
              }

              $update_qry = "update login_admin set admin_name='".$_POST["admin_name"]."',admin_pass='".$_POST["admin_pass"]."',admin_email='".$_POST["admin_email"]."' where id='".$_POST["id"]."'"; 
        }else{

              if(!(isset($_POST["username"]) && trim($_POST["username"] != ""))){
                  $errors .= "User Name Is Required.<br/>";
              }

              if(!(isset($_POST["password"]) && trim($_POST["password"] != ""))){
                  $errors .= "Password Is Required.<br/>";
              }

              if(!(isset($_POST["email"]) && trim($_POST["email"] != ""))){
                  $errors .= "Email Address Is Required.<br/>";
              }

              if(!(isset($_POST["first_name"]) && trim($_POST["first_name"] != ""))){
                  $errors .= "First Name Is Required.<br/>";
              }

              if(!(isset($_POST["last_name"]) && trim($_POST["last_name"] != ""))){
                  $errors .= "Last Name Is Required.<br/>";
              }


              $selectunitname = mysqli_query($link,"select * from login_user where l_user_name='".$_POST["username"]."' and l_id!='".$_POST["id"]."'");
              if(mysqli_num_rows($selectunitname)>0){
                  $errors .= "User Name Already Exists.<br/>";
              }


              $selectunitname = mysqli_query($link,"select * from login_user where l_email='".$_POST["email"]."' and l_id!='".$_POST["id"]."'");
              if(mysqli_num_rows($selectunitname)>0){
                  $errors .= "Email Address Already Exists.<br/>";
              }

              if(isset($errors) && $errors != ""){
                  $finalmsg = rtrim($errors,"<br/>");
                  $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
                  header("location:".$_SERVER['HTTP_REFERER']);
                  exit();
              }

              $update_qry = "update login_user set l_user_name='".$_POST["username"]."',l_password='".$_POST["password"]."',l_email='".$_POST["email"]."',l_first_name='".$_POST["first_name"]."',l_last_name='".$_POST["last_name"]."' where l_id='".$_POST["id"]."'"; 
        }

        $run_upd = mysqli_query($link,$update_qry); 
        $_SESSION["msg"] = "<div class='alert alert-success'>Profile Updated Successfully.</div>";
        header("location:profile_edit.php");
        exit();
?>