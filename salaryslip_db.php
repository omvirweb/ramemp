<?php   include_once 'inc/connection.php';
        include_once 'inc/functions.php';
        $monthyearsel2 = $_POST['month']."-".$_POST['year'];
        $curmnth = $_POST['month'];
        $curyear = $_POST['year'];
        $totDays = get_days_in_month($curmnth, $curyear);
        $dt = $_POST['year']."-".$_POST['month']."-01";
        $filename = $monthyearsel2."-salaryslip.pdf";
        require_once 'MPDF/vendor/autoload.php';
     
        $html = '<html>
                    <head><title>'.$monthyearsel2.' Salary Slip</title></head>
                    <body style="margin:0">';
                        for($j=0;$j<count($_POST['employee_id']);$j++){
                            $employeeid = $_POST['employee_id'][$j];
                            $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
                            $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
                            $presentstotal = 0;
                            $absenttotal = 0;
                            $paidleavetotal = 0;
                            $finaltotal = 0;
                            $totalpf = 0;
                            $totalesi = 0;
                            $totalfacilitytimesafetyexp = 0;
                            $grossearning = 0;
                            $grossdeduction = 0;
                            $netsalary = 0;
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
                            $totalgross = number_format((float)$ewages, 2, '.', '') + $e_da + $e_actual_hra + $e_medical_allow + $e_convey_allow + $e_edu_allow + $e_other_allow;
                            $totalpf = number_format((float)$totalwedge * $e_pf / 100, 2, '.', '');
                            $totalesi = number_format((float)$totalwedge * $e_esi / 100, 2, '.', '');
                            $totalfacilitytimesafetyexp = number_format((float)$totalwedge * $e_facility_time_safety_exp / 100, 2, '.', '');
                            $grossearning = number_format((float)$totalwedge + $e_earning_hra + $e_earning_medical + $e_earning_conveyance + $e_earning_sta_bonus + $e_earning_leave_enc + $e_earning_gratuity + $e_earning_spe_a + $e_earning_pro_inc_attn_bonus + $e_earning_ot_amount, 2, '.', '');
                            $grossdeduction = number_format((float)$e_pt + $totalpf + $totalesi + $e_lwf + $e_tds + $e_advance + $e_loan_ins + $e_canteen + $e_oth_ded + $totalfacilitytimesafetyexp, 2, '.', '');
                            $netsalary = number_format((float)$grossearning - $grossdeduction, 2, '.', '');
                            
                            $html .= '<table style="border: 1px solid;width: 100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="border-right:1px solid;width: 30% "><img src="'.SITE_ROOT_FRONT.'/UploadImages/company/'.$_SESSION['company_logo'].'" style="width:150px" /></td>
                                                <td style="text-align: center;width: 70%;padding-top:15px">
                                                    <div style="font-size: 17px;font-weight: bold;color:#2b3984">'.strtoupper($_SESSION['company_name']).'</div>
                                                    <div style="font-size: 10px;color:#2b3984;">'.strtoupper($_SESSION['company_add']).'</div>
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;margin-top:20px;">
                                                        <tr>
                                                            <td style="width: 50%;font-weight: bold;font-size:10px;color:#000000">SALARY SLIP FOR THE MONTH OF '.get_month($_POST['month']).' - '.$_POST['year'].'</td>
                                                            <td style="width: 50%;font-weight: bold;text-align: right;font-size:10px">FORM NO: 4(B) RULE NO: 26(2)</td>
                                                        </tr>
                                                    </table>
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 40%;font-weight: bold;font-size:10px;border-top:1px solid;border-right:1px solid">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                    <tr>
                                                                        <td style="width: 80px;font-weight: bold;font-size:10px;text-align:left;padding-left:1px;padding-top:4px;padding-bottom:4px">ESIC No.</td>
                                                                        <td style="width: 10px;font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">:</td>
                                                                        <td style="font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_esic_no'].'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="width: 60%;font-weight: bold;text-align: right;font-size:10px;border-top:1px solid">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                    <tr>
                                                                        <td style="width: 80px;font-weight: bold;font-size:10px;text-align:left;padding-left:1px;padding-top:4px;padding-bottom:4px">Pan No.</td>
                                                                        <td style="width: 10px;font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">:</td>
                                                                        <td style="font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_pan_no'].'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:1px solid;border-right:1px solid">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                           <td style="width: 80px;font-weight: bold;font-size:10px;padding-left:4px;padding-top:4px;padding-bottom:4px">UAN No.</td>
                                                           <td style="width: 10px;font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">:</td>
                                                           <td style="font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px;padding-right:4px;">'.$rwselecemployeedata['e_uan_no'].'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td colspan="2" style="border-top:1px solid;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 43.2%;font-weight: bold;font-size:10px;border-right:1px solid">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                    <tr>
                                                                        <td style="width: 80px;font-weight: bold;font-size:10px;text-align:left;padding-left:1px;padding-top:4px;padding-bottom:4px">PF No.</td>
                                                                        <td style="width: 10px;font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">:</td>
                                                                        <td style="font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_id'].'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="width: 54.4%;font-weight: bold;text-align: right;font-size:10px;">
                                                                 <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                    <tr>
                                                                        <td style="width: 80px;font-weight: bold;font-size:10px;text-align:left;padding-left:1px;padding-top:4px;padding-bottom:4px">Aadhar No.</td>
                                                                        <td style="width: 10px;font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">:</td>
                                                                        <td style="font-weight: bold;font-size:10px;text-align:left;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_atthar_no'].'</td>
                                                                    </tr>
                                                                 </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                      </table>
                                      <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tr>
                                                <td style="width:63.9%;border-left:1px solid">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 120px;font-weight: bold;font-size:10px;padding-left:4px;padding-top:4px;padding-bottom:4px">Employee Name</td>
                                                            <td style="width: 10px;font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">:</td>
                                                            <td style="font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_id'].' - '.strtoupper($rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname']).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 120px;font-weight: bold;font-size:10px;padding-left:4px;padding-top:4px;padding-bottom:4px">Department</td>
                                                            <td style="width: 10px;font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">:</td>
                                                            <td style="font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">'.strtoupper(get_department($rwselecemployeedata['e_depart_id'])).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 120px;font-weight: bold;font-size:10px;padding-left:4px;padding-top:4px;padding-bottom:4px">Bank Name</td>
                                                            <td style="width: 10px;font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">:</td>
                                                            <td style="font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_bank_name'].'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="width:36.1%;border-left:1px solid;border-right:1px solid">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 80px;font-weight: bold;font-size:10px;padding-left:1px;padding-top:4px;padding-bottom:4px">Designation</td>
                                                            <td style="width: 10px;font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">:</td>
                                                            <td style="font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_current_designation'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 80px;font-weight: bold;font-size:10px;padding-left:1px;padding-top:4px;padding-bottom:4px">&nbsp;</td>
                                                            <td style="width: 10px;font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px"></td>
                                                            <td style="font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 80px;font-weight: bold;font-size:10px;padding-left:1px;padding-top:4px;padding-bottom:4px">Bank A/C No</td>
                                                            <td style="width: 10px;font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">:</td>
                                                            <td style="font-weight: bold;font-size:10px;padding-top:4px;padding-bottom:4px">'.$rwselecemployeedata['e_acc_no'].'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                      </table>
                                      <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tr>
                                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 5px 0;width: 20%;font-size:11px;">ATTENDANCE</td>
                                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 5px 0;width: 20%;border-left: 0;font-size:11px;">ACTUAL</td>
                                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 5px 0;width: 20%;border-left: 0;font-size:11px;">EARNINGS</td>
                                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 5px 0;width: 20%;border-left: 0;font-size:11px;">DEDUCTIONS</td>
                                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 5px 0;width: 20%;border-left: 0;font-size:11px;">BALANACE
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Month Days</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$finaltotal.'</td>
                                                        </tr>
                                                        <tr>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Present Days</td>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$finaltotal.'</td>
                                                        </tr>
                                                        <tr>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Paid Leave</td>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$paidleavetotal.'</td>
                                                        </tr>
                                                        <tr>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Paid Holidays</td>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">0.00</td>
                                                        </tr>
                                                        <tr>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Week OFF</td>
                                                           <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">L.W.P.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$paidleavetotal.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Paid Days</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$finaltotal.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Salary</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.number_format((float)$ewages, 2, '.', '').'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">Pay Mode</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">BANK</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;font-size:8px">&nbsp;</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Basic</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.number_format((float)$ewages, 2, '.', '').'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">D.A.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_da.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">H.R.A</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_actual_hra.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Medical Allow.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_medical_allow.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Convey. Allow.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_convey_allow.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Edu. Allow.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_edu_allow.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Other Allow.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_other_allow.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Total Gross</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.number_format((float)$totalgross, 2, '.', '').'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Basic</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.number_format((float)$totalwedge, 2, '.', '').'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">H.R.A</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_hra.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Medical</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_medical.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Conveyance</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_conveyance.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Sta. Bonus</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_sta_bonus.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Leave Enc.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_leave_enc.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Gratuity</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_gratuity.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Spe. A.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_spe_a.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size: 5px;">Pro. Inc./Attn. Bonus</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_pro_inc_attn_bonus.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">OT Amount</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_earning_ot_amount.'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">PT</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_pt.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">PF</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$totalpf.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">ESI</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$totalesi.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">LWF</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_lwf.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">TDS</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_tds.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Advance</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_advance.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Loan Ins.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_loan_ins.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Canteen</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_canteen.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Oth. Ded.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$e_oth_ded.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size: 5px">Facility / Time / Safety Exp.</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$totalfacilitytimesafetyexp.'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Gross Earning</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.number_format((float)$grossearning, 2, '.', '').'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Gross Deduction</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.$grossdeduction.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Net Salary</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">'.number_format((float)$netsalary, 2, '.', '').'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-weight: bold;font-size:8px">Loan Detail :</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Opening</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Net Addition</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">Closing</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                            <td style="padding: 5px 5px;border: 1px solid;width: 50%;border-top: 0;border-left: 0;font-size:8px">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                      </table>
                                      <div style="font-size: 10px;margin-bottom:80px">This is Computer Generated Salary Slip. It Does Not Require Signature.</div>';
                        }
        $html .= '</body></html>';

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'P']);
        $mpdf->AddPageByArray(['margin-left' => 5,'margin-right' => 5,'margin-top' => 15,'margin-bottom' => 15,]);
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->WriteHTML($html);
        $mpdf->Output("UploadImages/salryslip/".$filename, 'F');
        echo '<iframe src="'.SITE_ROOT_FRONT.'UploadImages/salryslip/'.$filename.'" style="width: 100%;height: 600px;"></iframe>';
        exit;
?>