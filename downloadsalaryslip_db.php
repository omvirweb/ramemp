<?php include_once 'inc/connection.php';
      include_once 'inc/functions.php';
      $monthyearsel2 = $_POST['month']."-".$_POST['year'];
      $curmnth = $_POST['month'];
      $curyear = $_POST['year'];
      $totDays = get_days_in_month($curmnth, $curyear);
      $dt = $_POST['year']."-".$_POST['month']."-01";
      $filename = $monthyearsel2."-monthlysalaryslip.xls";
      
      $selectgeneralsettings = mysqli_query($link,"select * from login_admin");
      $rwselectpackunit = mysqli_fetch_array($selectgeneralsettings);
      $pf_per = $rwselectpackunit['pf_per'];
      $pt_txt = $rwselectpackunit['pt_txt'];
      $esi_per = $rwselectpackunit['esi_per'];
      
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=\"$filename\"");
      

      $selectcompany = mysqli_query($link,"select * from company where c_id='".$_SESSION['company_id']."'");
      $rwselectcompany = mysqli_fetch_array($selectcompany);

      for($j=0;$j<count($_POST['employee_id']);$j++){
              $employeeid = $_POST['employee_id'][$j];
              $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
              $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
            
              $finaltotal = 0;
              $paidleavefinaltotal = 0;
              $paidleavewpfinaltotal = 0;
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
                $selectattendence2 = mysqli_query($link,"select * from employee_attendance where ea_emp_id='".$employeeid."' and ea_emp_date='".$_POST['year']."-".$_POST['month']."-".$day."'");            
                if(mysqli_num_rows($selectattendence2)>0){
                    $rwselectattendence = mysqli_fetch_array($selectattendence2);
                    if($rwselectattendence['ea_emp_attendance_type'] == "1"){
                        $finaltotal = $finaltotal + 1;
                    }
    
                    if($rwselectattendence['ea_emp_attendance_type'] == "2"){
                        $paidleavefinaltotal = $paidleavefinaltotal + 1;
                    }
    
                    if($rwselectattendence['ea_emp_attendance_type'] == "0"){
                        $paidleavewpfinaltotal = $paidleavewpfinaltotal + 1;
                    }
                } 
              }
    
              $finaltotal = $finaltotal + $paidleavefinaltotal;
              
              if($rwselecemployeedata['e_wedge'] != ""){
                  $ewages = $rwselecemployeedata['e_wedge'];
              }else if($rwselecemployeedata['e_fullwedge'] != ""){
                  $ewages = $rwselecemployeedata['e_fullwedge'] / $totDays;
              }else{
                  $ewages = 0;
              }
              
              $totalwedge = $finaltotal*$ewages;
              
              if($rwselecemployeedata['e_pt'] == "0"){
                  $pt_txt = $pt_txt;
              }else{
                  $pt_txt = 0;
              }
              
              if($rwselecemployeedata['e_pf'] == "0"){
                  $pf_txt2 = round($totalwedge*($pf_per / 100));
              }else{
                  $pf_txt2 = 0;
              }
              
              if($rwselecemployeedata['e_esi'] == "0"){
                  $esi_txt2 = round($totalwedge * $esi_per / 100);
              }else{
                  $esi_txt2 = 0;
              }
              
              if($rwselecemployeedata['e_pt'] == "0" || $rwselecemployeedata['e_pf'] == "0" || $rwselecemployeedata['e_esi'] == "0"){
                  $grossdeduction = ($pt_txt + $pf_txt2 + $esi_txt2);
                  $netsalary = ($totalwedge - ($pt_txt + $pf_txt2 + $esi_txt2));
              }else{
                  $grossdeduction = 0;
                  $netsalary = $totalwedge;
              }
              
              $fullname = strtoupper($rwselecemployeedata['e_lastname']." ".$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']);
              
              if (filter_var($netsalary, FILTER_VALIDATE_FLOAT) && $netsalary > 0) {
                  $netsalary = $netsalary;
              }else{
                  $netsalary = 0;
              }
              
              $selectdata = mysqli_query($link,"select * from download_salary where ds_m_id='".$employeeid."' and ds_added_date = '".$dt."'");
              if(mysqli_num_rows($selectdata)>0){
                  mysqli_query($link,"update `download_salary` set `ds_salary`='".number_format((float)$netsalary, 2, '.', '')."',`ds_acc_no`='".$rwselecemployeedata['e_acc_no']."',`ds_acc_ifsc_no`='".$rwselecemployeedata['e_ifsc_code']."' where ds_m_id='".$employeeid."' and ds_added_date='".$dt."'");
              }else{
                  mysqli_query($link,"INSERT INTO `download_salary`(`ds_m_id`, `ds_salary`, `ds_acc_no`, `ds_acc_ifsc_no`, `ds_added_date`) VALUES ('".$employeeid."','".number_format((float)$netsalary, 2, '.', '')."','".$rwselecemployeedata['e_acc_no']."','".$rwselecemployeedata['e_ifsc_code']."','".$dt."')");
              }
              $id1 = $rwselectcompany['c_bank_acc_no'];
              $id2 = $rwselecemployeedata['e_acc_no'];
              $id3 = $rwselecemployeedata['e_ifsc_code'];
             echo "NFT\t=\"$id1\"\t".number_format((float)$netsalary, 2, '.', '')."\tINR\t=\"$id2\"\t=\"$id3\"\t".$fullname."\r\n"; 
      }
?>