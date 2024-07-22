<?php   include_once 'inc/connection.php';
        include_once 'inc/functions.php';
        $monthyearsel2 = $_POST['month']."-".$_POST['year'];
        $curmnth = $_POST['month'];
        $curyear = $_POST['year'];
        $totDays = get_days_in_month($curmnth, $curyear);
        $dt = $_POST['year']."-".$_POST['month']."-01";
        $filename = $monthyearsel2."-salaryregister.pdf";
        require_once 'MPDF/vendor/autoload.php';
      
        $selectcomp = mysqli_query($link,"select * from company where c_id='".$_SESSION['company_id']."'");
        $rwselectcomp = mysqli_fetch_array($selectcomp);
        
        $employeedata = "";
        $emp_no = 1;
        $finaltotal = 0;
        $totalwedge = 0;
        $totalgrossamtpayable = 0;
        $totalpf = 0;
        $totalesi = 0;
        $totalpt = 0;
        $totallwf = 0;
        $totaltds = 0;
        $totaladvance = 0;
        $totalcanteen = 0;
        $totalothded = 0;
        $totalloanins = 0;
        $totaltimeloss = 0;
        $totalsafatyequi = 0;
        $totalfacility_time_safety_exp = 0;
        $totaldeduction = 0;
        $netpayable = 0;
        $totalepf = 0;
        $totalfpf = 0;
        $maleemployee = 0;
        $femaleemployee = 0;
        $finalwage = 0;
        $finaltotalbasic = 0;
      
        
        for($j=0;$j<count($_POST['employee_id']);$j++){
            $employeeid = $_POST['employee_id'][$j];
            $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
            $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
            $genderlabel = "";
            if($rwselecemployeedata['e_gender'] == "0"){
                $genderlabel = "MALE";
                $maleemployee = $maleemployee + 1;
            }else if($rwselecemployeedata['e_gender'] == "1"){
                $genderlabel = "FEMALE";
                $femaleemployee = $femaleemployee + 1;
            }
            
            $totalpresntscount = 0;
            $totalabpresntscount = 0;
            $totalableavescount = 0;
            $finaltotalp = 0;
            $totalgrossamtpayablep = 0;
            $ptotalpf = 0;
            $ptotalesi = 0;
            $ptotalfacility_time_safety_exp = 0;
            $ptotaldeduction = 0;
            $pnetpayable = 0;
            $ptotalepf = 0;
            $ptotalfpf = 0;
            $pfinaltotalbasic = 0;
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
                        $totalpresntscount = $totalpresntscount + 1;
                    }

                    if($rwselectattendence['ea_emp_attendance_type'] == "2"){
                        $totalabpresntscount = $totalabpresntscount + 1;
                    }

                    if($rwselectattendence['ea_emp_attendance_type'] == "0"){
                        $totalableavescount = $totalableavescount + 1;
                    }

                }
                $totalpcount = $totalpresntscount+$totalabpresntscount;
            }
            
            if($rwselecemployeedata['e_wedge'] != ""){
                $ewages = $rwselecemployeedata['e_wedge'];
            }else if($rwselecemployeedata['e_fullwedge'] != ""){
                $ewages = $rwselecemployeedata['e_fullwedge'] / $totDays;
            }else{
                $ewages = 0;
            }
            
            $finaltotal = $finaltotal + $totalpresntscount + $totalableavescount;
            $finaltotalp = $totalpresntscount + $totalableavescount;
            $totalwedge = $finaltotal*$ewages;
            $finalwage = $finalwage + $ewages;
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
            
            if($rwselecemployeedata['e_abry_pf'] != ""){
                $e_abry_pf = $rwselecemployeedata['e_abry_pf'];
            }else{
                $e_abry_pf = 0.00;
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
            
            if($rwselecemployeedata['e_pt'] != ""){
                $e_pt = $rwselecemployeedata['e_pt'];
            }else{
                $e_pt = 0;
            }
            
            if($rwselecemployeedata['e_timeloss'] != ""){
                $e_timeloss = ($totalwedge * $rwselecemployeedata['e_timeloss']) / 100;
            }else{
                $e_timeloss = 0;
            }
            
            if($rwselecemployeedata['e_epf'] != ""){
                $e_epf = $rwselecemployeedata['e_epf'];
            }else{
                $e_epf = 0;
            }
            
            if($rwselecemployeedata['e_fpf'] != ""){
                $e_fpf = $rwselecemployeedata['e_fpf'];
            }else{
                $e_fpf = 0;
            }
            
            if($totalwedge >= 12000){
                if($e_pt != "0"){
                    $e_pt = $e_pt;
                }else{
                    $e_pt = '200';
                }
            }else{
                $e_pt = $e_pt;
            }
            $finaltotalbasic = $finaltotalbasic + $ewages * $finaltotalp;
            $totalpf = number_format((float)$totalpf + ($totalwedge * $rwselecemployeedata['e_pf']) / 100, 2, '.', '');
            $ptotalpf = number_format((float)($ewages * $finaltotalp * $e_pf)/100, 2, '.', '');
            $totalesi = number_format((float)$totalesi + ($totalwedge * $rwselecemployeedata['e_esi']) / 100, 2, '.', '');
            $ptotalesi = number_format((float)($ewages * $finaltotalp * $e_esi)/100, 2, '.', '');
            $totalpt = number_format((float)$totalpt + $e_pt, 2, '.', '');
            $totallwf = number_format((float)$totallwf + $e_lwf, 2, '.', '');
            $totaltds = number_format((float)$totaltds + $e_tds, 2, '.', '');
            $totaladvance = number_format((float)$totaladvance  + $e_advance, 2, '.', '');
            $totalcanteen = number_format((float)$totalcanteen + $e_canteen, 2, '.', '');
            $totalothded = number_format((float)$totalothded + $e_oth_ded, 2, '.', '');
            $totalloanins = number_format((float)$totalloanins + $e_loan_ins, 2, '.', '');
            $totaltimeloss = number_format((float)$totaltimeloss + $e_timeloss, 2, '.', '');
            $totalsafatyequi = number_format((float)$totalsafatyequi, 2, '.', '');
            $totalfacility_time_safety_exp = number_format((float)$totalfacility_time_safety_exp + ($totalwedge * $rwselecemployeedata['e_facility_time_safety_exp']) / 100, 2, '.', '');
            $ptotalfacility_time_safety_exp = ($ewages * $finaltotalp * $rwselecemployeedata['e_facility_time_safety_exp']) / 100;
            $totalgrossamtpayable = number_format((float)$totalgrossamtpayable + $totalwedge + $e_da + $e_actual_hra + $e_other_allow + $e_earning_hra + $e_earning_medical + $e_earning_conveyance + $e_earning_sta_bonus + $e_earning_leave_enc + $e_earning_gratuity + $e_earning_spe_a + $e_edu_allow + $e_earning_pro_inc_attn_bonus + $e_earning_ot_amount + ($totalwedge * $rwselecemployeedata['e_abry_pf']) / 100, 2, '.', '');
            $totalgrossamtpayablep = number_format((float)$ewages * $finaltotalp + $e_da + $e_actual_hra + $e_other_allow + $e_earning_hra + $e_earning_medical + $e_earning_conveyance + $e_earning_sta_bonus + $e_earning_leave_enc + $e_earning_gratuity + $e_earning_spe_a + $e_edu_allow + $e_earning_pro_inc_attn_bonus + $e_earning_ot_amount + ($ewages * $finaltotalp * $rwselecemployeedata['e_abry_pf']) / 100, 2, '.', '');
            $totaldeduction = number_format((float)$totaldeduction + $totalpf + $totalesi + $totalpt + $totallwf + $totaltds + $totaladvance + $e_canteen + $totalothded + $totalloanins + $totaltimeloss + $totalsafatyequi + $totalfacility_time_safety_exp, 2, '.', '');
            $ptotaldeduction = number_format((float)$ptotalpf + $ptotalesi + $e_pt + $e_lwf + $e_tds + $e_advance + $totalcanteen + $e_oth_ded + $e_loan_ins + $e_timeloss + $ptotalfacility_time_safety_exp, 2, '.', '');
            $netpayable = number_format((float)$netpayable + $totalgrossamtpayable - $totaldeduction, 2, '.', '');
            $pnetpayable = number_format((float)$totalgrossamtpayablep - $ptotaldeduction, 2, '.', '');
            $totalepf = number_format((float)$totalepf + ($totalwedge * $rwselecemployeedata['e_epf']) / 100, 2, '.', '');
            $ptotalepf = number_format((float)($ewages * $finaltotalp * $totalwedge * $rwselecemployeedata['e_epf'])/100, 2, '.', '');
            $totalfpf = number_format((float)$totalepf + ($totalwedge * $rwselecemployeedata['e_fpf']) / 100, 2, '.', '');
            $ptotalfpf = number_format((float)($ewages * $finaltotalp * $rwselecemployeedata['e_fpf']) / 100, 2, '.', '');
            $totalearning_sta_bonus = $totalearning_sta_bonus + $e_earning_sta_bonus;
            $totaledu_allow = $totaledu_allow + $e_edu_allow;
            $totalearning_hra = $totalearning_hra + $e_earning_hra;
            $totalearning_leave_enc = $totalearning_leave_enc + $e_earning_leave_enc;
            $totalearning_pro_inc_attn_bonus = $totalearning_pro_inc_attn_bonus + $e_earning_pro_inc_attn_bonus;
            $totalearning_medical = $totalearning_medical + $e_earning_medical;
            $totalearning_gratuity = $totalearning_gratuity + $e_earning_gratuity;
            $totalearning_ot_amount = $totalearning_ot_amount + $e_earning_ot_amount;
            $totalearning_conveyance = $totalearning_conveyance + $e_earning_conveyance;
            $totalearning_spe_a = $totalearning_spe_a + $e_earning_spe_a;
            $totalabry_pf = $totalabry_pf + (($ewages * $finaltotalp * $rwselecemployeedata['e_abry_pf']) / 100);
            $pfinaltotalbasic = $pfinaltotalbasic + $finaltotalbasic + $e_earning_sta_bonus + $e_edu_allow + $e_earning_hra + $e_earning_leave_enc + $e_earning_pro_inc_attn_bonus + $e_earning_medical + $e_earning_gratuity + $e_earning_ot_amount + $e_earning_conveyance + $e_earning_spe_a + (($ewages * $finaltotalp * $rwselecemployeedata['e_abry_pf']) / 100);
            $totalpff = $totalpff + $ptotalpf;
            $totaltdsf = $totaltdsf + $e_tds;
            $totalloan_insf = $totalloan_insf + $e_loan_ins;
            $totalesif = $totalesif + $ptotalesi;
            $totaladvancef = $totaladvancef + $e_advance;
            $totaltimelossf = $totaltimelossf + $e_timeloss;
            $totalptf = $totalptf + $e_pt;
            $totalcanteenf = $totalcanteenf + $e_canteen;
            $totalsafateyequip = $totalsafateyequip + 0;
            $totallwff = $totallwff + $e_lwf;
            $totaloth_dedf = $totaloth_dedf + $e_oth_ded;
            $totalfacility_time_safety_expp = $totalfacility_time_safety_expp + $ptotalfacility_time_safety_exp;
            $pfinaldeduction = $pfinaldeduction + $ptotalpf + $e_tds + $e_loan_ins + $ptotalesi + $e_advance + $e_timeloss + $e_pt + $e_canteen + $e_lwf + $e_oth_ded + $ptotalfacility_time_safety_exp;
            $pfinalnetpayable = $pfinaltotalbasic - $pfinaldeduction;
            $ptotalepff = $ptotalepff + ($ewages * $finaltotalp * $totalwedge * $rwselecemployeedata['e_epf'])/100;
            $ptotalfpff = $ptotalfpff + ($ewages * $finaltotalp * $totalwedge * $rwselecemployeedata['e_fpf'])/100;
            $ptotalesif = $ptotalesif + $ptotalesi;
            $e_lwff = $e_lwff + $e_lwf;
            
            $employeedata .= '<table style="width: 100%;border:1px solid;border-top:0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: center;font-weight: bold;width:8.9%">
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td style="text-align: center;font-weight: bold">'.$emp_no.'</td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:1px solid;text-align: center;font-weight: bold">'.$rwselecemployeedata['e_id'].'</td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:1px solid;text-align: center;">BANK</td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:1px solid;text-align: center;">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: center;width:7.8%">
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                          <tr>
                                            <td style="text-align: center;">'.number_format((float)$totalpcount, 2, '.', '').'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: center;">'.number_format((float)$totalableavescount, 2, '.', '').'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: center;">0</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: center;">'.$genderlabel.'</td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: center;font-weight: bold;width:12.8%">
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                          <tr>
                                            <td colspan="2" style="text-align: center;font-weight: bold">'.strtoupper($rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname']).'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: center;font-size:8px;border-right:1px solid">UAN No.</td>
                                            <td style="border-top:1px solid;text-align: center;font-size:8px">'.strtoupper($rwselecemployeedata['e_uan_no']).'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: center;font-size:8px;border-right:1px solid">ESIC No.</td>
                                            <td style="border-top:1px solid;text-align: center;font-size:8px">'.strtoupper($rwselecemployeedata['e_esic_no']).'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: center;font-size:8px;border-right:1px solid">Aadhar No.</td>
                                            <td style="border-top:1px solid;text-align: center;font-size:8px">'.strtoupper($rwselecemployeedata['e_atthar_no']).'</td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: right;width:5.9%;vertical-align:top">'.$ewages.'</td>
                                    <td style="border-left:1px solid;text-align: center;font-weight: bold;width:7.7%">
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                          <tr>
                                            <td style="text-align: right;">'.number_format((float)$ewages, 2, '.', '').'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_da.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_actual_hra.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_other_allow.'</td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: center;font-weight: bold;width:13.6%">
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                          <tr>
                                            <td style="text-align: right;">'.number_format((float)$ewages * $finaltotalp, 2, '.', '').'</td>
                                            <td style="text-align: right;border-left:1px solid;">'.$e_earning_sta_bonus.'</td>
                                            <td style="text-align: right;border-left:1px solid;">'.$e_edu_allow.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;width: 33.33%;">'.$e_earning_hra.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;width: 33.33%;">'.$e_earning_leave_enc.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;width: 33.33%;">'.$e_earning_pro_inc_attn_bonus.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_earning_medical.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">'.$e_earning_gratuity.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">'.$e_earning_ot_amount.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_earning_conveyance.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">'.$e_earning_spe_a.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">'.$e_abry_pf.'</td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: right;width: 5.9%;">'.$totalgrossamtpayablep.'</td>
                                    <td style="border-left:1px solid;text-align: center;font-weight: bold;width:14%">
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                          <tr>
                                            <td style="text-align: right;">'.$ptotalpf.'</td>
                                            <td style="text-align: right;border-left:1px solid;">'.$e_tds.'</td>
                                            <td style="text-align: right;border-left:1px solid;">'.$e_loan_ins.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;width: 33.33%;">'.$ptotalesi.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;width: 33.33%;">'.$e_advance.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;width: 33.33%;">'.$e_timeloss.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_pt.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">'.$e_canteen.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">0</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_lwf.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">'.$e_oth_ded.'</td>
                                            <td style="border-top:1px solid;text-align: right;border-left:1px solid;">'.$ptotalfacility_time_safety_exp.'</td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: right;width: 8%;vertical-align:top">'.$ptotaldeduction.'</td>
                                    <td style="border-left:1px solid;text-align: right;width: 6%;">
                                        <table style="width: 100%;vertical-align:top" cellpadding="5" cellspacing="0">
                                          <tr>
                                            <td style="text-align: right;padding-bottom: 12px;">'.$pnetpayable.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;padding-top: 10px;">&nbsp;</td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: right;width:6%">
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                          <tr>
                                            <td style="text-align: right;">'.$ptotalepf.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$ptotalfpf.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$ptotalesi.'</td>
                                          </tr>
                                          <tr>
                                            <td style="border-top:1px solid;text-align: right;">'.$e_lwf.'</td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 9%">NEFT</td>
                                </tr>
                             </table>
                             <table style="width: 100%;border-left:1px solid;border-bottom:1px solid;" cellpadding="5" cellspacing="0">
                                <tr>
                                  <td style="width:25%">Bank Name : '.$rwselecemployeedata['e_bank_name'].'</td>
                                  <td style="border-left:1px solid;width:25%">Pan No. : '.$rwselecemployeedata['e_pan_no'].'</td>
                                  <td style="border-left:1px solid;width:25%">A/C No. : '.$rwselecemployeedata['e_acc_no'].'</td>
                                  <td style="border-right:1px solid;border-left:1px solid;width:25%">IFSC Code : '.$rwselecemployeedata['e_ifsc_code'].'</td>
                                </tr>
                            </table>';
            $emp_no++;
        }

        $html = '<html>
                    <head><title>'.$monthyearsel2.' Salary Register</title></head>
                    <body style="margin:0">
                      	<table style="width: 100%;border:1px solid;border-bottom:0" cellpadding="8" cellspacing="0">
    	                    <tr>
    	                        <td style="text-align:center;font-size:17px;font-weight:bold">'.strtoupper($_SESSION['company_name']).'</td>
    	                    </tr>
    	                    <tr>
    	                         <td style="text-align:center;font-size:13px;font-weight:bold">'.strtoupper($_SESSION['company_add']).'</td>
    	                    </tr>
    	                </table>
    	                <table style="width: 100%;border:1px solid;border-top:0" cellpadding="8" cellspacing="0">
                            <tr>
                                <td style="text-align:center;font-size:13px;font-weight:bold;width:80%;vertical-align:top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SALARY REGISTER<br/><br/><br/><br/>
                                    <table style="width: 100%;vertical-align:bottom" cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td colspan="4" style="text-align:left;font-size:11px;font-weight:bold">Department : '.strtoupper(get_department($_POST['depart_id'])).'</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;font-size:9px;font-weight:bold;padding-top:10px;width:25%">Month : '.get_month($_POST['month']).' - '.$_POST['year'].'</td>
                                            <td style="text-align:left;font-size:9px;font-weight:bold;padding-top:10px;width:25%">Company PT Code : </td>
                                            <td style="text-align:left;font-size:9px;font-weight:bold;padding-top:10px;width:25%">Company PF Code : '.strtoupper($rwselectcomp['c_pf_code']).'</td>
                                            <td style="text-align:left;font-size:9px;font-weight:bold;padding-top:10px;width:25%">Company ESIC Code : '.strtoupper($rwselectcomp['c_ecis_code']).'</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="text-align:left;font-size:8px;">
                                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="text-align:left;font-size:8px;padding-bottom:4px">[1] The Minimum Wedges Act. 1948</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;font-size:8px;padding-bottom:4px">[2] Labour\'s Payments Register (Factory Act) 1948</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;font-size:8px;padding-bottom:4px">[3] The Payment Of Bonus Act 1965</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;font-size:8px;padding-bottom:4px">[4] (Shop & Est) The Bombay Payment of Wadges Act 1963 as Per Rules -5</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;font-size:8px;padding-bottom:4px">[5] The Contractor Labour (R & A) Act 1970</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;font-size:8px;">[6] The Meternity Benifits Act. 1961</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table style="width: 100%;border:1px solid;border-top:0" cellpadding="0" cellspacing="0">
                         <tr>
                            <td style="text-align: center;font-weight: bold;width:9%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold">Sr. No.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">Emp. Code</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;">Paymode</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;">Designation</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;width:8%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;">Paid Days</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;">L.W.P.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;">Week OFF</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;">Gender</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:13%">Employee Name</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:6%">Salary</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:8%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold">ACTUAL</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">Basic</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">D.A.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">H.R.A.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">Oth. Allow</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:14%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td colspan="3" style="text-align: center;font-weight: bold">EARNINGS</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">Basic</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">Sta. Bonus</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">Edu.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width: 33.33%;">H.R.A.</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">Leave</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 7px;border-left:1px solid;font-weight: bold;width: 33.33%;">Pro. Ince./Attn. Bonus</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">Medical</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">Gratuity</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">OT Amt.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">Conv.</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">Spe. A.</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">ABRY PF</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 6%;">Gross Amount Payable</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:14%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td colspan="3" style="text-align: center;font-weight: bold">DEDUCTIONS</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">P.F.</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">TDS</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">Loan</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width: 33.33%;">E.S.I</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">Advance</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">Time Loss</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">P.T.</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">Canteen</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;">Safety Equi.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">LWF</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">Oth. Ded.</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;">Facility Ex.</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 8%;">Total Deduction</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 6%;">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold;padding-bottom: 12px;">Net Payable</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;padding-top: 10px;">Salary Pay Date</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:6%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold;">Comp.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">E.P.F.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">F.P.F.</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">E.S.I</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">L.W.F</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 9%">Received Signature</td>
                         </tr>
                      </table>'.$employeedata.'<table style="width: 100%;border:1px solid;border-top:0" cellpadding="0" cellspacing="0">
                         <tr>
                            <td style="text-align: left;font-weight: bold;width:25%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td>
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                            <tr>
                                              <td style="font-weight:bold">Department Summary</td>
                                              <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td>Total Dept. Employee :-</td>
                                              <td>'.($emp_no-1).'</td>
                                            </tr>
                                            <tr>
                                              <td>Total Dept. Male Employee :-</td>
                                              <td>'.$maleemployee.'</td>
                                            </tr>
                                            <tr>
                                              <td>Total Dept. Female Employee :-</td>
                                              <td>'.$femaleemployee.'</td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:6%">'.$finalwage.'</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:8%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:20%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-size: 10px;font-weight: bold;width:33.33%">'.$finaltotalbasic.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_sta_bonus.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totaledu_allow.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width: 33.33%;">'.$totalearning_hra.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totalearning_leave_enc.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totalearning_pro_inc_attn_bonus.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width:33.33%">'.$totalearning_medical.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_gratuity.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_ot_amount.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width:33.33%">'.$totalearning_conveyance.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_spe_a.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalabry_pf.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 6%;">'.$pfinaltotalbasic.'</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:14%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-size: 10px;font-weight: bold">'.$totalpff.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totaltdsf.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totalloan_insf.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width: 33.33%;">'.$totalesif.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totaladvancef.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totaltimelossf.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">'.$totalptf.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totalcanteenf.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;">'.$totalsafateyequip.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">'.$totallwff.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totaloth_dedf.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;">'.$totalfacility_time_safety_expp.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 8%;">'.$pfinaldeduction.'</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 6%;">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold;padding-bottom: 12px;">'.round($pfinalnetpayable).'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;padding-top: 10px;">&nbsp;</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:6%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold;">'.$ptotalepff.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">'.$ptotalfpff.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">'.$ptotalesif.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">'.$e_lwff.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 9%">&nbsp;</td>
                         </tr>
                      </table>
                      <table style="width: 100%;border:1px solid;border-top:0" cellpadding="0" cellspacing="0">
                         <tr>
                            <td style="text-align: left;font-weight: bold;width:25%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td>
                                        <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                            <tr>
                                              <td style="font-weight:bold">Total Summary</td>
                                              <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td>Total Employee :-</td>
                                              <td>'.($emp_no-1).'</td>
                                            </tr>
                                            <tr>
                                              <td>Total Male Employee :-</td>
                                              <td>'.$maleemployee.'</td>
                                            </tr>
                                            <tr>
                                              <td>Total Female Employee :-</td>
                                              <td>'.$femaleemployee.'</td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:6%">'.$finalwage.'</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:8%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold">&nbsp;</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:20%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-size: 10px;font-weight: bold;width:33.33%">'.$finaltotalbasic.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_sta_bonus.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totaledu_allow.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width: 33.33%;">'.$totalearning_hra.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totalearning_leave_enc.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totalearning_pro_inc_attn_bonus.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width:33.33%">'.$totalearning_medical.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_gratuity.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_ot_amount.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width:33.33%">'.$totalearning_conveyance.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalearning_spe_a.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width:33.33%">'.$totalabry_pf.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 6%;">'.$pfinaltotalbasic.'</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:14%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-size: 10px;font-weight: bold">'.$totalpff.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totaltdsf.'</td>
                                    <td style="text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totalloan_insf.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold;width: 33.33%;">'.$totalesif.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totaladvancef.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;width: 33.33%;">'.$totaltimelossf.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">'.$totalptf.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totalcanteenf.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;">'.$totalsafateyequip.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;font-weight: bold">'.$totallwff.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold">'.$totaloth_dedf.'</td>
                                    <td style="border-top:1px solid;text-align: center;font-size: 10px;border-left:1px solid;font-weight: bold;">'.$totalfacility_time_safety_expp.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 8%;">'.$pfinaldeduction.'</td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 6%;">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold;padding-bottom: 12px;">'.round($pfinalnetpayable).'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;padding-top: 10px;">&nbsp;</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width:6%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td style="text-align: center;font-weight: bold;">'.$ptotalepff.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">'.$ptotalfpff.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">'.$ptotalesif.'</td>
                                  </tr>
                                  <tr>
                                    <td style="border-top:1px solid;text-align: center;font-weight: bold;">'.$e_lwff.'</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="border-left:1px solid;text-align: center;font-weight: bold;width: 9%">&nbsp;</td>
                         </tr>
                      </table><table style="width: 100%;border:1px solid;border-top:0" cellpadding="5" cellspacing="0">
                         <tr>
                            <td style="text-align: left;font-weight: bold;width:33.33%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                      <td>D.A.</td>
                                      <td>:-</td>
                                      <td>Dearness Allowance</td>
                                  </tr>
                                  <tr>
                                      <td>H.R.A.</td>
                                      <td>:-</td>
                                      <td>House Rent Allowance</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="text-align: left;font-weight: bold;width:33.33%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                      <td>Sta.Bonus</td>
                                      <td>:-</td>
                                      <td>Statutory Bonus</td>
                                  </tr>
                                  <tr>
                                      <td>Leave Enc.</td>
                                      <td>:-</td>
                                      <td>Leave Encashment</td>
                                  </tr>
                                </table>
                            </td>
                            <td style="text-align: left;font-weight: bold;width:33.33%">
                                <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                  <tr>
                                      <td>Spe. A.</td>
                                      <td>:-</td>
                                      <td>Special Allowance</td>
                                  </tr>
                                  <tr>
                                      <td>Edu.</td>
                                      <td>:-</td>
                                      <td>Education Allowance</td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          </table>
                    </body>
                </html>';
      

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'L']);
        $mpdf->AddPageByArray(['margin-left' => 5,'margin-right' => 5,'margin-top' => 5,'margin-bottom' => 5,]);
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->WriteHTML($html);
        $mpdf->Output("UploadImages/Salary_Register/".$filename, 'F');
        echo '<iframe src="'.SITE_ROOT_FRONT.'UploadImages/Salary_Register/'.$filename.'" style="width: 100%;height: 600px;"></iframe>';
        exit;
?>