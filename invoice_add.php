<!DOCTYPE html>
<html>
<head>
<?php
        if (isset ($_REQUEST['id']) ) {  
            $page_name = "Edit Invoice";
        }else{
            $page_name = "Add Invoice";
        }
        include_once("inc/head.php");
        if(isset($_SESSION["i_m_admin"]) && $_SESSION["i_m_admin"] == "true"){
            $ur_company = 1;
            $ur_department = 1;
            $ur_sub_department = 1;
            $ur_employee = 1;
            $ur_attendence_sheet = 1;
            $ur_monthly_report = 1;
            $ur_salary_sleep = 1;
            $ur_insuration_corporation = 1;
            $ur_invoice = 1;
            $ur_salary_register = 1;
            $ur_wadges = 1;
            $ur_billing_sheet = 1;
            $ur_general_settings = 1;
            $ur_type = '-1';
            $ur_download_excel_sheet = '1';
            $ur_monthly_salary_status = '1';
        }else if(isset($_SESSION["i_m_admin"]) && $_SESSION["i_m_admin"] == "false"){
            $selectuser = mysqli_query($link,"select * from login_user where l_id='".$_SESSION['ist_admin']."'");
            $rwselectuser = mysqli_fetch_array($selectuser);
            $ur_company = $rwselectuser['l_company'];
            $ur_department = $rwselectuser['l_department'];
            $ur_sub_department = $rwselectuser['l_sub_department'];
            $ur_employee = $rwselectuser['l_employee'];
            $ur_attendence_sheet = $rwselectuser['l_attendence_sheet'];
            $ur_monthly_report = $rwselectuser['l_monthly_report'];
            $ur_salary_sleep = $rwselectuser['l_salary_sleep'];
            $ur_insuration_corporation = $rwselectuser['l_insuration_corporation'];
            $ur_invoice = $rwselectuser['l_invoice'];
            $ur_salary_register = $rwselectuser['l_salary_register'];
            $ur_wadges = $rwselectuser['l_wadges'];
            $ur_billing_sheet = $rwselectuser['l_billing_sheet'];
            $ur_general_settings = $rwselectuser['l_general_settings'];
            $ur_type = $rwselectuser['l_type'];
            $ur_download_excel_sheet = $rwselectuser['l_download_excel_sheet'];
            $ur_monthly_salary_status = $rwselectuser['l_monthly_salary_status'];
        }
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }else if($ur_invoice == '0'){
            header("location:dashboard.php");
            exit();
        }
 
        if (isset ($_REQUEST['id']) ) { 
            $selectpackunit = mysqli_query($link,"select * from invoice where inv_id='".$_REQUEST['id']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
            $action = "edit";
            $id = $_REQUEST['id'];
            $inv_to = $rwselectpackunit['inv_to'];
            $inv_to_add = $rwselectpackunit['inv_to_add'];
            $inv_to_city = $rwselectpackunit['inv_to_city'];
            $inv_date = $rwselectpackunit['inv_date'];
            $inv_subject = $rwselectpackunit['inv_subject'];
            $inv_gst_per = $rwselectpackunit['inv_gst_per'];
            $inv_note = $rwselectpackunit['inv_note'];
            $inv_service_charge = $rwselectpackunit['inv_service_charge'];
        }else{
            $action = "add";
            $id = "";
            $inv_to = "";
            $inv_to_add = "";
            $inv_to_city = "";
            $inv_date = "";
            $inv_subject = "";
            $inv_gst_per = "";
            $inv_note = "";
            $inv_service_charge = "";
        }
        
 
?>
</head>
<body>
    <div class="container-scroller">
        <?php 
            include_once("inc/top-pan.php"); 
        ?>
        <div class="container-fluid page-body-wrapper">
              <div class="main-panel">        
                  <div class="content-wrapper">
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <div class="row">
                            <div class="col-md-10 col-xs-12">
                              <h3 class="font-weight-bold"><?php echo $page_name; ?></h3>
                            </div>
                            <div class="col-md-2 col-xs-12 text-right">
                              <a class="btn btn-primary" href="invoice.php">Back</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="invoice_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="inv_date">Date <span>*</span></label>
                                          <input type="date" class="form-control" id="inv_date" name="inv_date" placeholder="Select Date" value="<?php echo $inv_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <div class="form-group">
                                          <label for="inv_to">To Name <span>*</span></label>
                                          <input type="text" class="form-control" id="inv_to" name="inv_to" placeholder="Enter To Name" value="<?php echo $inv_to; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="inv_subject">Subject <span>*</span></label>
                                            <input type="text" class="form-control" id="inv_subject" name="inv_subject" placeholder="Enter Subject" value="<?php echo $inv_subject; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="inv_to_city">To City <span>*</span></label>
                                            <input type="text" class="form-control" id="inv_to_city" name="inv_to_city" placeholder="Enter To City" value="<?php echo $inv_to_city; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="inv_gst_per">GST (%) <span>*</span></label>
                                            <input type="number" min="0" max="40" class="form-control" id="inv_gst_per" name="inv_gst_per" placeholder="Enter GST (%)" value="<?php echo $inv_gst_per; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="inv_service_charge">Service Charge</label>
                                            <input type="text" class="form-control" id="inv_service_charge" name="inv_service_charge" placeholder="Enter Service Charge" value="<?php echo $inv_service_charge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="inv_to_add">To Address <span>*</span></label>
                                          <textarea class="form-control" rows="5" id="inv_to_add" name="inv_to_add" placeholder="Enter To Address"><?php echo $inv_to_add; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="inv_note">Note</label>
                                            <textarea class="form-control" rows="5" id="inv_note" name="inv_note" placeholder="Enter Note"><?php echo $inv_note; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Invoice Details</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-sm-12">
                                        <div class="form-group">
                                          <label for="inv_d_item">Item Name <span>*</span></label>
                                          <input type="text" class="form-control" id="inv_d_item" name="inv_d_item" placeholder="Enter Item Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="inv_d_qty">QTY <span>*</span></label>
                                          <input type="number" class="form-control" id="inv_d_qty" name="inv_d_qty" placeholder="Enter QTY">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                          <label for="inv_d_rate">Rate <span>*</span></label>
                                          <input type="text" class="form-control" id="inv_d_rate" name="inv_d_rate" placeholder="Enter Rate">
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                          <label for="inv_d_rate" style="display: block;">&nbsp;</label>
                                          <a href="javascript:void(0);" class="btn btn-primary add_item">+</a>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="item_details">
                                    <?php $m=1;
                                          $selectitemdetails = mysqli_query($link,"select * from invoice_data where inv_d_m_id='".$id."'"); 
                                          $nmselectitemdetails = mysqli_num_rows($selectitemdetails);
                                          while($rwselectitemdetails = mysqli_fetch_array($selectitemdetails)){
                                    ?>
                                    <div class="row del_<?php echo $m; ?>"><div class="col-md-7 col-sm-12"><div class="form-group"><input type="text" class="form-control" name="inv_d_item[]" value="<?php echo $rwselectitemdetails['inv_d_item']; ?>"></div></div><div class="col-md-2 col-sm-12"><div class="form-group"><input type="number" class="form-control" name="inv_d_qty[]" value="<?php echo $rwselectitemdetails['inv_d_qty']; ?>"></div></div><div class="col-md-2 col-sm-12"><div class="form-group"><input type="text" class="form-control" name="inv_d_rate[]" value="<?php echo $rwselectitemdetails['inv_d_rate']; ?>"></div></div><div class="col-md-1 col-sm-12"><div class="form-group"><a href="javascript:void(0);" data-id="<?php echo $m; ?>" class="btn btn-danger remove_item">-</a></div></div></div>
                                    <?php $m++; } ?>
                                </div>
                                <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-primary mr-2" id="add_bottom" disabled="disabled">Submit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <?php include_once("inc/footer.php"); ?>
              </div>
        </div>
    </div>
<?php include_once("js.php"); ?>
<script>
    jQuery('#inv_date,#inv_to,#inv_to_add,#inv_to_city,#inv_subject,#inv_gst_per,#inv_note,#inv_service_charge').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
    });
    jQuery("#add_bottom").click(function () {
        lfg = 1;
        var inv_date = jQuery.trim(jQuery("#inv_date").val());
        var inv_to = jQuery.trim(jQuery("#inv_to").val());
        var inv_to_add = jQuery.trim(jQuery("#inv_to_add").val());
        var inv_to_city = jQuery.trim(jQuery("#inv_to_city").val());
        var inv_subject = jQuery.trim(jQuery("#inv_subject").val());
        var inv_gst_per = jQuery.trim(jQuery("#inv_gst_per").val());
        jQuery("#inv_date").removeClass("error-border");
        jQuery("#inv_to").removeClass("error-border");
        jQuery("#inv_to_city").removeClass("error-border");
        jQuery("#inv_subject").removeClass("error-border");
        jQuery("#inv_gst_per").removeClass("error-border");
        jQuery("#inv_to_add").removeClass("error-border");
        if (inv_date == "") {
            lfg = 0;
            jQuery("#inv_date").addClass("error-border");
            jQuery("#inv_date").focus();
            return false;
        }else if (inv_to == "") {
            lfg = 0;
            jQuery("#inv_to").addClass("error-border");
            jQuery("#inv_to").focus();
            return false;
        }else if (inv_to_city == "") {
            lfg = 0;
            jQuery("#inv_to_city").addClass("error-border");
            jQuery("#inv_to_city").focus();
            return false;
        }else if (inv_subject == "") {
            lfg = 0;
            jQuery("#inv_subject").addClass("error-border");
            jQuery("#inv_subject").focus();
            return false;
        }else if (inv_gst_per == "") {
            lfg = 0;
            jQuery("#inv_gst_per").addClass("error-border");
            jQuery("#inv_gst_per").focus();
            return false;
        }else if (inv_to_add == "") {
            lfg = 0;
            jQuery("#inv_to_add").addClass("error-border");
            jQuery("#inv_to_add").focus();
            return false;
        }
    });
    jQuery(document).ready(function(){
        var actiondata = "<?php echo $action; ?>";
        if(actiondata == "edit"){
            var i = "<?php echo $nmselectitemdetails+1; ?>";
        }else{
            var i = 1;
        }
        jQuery(document).on('click','.add_item',function(){
            var inv_d_item = jQuery("#inv_d_item").val();
            var inv_d_qty = jQuery("#inv_d_qty").val();
            var inv_d_rate = jQuery("#inv_d_rate").val();
            jQuery("#inv_d_item").removeClass("error-border");
            jQuery("#inv_d_qty").removeClass("error-border");
            jQuery("#inv_d_rate").removeClass("error-border");
            if(inv_d_item == ""){
                jQuery("#inv_d_item").addClass("error-border");
                jQuery("#inv_d_item").focus();
                return false;
            }else if(inv_d_qty == ""){alert();
                jQuery("#inv_d_qty").addClass("error-border");
                jQuery("#inv_d_qty").focus();
                return false;
            }else if(inv_d_rate == ""){
                jQuery("#inv_d_rate").addClass("error-border");
                jQuery("#inv_d_rate").focus();
                return false;
            }else{
                jQuery(".item_details").append('<div class="row del_'+i+'"><div class="col-md-7 col-sm-12"><div class="form-group"><input type="text" class="form-control" name="inv_d_item[]" value="'+inv_d_item+'"></div></div><div class="col-md-2 col-sm-12"><div class="form-group"><input type="number" class="form-control" name="inv_d_qty[]" value="'+inv_d_qty+'"></div></div><div class="col-md-2 col-sm-12"><div class="form-group"><input type="text" class="form-control" name="inv_d_rate[]" value="'+inv_d_rate+'" ></div></div><div class="col-md-1 col-sm-12"><div class="form-group"><a href="javascript:void(0);" data-id="'+i+'" class="btn btn-danger remove_item">-</a></div></div></div>');
                jQuery("#inv_d_item").val("");
                jQuery("#inv_d_qty").val("");
                jQuery("#inv_d_rate").val("");
                i++;
            }
        });

        jQuery(document).on('click','.remove_item',function(){
            var del_id = jQuery(this).data("id");
            jQuery(".del_"+del_id).remove();
        });
    });
</script>
</body>
</html>