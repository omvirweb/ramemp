<?php include_once 'inc/connection.php';
      include_once 'inc/functions.php';
      $target_dir = "UploadImages/salarystatus/";

      for($j=0;$j<count($_POST['employee_id']);$j++){
          $employeeid = $_POST['employee_id'][$j];
          $monthyearsel = $_POST['year']."-".$_POST['month']."-01";
          
          if ($_FILES["ea_emp_attendance_type".$employeeid]["size"] > 0) {
            $img1 = basename($_FILES["ea_emp_attendance_type".$employeeid]["name"]);
            $target_file = $target_dir . $img1;
            move_uploaded_file($_FILES["ea_emp_attendance_type".$employeeid]["tmp_name"], $target_file);            
          }else{
            $img1 = $_POST['hidden_logo'.$employeeid];
          }
          
          mysqli_query($link,"update download_salary set ds_proof='".$img1."' where ds_m_id='".$employeeid."' and ds_added_date='".$monthyearsel."'");
      }
    
      $_SESSION["msg"] = "<div class='alert alert-success'>Proof Of ".$_POST['month']."-".$_POST['year']." Updated Successfully.</div>";
      header("location:monthlysalarystatus.php?e_depart_id=".$_POST['depart_id']."&e_sub_depart_id=".$_POST['sub_depart_id']."&e_month_id=".$_POST['month']."&e_year_id=".$_POST['year']);
      exit();
?>