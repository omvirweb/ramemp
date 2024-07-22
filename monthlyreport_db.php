<?php include_once 'inc/connection.php';
      include_once 'inc/functions.php';
      $monthyearsel2 = $_POST['month']."-".$_POST['year'];
      $dt = $_POST['year']."-".$_POST['month']."-01";
      $filename = $monthyearsel2."-monthlyreport.pdf";
      require_once 'MPDF/vendor/autoload.php';

      $employeedata = "";
      $p=1;
      $finaltotal = 0;
      for($j=0;$j<count($_POST['employee_id']);$j++){
          $employeeid = $_POST['employee_id'][$j];
          $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$employeeid."'");
          $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
          $employeedata .= '<tr>
                                <td style="text-align: center;border:1px solid;border-top:0">'.$p.'</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">'.$rwselecemployeedata['e_id'].'</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">'.$rwselecemployeedata['e_firstname']." ".$rwselecemployeedata['e_fathername']." ".$rwselecemployeedata['e_lastname'].'</td>
                                <td style="vertical-align: top;text-align: center;border:1px solid;border-left:0;border-top:0">
                                  <table style="width: 100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td style="border-right: 1px solid;text-align: center;">&nbsp;</td>
                                      <td style="height:50px;display:block"><div style="text-align: center;padding: 11px 0 0;">-</div></td>
                                    </tr>
                                  </table>
                                </td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">-</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">-</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">'.get_month($_POST['month']).' '.$_POST['year'].'</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">
                                  <table style="width: 100%" cellpadding="0" cellspacing="0">
                                      <tr>';
                                      $totalpresntscount = 0;
                                      $totalabpresntscount = 0;
                                      $totalableavescount = 0;
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
                                        $borderdata = "border-right: 1px solid";
                                        if($day == "31"){
                                            $borderdata = "";
                                        }
                                        $employepresents = "A";
                                        
                                        if(mysqli_num_rows($selectattendence2)>0){
                                            $rwselectattendence = mysqli_fetch_array($selectattendence2);
                                            if($rwselectattendence['ea_emp_attendance_type'] == "1"){
                                                $employepresents = "P";
                                                $totalpresntscount = $totalpresntscount + 1;
                                            }

                                            if($rwselectattendence['ea_emp_attendance_type'] == "2"){
                                                $employepresents = "P<br/>L";
                                                $totalabpresntscount = $totalabpresntscount + 1;
                                            }

                                            if($rwselectattendence['ea_emp_attendance_type'] == "0"){
                                                $employepresents = "A";
                                                $totalableavescount = $totalableavescount + 1;
                                            }

                                        }
                                      
                                          $employeedata .= '<td style="'.$borderdata.';border-right: 1px solid;text-align: center;height:50px;display:block">'.$employepresents.'</td>';
                                        
                                        }
                                        $totalpcount = $totalpresntscount+$totalabpresntscount;

                           $employeedata .= '</tr>
                                  </table>
                                </td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">'.$totalpresntscount.'</td>
                                <td style="vertical-align: top;text-align: center;border:1px solid;border-left:0;border-top:0">
                                  <table style="width: 100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td style="border-right: 1px solid;text-align: center;">-</td>
                                      <td style="border-right: 1px solid;height:50px;display:block">-</td>
                                      <td style="border-right: 1px solid;height:50px;display:block">-</td>
                                      <td style="border-right: 1px solid;height:50px;display:block">'.$totalabpresntscount.'</td>
                                      <td style="height:50px;display:block">'.$totalableavescount.'</td>
                                    </tr>
                                  </table>
                                </td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">-</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">-</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">0.00</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">-</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">'.$totalpcount.'</td>
                                <td style="text-align: center;border:1px solid;border-left:0;border-top:0">&nbsp;</td>
                            </tr>';

          $p++;
          $finaltotal = $finaltotal + $totalpcount;
      }
      
      $html = '<html>
                  <head><title>'.$monthyearsel2.' Monthly Report</title>
                  
                  </head>

  <body style="margin:0">
    <div style="text-align: center;font-weight: bold;font-size: 22px;margin-bottom:40px;">FORM NO. 28 <br/> <font style="font-size: 12px;font-weight: normal;">(Prescribed under Rule 110)</font></div>
    <div style="width:100%">
      <div style="float: left;width: 63%;padding-left: 20px;">
          <table>
             <tr>
               <td style="font-weight: bold;width: 38%">NAME OF ESTABLISHMENT</td>
               <td style="font-weight: bold;width: 3%">:</td>
               <td style="font-weight: bold;">'.strtoupper($_SESSION['company_name']).'</td>
             </tr>
             <tr>
               <td style="font-weight: bold;">ADDRESS OF ESTABLISHMENT</td>
               <td style="font-weight: bold;">:</td>
               <td style="font-weight: bold;">'.strtoupper($_SESSION['company_add']).'</td>
             </tr>
          </table>
      </div>
      <div style="float: right;width: 30%;padding-right: 20px">
        <div style="font-size: 8px;">1. Form Under Rule-6 of Eual Remuneration Rules, 1976</div>
        <div style="font-size: 8px;">2. Form Under Rule-25(2) of Gujarat Minimum Wages Rule, 1961</div>
        <div style="font-size: 8px;">3. Form Under Rule-110 of Gujarat Factories Rules, 1963</div>
        <div style="font-size: 8px;">4. From Under Rule-78 of Contract Labour (Regulation & Abolition) Gujarat Rules</div>
        <div style="font-size: 8px;">5. From Under Rule-52(2) Of Inter State Migrant Workers(Gujarat) Rules</div>
      </div>
    </div>
    <div style="clear: both;"></div>
    <div style="font-weight: bold;text-align: right;font-size: 13px;margin-top: 25px">[Department :- '.strtoupper(get_department($_POST['depart_id'])).']</div>
    <div style="width: 100%">
      <div style="float: left;width: 33.33%">From date: '.date("01/m/Y", strtotime($dt)).' to '.date("t/m/Y", strtotime($dt)).'</div>
      <div style="float: left;width: 33.33%;font-weight: bold;text-align: center;font-size: 17px">Monthly Muster</div>
      <div style="float: left;width: 33.33%;font-weight: bold;text-align: right;">Department : <font style="font-weight: normal;">'.strtoupper(get_department($_POST['depart_id'])).'</font></div>
    </div>
    <div style="clear: both;"></div>
    <table style="width: 100%;margin-top: 10px" cellpadding="5" cellspacing="0">
      <tr>
        <td style="border:1px solid">Sr. No.</td>
        <td style="border:1px solid;border-left:0;width:auto;text-align:center"><div style="text-align: center;">Register Of Workmane Sr. No</div></td>
        <td style="border:1px solid;border-left:0;text-align:center"><span>Name Of worker / Father / Husband Name & Date of Appoitment</span></td>
        <td  style="vertical-align: top;text-align: center;border:1px solid;border-left:0"><div style="padding: 13px 0">Group to which the worker belong</div>
          <table style="width: 100%" cellpadding="5" cellspacing="0">
            <tr>
              <td style="border-top: 1px solid;border-right: 1px solid;text-align: center;">Occupation</td>
              <td style="border-top: 1px solid;height:160px;display:block"><div style="text-align: center;">Alphabet</div></td>
            </tr>
          </table>
        </td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Number of relay If working In Shift</div></td>
        <td style="vertical-align: top;border:1px solid;border-left:0;text-align:center">
          <table style="width: 100%" cellpadding="5" cellspacing="0">
              <tr>
                <td style="border-bottom: 1px solid;text-align: center;padding: 8px 0;">Adolescent if certified</td>
              </tr>
              <tr>
                <td style="border-bottom: 1px solid;text-align: center;padding: 8px 0;">Number & date of certificate</td>
              </tr>  
              <tr>
                <td style="text-align: center;padding: 8px 0;">Token number</td>
              </tr>
          </table>
        </td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Period of Work</div></td>
        <td style="vertical-align: top;text-align: center;border:1px solid;border-left:0"><div style="height: 27px;padding-top: 10px">Daily Attendence for the month of</div> 
          <table style="width: 100%" cellpadding="5" cellspacing="0">
              <tr style="height: 40px">
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">1</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">2</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">3</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">4</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">5</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">6</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">7</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">8</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">9</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">10</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">11</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">12</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">13</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">14</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">15</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">16</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">17</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">18</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">19</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">20</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">21</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">22</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">23</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">24</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">25</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">26</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">27</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">28</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">29</div></td>
                <td style="border-top: 1px solid;border-right: 1px solid;height:175px;display:block"><div style="text-align: center;">30</div></td>
                <td style="border-top: 1px solid;height:175px;display:block"><div style="text-align: center;">31</div></td>
              </tr>
          </table>
        </td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Total number of mandays worked</div></td>
        <td style="vertical-align: top;text-align: center;border:1px solid;border-left:0;text-align:center"><div>Man days lost due to</div>
          <table style="width: 100%" cellpadding="5" cellspacing="0">
            <tr>
              <td style="border-top: 1px solid;border-right: 1px solid;text-align:center;height:175px;display:block"><div style="text-align: center;">Strike</div></td>
              <td style="border-top: 1px solid;border-right: 1px solid;text-align:center;height:175px;display:block"><div style="text-align: center;">Lay off</div></td>
              <td style="border-top: 1px solid;border-right: 1px solid;text-align:center;height:175px;display:block"><div style="text-align: center;">Lock out</div></td>
              <td style="border-top: 1px solid;border-right: 1px solid;text-align:center;height:175px;display:block"><div style="text-align: center;">PL</div></td>
              <td style="border-top: 1px solid;;text-align:center;height:175px;display:block"><div style="text-align: center;">LWP</div></td>
            </tr>
          </table>
        </td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Any other person</div></td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Total of 1,15 to Col. 20</div></td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Number of festival & national holiday</div></td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Number of weekly holidays (off) paid for</div></td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Total mandays paid for</div></td>
        <td style="border:1px solid;border-left:0;text-align:center"><div style="text-align: center;">Remarks</div></td>
      </tr>
      <tr>
        <td style="text-align: center;border:1px solid;border-top:0">1</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">2</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">3 & 4 & 5</td>
        <td style="vertical-align: top;text-align: center;border:1px solid;border-left:0;border-top:0">
          <table style="width: 100%" cellpadding="0" cellspacing="0">
            <tr>
              <td style="border-right: 1px solid;text-align: center;">6</td>
              <td style=""><div style="height: 30px;text-align: center;padding: 11px 0 0;">7</div></td>
            </tr>
          </table>
        </td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">8</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">9 & 10</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">11</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">12</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">13</td>
        <td style="vertical-align: top;text-align: center;border:1px solid;border-left:0;border-top:0">
          <table style="width: 100%" cellpadding="0" cellspacing="0">
            <tr>
              <td style="border-right: 1px solid;text-align: center;">14</td>
              <td style="border-right: 1px solid;text-align: center;"><div style="height: 30px;text-align: center;padding: 11px 0 0;">15</div></td>
              <td style="border-right: 1px solid;text-align: center;"><div style="height: 30px;text-align: center;padding: 11px 0 0;">16</div></td>
              <td style="border-right: 1px solid;text-align: center;"><div style="height: 30px;text-align: center;padding: 11px 0 0;">17</div></td>
              <td style=""><div style="height: 30px;text-align: center;padding: 11px 0 0;">18</div></td>
            </tr>
          </table>
        </td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">19</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">20</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">21</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">22</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">23</td>
        <td style="text-align: center;border:1px solid;border-left:0;border-top:0">24</td>
      </tr>'.$employeedata.'<tr>
          <td colspan="12" style="text-align: center;border:1px solid;border-top:0">&nbsp;</td>
          <td colspan="2" style="text-align: center;border:1px solid;border-left:0;border-top:0">Total Days</td>
          <td style="text-align: center;border:1px solid;border-left:0;border-top:0">'.$finaltotal.'</td>
          <td style="text-align: center;border:1px solid;border-left:0;border-top:0">&nbsp;</td>
      </tr></table>
  </body>
</html>';

      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'L']);
      $mpdf->AddPageByArray([
    'margin-left' => 15,
    'margin-right' => 15,
    'margin-top' => 10,
    'margin-bottom' => 0,]);
      $mpdf->setAutoTopMargin = 'stretch';
      $mpdf->setAutoBottomMargin = 'stretch';
      $mpdf->WriteHTML($html);
      $mpdf->Output("UploadImages/monthlyreport/".$filename, 'F');
      echo '<iframe src="'.SITE_ROOT_FRONT.'UploadImages/monthlyreport/'.$filename.'" style="width: 100%;height: 600px;"></iframe>';
      exit;
?>