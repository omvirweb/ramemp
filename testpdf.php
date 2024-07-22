<?php include_once 'inc/connection.php';
      include_once 'inc/functions.php';
      $filename = "invoice.pdf";
      require_once 'MPDF/vendor/autoload.php';
    $html = '<html>
                      <head>
                          <title>Invoice 123</title>
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
                          <div style="min-height:500px">
                              <div style="width:100%">
                        		<div style="width: 30%;float:left">Sr No</div>
                        		<div style="width: 40%;float:left">Description</div>
                        		<div style="width: 30%;float:left">Rate</div>
                        	  </div>
                          </div>
                          
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
                                <td style="font-size:11px;font-weight:bold;width:70%">
                                    <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;width:40%;font-weight:bold">Total Amount</td>
                                        <td style="font-size:11px;width:2%;">:</td>
                                        <td style="font-size:11px;">asdja djakl laksjd asjdl a</td>
                                      </tr>
                                    </table>
                                </td>
                                <td style="font-size:11px;font-weight:bold;border-left:1px solid">
                                    <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold">Total Due</td>
                                        <td style="font-size:11px;font-weight:bold;text-align:right">23423234</td>
                                      </tr>
                                    </table>
                                </td>
                             </tr>
                          </table>
                          <table style="width: 100%;border:1px solid;border-top:0;" cellpadding="5" cellspacing="0">
                             <tr>
                                <td style="font-size:11px;font-weight:bold;width:70%;vertical-align:top">Note:<br/>asdasd</td>
                                <td style="font-size:11px;font-weight:bold;">
                                    <table style="width: 100%;" cellpadding="5" cellspacing="0">
                                      <tr>
                                        <td style="font-size:11px;font-weight:bold">For, huma</td>
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
echo $html;exit;
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','0','',0,0,0,0,'margin_header' => 0,'orientation' => 'P']);
          $mpdf->AddPageByArray([
              'margin-left' => 5,
              'margin-right' => 5,
              'margin-top' => 5,
              'margin-bottom' => 5,]);
          $mpdf->setAutoTopMargin = 'stretch';
          $mpdf->setAutoBottomMargin = 'stretch';
          $mpdf->WriteHTML($html);
          $mpdf->Output($filename, 'D');
          exit;

?>