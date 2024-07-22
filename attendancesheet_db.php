<?php include_once 'inc/connection.php';

      for($j=0;$j<count($_POST['employee_id']);$j++){
          $employeeid = $_POST['employee_id'][$j];
          for($i=1;$i<=31;$i++){
              if($i==1){
                $day = "01";
              }else if($i==2){
                $day = "02";
              }else if($i==3){
                $day = "03";
              }else if($i==4){
                $day = "04";
              }else if($i==5){
                $day = "05";
              }else if($i==6){
                $day = "06";
              }else if($i==7){
                $day = "07";
              }else if($i==8){
                $day = "08";
              }else if($i==9){
                $day = "09";
              }else{
                $day = $i;
              }
              $monthyearsel = $_POST['year']."-".$_POST['month']."-".$day;
              $selectemployee = mysqli_query($link,"select * from employee_attendance where ea_emp_id='".$employeeid."' and ea_emp_date = '".$monthyearsel."'");
              
              if(mysqli_num_rows($selectemployee)>0){
                  $selectemployee = mysqli_fetch_array($selectemployee);
                  if($monthyearsel != "" && $monthyearsel != "0000-00-00"){
                    mysqli_query($link,"update employee_attendance set ea_emp_attendance_type='".$_POST['ea_emp_attendance_type'.$employeeid.'_'.$i]."',ea_emp_status='0' where ea_emp_id='".$employeeid."' and ea_emp_date='".$monthyearsel."'");
                  }
              }else{
                  if($monthyearsel != "" && $monthyearsel != "0000-00-00"){
                        mysqli_query($link,"insert into employee_attendance (ea_emp_id,ea_emp_date,ea_emp_attendance_type) values ('".$employeeid."','".$monthyearsel."','".$_POST['ea_emp_attendance_type'.$employeeid.'_'.$i]."')");
                  }
              }
          }
      }
      $_SESSION["msg"] = "<div class='alert alert-success'>Attendance Of ".$_POST['month']."-".$_POST['year']." Updated Successfully.</div>";
      header("location:attendancesheet.php?e_depart_id=".$_POST['depart_id']."&e_sub_depart_id=".$_POST['sub_depart_id']."&e_month_id=".$_POST['month']."&e_year_id=".$_POST['year']);
      exit();

?>