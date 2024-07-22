<?php include_once 'inc/connection.php';
      include_once 'inc/functions.php';
      $action = $_REQUEST['action'];
      if($action == 'add'){
          $errors = "";
          if(!(isset($_POST["inv_date"]) && trim($_POST["inv_date"] != ""))){
              $errors .= "Date Is Required.<br/>";
          }

          if(!(isset($_POST["inv_to"]) && trim($_POST["inv_to"] != ""))){
              $errors .= "Name Is Required.<br/>";
          }

          if(!(isset($_POST["inv_to_city"]) && trim($_POST["inv_to_city"] != ""))){
              $errors .= "City Is Required.<br/>";
          }

          if(!(isset($_POST["inv_subject"]) && trim($_POST["inv_subject"] != ""))){
              $errors .= "Subject Is Required.<br/>";
          }

          if(!(isset($_POST["inv_gst_per"]) && trim($_POST["inv_gst_per"] != ""))){
              $errors .= "GST Is Required.<br/>";
          }

          if(!(isset($_POST["inv_to_add"]) && trim($_POST["inv_to_add"] != ""))){
              $errors .= "Address Is Required.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          $selectincrement = mysqli_query($link,"select * from invoice where inv_com_id='".$_SESSION['company_id']."'");
          $nmselectincrement = mysqli_num_rows($selectincrement);
          if($nmselectincrement > 0){
            $nmselectincrement = $nmselectincrement + 1;
          }else{
            $nmselectincrement = 1;
          }
          $update_qry = "INSERT INTO `invoice`(`inc_icre_id`, `inv_com_id`, `inv_to`, `inv_to_add`, `inv_to_city`, `inv_date`, `inv_subject`, `inv_gst_per`, `inv_note`,`inv_service_charge`) VALUES ('".$nmselectincrement."','".$_SESSION['company_id']."','".$_POST['inv_to']."','".$_POST['inv_to_add']."','".$_POST['inv_to_city']."','".$_POST['inv_date']."','".$_POST['inv_subject']."','".$_POST['inv_gst_per']."','".$_POST['inv_note']."','".$_POST['inv_service_charge']."')";  
          mysqli_query($link,$update_qry); 
          $lastid = mysqli_insert_id($link);

          for($j=0;$j<count($_POST['inv_d_item']);$j++){
              $item_name = $_POST['inv_d_item'][$j];
              $item_qty = $_POST['inv_d_qty'][$j];
              $item_rate = $_POST['inv_d_rate'][$j];

              $update_qry2 = "INSERT INTO `invoice_data`(`inv_d_m_id`, `inv_d_item`, `inv_d_qty`, `inv_d_rate`) VALUES ('".$lastid."','".$item_name."','".$item_qty."','".$item_rate."')";  
              mysqli_query($link,$update_qry2);
          }

          $_SESSION["msg"] = "<div class='alert alert-success'>Invoice ".$lastid." Inserted Successfully.</div>";
          header("location:invoice.php");
          exit();
      }else if($action == 'edit'){
          $errors = "";
          if(!(isset($_POST["inv_date"]) && trim($_POST["inv_date"] != ""))){
              $errors .= "Date Is Required.<br/>";
          }

          if(!(isset($_POST["inv_to"]) && trim($_POST["inv_to"] != ""))){
              $errors .= "Name Is Required.<br/>";
          }

          if(!(isset($_POST["inv_to_city"]) && trim($_POST["inv_to_city"] != ""))){
              $errors .= "City Is Required.<br/>";
          }

          if(!(isset($_POST["inv_subject"]) && trim($_POST["inv_subject"] != ""))){
              $errors .= "Subject Is Required.<br/>";
          }

          if(!(isset($_POST["inv_gst_per"]) && trim($_POST["inv_gst_per"] != ""))){
              $errors .= "GST Is Required.<br/>";
          }

          if(!(isset($_POST["inv_to_add"]) && trim($_POST["inv_to_add"] != ""))){
              $errors .= "Address Is Required.<br/>";
          }

          if(isset($errors) && $errors != ""){
              $finalmsg = rtrim($errors,"<br/>");
              $_SESSION["msg"] = "<div class='alert alert-danger'>".$finalmsg."</div>";
              header("location:".$_SERVER['HTTP_REFERER']);
              exit();
          }

          $update_qry3 = "delete from invoice_data where inv_d_m_id='".$_POST["id"]."'";
          mysqli_query($link,$update_qry3);

          $update_qry = "Update `invoice` set `inv_to`='".$_POST['inv_to']."',`inv_to_add`='".$_POST['inv_to_add']."',`inv_to_city`='".$_POST['inv_to_city']."',`inv_date`='".$_POST['inv_date']."',`inv_subject`='".$_POST['inv_subject']."',`inv_gst_per`='".$_POST['inv_gst_per']."',`inv_note`='".$_POST['inv_note']."',`inv_service_charge`='".$_POST['inv_service_charge']."' where inv_id='".$_POST['id']."'";  
          mysqli_query($link,$update_qry); 
          $lastid = $_POST['id'];

          for($j=0;$j<count($_POST['inv_d_item']);$j++){
              $item_name = $_POST['inv_d_item'][$j];
              $item_qty = $_POST['inv_d_qty'][$j];
              $item_rate = $_POST['inv_d_rate'][$j];

              $update_qry2 = "INSERT INTO `invoice_data`(`inv_d_m_id`, `inv_d_item`, `inv_d_qty`, `inv_d_rate`) VALUES ('".$lastid."','".$item_name."','".$item_qty."','".$item_rate."')";  
              mysqli_query($link,$update_qry2);
          }

          $_SESSION["msg"] = "<div class='alert alert-success'>Invoice ".$lastid." Updated Successfully.</div>";
          header("location:invoice.php");
          exit();
      }else if($action == 'print'){ 
          $selectincrement = mysqli_query($link,"select * from invoice where inv_id='".$_REQUEST["id"]."'");
          $rwselectincrement = mysqli_fetch_array($selectincrement);
          $filename = "invoice_".$rwselectincrement['inc_icre_id'].".pdf";
          require_once 'MPDF/vendor/autoload.php';

          $selectcomp = mysqli_query($link,"select * from company where c_id='".$rwselectincrement['inv_com_id']."'");
          $rwselectcomp = mysqli_fetch_array($selectcomp);
          

          $html = '<html>
                      <head>
                          <title>Invoice '.$rwselectincrement['inc_icre_id'].'</title>
                      </head>
                      <body style="margin:0">
                          <table style="width: 100%;border:1px solid" cellpadding="8" cellspacing="0">
                             <tr>
                               <td><img src="'.SITE_ROOT_FRONT.'UploadImages/company/'.$rwselectcomp['c_logo'].'" style="width:50%"/></td>
                             </tr>
                             <tr>
                               <td colspan="2" style="border-top:1px solid;font-size:11px;">'.$rwselectcomp['c_address'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No. '.$rwselectcomp['c_phone'].'</td>
                             </tr>
                             <tr>
                               <td colspan="2" style="border-top:1px solid;font-size:12px;font-weight:bold;text-align:center;text-decoration:underline">INVOICE</td>
                             </tr>
                             <tr>
                               <td style="border-top:1px solid;font-size:11px;font-weight:bold;border-right:1px solid">M/s : '.strtoupper($rwselectincrement['inv_to']).'</td>
                               <td style="border-top:1px solid;font-size:11px;font-weight:bold;text-align:left">Invoice No. : '.$rwselectincrement['inc_icre_id'].'</td>
                             </tr>
                             <tr>
                               <td style="font-size:11px;font-weight:bold;border-right:1px solid">Address : '.$rwselectincrement['inv_to_add'].'</td>
                               <td style="font-size:11px;font-weight:bold;text-align:left">Date : '.date("d-m-Y",strtotime($rwselectincrement['inv_date'])).'</td>
                             </tr>
                             <tr>
                               <td style="font-size:11px;font-weight:bold;border-right:1px solid">GSTIN No. : </td>
                               <td style="font-size:11px;font-weight:bold;text-align:left">Place Of Supply : '.$rwselectincrement['inv_to_city'].'</td>
                             </tr>
                             <tr>
                               <td style="font-size:11px;font-weight:bold;border-right:1px solid">Site Name: '.strtoupper($rwselectincrement['inv_subject']).'</td>
                               <td style="font-size:11px;font-weight:bold;text-align:left">&nbsp;</td>
                             </tr>
                          </table>
                          <table style="width: 100%;border:1px solid;border-top:0;min-height:500px" cellpadding="8" cellspacing="0">
                             <tr>
                                <td style="border-bottom:1px solid;border-right:1px solid;font-size:12px;font-weight:bold;text-align:center;width:8%">Sr No</td>
                                <td style="border-bottom:1px solid;border-right:1px solid;font-size:12px;font-weight:bold;text-align:center;">Particular</td>
                                <td style="border-bottom:1px solid;border-right:1px solid;font-size:12px;font-weight:bold;text-align:center;width:10%">Qty</td>
                                <td style="border-bottom:1px solid;border-right:1px solid;font-size:12px;font-weight:bold;text-align:center;width:10%">Rate</td>
                                <td style="border-bottom:1px solid;font-size:12px;font-weight:bold;text-align:center;width:14%">Amount</td>
                             </tr>';
                             $selectinvociedata = mysqli_query($link,"select * from invoice_data where inv_d_m_id='".$_REQUEST["id"]."'");
                             $i=1;
                             $finalsubtotal = 0;
                             $nmselectinvociedata = mysqli_num_rows($selectinvociedata);
                             $totaltr = 19 - $nmselectinvociedata;
                             while($rwselectinvociedata = mysqli_fetch_array($selectinvociedata)){
                                $totalsub = $rwselectinvociedata['inv_d_qty'] * $rwselectinvociedata['inv_d_rate'];
                                $finalsubtotal = $finalsubtotal + $totalsub;
                                $html .= '<tr>
                                            <td style="border-right:1px solid;font-size:12px;text-align:center;width:8%">'.$i.'</td>
                                            <td style="border-right:1px solid;font-size:12px;text-align:left;">'.$rwselectinvociedata['inv_d_item'].'</td>
                                            <td style="border-right:1px solid;font-size:12px;text-align:right;width:10%">'.$rwselectinvociedata['inv_d_qty'].'</td>
                                            <td style="border-right:1px solid;font-size:12px;text-align:right;width:10%">'.$rwselectinvociedata['inv_d_rate'].'</td>
                                            <td style="font-size:12px;text-align:right;width:14%">'.number_format((float)$totalsub, 2, '.', '').'</td>
                                          </tr>';
                                $i++;
                             }

                            $cgst = 0;
                            $sgst = 0;
                            $totalgstprice = 0;
                            if(!empty($rwselectincrement['inv_gst_per']) && $rwselectincrement['inv_gst_per'] != '0'){
                                $finalgstprice  = $finalsubtotal * $rwselectincrement['inv_gst_per'] / 100;
                                $cgst = $finalgstprice / 2;
                                $sgst = $finalgstprice / 2;
                                $totalgstprice = $cgst + $sgst;
                            }

                            $service_charge = 0;
                            if(!empty($rwselectincrement['inv_service_charge']) && $rwselectincrement['inv_service_charge'] != '0'){
                                $service_charge = $rwselectincrement['inv_service_charge'];
                            }

                            $fsubtatal = $finalsubtotal + $cgst + $sgst + $service_charge;
                            $finaltatal = $finalsubtotal + $cgst + $sgst + $service_charge;
                            for($r=0;$r<=$totaltr;$r++){
                                $html .= '<tr>
                                            <td style="border-right:1px solid;font-size:12px;text-align:center;width:8%"></td>
                                            <td style="border-right:1px solid;font-size:12px;text-align:left;"></td>
                                            <td style="border-right:1px solid;font-size:12px;text-align:right;width:10%"></td>
                                            <td style="border-right:1px solid;font-size:12px;text-align:right;width:10%"></td>
                                            <td style="font-size:12px;text-align:right;width:14%"></td>
                                          </tr>';
                            }
                $html .= '</table>
                          <table style="width: 100%;border:1px solid;border-top:0;background:#f2f2f2" cellpadding="5" cellspacing="0">
                             <tr>
                               <td style="font-size:11px;font-weight:bold;width:70%">GSTIN No. : '.$rwselectcomp['c_gst_no'].'</td>
                               <td style="font-size:11px;font-weight:bold;border-left:1px solid">
                                  <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold;">Total PF Amount</td>
                                        <td style="font-size:11px;font-weight:bold;text-align:right">0.00</td>
                                      </tr>
                                  </table>
                               </td>
                             </tr>
                          </table>
                          <table style="width: 100%;border:1px solid;border-top:0;" cellpadding="5" cellspacing="0">
                             <tr>
                                <td style="width:70%">
                                  <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;width:40%;font-weight:bold">Bank Name</td>
                                        <td style="font-size:11px;width:2%;">:</td>
                                        <td style="font-size:11px;">'.strtoupper($rwselectcomp['c_bank_name']).'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;width:40%;font-weight:bold">Branch</td>
                                        <td style="font-size:11px;width:2%;">:</td>
                                        <td style="font-size:11px;">'.strtoupper($rwselectcomp['c_branch_name']).'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;width:40%;font-weight:bold">Bank A/c. No.</td>
                                        <td style="font-size:11px;width:2%;">:</td>
                                        <td style="font-size:11px;">'.strtoupper($rwselectcomp['c_bank_acc_no']).'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;width:40%;font-weight:bold">RTGS/IFSC Code</td>
                                        <td style="font-size:11px;width:2%;">:</td>
                                        <td style="font-size:11px;">'.strtoupper($rwselectcomp['c_ifsc_rtgs_code']).'</td>
                                      </tr>
                                  </table>
                                  <table style="width: 100%;border-top:1px solid" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;width:40%;font-weight:bold">Total GST</td>
                                        <td style="font-size:11px;width:2%;">:</td>
                                        <td style="font-size:11px;">'.convert_number_to_words($totalgstprice).'</td>
                                      </tr>
                                  </table>
                                </td>
                                <td style="font-size:11px;font-weight:bold;border-left:1px solid">
                                  <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;">Service Charge</td>
                                        <td style="font-size:11px;text-align:right">'.number_format((float)$rwselectincrement['inv_service_charge'], 2, '.', '').'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold">SUB TOTAL</td>
                                        <td style="font-size:11px;text-align:right;font-weight:bold">'.number_format((float)$finalsubtotal, 2, '.', '').'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;">CGST</td>
                                        <td style="font-size:11px;text-align:right">'.number_format((float)$cgst, 2, '.', '').'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;">SGST</td>
                                        <td style="font-size:11px;text-align:right">'.number_format((float)$sgst, 2, '.', '').'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;">Prof. Tax</td>
                                        <td style="font-size:11px;text-align:right">0.00</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;">Round Off</td>
                                        <td style="font-size:11px;text-align:right">'.number_format((float)(round($finaltatal)-$fsubtatal), 2, '.', '').'</td>
                                      </tr>
                                  </table>
                               </td>
                             </tr>
                          </table>
                          <table style="width: 100%;border:1px solid;border-top:0;" cellpadding="5" cellspacing="0">
                             <tr>
                                <td style="font-size:11px;font-weight:bold;width:70%">
                                    <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;width:40%;font-weight:bold">Total Amount</td>
                                        <td style="font-size:11px;width:2%;">:</td>
                                        <td style="font-size:11px;">'.convert_number_to_words(round($finaltatal)).'</td>
                                      </tr>
                                    </table>
                                </td>
                                <td style="font-size:11px;font-weight:bold;border-left:1px solid">
                                    <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold">Total Due</td>
                                        <td style="font-size:11px;font-weight:bold;text-align:right">'.number_format(round($finaltatal), 2, '.', '').'</td>
                                      </tr>
                                    </table>
                                </td>
                             </tr>
                          </table>
                          <table style="width: 100%;border:1px solid;border-top:0;" cellpadding="5" cellspacing="0">
                             <tr>
                                <td style="font-size:11px;font-weight:bold;width:70%;vertical-align:top">Note:<br/>'.$rwselectincrement['inv_note'].'</td>
                                <td style="font-size:11px;font-weight:bold;">
                                    <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold">For, '.get_company($rwselectincrement['inv_com_id']).'</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold">(Authorised Signatory)</td>
                                      </tr>
                                    </table>
                                </td>
                             </tr>
                          </table>
                      </body>
                  </html>';
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'P']);
          $mpdf->AddPageByArray([
              'margin-left' => 5,
              'margin-right' => 5,
              'margin-top' => 5,
              'margin-bottom' => 5,]);
          $mpdf->setAutoTopMargin = 'stretch';
          $mpdf->setAutoBottomMargin = 'stretch';
          $mpdf->WriteHTML($html);
          $mpdf->Output("UploadImages/invoice/".$filename, 'F');
          echo '<iframe src="'.SITE_ROOT_FRONT.'UploadImages/invoice/'.$filename.'" style="width: 100%;height: 600px;"></iframe>';
          exit;
      }else if($action == 'delete'){ 
          $update_qry = "delete from invoice where inv_id='".$_POST["id"]."'";
          mysqli_query($link,$update_qry); 
          $update_qry2 = "delete from invoice_data where inv_d_m_id='".$_POST["id"]."'";
          mysqli_query($link,$update_qry2); 
          $_SESSION["msg"] = "<div class='alert alert-success'>Invoice ".$_POST["id"]." Deleted Successfully.</div>";
          echo "invoice.php";
      }else{
          $_SESSION["msg"] = "<div class='alert alert-danger'>Action not found.</div>";
          header("location:invoice.php");
          exit();
      }
      
      

?>