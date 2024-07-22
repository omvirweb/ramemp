<?php include_once 'inc/connection.php';
      $action = $_POST['action'];
      if($action == 'add'){
          $errors = "";
          if(!(isset($_POST["d_main"]) && trim($_POST["d_main"] != ""))){
              $errors .= "Department Name Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from department where d_main='".$_POST["d_main"]."' and d_company_id='".$_SESSION['company_id']."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "Department Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }


          $update_qry = "INSERT INTO `department`(`d_company_id`, `d_main`, `d_parent_id`, `d_jem_portal_no`, `d_state`, `d_city`, `d_village`, `d_schema`,`d_sitename`) VALUES ('".$_SESSION['company_id']."','".$_POST['d_main']."','0','".$_POST['d_jem_portal_no']."','".$_POST['d_state']."','".$_POST['d_city']."','".$_POST['d_village']."','".$_POST['d_schema']."','".$_POST['d_sitename']."')";  
          $run_upd = mysqli_query($link,$update_qry); 
          $lastid = mysqli_insert_id($link);
          
          for($j=0;$j<count($_POST['d_sub_main']);$j++){
              $d_sub_ori_main = $_POST['d_sub_ori_main'][$j];
              $d_sub_main = $_POST['d_sub_main'][$j];
              $d_sub_jem_portal_no = $_POST['d_sub_jem_portal_no'][$j];
              $d_sub_state = $_POST['d_sub_state'][$j];
              $d_sub_city = $_POST['d_sub_city'][$j];
              $d_sub_village = $_POST['d_sub_village'][$j];
              $d_sub_schema = $_POST['d_sub_schema'][$j];
              
              $selectsubdep1 = mysqli_query($link,"select * from department where d_main='".$d_sub_ori_main."' and d_parent_id='".$lastid."'");
              $selectsubdep2 = mysqli_query($link,"select * from department where d_main='".$d_sub_main."' and d_parent_id='".$lastid."'");
              if(mysqli_num_rows($selectsubdep1)>0){
                  $rwselectsubdep1 = mysqli_fetch_array($selectsubdep1);
                  mysqli_query($link,"update department set `d_main`='".$d_sub_main."', `d_jem_portal_no`='".$d_sub_jem_portal_no."', `d_state`='".$d_sub_state."', `d_city`='".$d_sub_city."', `d_village`='".$d_sub_village."', `d_schema`='".$d_sub_schema."' where d_id='".$rwselectsubdep1['d_id']."'");
              }else if(mysqli_num_rows($selectsubdep2)>0){
                  $rwselectsubdep2 = mysqli_fetch_array($selectsubdep2);
                  mysqli_query($link,"update department set `d_main`='".$d_sub_main."', `d_jem_portal_no`='".$d_sub_jem_portal_no."', `d_state`='".$d_sub_state."', `d_city`='".$d_sub_city."', `d_village`='".$d_sub_village."', `d_schema`='".$d_sub_schema."' where d_id='".$rwselectsubdep2['d_id']."'");
              }else{
                  mysqli_query($link,"INSERT INTO `department`(`d_main`, `d_jem_portal_no`, `d_state`, `d_city`, `d_village`, `d_schema`,`d_parent_id`,`d_company_id`) VALUES ('".$d_sub_main."','".$d_sub_jem_portal_no."','".$d_sub_state."','".$d_sub_city."','".$d_sub_village."','".$d_sub_schema."','".$lastid."','".$_SESSION['company_id']."')");
              }
              
          }
          $_SESSION["msg"] = "<div class='alert alert-success'>Department ".ucfirst($_POST['d_main'])." Inserted Successfully.</div>";
          header("location:department.php");
          exit();

      }else if($action == 'edit'){
          $errors = "";

          if(!(isset($_POST["d_main"]) && trim($_POST["d_main"] != ""))){
              $errors .= "Department Name Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from department where d_main='".$_POST["d_main"]."' and d_company_id='".$_POST['d_company_id']."' and d_id!='".$_POST["id"]."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "Department Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          $update_qry = "UPDATE `department` SET `d_main`='".$_POST["d_main"]."',`d_jem_portal_no`='".$_POST["d_jem_portal_no"]."',`d_state`='".$_POST["d_state"]."',`d_city`='".$_POST["d_city"]."',`d_village`='".$_POST["d_village"]."',`d_schema`='".$_POST["d_schema"]."',`d_sitename`='".$_POST['d_sitename']."' WHERE `d_id`='".$_POST["id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
          $lastid = $_POST['id'];
          
          for($j=0;$j<count($_POST['d_sub_main']);$j++){
              $d_sub_ori_main = $_POST['d_sub_ori_main'][$j];
              $d_sub_main = $_POST['d_sub_main'][$j];
              $d_sub_jem_portal_no = $_POST['d_sub_jem_portal_no'][$j];
              $d_sub_state = $_POST['d_sub_state'][$j];
              $d_sub_city = $_POST['d_sub_city'][$j];
              $d_sub_village = $_POST['d_sub_village'][$j];
              $d_sub_schema = $_POST['d_sub_schema'][$j];
              
              $selectsubdep1 = mysqli_query($link,"select * from department where d_main='".$d_sub_ori_main."' and d_parent_id='".$lastid."'");
              $selectsubdep2 = mysqli_query($link,"select * from department where d_main='".$d_sub_main."' and d_parent_id='".$lastid."'");
              if(mysqli_num_rows($selectsubdep1)>0){
                  $rwselectsubdep1 = mysqli_fetch_array($selectsubdep1);
                  mysqli_query($link,"update department set `d_main`='".$d_sub_main."', `d_jem_portal_no`='".$d_sub_jem_portal_no."', `d_state`='".$d_sub_state."', `d_city`='".$d_sub_city."', `d_village`='".$d_sub_village."', `d_schema`='".$d_sub_schema."' where d_id='".$rwselectsubdep1['d_id']."'");
              }else if(mysqli_num_rows($selectsubdep2)>0){
                  $rwselectsubdep2 = mysqli_fetch_array($selectsubdep2);
                  mysqli_query($link,"update department set `d_main`='".$d_sub_main."', `d_jem_portal_no`='".$d_sub_jem_portal_no."', `d_state`='".$d_sub_state."', `d_city`='".$d_sub_city."', `d_village`='".$d_sub_village."', `d_schema`='".$d_sub_schema."' where d_id='".$rwselectsubdep2['d_id']."'");
              }else{
                  mysqli_query($link,"INSERT INTO `department`(`d_main`, `d_jem_portal_no`, `d_state`, `d_city`, `d_village`, `d_schema`,`d_parent_id`,`d_company_id`) VALUES ('".$d_sub_main."','".$d_sub_jem_portal_no."','".$d_sub_state."','".$d_sub_city."','".$d_sub_village."','".$d_sub_schema."','".$lastid."','".$_POST['d_company_id']."')");
              }
              
          }
          $_SESSION["msg"] = "<div class='alert alert-success'>Department ".ucfirst($_POST["d_main"])." Updated Successfully.</div>";
          header("location:department.php");
          exit();

      }else if($action == 'delete'){ 
          $update_qry = "delete from department where d_id='".$_POST["id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Department Deleted Successfully.</div>";
          echo "department.php";
      }else if($action == 'deletesub'){ 
          $update_qry = "delete from department where d_id='".$_POST["id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
      }else{
          $_SESSION["msg"] = "<div class='alert alert-danger'>Action not found.</div>";
          header("location:department.php");
          exit();
      }
?>