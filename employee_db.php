<?php include_once 'inc/connection.php';
      include_once 'inc/functions.php';
      $action = $_POST['action'];
      $target_dir = "UploadImages/employee/";
      if($action == 'add'){
          $errors = "";
          if(!(isset($_POST["e_firstname"]) && trim($_POST["e_firstname"] != ""))){
              $errors .= "First name Is Required.<br/>";
          }
          
          if(!(isset($_POST["e_fathername"]) && trim($_POST["e_fathername"] != ""))){
              $errors .= "Father name Is Required.<br/>";
          }
          
          if(!(isset($_POST["e_lastname"]) && trim($_POST["e_lastname"] != ""))){
              $errors .= "Last name Is Required.<br/>";
          }

          if(!(isset($_POST["e_mobile_no"]) && trim($_POST["e_mobile_no"] != ""))){
              $errors .= "Mobile No Is Required.<br/>";
          }

          if(!(isset($_POST["e_depart_id"]) && trim($_POST["e_depart_id"] != ""))){
              $errors .= "Department Is Required.<br/>";
          }

          if(!(isset($_POST["e_gender"]) && trim($_POST["e_gender"] != ""))){
              $errors .= "Gender Is Required.<br/>";
          }

          if(!(isset($_POST["e_marriage"]) && trim($_POST["e_marriage"] != ""))){
              $errors .= "Marital Detail Is Required.<br/>";
          }
          
          if(!(isset($_POST["e_register_date"]) && trim($_POST["e_register_date"] != ""))){
              $errors .= "Register Date Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from employee where e_fullname='".$_POST["e_fullname"]."' and e_company_id='".$_SESSION['company_id']."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "Full Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          if ($_FILES["e_photo"]["size"] > 0) {
            $img1 = basename($_FILES["e_photo"]["name"]);
            $target_file = $target_dir . $img1;
            move_uploaded_file($_FILES["e_photo"]["tmp_name"], $target_file);            
          }else{
            $img1 = $_POST['hidden_logo'];
          }

          $acc_nodata = $_POST['e_acc_no1']."".$_POST['e_acc_no2']."".$_POST['e_acc_no3']."".$_POST['e_acc_no4']."".$_POST['e_acc_no5']."".$_POST['e_acc_no6']."".$_POST['e_acc_no7']."".$_POST['e_acc_no8']."".$_POST['e_acc_no9']."".$_POST['e_acc_no10']."".$_POST['e_acc_no11']."".$_POST['e_acc_no12']."".$_POST['e_acc_no13']."".$_POST['e_acc_no14']."".$_POST['e_acc_no15']."".$_POST['e_acc_no16']."".$_POST['e_acc_no17']."".$_POST['e_acc_no18'];
          
          $ifsc_nodata = $_POST['e_ifsc_code1']."".$_POST['e_ifsc_code2']."".$_POST['e_ifsc_code3']."".$_POST['e_ifsc_code4']."".$_POST['e_ifsc_code5']."".$_POST['e_ifsc_code6']."".$_POST['e_ifsc_code7']."".$_POST['e_ifsc_code8']."".$_POST['e_ifsc_code9']."".$_POST['e_ifsc_code10']."".$_POST['e_ifsc_code11'];
          

          $update_qry = "INSERT INTO `employee`(`e_company_id`, `e_photo`, `e_wedge`, `e_fullwedge`, `e_code_employee`, `e_depart_id`, `e_sub_depart_id`, `e_current_office_name_address`, `e_current_designation`, `e_firstname`, `e_lastname`, `e_mothername`, `e_fathername`, `e_emergency_mo_no`, `e_gender`, `e_marriage`, `e_birthdate`, `e_mobile_no`, `e_email`, `e_atthar_no`, `e_pan_no`, `e_esic_no`, `e_uan_no`, `e_bank_name`, `e_branch_name`, `e_acc_no`, `e_ifsc_code`, `e_postal_address`, `e_pincode`, `e_education1`, `e_year1`, `e_grade1`, `e_education2`, `e_year2`, `e_grade2`, `e_education3`, `e_year3`, `e_grade3`, `e_education4`, `e_year4`, `e_grade4`, `e_exp_com1`, `e_exp_des1`, `e_exp_sal1`, `e_exp_time1`, `e_exp_com2`, `e_exp_des2`, `e_exp_sal2`, `e_exp_time2`, `e_exp_com3`, `e_exp_des3`, `e_exp_sal3`, `e_exp_time3`, `e_exp_com4`, `e_exp_des4`, `e_exp_sal4`, `e_exp_time4`, `e_other_details`,`e_register_date`, `e_da`, `e_actual_hra`, `e_medical_allow`, `e_convey_allow`, `e_edu_allow`, `e_other_allow`, `e_earning_hra`, `e_earning_medical`, `e_earning_conveyance`, `e_earning_sta_bonus`, `e_earning_leave_enc`, `e_earning_gratuity`, `e_earning_spe_a`, `e_earning_pro_inc_attn_bonus`, `e_earning_ot_amount`, `e_pt`, `e_pf`, `e_esi`, `e_lwf`, `e_tds`, `e_advance`, `e_loan_ins`, `e_canteen`, `e_oth_ded`, `e_facility_time_safety_exp`,`e_emp_contribution`,`e_epf`,`e_fpf`,`e_abry_pf`,`e_timeloss`,`e_admin_wedge`,`e_bonus_wedge`,`e_travel_wedge`,`e_other_wedge`,`e_insurance`,`e_incometax`,`e_epfo`,`e_admin_epfo`,`e_admin_esic`,`e_service_charge`) VALUES ('".$_SESSION['company_id']."','".$img1."','".$_POST['e_wedge']."','".$_POST['e_fullwedge']."','".$_POST['e_code_employee']."','".$_POST['e_depart_id']."','".$_POST['e_sub_depart_id']."','".$_POST['e_current_office_name_address']."','".$_POST['e_current_designation']."','".$_POST['e_firstname']."','".$_POST['e_lastname']."','".$_POST['e_mothername']."','".$_POST['e_fathername']."','".$_POST['e_emergency_mo_no']."','".$_POST['e_gender']."','".$_POST['e_marriage']."','".$_POST['e_birthdate']."','".$_POST['e_mobile_no']."','".$_POST['e_email']."','".$_POST['e_atthar_no']."','".$_POST['e_pan_no']."','".$_POST['e_esic_no']."','".$_POST['e_uan_no']."','".$_POST['e_bank_name']."','".$_POST['e_branch_name']."','".$acc_nodata."','".$ifsc_nodata."','".$_POST['e_postal_address']."','".$_POST['e_pincode']."','".$_POST['e_education1']."','".$_POST['e_year1']."','".$_POST['e_grade1']."','".$_POST['e_education2']."','".$_POST['e_year2']."','".$_POST['e_grade2']."','".$_POST['e_education3']."','".$_POST['e_year3']."','".$_POST['e_grade3']."','".$_POST['e_education4']."','".$_POST['e_year4']."','".$_POST['e_grade4']."','".$_POST['e_exp_com1']."','".$_POST['e_exp_des1']."','".$_POST['e_exp_sal1']."','".$_POST['e_exp_time1']."','".$_POST['e_exp_com2']."','".$_POST['e_exp_des2']."','".$_POST['e_exp_sal2']."','".$_POST['e_exp_time2']."','".$_POST['e_exp_com3']."','".$_POST['e_exp_des3']."','".$_POST['e_exp_sal3']."','".$_POST['e_exp_time3']."','".$_POST['e_exp_com4']."','".$_POST['e_exp_des4']."','".$_POST['e_exp_sal4']."','".$_POST['e_exp_time4']."','".$_POST['e_other_details']."','".$_POST['e_register_date']."','".$_POST['e_da']."','".$_POST['e_actual_hra']."','".$_POST['e_medical_allow']."','".$_POST['e_convey_allow']."','".$_POST['e_edu_allow']."','".$_POST['e_other_allow']."','".$_POST['e_earning_hra']."','".$_POST['e_earning_medical']."','".$_POST['e_earning_conveyance']."','".$_POST['e_earning_sta_bonus']."','".$_POST['e_earning_leave_enc']."','".$_POST['e_earning_gratuity']."','".$_POST['e_earning_spe_a']."','".$_POST['e_earning_pro_inc_attn_bonus']."','".$_POST['e_earning_ot_amount']."','".$_POST['e_pt']."','".$_POST['e_pf']."','".$_POST['e_esi']."','".$_POST['e_lwf']."','".$_POST['e_tds']."','".$_POST['e_advance']."','".$_POST['e_loan_ins']."','".$_POST['e_canteen']."','".$_POST['e_oth_ded']."','".$_POST['e_facility_time_safety_exp']."','".$_POST['e_emp_contribution']."','".$_POST['e_epf']."','".$_POST['e_fpf']."','".$_POST['e_abry_pf']."','".$_POST['e_timeloss']."','".$_POST['e_admin_wedge']."','".$_POST['e_bonus_wedge']."','".$_POST['e_travel_wedge']."','".$_POST['e_other_wedge']."','".$_POST['e_insurance']."','".$_POST['e_incometax']."','".$_POST['e_epfo']."','".$_POST['e_admin_epfo']."','".$_POST['e_admin_esic']."','".$_POST['e_service_charge']."')";  
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Employee ".ucfirst($_POST['e_fullname'])." Inserted Successfully.</div>";
          header("location:employee.php");
          exit();

      }else if($action == 'edit'){
          $errors = "";

          if(!(isset($_POST["e_firstname"]) && trim($_POST["e_firstname"] != ""))){
              $errors .= "First name Is Required.<br/>";
          }
          
          if(!(isset($_POST["e_fathername"]) && trim($_POST["e_fathername"] != ""))){
              $errors .= "Father name Is Required.<br/>";
          }
          
          if(!(isset($_POST["e_lastname"]) && trim($_POST["e_lastname"] != ""))){
              $errors .= "Last name Is Required.<br/>";
          }

          if(!(isset($_POST["e_mobile_no"]) && trim($_POST["e_mobile_no"] != ""))){
              $errors .= "Mobile No Is Required.<br/>";
          }

          if(!(isset($_POST["e_depart_id"]) && trim($_POST["e_depart_id"] != ""))){
              $errors .= "Department Is Required.<br/>";
          }

          
          if(!(isset($_POST["e_gender"]) && trim($_POST["e_gender"] != ""))){
              $errors .= "Gender Is Required.<br/>";
          }

          if(!(isset($_POST["e_marriage"]) && trim($_POST["e_marriage"] != ""))){
              $errors .= "Marital Detail Is Required.<br/>";
          }

          $selectunitname = mysqli_query($link,"select * from employee where e_fullname='".$_POST["e_fullname"]."' and e_id!='".$_POST["id"]."' and e_company_id='".$_SESSION['company_id']."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "Full Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          if ($_FILES["e_photo"]["size"] > 0) {
            $img1 = basename($_FILES["e_photo"]["name"]);
            $target_file = $target_dir . $img1;
            move_uploaded_file($_FILES["e_photo"]["tmp_name"], $target_file);            
          }else{
            $img1 = $_POST['hidden_logo'];
          }
          
          $acc_nodata = $_POST['e_acc_no1']."".$_POST['e_acc_no2']."".$_POST['e_acc_no3']."".$_POST['e_acc_no4']."".$_POST['e_acc_no5']."".$_POST['e_acc_no6']."".$_POST['e_acc_no7']."".$_POST['e_acc_no8']."".$_POST['e_acc_no9']."".$_POST['e_acc_no10']."".$_POST['e_acc_no11']."".$_POST['e_acc_no12']."".$_POST['e_acc_no13']."".$_POST['e_acc_no14']."".$_POST['e_acc_no15']."".$_POST['e_acc_no16']."".$_POST['e_acc_no17']."".$_POST['e_acc_no18'];
          
          $ifsc_nodata = $_POST['e_ifsc_code1']."".$_POST['e_ifsc_code2']."".$_POST['e_ifsc_code3']."".$_POST['e_ifsc_code4']."".$_POST['e_ifsc_code5']."".$_POST['e_ifsc_code6']."".$_POST['e_ifsc_code7']."".$_POST['e_ifsc_code8']."".$_POST['e_ifsc_code9']."".$_POST['e_ifsc_code10']."".$_POST['e_ifsc_code11'];

          $e_pt = 0;
          if(isset($_POST['e_pt'])){
              $e_pt = 1;
          }
          
          $e_pf = 0;
          if(isset($_POST['e_pf'])){
              $e_pf = 1;
          }
          
          $e_esi = 0;
          if(isset($_POST['e_esi'])){
              $e_esi = 1;
          }
          
          $update_qry = "UPDATE `employee` SET `e_photo`='".$img1."',`e_wedge`='".$_POST['e_wedge']."',`e_fullwedge`='".$_POST['e_fullwedge']."',`e_code_employee`='".$_POST['e_code_employee']."',`e_depart_id`='".$_POST['e_depart_id']."',`e_sub_depart_id`='".$_POST['e_sub_depart_id']."',`e_current_office_name_address`='".$_POST['e_current_office_name_address']."',`e_current_designation`='".$_POST['e_current_designation']."',`e_firstname`='".$_POST['e_firstname']."',`e_lastname`='".$_POST['e_lastname']."',`e_mothername`='".$_POST['e_mothername']."',`e_fathername`='".$_POST['e_fathername']."',`e_emergency_mo_no`='".$_POST['e_emergency_mo_no']."',`e_gender`='".$_POST['e_gender']."',`e_marriage`='".$_POST['e_marriage']."',`e_birthdate`='".$_POST['e_birthdate']."',`e_mobile_no`='".$_POST['e_mobile_no']."',`e_email`='".$_POST['e_email']."',`e_atthar_no`='".$_POST['e_atthar_no']."',`e_pan_no`='".$_POST['e_pan_no']."',`e_esic_no`='".$_POST['e_esic_no']."',`e_uan_no`='".$_POST['e_uan_no']."',`e_bank_name`='".$_POST['e_bank_name']."',`e_branch_name`='".$_POST['e_branch_name']."',`e_acc_no`='".$acc_nodata."',`e_ifsc_code`='".$ifsc_nodata."',`e_postal_address`='".$_POST['e_postal_address']."',`e_pincode`='".$_POST['e_pincode']."',`e_education1`='".$_POST['e_education1']."',`e_year1`='".$_POST['e_year1']."',`e_grade1`='".$_POST['e_grade1']."',`e_education2`='".$_POST['e_education2']."',`e_year2`='".$_POST['e_year2']."',`e_grade2`='".$_POST['e_grade2']."',`e_education3`='".$_POST['e_education3']."',`e_year3`='".$_POST['e_year3']."',`e_grade3`='".$_POST['e_grade3']."',`e_education4`='".$_POST['e_education4']."',`e_year4`='".$_POST['e_year4']."',`e_grade4`='".$_POST['e_grade4']."',`e_exp_com1`='".$_POST['e_exp_com1']."',`e_exp_des1`='".$_POST['e_exp_des1']."',`e_exp_sal1`='".$_POST['e_exp_sal1']."',`e_exp_time1`='".$_POST['e_exp_time1']."',`e_exp_com2`='".$_POST['e_exp_com2']."',`e_exp_des2`='".$_POST['e_exp_des2']."',`e_exp_sal2`='".$_POST['e_exp_sal2']."',`e_exp_time2`='".$_POST['e_exp_time2']."',`e_exp_com3`='".$_POST['e_exp_com3']."',`e_exp_des3`='".$_POST['e_exp_des3']."',`e_exp_sal3`='".$_POST['e_exp_sal3']."',`e_exp_time3`='".$_POST['e_exp_time3']."',`e_exp_com4`='".$_POST['e_exp_com4']."',`e_exp_des4`='".$_POST['e_exp_des4']."',`e_exp_sal4`='".$_POST['e_exp_sal4']."',`e_exp_time4`='".$_POST['e_exp_time4']."',`e_other_details`='".$_POST['e_other_details']."',`e_register_date`='".$_POST['e_register_date']."',`e_da`='".$_POST['e_da']."',`e_actual_hra`='".$_POST['e_actual_hra']."',`e_medical_allow`='".$_POST['e_medical_allow']."',`e_convey_allow`='".$_POST['e_convey_allow']."',`e_edu_allow`='".$_POST['e_edu_allow']."',`e_other_allow`='".$_POST['e_other_allow']."',`e_earning_hra`='".$_POST['e_earning_hra']."',`e_earning_medical`='".$_POST['e_earning_medical']."',`e_earning_conveyance`='".$_POST['e_earning_conveyance']."',`e_earning_sta_bonus`='".$_POST['e_earning_sta_bonus']."',`e_earning_leave_enc`='".$_POST['e_earning_leave_enc']."',`e_earning_gratuity`='".$_POST['e_earning_gratuity']."',`e_earning_spe_a`='".$_POST['e_earning_spe_a']."',`e_earning_pro_inc_attn_bonus`='".$_POST['e_earning_pro_inc_attn_bonus']."',`e_earning_ot_amount`='".$_POST['e_earning_ot_amount']."',`e_pt`='".$_POST['e_pt']."',`e_pf`='".$_POST['e_pf']."',`e_esi`='".$_POST['e_esi']."',`e_lwf`='".$_POST['e_lwf']."',`e_tds`='".$_POST['e_tds']."',`e_advance`='".$_POST['e_advance']."',`e_loan_ins`='".$_POST['e_loan_ins']."',`e_canteen`='".$_POST['e_canteen']."',`e_oth_ded`='".$_POST['e_oth_ded']."',`e_facility_time_safety_exp`='".$_POST['e_facility_time_safety_exp']."',`e_emp_contribution`='".$_POST['e_emp_contribution']."',`e_epf`='".$_POST['e_epf']."',`e_fpf`='".$_POST['e_fpf']."',`e_abry_pf`='".$_POST['e_abry_pf']."',`e_timeloss`='".$_POST['e_timeloss']."',`e_admin_wedge`='".$_POST['e_admin_wedge']."',`e_bonus_wedge`='".$_POST['e_bonus_wedge']."',`e_travel_wedge`='".$_POST['e_travel_wedge']."',`e_other_wedge`='".$_POST['e_other_wedge']."',`e_insurance`='".$_POST['e_insurance']."',`e_incometax`='".$_POST['e_incometax']."',`e_epfo`='".$_POST['e_epfo']."',`e_admin_epfo`='".$_POST['e_admin_epfo']."',`e_admin_esic`='".$_POST['e_admin_esic']."',`e_service_charge`='".$_POST['e_service_charge']."'  WHERE `e_id`='".$_POST["id"]."'";

          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Employee ".ucfirst($_POST["uname"])." Updated Successfully.</div>";
          header("location:employee.php");
          exit();

      }else if($action == 'delete'){ 
          $update_qry = "delete from employee where e_id='".$_POST["id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Employee Deleted Successfully.</div>";
          echo "employee.php";
      }else if($action == 'letterofallotment'){ 
          require_once 'MPDF/vendor/autoload.php';
          
          $filename = "letterofallotment.pdf";
          $html2 = "";
          
          for($j=0;$j<count($_POST['employee_id']);$j++){
          $employeeid = $_POST['employee_id'][$j];
          $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
          $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
                $html2 .= '
                        <img src="'.SITE_ROOT_FRONT.'/img/topbar.png" />
                        <table style="width:100%" border="0">
                            <tr>
                                <td style="width:80%">&nbsp;</td>
                                <td style="text-align:right;padding-right:100px"><img src="'.SITE_ROOT_FRONT.'/UploadImages/company/'.$_SESSION['company_logo'].'" style="width:450px" /></td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:50px" border="0">
                            <tr>
                                <td>
                                    <div style="font-style:italic;color:#12364e;">To,</div>
                                    <div style="color:#624878;text-transform:uppercase;font-size:20px">'.strtoupper($rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname']).'</div>
                                    <div style="color:#12364e;font-size:12px">'.strtoupper($rwselecemployeedata['e_current_designation']).'</div>
                                    <div style="height:100px">&nbsp;</div>
                                    <div style="font-size:12px"><span style="color:#624878">P:</span><span style="color:#12364e;">'.$rwselecemployeedata['e_mobile_no'].'</span></div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px" border="0">
                            <tr>
                                <td style="text-align:right">
                                    <span style="font-weight:bold;font-size:12px;color:#624878;">DATE:</span> <span style="font-weight:bold;font-size:12px;color:#12364e;">'.date("d M, Y",strtotime($rwselecemployeedata['e_register_date'])).'</span>
                                </td>
                            </tr>
                        </table>
                        <div style="height:630px">&nbsp;</div>
                        <img src="'.SITE_ROOT_FRONT.'/img/bottombar.png" />';
          }
          
          $html = '<html>
                    <head><title>Letter Of Allotment</title></head>
                    <body style="margin:0">'.$html2.' </body></html>';
                    
                    
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'P']);
          $mpdf->AddPageByArray([
        'margin-left' => 0,
        'margin-right' => 0,
        'margin-top' => 10,
        'margin-bottom' => 0,]);
          $mpdf->setAutoTopMargin = 'stretch';
          $mpdf->setAutoBottomMargin = 'stretch';
          $mpdf->WriteHTML($html);
          $mpdf->Output($filename, 'D');
          exit;
      }else if($action == 'releavingletter'){ 
          require_once 'MPDF/vendor/autoload.php';
          
          $filename = "releavingletter.pdf";
          $html2 = "";
          
          for($j=0;$j<count($_POST['employee_id']);$j++){
          $employeeid = $_POST['employee_id'][$j];
          $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
          $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
                $html2 .= '
                        <img src="'.SITE_ROOT_FRONT.'/img/topbar.png" />
                        <table style="width:100%" border="0">
                            <tr>
                                <td style="width:80%">&nbsp;</td>
                                <td style="text-align:right;padding-right:100px"><img src="'.SITE_ROOT_FRONT.'/UploadImages/company/'.$_SESSION['company_logo'].'" style="width:450px" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right;padding-right:130px;padding-top:50px;">'.date("d M, Y").'</td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;" border="0">
                            <tr>
                                <td>
                                    <div>'.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].'</div>
                                    <div>'.$rwselecemployeedata['e_current_office_name_address'].'</div>
                                    <div>'.$rwselecemployeedata['e_mobile_no'].'</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:40px" border="0">
                            <tr>
                                <td>
                                    <div>Dear '.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].'</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>Subject: Relieving Letter</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>This is to confirm that your employment with '.strtoupper(get_department($rwselecemployeedata['e_sub_depart_id'])).' '.$rwselecemployeedata['e_current_office_name_address'].' has ended as of  '.date("d M, Y").' . We hereby accept your resignation and relieve you from your duties with immediate effect.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>We appreciate the contributions you have made during your tenure with us and wish you the best in your future endeavors '.date("d M, Y").'. This includes keys, badges, equipment, and any other items belonging to the company.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>Your final paycheck, including any accrued but unused vacation time, will be processed in accordance with company policy</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>Should you have any questions or require further information, please do not hesitate to contact Mansi Raichura in the Human Resources department at 90163 50291. We wish you the best in your future endeavors.</div>
                                </td>
                            </tr>
                        </table>
                        <div style="height:180px">&nbsp;</div>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>Sincerely,</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>'.strtoupper($_SESSION['company_name']).'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.strtoupper($_SESSION['company_add']).'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.$_SESSION['company_phone'].'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.$_SESSION['company_email'].'</div>
                                </td>
                            </tr>
                        </table>';
          }
          
          $html = '<html>
                    <head><title>Releaving Letter</title></head>
                    <body style="margin:0">'.$html2.' </body></html>';
                    
                    
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'P']);
          $mpdf->AddPageByArray([
        'margin-left' => 0,
        'margin-right' => 0,
        'margin-top' => 10,
        'margin-bottom' => 10,]);
          $mpdf->setAutoTopMargin = 'stretch';
          $mpdf->setAutoBottomMargin = 'stretch';
          $mpdf->WriteHTML($html);
          $mpdf->Output($filename, 'D');
          exit;
      }else if($action == 'experienceletter'){ 
          require_once 'MPDF/vendor/autoload.php';
          
          $filename = "experienceletter.pdf";
          $html2 = "";
          
          for($j=0;$j<count($_POST['employee_id']);$j++){
          $employeeid = $_POST['employee_id'][$j];
          $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
          $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
                $html2 .= '
                        <img src="'.SITE_ROOT_FRONT.'/img/topbar.png" />
                        <table style="width:100%" border="0">
                            <tr>
                                <td style="width:80%">&nbsp;</td>
                                <td style="text-align:right;padding-right:100px"><img src="'.SITE_ROOT_FRONT.'/UploadImages/company/'.$_SESSION['company_logo'].'" style="width:450px" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right;padding-right:130px;padding-top:50px;">'.date("d M, Y").'</td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:150px" border="0">
                            <tr>
                                <td>
                                    <div>This letter is to certify that '.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].' was employed with '.strtoupper($_SESSION['company_name']).' from '.date("d M, Y",strtotime($rwselecemployeedata['e_register_date'])).'. During their tenure with us, '.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].' served in the capacity of '.strtoupper($rwselecemployeedata['e_current_designation']).'.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>Throughout their employment, '.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].' demonstrated professionalism, dedication, and proficiency in their duties. They contributed positively to the team, consistently achieving their goals and objectives.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>'.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].' possesses excellent '.strtoupper($rwselecemployeedata['e_current_designation']).', which greatly benefited our organization. They were reliable, punctual, and exhibited strong problem-solving abilities</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>We are confident that '.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].' will continue to excel in their future endeavors. It was a pleasure to have them as part of our team, and we wish them all the best in their future career pursuits.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>Should you require any further information, please feel free to contact us.</div>
                                </td>
                            </tr>
                        </table>
                        <div style="height:180px">&nbsp;</div>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>Sincerely,</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>'.strtoupper($_SESSION['company_name']).'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.strtoupper($_SESSION['company_add']).'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.$_SESSION['company_phone'].'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.$_SESSION['company_email'].'</div>
                                </td>
                            </tr>
                        </table>';
          }
          
          $html = '<html>
                    <head><title>Experience Letter</title></head>
                    <body style="margin:0">'.$html2.' </body></html>';
                    
                    
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'P']);
          $mpdf->AddPageByArray([
        'margin-left' => 0,
        'margin-right' => 0,
        'margin-top' => 10,
        'margin-bottom' => 0,]);
          $mpdf->setAutoTopMargin = 'stretch';
          $mpdf->setAutoBottomMargin = 'stretch';
          $mpdf->WriteHTML($html);
          $mpdf->Output($filename, 'D');
          exit;
      }else if($action == 'terminationletter'){ 
          require_once 'MPDF/vendor/autoload.php';
          
          $filename = "terminationletter.pdf";
          $html2 = "";
          
          for($j=0;$j<count($_POST['employee_id']);$j++){
          $employeeid = $_POST['employee_id'][$j];
          $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
          $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
                $html2 .= '
                        <img src="'.SITE_ROOT_FRONT.'/img/topbar.png" />
                        <table style="width:100%" border="0">
                            <tr>
                                <td style="width:80%">&nbsp;</td>
                                <td style="text-align:right;padding-right:100px"><img src="'.SITE_ROOT_FRONT.'/UploadImages/company/'.$_SESSION['company_logo'].'" style="width:450px" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right;padding-right:130px;padding-top:50px;">'.date("d M, Y").'</td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:40px" border="0">
                            <tr>
                                <td>
                                    <div>'.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].'</div>
                                    <div>'.$rwselecemployeedata['e_current_office_name_address'].'</div>
                                    <div>'.$rwselecemployeedata['e_mobile_no'].'</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:40px" border="0">
                            <tr>
                                <td>
                                    <div>Dear '.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].',</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>Subject: Termination of Employment</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px" border="0">
                            <tr>
                                <td>
                                    <div>This letter serves as formal notice of the termination of your employment with '.strtoupper(get_department($rwselecemployeedata['e_sub_depart_id'])).' '.$rwselecemployeedata['e_current_office_name_address'].', effective  '.date("d M, Y").'.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>After careful consideration and review, it has been determined that the termination of your employment is necessary due to such as poor performance, violation of company policies, etc.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>Your final paycheck will be issued to you in accordance with government policy. Please note that you are required to return all company property in your possession.</div>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <div>Should you have any questions or require further information, please do not hesitate to contact *Mansi Raichura* in the Human Resources department at *90163 50291*.We wish you the best in your future endeavors.</div>
                                </td>
                            </tr>
                        </table>
                        <div style="height:190px">&nbsp;</div>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px;text-align:right" border="0">
                            <tr>
                                <td>
                                    <div>Sincerely,</div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;padding-left:60px;padding-right:60px;padding-top:30px;text-align:right" border="0">
                            <tr>
                                <td>
                                    <div>'.strtoupper($_SESSION['company_name']).'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.strtoupper($_SESSION['company_add']).'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.$_SESSION['company_phone'].'</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>'.$_SESSION['company_email'].'</div>
                                </td>
                            </tr>
                        </table>';
          }
          
          $html = '<html>
                    <head><title>Termination Letter</title></head>
                    <body style="margin:0">'.$html2.' </body></html>';
                    
                    
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'P']);
          $mpdf->AddPageByArray([
        'margin-left' => 0,
        'margin-right' => 0,
        'margin-top' => 10,
        'margin-bottom' => 0,]);
          $mpdf->setAutoTopMargin = 'stretch';
          $mpdf->setAutoBottomMargin = 'stretch';
          $mpdf->WriteHTML($html);
          $mpdf->Output($filename, 'D');
          exit;
      }else if($action == 'get_sub_department'){ 
          $update_qry = "select * from department where d_parent_id='".$_POST["e_depart_id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
          $dataoption = '<option value="">Sub Department</option>';
          while($rwrun_upd = mysqli_fetch_array($run_upd)){
                $selectedoption = "";
          		if(!empty($_POST['selecteddepart']) && $_POST['selecteddepart'] == $rwrun_upd['d_id']){
          			$selectedoption = 'selected="selected"';
          		}
          		$dataoption .= '<option value="'.$rwrun_upd['d_id'].'" '.$selectedoption.'>'.$rwrun_upd['d_main'].' '.$rwrun_upd['d_state'].' '.$rwrun_upd['d_city']." ".$rwrun_upd['d_village'].' '.$rwrun_upd['d_schema'].'</option>';
          }
          echo $dataoption;
      }else{
          $_SESSION["msg"] = "<div class='alert alert-danger'>Action not found.</div>";
          header("location:employee.php");
          exit();
      }
?>