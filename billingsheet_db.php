<?php   include_once 'inc/connection.php';
        include_once 'inc/functions.php';
        $monthyearsel2 = $_POST['month']."-".$_POST['year'];
        $dt = $_POST['year']."-".$_POST['month']."-01";
        $curmnth = $_POST['month'];
        $curyear = $_POST['year'];
        $totDays = get_days_in_month($curmnth, $curyear);
        $filename = $monthyearsel2."-billingsheet.pdf";
        $department = $_POST['depart_id'];
        $subdepartment = $_POST['sub_depart_id'];
        $fullmonthyear = get_month2($_POST['month'])." - ".$_POST['year'];
        require_once 'MPDF/vendor/autoload.php';
      
        $selectdepartmentdetails= mysqli_query($link,"select * from department where d_id='".$subdepartment."'");
        $rwselectdepartmentdetails= mysqli_fetch_array($selectdepartmentdetails);
      
        $selectgeneralsettings = mysqli_query($link,"select * from login_admin");
        $rwselectpackunit = mysqli_fetch_array($selectgeneralsettings);
        $service_charge = $rwselectpackunit['service_charge'];
        $sgst = $rwselectpackunit['sgst'];
        $cgst = $rwselectpackunit['cgst'];

        $selectcomp = mysqli_query($link,"select * from company where c_id='".$_SESSION['company_id']."'");
        $rwselectcomp = mysqli_fetch_array($selectcomp);

        $employeedata = "";
        $emp_no = 1;
        for($j=0;$j<count($_POST['employee_id']);$j++){
                $employeeid = $_POST['employee_id'][$j];
                $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
                $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
                $presentstotal = 0;
                $absenttotal = 0;
                $paidleavetotal = 0;
                $totalcountp = 0;
                $pleavescount = 0;
                $pworkingdays = 0;
                $ppresentcountdata = 0;
                $pbasic = 0;
                $pepfo = 0;
                $pesic = 0;
                $paepfo = 0;
                $paesic = 0;
                $pbonus = 0;
                $pctc = 0;
                $pservicecharge = 0;
                $pcharge = 0;
                $psgst = 0;
                $pcgst = 0;
                $pnetbilling = 0;
                
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
                            $presentstotal = $presentstotal + 1;
                        }
        
                        if($rwselectattendence['ea_emp_attendance_type'] == "2"){
                            $paidleavetotal = $paidleavetotal + 1;
                        }
        
                        if($rwselectattendence['ea_emp_attendance_type'] == "0"){
                            $absenttotal = $absenttotal + 1;
                        }
                    } 
                    
                    $totalcountp = $presentstotal + $paidleavetotal;
                }
                
                
                
                if($rwselecemployeedata['e_wedge'] != ""){
                    $ewages = $rwselecemployeedata['e_wedge'];
                }else if($rwselecemployeedata['e_fullwedge'] != ""){
                    $ewages = $rwselecemployeedata['e_fullwedge'] / $totDays;
                }else{
                    $ewages = 0;
                }
                
                
                  
                if($rwselecemployeedata['e_da'] != ""){
                    $e_da = $rwselecemployeedata['e_da'];
                }else{
                    $e_da = 0;
                }
                  
                if($rwselecemployeedata['e_actual_hra'] != ""){
                    $e_actual_hra = $rwselecemployeedata['e_actual_hra'];
                }else{
                    $e_actual_hra = 0;
                }
                  
                if($rwselecemployeedata['e_medical_allow'] != ""){
                    $e_medical_allow = $rwselecemployeedata['e_medical_allow'];
                }else{
                    $e_medical_allow = 0;
                }
                  
                if($rwselecemployeedata['e_convey_allow'] != ""){
                    $e_convey_allow = $rwselecemployeedata['e_convey_allow'];
                }else{
                    $e_convey_allow = 0;
                }
                  
                if($rwselecemployeedata['e_edu_allow'] != ""){
                    $e_edu_allow = $rwselecemployeedata['e_edu_allow'];
                }else{
                    $e_edu_allow = 0;
                }
                  
                if($rwselecemployeedata['e_other_allow'] != ""){
                    $e_other_allow = $rwselecemployeedata['e_other_allow'];
                }else{
                    $e_other_allow = 0;
                }
                
                if($rwselecemployeedata['e_earning_hra'] != ""){
                    $e_earning_hra = $rwselecemployeedata['e_earning_hra'];
                }else{
                    $e_earning_hra = 0;
                }
                  
                if($rwselecemployeedata['e_earning_medical'] != ""){
                    $e_earning_medical = $rwselecemployeedata['e_earning_medical'];
                }else{
                    $e_earning_medical = 0;
                }
                  
                if($rwselecemployeedata['e_earning_conveyance'] != ""){
                    $e_earning_conveyance = $rwselecemployeedata['e_earning_conveyance'];
                }else{
                    $e_earning_conveyance = 0;
                }
                  
                if($rwselecemployeedata['e_earning_sta_bonus'] != ""){
                    $e_earning_sta_bonus = $rwselecemployeedata['e_earning_sta_bonus'];
                }else{
                    $e_earning_sta_bonus = 0;
                }
                  
                if($rwselecemployeedata['e_earning_leave_enc'] != ""){
                    $e_earning_leave_enc = $rwselecemployeedata['e_earning_leave_enc'];
                }else{
                    $e_earning_leave_enc = 0;
                }
                  
                if($rwselecemployeedata['e_earning_gratuity'] != ""){
                    $e_earning_gratuity = $rwselecemployeedata['e_earning_gratuity'];
                }else{
                    $e_earning_gratuity = 0;
                }
                  
                if($rwselecemployeedata['e_earning_spe_a'] != ""){
                    $e_earning_spe_a = $rwselecemployeedata['e_earning_spe_a'];
                }else{
                    $e_earning_spe_a = 0;
                }
                  
                if($rwselecemployeedata['e_earning_pro_inc_attn_bonus'] != ""){
                    $e_earning_pro_inc_attn_bonus = $rwselecemployeedata['e_earning_pro_inc_attn_bonus'];
                }else{
                    $e_earning_pro_inc_attn_bonus = 0;
                }
                  
                if($rwselecemployeedata['e_earning_ot_amount'] != ""){
                    $e_earning_ot_amount = $rwselecemployeedata['e_earning_ot_amount'];
                }else{
                    $e_earning_ot_amount = 0;
                }
                  
                if($rwselecemployeedata['e_pt'] != ""){
                    $e_pt = $rwselecemployeedata['e_pt'];
                }else{
                    $e_pt = 0;
                }
                  
                if($rwselecemployeedata['e_pf'] != ""){
                    $e_pf = $rwselecemployeedata['e_pf'];
                }else{
                    $e_pf = 0;
                }
                  
                if($rwselecemployeedata['e_esi'] != ""){
                    $e_esi = $rwselecemployeedata['e_esi'];
                }else{
                    $e_esi = 0;
                }
                  
                if($rwselecemployeedata['e_lwf'] != ""){
                    $e_lwf = $rwselecemployeedata['e_lwf'];
                }else{
                    $e_lwf = 0;
                }
                  
                if($rwselecemployeedata['e_tds'] != ""){
                    $e_tds = $rwselecemployeedata['e_tds'];
                }else{
                    $e_tds = 0;
                }
                  
                if($rwselecemployeedata['e_advance'] != ""){
                    $e_advance = $rwselecemployeedata['e_advance'];
                }else{
                    $e_advance = 0;
                }
                  
                if($rwselecemployeedata['e_loan_ins'] != ""){
                    $e_loan_ins = $rwselecemployeedata['e_loan_ins'];
                }else{
                    $e_loan_ins = 0;
                }
                  
                if($rwselecemployeedata['e_canteen'] != ""){
                    $e_canteen = $rwselecemployeedata['e_canteen'];
                }else{
                    $e_canteen = 0;
                }
                  
                if($rwselecemployeedata['e_oth_ded'] != ""){
                    $e_oth_ded = $rwselecemployeedata['e_oth_ded'];
                }else{
                    $e_oth_ded = 0;
                }
                  
                if($rwselecemployeedata['e_facility_time_safety_exp'] != ""){
                    $e_facility_time_safety_exp = $rwselecemployeedata['e_facility_time_safety_exp'];
                }else{
                    $e_facility_time_safety_exp = 0.00;
                }
                
                if($rwselecemployeedata['e_epfo'] != ""){
                    $e_epfo = $rwselecemployeedata['e_epfo'];
                }else{
                    $e_epfo = 0.00;
                }
                
                if($rwselecemployeedata['e_admin_epfo'] != ""){
                    $e_admin_epfo = $rwselecemployeedata['e_admin_epfo'];
                }else{
                    $e_admin_epfo = 0.00;
                }
                
                if($rwselecemployeedata['e_admin_esic'] != ""){
                    $e_admin_esic = $rwselecemployeedata['e_admin_esic'];
                }else{
                    $e_admin_esic = 0.00;
                }
                
                if($rwselecemployeedata['e_bonus_wedge'] != ""){
                    $e_bonus_wedge = $rwselecemployeedata['e_bonus_wedge'];
                }else{
                    $e_bonus_wedge = 0.00;
                }
                
                if($rwselecemployeedata['e_service_charge'] != ""){
                    $e_service_charge = $rwselecemployeedata['e_service_charge'];
                }else{
                    $e_service_charge = 0.00;
                }
                  
                $finaltotal = $finaltotal + $presentstotal + $paidleavetotal;
                $totalwedge = $finaltotal*$ewages;
                if($totalwedge >= 12000){
                    if($e_pt != "0"){
                        $e_pt = $e_pt;
                    }else{
                        $e_pt = '200';
                    }
                }else{
                    $e_pt = $e_pt;
                }
                
                $pwages = $totalcountp * $ewages;
                $pleavescount = $absenttotal;
                $pholiday = 7;
                $pworkingdays = $totDays - $pleavescount - $pholiday;
                $ppresentcountdata = $totDays - $pleavescount;
                $pbasic = $ppresentcountdata * $ewages;
                $pepfo = ($pbasic * $e_epfo) / 100;
                $pesic = ($pbasic * $e_esi) / 100;
                $paepfo = ($pbasic * $e_admin_epfo) / 100;
                $paesic = ($pbasic * $e_admin_esic) / 100;
                $pbonus = ($pbasic * $e_bonus_wedge) / 100;
                $pctc = $pbasic + $pepfo + $pesic + $paepfo + $paesic + $pbonus;
                $pservicecharge = $pctc * $e_service_charge / 100;
                $pcharge = $pctc + $pservicecharge;
                $psgst = ($pcharge * $sgst) / 100;
                $pcgst = ($pcharge * $cgst) / 100;
                $pnetbilling = $pcharge + $psgst + $pcgst;
                $fworkingdays = $fworkingdays + $pworkingdays;
                $ftotalpresentcountdata = $ftotalpresentcountdata + $ppresentcountdata;
                $ftotalbasic = $ftotalbasic + $pbasic;
                $ftotalepfo = $ftotalepfo + $pepfo;
                $ftotalesic = $ftotalesic + $pesic;
                $ftotalaepfo = $ftotalaepfo + $paepfo;
                $ftotalaesic = $ftotalaesic + $paesic;
                $ftotalbonus = $ftotalbonus + $pbonus;
                $ftotalctc = $ftotalctc + $pctc;
                $ftotalservicecharge = $ftotalservicecharge + $pservicecharge;
                $ftotal = $ftotal + $pcharge;
                $ftotalsgst = $ftotalsgst + $psgst;
                $ftotalcgst = $ftotalcgst + $pcgst;
                $ftotalnetbilling = $ftotalnetbilling + $pnetbilling;
                
                $employeedata .= '<tr>
                                    <td style="text-align:center;border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$emp_no.'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.strtoupper($rwselecemployeedata['e_firstname']).' '.strtoupper($rwselecemployeedata['e_fathername']).' '.strtoupper($rwselecemployeedata['e_lastname']).'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$rwselecemployeedata['e_current_office_name_address'].'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$rwselecemployeedata['e_current_designation'].'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pwages, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$totDays.'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$pleavescount.'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$pholiday.'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$pworkingdays.'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.$ppresentcountdata.'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pbasic, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pepfo, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pesic, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$paepfo, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$paesic, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pbonus, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pctc, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pservicecharge, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pcharge, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$psgst, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pcgst, 2, '.', '').'</td>
                                    <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">'.number_format((float)$pnetbilling, 2, '.', '').'</td>
                                  </tr>';
                $emp_no++;
        }
      
        $html = '<html>
                    <head><title>'.$monthyearsel2.' Billing Sheet</title></head>
                    <body style="margin:0">
                        <table>
                            <tr>
                                <td style="font-size:12px;"><b style="font-size:15px">'.strtoupper($_SESSION['company_name']).'</b> <br/> Contract No. :- '.$rwselectdepartmentdetails['d_jem_portal_no'].' <br/> PROGRAMME OFFICER '.$rwselectdepartmentdetails['d_main'].' '.$rwselectdepartmentdetails['d_city'].' </td>
                            </tr>
                        </table>
                        <table style="width: 100%;">
                            <tr>
                                <td style="text-align: center;font-size: 22px;font-weight: bold;border-top: 2px solid #000;border-bottom: 2px solid #000;padding: 10px;" colspan="22">'.$fullmonthyear.'</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-weight: bold;border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">SR</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">NAME OF EMPLOYEE</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">City</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">Designation</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">Wage</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">TOTAL DAYS OF THE MONTH</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">LEAVE</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">Holiday</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">WORKING DAY</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">Present</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">BASIC</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">EPFO</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">ESIC</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">ADMIN EPFO CHARGE</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">ADMIN ESIC CHARGE</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">BONUS 8.33%</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">TOTAL OF CTC</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">SERVICE CHARGE @ 3.85%</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">TOTAL</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">SGST @9%</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">CGST @9%</td>
                                <td style="text-align:center;font-weight: bold;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px">NET BILLING</td>
                              </tr>'.$employeedata.'<tr>
                                <td style="text-align:right;border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;text-decoration: underline;" colspan="8">TOTAL</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.$fworkingdays.'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.$ftotalpresentcountdata.'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalbasic, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalepfo, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalesic, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalaepfo, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalaesic, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalbonus, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalctc, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalservicecharge, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotal, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalsgst, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalcgst, 2, '.', '').'</td>
                                <td style="text-align:center;border-right:1px solid #000;border-bottom:1px solid #000;padding:5px 10px;font-weight:bold;">'.number_format((float)$ftotalnetbilling, 2, '.', '').'</td>
                              </tr>
                        </table>
                  </body>
                </html>';

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'L']);
        $mpdf->AddPageByArray(['margin-left' => 5,'margin-right' => 5,'margin-top' => 5,'margin-bottom' => 5,]);
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->WriteHTML($html);
        $mpdf->Output("UploadImages/billing/".$filename, 'F');
        echo '<iframe src="'.SITE_ROOT_FRONT.'UploadImages/billing/'.$filename.'" style="width: 100%;height: 600px;"></iframe>';
        exit;
?>