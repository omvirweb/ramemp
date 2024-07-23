<?php include_once 'inc/connection.php';
      include_once 'inc/functions.php';
      $action = $_POST['action'];
    //   $target_dir = "UploadImages/employee/";
    if($action == 'add'){
          $errors = "";
          if(!(isset($_POST["contract_name"]) && trim($_POST["contract_name"] != ""))){
              $errors .= "name Is Required.<br/>";
          }

          if(!(isset($_POST["daterange"]) && trim($_POST["daterange"] != ""))){
            $errors .= "Daterange Is Required.<br/>";
          }

          if(!(isset($_POST["depart_id"]) && trim($_POST["depart_id"] != ""))){
              $errors .= "Department Is Required.<br/>";
          }
          
          if(!(isset($_POST["designation_id"]) && trim($_POST["designation_id"] != ""))){
              $errors .= "Designation Is Required.<br/>";
          }

          if(!(isset($_POST["wage_rate"]) && trim($_POST["wage_rate"] != ""))){
              $errors .= "Wage Rate Is Required.<br/>";
          }

          if(!(isset($_POST["pf"]) && trim($_POST["pf"] != ""))){
              $errors .= "PF Is Required.<br/>";
          }

          if(!(isset($_POST["esic"]) && trim($_POST["esic"] != ""))){
              $errors .= "ESIC Is Required.<br/>";
          }

          if(!(isset($_POST["edli"]) && trim($_POST["edli"] != ""))){
              $errors .= "EDLI Is Required.<br/>";
          }
          
          if(!(isset($_POST["bonus"]) && trim($_POST["bonus"] != ""))){
              $errors .= "Bonus  Is Required.<br/>";
          }
          if(!(isset($_POST["epfo_charge"]) && trim($_POST["epfo_charge"] != ""))){
            $errors .= "EPFO charge  Is Required.<br/>";
            }

        if(!(isset($_POST["service_charge"]) && trim($_POST["service_charge"] != ""))){
          $errors .= "Service charge Is Required.<br/>";
        }

        if(!(isset($_POST["working_days"]) && trim($_POST["working_days"] != ""))){
            $errors .= "Working Days Is Required.<br/>";
          }

          if(!(isset($_POST["role"]) && trim($_POST["role"] != ""))){
            $errors .= "Role Is Required.<br/>";
          }

          
          if(!(isset($_POST["payment_mode"]) && trim($_POST["payment_mode"] != ""))){
            $errors .= "Payment Mode Is Required.<br/>";
          }

          if(!(isset($_POST["email"]) && trim($_POST["email"] != ""))){
            $errors .= "Email Is Required.<br/>";
          }

          if(!(isset($_POST["gstin"]) && trim($_POST["gstin"] != ""))){
            $errors .= "GSTIN Is Required.<br/>";
          }

          if(!(isset($_POST["address"]) && trim($_POST["address"] != ""))){
            $errors .= "Address Is Required.<br/>";
          }

          $daterange = $_POST['daterange'];
          $date = (explode("-",$daterange));
          $start_date = date("Y-m-d", strtotime($date[0]));
          $end_date = date("Y-m-d", strtotime($date[1]));
        //   $end_date = date_format()$date[1];
        //   print_r($start_date);exit;
          $selectunitname = mysqli_query($link,"select * from contract where name='".$_POST["contract_name"]."' and designation_id='".$_POST['designation_id']."'");
          if(mysqli_num_rows($selectunitname)>0){
              $errors .= "Name Already Exists.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

       

        //   $acc_nodata = $_POST['e_acc_no1']."".$_POST['e_acc_no2']."".$_POST['e_acc_no3']."".$_POST['e_acc_no4']."".$_POST['e_acc_no5']."".$_POST['e_acc_no6']."".$_POST['e_acc_no7']."".$_POST['e_acc_no8']."".$_POST['e_acc_no9']."".$_POST['e_acc_no10']."".$_POST['e_acc_no11']."".$_POST['e_acc_no12']."".$_POST['e_acc_no13']."".$_POST['e_acc_no14']."".$_POST['e_acc_no15']."".$_POST['e_acc_no16']."".$_POST['e_acc_no17']."".$_POST['e_acc_no18'];
          
        //   $ifsc_nodata = $_POST['e_ifsc_code1']."".$_POST['e_ifsc_code2']."".$_POST['e_ifsc_code3']."".$_POST['e_ifsc_code4']."".$_POST['e_ifsc_code5']."".$_POST['e_ifsc_code6']."".$_POST['e_ifsc_code7']."".$_POST['e_ifsc_code8']."".$_POST['e_ifsc_code9']."".$_POST['e_ifsc_code10']."".$_POST['e_ifsc_code11'];
          

          $update_qry = "INSERT INTO `contract`(`name`, `designation_id`, `depart_id`, `wage_rate`, `pf`, `esic`, `edli`, `bonus`, `epfo_charge`, `start_date`, `end_date`, `service_charge`, `working_days`, `role`, `payment_mode`, `email`, `gstin`, `address`) VALUES ('".$_POST['contract_name']."','".$_POST['designation_id']."','".$_POST['depart_id']."','".$_POST['wage_rate']."','".$_POST['pf']."','".$_POST['esic']."','".$_POST['edli']."','".$_POST['bonus']."','".$_POST['epfo_charge']."','".$start_date."','".$end_date."','".$_POST['service_charge']."','".$_POST['working_days']."','".$_POST['role']."','".$_POST['payment_mode']."','".$_POST['email']."','".$_POST['gstin']."','".$_POST['address']."')";  
          $run_upd = mysqli_query($link,$update_qry); 
        //   print_r($run_upd);exit;
          $_SESSION["msg"] = "<div class='alert alert-success'>Contract ".ucfirst($_POST['contract_name'])." Inserted Successfully.</div>";
          header("location:contract.php");
          exit();

      }else if($action == 'edit'){
          $errors = "";
          if(!(isset($_POST["contract_name"]) && trim($_POST["contract_name"] != ""))){
            $errors .= "name Is Required.<br/>";
        }
        
        if(!(isset($_POST["depart_id"]) && trim($_POST["depart_id"] != ""))){
            $errors .= "Department Is Required.<br/>";
        }
        
        if(!(isset($_POST["daterange"]) && trim($_POST["daterange"] != ""))){
            $errors .= "Daterange Is Required.<br/>";
        }
        
        if(!(isset($_POST["designation_id"]) && trim($_POST["designation_id"] != ""))){
            $errors .= "Designation Is Required.<br/>";
        }

        if(!(isset($_POST["wage_rate"]) && trim($_POST["wage_rate"] != ""))){
            $errors .= "Wage Rate Is Required.<br/>";
        }

        if(!(isset($_POST["pf"]) && trim($_POST["pf"] != ""))){
            $errors .= "PF Is Required.<br/>";
        }

        if(!(isset($_POST["esic"]) && trim($_POST["esic"] != ""))){
            $errors .= "ESIC Is Required.<br/>";
        }

        if(!(isset($_POST["edli"]) && trim($_POST["edli"] != ""))){
            $errors .= "EDLI Is Required.<br/>";
        }
        
        if(!(isset($_POST["bonus"]) && trim($_POST["bonus"] != ""))){
            $errors .= "Bonus  Is Required.<br/>";
        }
        if(!(isset($_POST["epfo_charge"]) && trim($_POST["epfo_charge"] != ""))){
          $errors .= "EPFO charge  Is Required.<br/>";
          }

      if(!(isset($_POST["service_charge"]) && trim($_POST["service_charge"] != ""))){
        $errors .= "Service charge Is Required.<br/>";
      }

      if(!(isset($_POST["working_days"]) && trim($_POST["working_days"] != ""))){
          $errors .= "Working Days Is Required.<br/>";
        }

        if(!(isset($_POST["role"]) && trim($_POST["role"] != ""))){
          $errors .= "Role Is Required.<br/>";
        }

        
        if(!(isset($_POST["payment_mode"]) && trim($_POST["payment_mode"] != ""))){
          $errors .= "Payment Mode Is Required.<br/>";
        }

        if(!(isset($_POST["email"]) && trim($_POST["email"] != ""))){
          $errors .= "Email Is Required.<br/>";
        }

        if(!(isset($_POST["gstin"]) && trim($_POST["gstin"] != ""))){
          $errors .= "GSTIN Is Required.<br/>";
        }

        if(!(isset($_POST["address"]) && trim($_POST["address"] != ""))){
          $errors .= "Address Is Required.<br/>";
        }

        $selectunitname = mysqli_query($link,"select * from contract where name='".$_POST["contract_name"]."' and designation_id='".$_POST['designation_id']."'");
        if(mysqli_num_rows($selectunitname)>0){
            $errors .= "Name Already Exists.<br/>";
        }
         

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

        //   if ($_FILES["e_photo"]["size"] > 0) {
        //     $img1 = basename($_FILES["e_photo"]["name"]);
        //     $target_file = $target_dir . $img1;
        //     move_uploaded_file($_FILES["e_photo"]["tmp_name"], $target_file);            
        //   }else{
        //     $img1 = $_POST['hidden_logo'];
        //   }
          
        //   $acc_nodata = $_POST['e_acc_no1']."".$_POST['e_acc_no2']."".$_POST['e_acc_no3']."".$_POST['e_acc_no4']."".$_POST['e_acc_no5']."".$_POST['e_acc_no6']."".$_POST['e_acc_no7']."".$_POST['e_acc_no8']."".$_POST['e_acc_no9']."".$_POST['e_acc_no10']."".$_POST['e_acc_no11']."".$_POST['e_acc_no12']."".$_POST['e_acc_no13']."".$_POST['e_acc_no14']."".$_POST['e_acc_no15']."".$_POST['e_acc_no16']."".$_POST['e_acc_no17']."".$_POST['e_acc_no18'];
          
        //   $ifsc_nodata = $_POST['e_ifsc_code1']."".$_POST['e_ifsc_code2']."".$_POST['e_ifsc_code3']."".$_POST['e_ifsc_code4']."".$_POST['e_ifsc_code5']."".$_POST['e_ifsc_code6']."".$_POST['e_ifsc_code7']."".$_POST['e_ifsc_code8']."".$_POST['e_ifsc_code9']."".$_POST['e_ifsc_code10']."".$_POST['e_ifsc_code11'];

        //   $e_pt = 0;
        //   if(isset($_POST['e_pt'])){
        //       $e_pt = 1;
        //   }
          
        //   $e_pf = 0;
        //   if(isset($_POST['e_pf'])){
        //       $e_pf = 1;
        //   }
          
        //   $e_esi = 0;
        //   if(isset($_POST['e_esi'])){
        //       $e_esi = 1;
        //   }

  
          $update_qry = "UPDATE `contract` SET `name`='".$_POST['contract_name']."',`designation_id`='".$_POST['designation_id']."',`depart_id`='".$_POST['depart_id']."',`wage_rate`='".$_POST['wage_rate']."',`pf`='".$_POST['pf']."',`esic`='".$_POST['esic']."',`edli`='".$_POST['edli']."',`bonus`='".$_POST['bonus']."',`epfo_charge`='".$_POST['epfo_charge']."',`service_charge`='".$_POST['service_charge']."',`working_days`='".$_POST['working_days']."',`role`='".$_POST['role']."',`payment_mode`='".$_POST['payment_mode']."',`email`='".$_POST['email']."',`gstin`='".$_POST['gstin']."',`address`='".$_POST['address']."'  WHERE `id`='".$_POST["id"]."'";

          $run_upd = mysqli_query($link,$update_qry); 
        //   print_r($run_upd);
          $_SESSION["msg"] = "<div class='alert alert-success'>Contract ".ucfirst($_POST["name"])." Updated Successfully.</div>";
          header("location:contract.php");
          exit();

      }else if($action == 'delete'){ 
          $update_qry = "delete from contract where id='".$_POST["id"]."'";
          $run_upd = mysqli_query($link,$update_qry); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Contract Deleted Successfully.</div>";
          echo "contract.php";
      }else if($action == 'letterofallotment'){ 
          require_once 'MPDF/vendor/autoload.php';
          
          $filename = "letterofallotment.pdf";
          $html2 = "";
          
          for($j=0;$j<count($_POST['contract_id']);$j++){
          $contractid = $_POST['contract_id'][$j];
          $selecemployeedata = mysqli_query($link,"select * from contract where id='".$contractid."'");
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