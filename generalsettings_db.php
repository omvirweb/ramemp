<?php include_once 'inc/connection.php';
      $update_qry = "UPDATE `login_admin` SET `hsminwages`='".$_POST['hsminwages']."',`sminwages`='".$_POST['sminwages']."',`ssminwages`='".$_POST['ssminwages']."',`usminwages`='".$_POST['usminwages']."',`sgst`='".$_POST['sgst']."',`cgst`='".$_POST['cgst']."'";

      $run_upd = mysqli_query($link,$update_qry); 
      $_SESSION["msg"] = "<div class='alert alert-success'>General Settings Updated Successfully.</div>";
      header("location:generalsettings.php");
      exit();
?>