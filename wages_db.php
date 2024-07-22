<?php   include_once 'inc/connection.php';
        include_once 'inc/functions.php';
        $monthyearsel2 = $_POST['month']."-".$_POST['year'];
        $dt = $_POST['year']."-".$_POST['month']."-01";
        $curmnth = $_POST['month'];
        $curyear = $_POST['year'];
        $totDays = get_days_in_month($curmnth, $curyear);
        $filename = $monthyearsel2."-wages.pdf";
        require_once 'MPDF/vendor/autoload.php';
      
        $selectgeneralsettings = mysqli_query($link,"select * from login_admin");
        $rwselectpackunit = mysqli_fetch_array($selectgeneralsettings);
        $hsminwages = $rwselectpackunit['hsminwages'];
        $sminwages = $rwselectpackunit['sminwages'];
        $ssminwages = $rwselectpackunit['ssminwages'];
        $usminwages = $rwselectpackunit['usminwages'];

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
                $pewages = 0;
                $totalcountp = 0;
                $psalaryda = 0;
                $pleave_wage = 0;
                $padmin_wage = 0;
                $pbonus_wage = 0;
                $ptravel_wage = 0;
                $pother_wage = 0;
                $pgross = 0;
                $ppf = 0;
                $pesic = 0;
                $ppt = 0;
                $pincometax = 0;
                $pinsurance = 0;
                $padvance = 0;
                $plwf = 0;
                $p_total_tax = 0;
                $pnetpayment = 0;
                
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
                
                if($rwselecemployeedata['e_admin_wedge'] != ""){
                    $e_admin_wedge = $rwselecemployeedata['e_admin_wedge'];
                }else{
                    $e_admin_wedge = 0.00;
                }
                
                if($rwselecemployeedata['e_bonus_wedge'] != ""){
                    $e_bonus_wedge = $rwselecemployeedata['e_bonus_wedge'];
                }else{
                    $e_bonus_wedge = 0.00;
                }
                
                if($rwselecemployeedata['e_travel_wedge'] != ""){
                    $e_travel_wedge = $rwselecemployeedata['e_travel_wedge'];
                }else{
                    $e_travel_wedge = 0.00;
                }
                
                if($rwselecemployeedata['e_other_wedge'] != ""){
                    $e_other_wedge = $rwselecemployeedata['e_other_wedge'];
                }else{
                    $e_other_wedge = 0.00;
                }
                
                if($rwselecemployeedata['e_incometax'] != ""){
                    $e_incometax = $rwselecemployeedata['e_incometax'];
                }else{
                    $e_incometax = 0.00;
                }
                
                if($rwselecemployeedata['e_insurance'] != ""){
                    $e_insurance = $rwselecemployeedata['e_insurance'];
                }else{
                    $e_insurance = 0.00;
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
                
                $skilltype = "";
                if($ewages >= $hsminwages && $hsminwages != '0'){
                      $skilltype = "Highly Skilled";
                }else if($ewages >= $sminwages && $sminwages != '0'){
                      $skilltype = "Skilled";
                }else if($ewages >= $ssminwages && $ssminwages != '0'){
                      $skilltype = "Semi Skilled";
                }else if($ewages >= $usminwages && $usminwages != '0'){
                      $skilltype = "Unskilled";
                }
                
                $pewages = $ewages;
                $pcount =  $totalcountp;
                $psalaryda = $totalcountp * $ewages + $e_da;
                $pleave_wage = $e_earning_leave_enc;
                $padmin_wage = ($psalaryda * $e_admin_wedge) / 100;
                $pbonus_wage = ($psalaryda * $e_bonus_wedge) / 100;
                $ptravel_wage = ($psalaryda * $e_travel_wedge) / 100;
                $pother_wage = ($psalaryda * $e_other_wedge) / 100;
                $pgross = $psalaryda + $pleave_wage + $padmin_wage + $pbonus_wage + $ptravel_wage + $pother_wage;
                $ppf = ($pgross * $e_pf) / 100;
                $pesic = ($pgross * $e_esi) / 100;
                $ppt = $e_pt;
                $pincometax = ($pgross * $e_incometax) / 100;
                $pinsurance = ($pgross * $e_insurance) / 100;
                $padvance = $e_advance;
                $plwf = $e_lwf;
                $p_total_tax = $ppf + $pesic + $ppt + $pincometax + $pinsurance + $padvance + $plwf;
                $pnetpayment = $pgross - $p_total_tax;
                $tdays = $tdays + $pcount;
                $tbasicda = $tbasicda + $psalaryda;
                $tleavewedge = $tleavewedge + $pleave_wage;
                $tadminwedge = $tadminwedge + $padmin_wage;
                $tbonuswedge = $tbonuswedge + $pbonus_wage;
                $ttavelwedge = $ttavelwedge + $ptravel_wage;
                $totherwedge = $totherwedge + $pother_wage;
                $tgross = $tgross + $pgross;
                $tpf = $tpf + $ppf;
                $tesic = $tesic + $pesic;
                $tpt = $tpt + $ppt;
                $tincometax = $tincometax + $pincometax;
                $tinsurance = $tinsurance + $pinsurance;
                $tadvance = $tadvance + $padvance;
                $tlwf = $tlwf + $plwf;
                $ttax = $ttax + $p_total_tax;
                $tnetpayment = $tnetpayment + $pnetpayment;
                
                $employeedata .= '<tr>
                                    <td style="border: 1px solid;font-size:7px;text-align:center;padding:8px;border-top:0">'.$emp_no.'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.strtoupper($skilltype).'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$pewages, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.$pcount.'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">-</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$psalaryda, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$pleave_wage, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$padmin_wage, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$pbonus_wage, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$ptravel_wage, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$pother_wage, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$pgross, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;border-top:0;font-size:7px;text-align:center">
                                        <table style="width: 100%;" cellpadding="8" cellspacing="0">
                                            <tr>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0;">'.number_format((float)$ppf, 2, '.', '').'</td>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$pesic, 2, '.', '').'</td>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$ppt, 2, '.', '').'</td>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$pincometax, 2, '.', '').'</td>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$pinsurance, 2, '.', '').'</td>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$padvance, 2, '.', '').'</td>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$plwf, 2, '.', '').'</td>
                                                <td style="font-size:7px;text-align:center;border-top:0">'.number_format((float)$p_total_tax, 2, '.', '').'</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$pnetpayment, 2, '.', '').'</td>
                                    <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">&nbsp;</td>
                                  </tr>';
                $emp_no++;
        }
      
        $html = '<html>
                    <head><title>'.$monthyearsel2.' Wages</title></head>
                    <body style="margin:0">
                        <table style="width: 100%;" cellpadding="8" cellspacing="0">
                            <tr>
                                <td style="width:30%">
                                    <table style="width: 100%;border-top:1px solid;border-left:1px solid;border-right:1px solid;border-bottom:3px double;" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td style="border-right:1px solid;border-bottom:1px solid;font-size:7px;text-align:center">Name Of Company:</td>
                                                <td style="border-bottom:1px solid;font-weight:bold;font-size:9px;text-align:center">'.strtoupper($_SESSION['company_name']).'</td>
                                            </tr>
                                            <tr>
                                                <td style="border-right:1px solid;font-size:7px;text-align:center">Name & Add. Of Contractor:</td>
                                                <td style="font-size:7px;text-align:center">'.strtoupper($_SESSION['company_add']).'</td>
                                            </tr>
                                    </table>
                                </td>
                                <td >
                                    <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td style="font-weight:bold;font-size:11px;text-align:center;border-top:1px solid;">Form-B Register of Wages</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight:bold;font-size:11px;text-align:center;border-bottom:3px double;">{See Rule 2(1)}</td>
                                            </tr>
                                    </table>
                                </td>
                                <td style="width:40%">
                                    <table style="width: 100%;" cellpadding="3" cellspacing="0">
                                            <tr>
                                                <td colspan="5" style="border: 1px solid;font-size:7px;text-align:center">Rate Of Minimum Wages and since the Date 01-'.$_POST['month'].' '.$_POST['year'].' to 30-'.$_POST['month'].' '.$_POST['year'].'</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid;border-top:0;font-size:7px;text-align:center">&nbsp;</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">Highly Skilled</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">Skilled</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">Semi-Skilled</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">Unskilled</td>
                                                <td rowspan="2" style="border: 1px solid;border-left:0;font-size:7px;text-align:center">Wage Period From</td>
                                                <td rowspan="2" style="border: 1px solid;border-left:0;font-size:7px;text-align:center">01-'.$_POST['month'].' '.$_POST['year'].' to 30-'.$_POST['month'].' '.$_POST['year'].'</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid;border-top:0;font-size:7px;text-align:center">Minimum Basic</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">'.$hsminwages.'</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">'.$sminwages.'</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">'.$ssminwages.'</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">'.$usminwages.'</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid;border-top:0;font-size:7px;text-align:center">Dearness Allow.</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td>&nbsp;</td>
                                                <td style="border: 1px solid;border-top:0;font-size:7px;text-align:center">(MONTHLY)</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid;border-top:0;font-size:7px;text-align:center">Overtime</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td style="border: 1px solid;border-top:0;border-left:0;font-size:7px;text-align:center">0</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table style="width: 100%;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="border: 1px solid;font-size:7px;text-align:center;padding:8px">Sr. No.</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">Sl. No. in Employee Register</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">Name</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">Rate of Wage</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">No. of Days worked</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">Overtime hours worked</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">Basic + DA</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">LEAVE WAGE</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">ADMIN</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">BONUS</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">TRAVEL</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">OTHER</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">TOTAL GROSS</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center">
                                    <table style="width: 100%;" cellpadding="8" cellspacing="0">
                                        <tr>
                                            <td colspan="9" style="text-align: center;font-size:7px;text-align:center">Deduction</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid;border-right:1px solid;font-size:7px;text-align:center">PF</td>
                                            <td style="border-top:1px solid;border-right:1px solid;font-size:7px;text-align:center">ESIC</td>
                                            <td style="border-top:1px solid;border-right:1px solid;font-size:7px;text-align:center">PT</td>
                                            <td style="border-top:1px solid;border-right:1px solid;font-size:7px;text-align:center">Income Tax</td>
                                            <td style="border-top:1px solid;border-right:1px solid;font-size:7px;text-align:center">Insurance</td>
                                            <td style="border-top:1px solid;border-right:1px solid;font-size:7px;text-align:center">ADVANCE</td>
                                            <td style="border-top:1px solid;border-right:1px solid;font-size:7px;text-align:center">LWF</td>
                                            <td style="border-top:1px solid;font-size:7px;text-align:center">Total</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">Net Payment</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px">Remarks</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;font-size:7px;text-align:center;padding:8px;border-top:0">&nbsp;</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">1</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">2</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">3</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">4</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">5</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">6</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">7</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">8</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">9</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">10</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">&nbsp;</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">&nbsp;</td>
                                <td style="border: 1px solid;border-left:0;border-top:0;font-size:7px;text-align:center">
                                    <table style="width: 100%;" cellpadding="8" cellspacing="0">
                                        <tr>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0;width: 15.5%;">13</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0;width: 13.5%;">14</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">15</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">16</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">17</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">18</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">19</td>
                                            <td style="font-size:7px;text-align:center;border-top:0">20</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">21</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">22</td>
                            </tr>'.$employeedata.'<tr>
                                <td colspan="4" style="border: 1px solid;font-size:7px;text-align:right;padding:8px;border-top:0;font-weight:bold">TOTAL</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.$tdays.'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">&nbsp;</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$tbasicda, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$tleavewedge, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$tadminwedge, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$tbonuswedge, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$ttavelwedge, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$totherwedge, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$tgross, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;border-top:0;font-size:7px;text-align:center">
                                    <table style="width: 100%;" cellpadding="8" cellspacing="0">
                                        <tr>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0;width: 15.5%;">'.number_format((float)$tpf, 2, '.', '').'</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0;width: 13.5%;">'.number_format((float)$tesic, 2, '.', '').'</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$tpt, 2, '.', '').'</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$tincometax, 2, '.', '').'</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$tinsurance, 2, '.', '').'</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$tadvance, 2, '.', '').'</td>
                                            <td style="border-right:1px solid;font-size:7px;text-align:center;border-top:0">'.number_format((float)$tlwf, 2, '.', '').'</td>
                                            <td style="font-size:7px;text-align:center;border-top:0">'.number_format((float)$ttax, 2, '.', '').'</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">'.number_format((float)$tnetpayment, 2, '.', '').'</td>
                                <td style="border: 1px solid;border-left:0;font-size:7px;text-align:center;padding:8px;border-top:0">&nbsp;</td>
                            </tr>
                        </table>
                    </body>
                </html>';

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'L']);
        $mpdf->AddPageByArray(['margin-left' => 5,'margin-right' => 5,'margin-top' => 5,'margin-bottom' => 5,]);
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->WriteHTML($html);
        $mpdf->Output("UploadImages/wages/".$filename, 'F');
        echo '<iframe src="'.SITE_ROOT_FRONT.'UploadImages/wages/'.$filename.'" style="width: 100%;height: 600px;"></iframe>';
        exit;
?>