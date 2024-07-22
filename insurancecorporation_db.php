<?php   include_once 'inc/connection.php';
        include_once 'inc/functions.php';
        $monthyearsel2 = $_POST['month']."-".$_POST['year'];
        $curmnth = $_POST['month'];
        $curyear = $_POST['year'];
        $totDays = get_days_in_month($curmnth, $curyear);
        $dt = $_POST['year']."-".$_POST['month']."-01";
        $filename = $monthyearsel2."-insurancecorporation.pdf";
        require_once 'MPDF/vendor/autoload.php';
        $html2 = '';
        $p = 1;
        $totalipcontribution = 0;
        $totalcontribution = 0;
        $totalemployercontribution = 0;
        $finalwage = 0;
        for($j=0;$j<count($_POST['employee_id']);$j++){
            $employeeid = $_POST['employee_id'][$j];
            $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
            $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
            $presentstotal = 0;
            $absenttotal = 0;
            $paidleavetotal = 0;
            $finaltotal = 0;
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
              
            if($rwselecemployeedata['e_facility_time_safety_exp'] != ""){
                $e_facility_time_safety_exp = $rwselecemployeedata['e_facility_time_safety_exp'];
            }else{
                $e_facility_time_safety_exp = 0.00;
            }
            
            if($rwselecemployeedata['e_emp_contribution'] != ""){
                $e_emp_contribution = $rwselecemployeedata['e_emp_contribution'];
            }else{
                $e_emp_contribution = 0;
            }
            
            $finaltotal = $finaltotal + $presentstotal + $paidleavetotal;
            $totalwedge = $finaltotal*$ewages;
            $ipcontribution = $totalwedge * $e_emp_contribution / 100;
            $tcontribution = $totalwedge * ($e_esi + $e_emp_contribution) / 100;
            $leavedata = "-";
            if($finaltotal == "0"){
                $totalwedge = "0";
                $leavedata = "On Leave";
            }
            $totalipcontribution = $totalipcontribution + $ipcontribution;
            $totalcontribution = $totalcontribution + $tcontribution;
            $totalemployercontribution = $totalemployercontribution + $totalcontribution - $totalipcontribution;
            $finalwage = $finalwage + $totalwedge;
            $html2 .= '<tr>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 7%;border-top:0;font-size:12px;">'.$p.'</td>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 8%;border-left: 0;border-top:0;font-size:12px;">-</td>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 10%;border-left: 0;border-top:0;font-size:12px;">'.$rwselecemployeedata['e_esic_no'].'</td>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 25.5%;border-left: 0;border-top:0;font-size:12px;">'.strtoupper($rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname']).'</td>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 8%;border-left: 0;border-top:0;font-size:12px;">'.$finaltotal.'</td>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 10%;border-left: 0;border-top:0;font-size:12px;">'.number_format((float)$totalwedge, 2, '.', '').'</td>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 10%;border-left: 0;border-top:0;font-size:12px;">'.number_format((float)$ipcontribution, 2, '.', '').'</td>
                            <td style="border: 1px solid;font-weight: bold;padding: 10px 5px;width: 20.5%;border-left: 0;border-top:0;font-size:12px;">'.$leavedata.'</td>
                        </tr>';
            $p++;
        }
        
        $html = '<html>
                    <head><title>'.$monthyearsel2.' Insurance Corporation</title></head>
                    <body style="margin:0">
                        <table style="width: 100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 40%;padding:20px 40px"><img src="'.SITE_ROOT_FRONT.'/img/pdf_logo.png" /></td>
                                <td>
                                    <table style="width: 100%;margin-bottom:30px" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><div style="font-size: 20px;text-align: center;font-weight: bold;text-decoration: underline;">Employees\' State Insurance Corporation</div></td>
                                        </tr>
                                    </table>  
                                    <table style="width: 100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><div style="font-size: 15px;text-align: center;padding:0 15px 15px">Contribution History Of 37001213990001099 for Oct2023</div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 10px 0;width: 20%;font-size:12px;">Total IP Contribution</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 10px 0;width: 20%;border-left: 0;font-size:12px;">Total Employer Contribution</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 10px 0;width: 20%;border-left: 0;font-size:12px;">Total Contribution</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 10px 0;width: 20%;border-left: 0;font-size:12px;">Total Goverment Contribution</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;text-align: center;padding: 10px 0;width: 20%;border-left: 0;font-size:12px;">Total Monthly Wages</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;font-weight: bold;text-align: center;padding: 10px 0;width: 20%;border-top:0;font-size:12px;">'.number_format((float)$totalipcontribution, 2, '.', '').'</td>
                                <td style="border: 1px solid;font-weight: bold;text-align: center;padding: 10px 0;width: 20%;border-left: 0;border-top:0;font-size:12px;">'.number_format((float)$totalemployercontribution, 2, '.', '').'</td>
                                <td style="border: 1px solid;font-weight: bold;text-align: center;padding: 10px 0;width: 20%;border-left: 0;border-top:0;font-size:12px;">'.number_format((float)$totalcontribution, 2, '.', '').'</td>
                                <td style="border: 1px solid;font-weight: bold;text-align: center;padding: 10px 0;width: 20%;border-left: 0;border-top:0;font-size:12px;">0.00</td>
                                <td style="border: 1px solid;font-weight: bold;text-align: center;padding: 10px 0;width: 20%;border-left: 0;border-top:0;font-size:12px;">'.number_format((float)$finalwage, 2, '.', '').'</td>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 7%;border-top:0;font-size:12px;">SNo.</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 8%;border-left: 0;border-top:0;font-size:12px;">Is Disable</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 10%;border-left: 0;border-top:0;font-size:12px;">IP Number</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 25.5%;border-left: 0;border-top:0;font-size:12px;">IP Name</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 8%;border-left: 0;border-top:0;font-size:12px;">No. Of Days</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 10%;border-left: 0;border-top:0;font-size:12px;">Total Wages</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 10%;border-left: 0;border-top:0;font-size:12px;">IP Contribution</td>
                                <td style="border: 1px solid;font-weight: bold;background: #ccc;padding: 10px 5px;width: 20.5%;border-left: 0;border-top:0;font-size:12px;">Reason</td>
                            </tr>'.$html2.'
                        </table>
                        <table cellpadding="0" cellspacing="0" style="width: 100%;margin-top: 25px;">
                            <tr>
                                <td style="width: 80%;">&nbsp;</td>
                                <td><font style="font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> '.date('h:i:s A').'</td>
                            </tr>
                            <tr>
                                <td style="width: 80%;">&nbsp;</td>
                                <td><font style="font-weight: bold">Printed On:</font> '.date("d/m/Y").'</td>
                            </tr>
                        </table>
                    </body>
                </html>';
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'L']);
        $mpdf->AddPageByArray(['margin-left' => 5,'margin-right' => 5,'margin-top' => 5,'margin-bottom' => 5,]);
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->WriteHTML($html);
        $mpdf->Output("UploadImages/insurance_corporation/".$filename, 'F');
        echo '<iframe src="'.SITE_ROOT_FRONT.'UploadImages/insurance_corporation/'.$filename.'" style="width: 100%;height: 600px;"></iframe>';
        exit;
?>