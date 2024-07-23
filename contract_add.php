<!DOCTYPE html>
<html>
<head>
<?php
        if (isset ($_REQUEST['id']) ) {  
            $page_name = "Edit Contract";
        }else{
            $page_name = "Add Contract";
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
            $ur_contract = 1;
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
            $ur_contract = $rwselectuser['l_contract'];
            $ur_type = $rwselectuser['l_type'];
            $ur_download_excel_sheet = $rwselectuser['l_download_excel_sheet'];
            $ur_monthly_salary_status = $rwselectuser['l_monthly_salary_status'];
        }
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }else if($ur_employee == '0'){
            header("location:dashboard.php");
            exit();
        }
        if (isset ($_REQUEST['id']) ) { 
            $selectpackunit = mysqli_query($link,"select * from contract where id='".$_REQUEST['id']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
           
            $action = "edit";
            $id = $_REQUEST['id'];
            $name = $rwselectpackunit['name'];
            $designation_id = $rwselectpackunit['designation_id'];
            $depart_id = $rwselectpackunit['depart_id'];
            $wage_rate = $rwselectpackunit['wage_rate'];
            $pf = $rwselectpackunit['pf'];
            $esic = $rwselectpackunit['esic'];
            $edli = $rwselectpackunit['edli'];
            $bonus = $rwselectpackunit['bonus'];
            $epfo_charge = $rwselectpackunit['epfo_charge'];
            $daterange = $rwselectpackunit['epfo_charge'];
            $start_date = $rwselectpackunit['start_date'];
            $end_date = $rwselectpackunit['end_date'];
            $service_charge = $rwselectpackunit['service_charge'];
            $working_days = $rwselectpackunit['working_days'];
            $role = $rwselectpackunit['role'];
            $payment_mode = $rwselectpackunit['payment_mode'];
            $email = $rwselectpackunit['email'];
            $gstin = $rwselectpackunit['gstin'];
            $address = $rwselectpackunit['address'];
            // $e_epfo = $rwselectpackunit['e_epfo'];
            // $e_admin_epfo = $rwselectpackunit['e_admin_epfo'];
            // $e_admin_esic = $rwselectpackunit['e_admin_esic'];
        }else{
            $selectemployee2 = mysqli_query($link,"select MAX(id) as total from contract");
            $rwselectemployee2 = mysqli_fetch_array($selectemployee2);
            
            $totalval = $rwselectemployee2['total'] + 1;
            
            $action = "add";
            $id = "";
            $name = "";
            $designation_id = "";
            $depart_id = "";
            $wage_rate = "";
            $pf = "";
            $esic = "";
            $depart_id = "";
            $edli = "";
            $bonus = "";
            $epfo_charge = "";
            $start_date = date("Y/m/d");
            $end_date = date("Y/m/d");
            $service_charge = "";
            $working_days = "";
            $role = "";
            $payment_mode = "";
            $email = "";
            $gstin = "";
            $address = "";
         
        }
        
 
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                              <a class="btn btn-primary" href="contract.php">Back</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="contract_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="contract_name">Contract Name </label>
                                            <input type="text" class="form-control" id="contract_name" name="contract_name" placeholder="Enter Contract Name" value="<?php echo $name; ?>" >
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="depart_id">Department <span>*</span></label>
                                            <select class="form-control" id="depart_id" name="depart_id">
                                                <option value="">Select Department</option>
                                                <?php $depart = mysqli_query($link,"select * from department where 1&1 and d_parent_id='0' and d_company_id='".$_SESSION['company_id']."' ORDER BY d_id DESC"); 
                                                	  while($rwdepart = mysqli_fetch_array($depart)){
                                                ?>
                                                		<option value="<?php echo $rwdepart['d_id']; ?>" <?php if($depart_id == $rwdepart['d_id']){echo "selected";} ?>><?php echo $rwdepart['d_main']." ".$rwdepart['d_state']." ".$rwdepart['d_city']." ".$rwdepart['d_village']." ".$rwdepart['d_schema']; ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                        <label for="designation_id">Designation <span>*</span></label>
                                            <select class="form-control" id="designation_id" name="designation_id">
                                                <option value="">Select Designation</option>
                                                <?php $depart = mysqli_query($link,"select * from designations where 1&1  ORDER BY id DESC"); 
                                                	  while($rwdepart = mysqli_fetch_array($depart)){
                                                ?>
                                                		<option value="<?php echo $rwdepart['id']; ?>" <?php if($designation_id == $rwdepart['id']){echo "selected";} ?>><?php echo $rwdepart['name']; ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="wage_rate">Wage Rate</label>
                                            <input type="number" class="form-control" id="wage_rate" name="wage_rate" placeholder="Enter Wage Rate" value="<?php echo $wage_rate; ?>" >
                                        </div>
                                    </div>

                                </div>


                                   <div class="row">

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="PF">PF</label>
                                            <input type="number" class="form-control" id="pf" name="pf" placeholder="Enter PF" value="<?php echo $pf; ?>" >
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="esic">ESIC</label>
                                            <input type="text" class="form-control" id="esic" name="esic" placeholder="Enter ESIC" value="<?php echo $esic; ?>" >
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="edli">EDLI</label>
                                            <input type="text" class="form-control" id="edli" name="edli" placeholder="Enter EDLI" value="<?php echo $edli; ?>" >
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="bonus">Bonus </label>
                                            <input type="text" class="form-control" id="bonus" name="bonus" placeholder="Enter Bonus" value="<?php echo $bonus; ?>" >
                                        </div>
                                    </div>

                                   </div>     
                                   
                                   
                                  <div class="row">

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="epfo_charge">ADMIN EPFO CHARGE</label>
                                            <input type="number" class="form-control" id="epfo_charge" name="epfo_charge" placeholder="Enter ADMIN EPFO CHARGE" value="<?php echo $epfo_charge; ?>" >
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="service_charge">Service Charge Rate  </label>
                                            <input type="text" class="form-control" id="service_charge" name="service_charge" placeholder="Enter Service Charge Rate" value="<?php echo $service_charge; ?>" >
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="working_days">Working Days </label>
                                            <input type="text" class="form-control" id="working_days" name="working_days" placeholder="Enter Working Days" value="<?php echo $working_days; ?>" >
                                        </div>
                                    </div>
                                                     <?php 
                                                     $start_date = date("m/d/Y", strtotime($start_date));
                                                     $end_date = date("m/d/Y", strtotime($end_date));
                                                    //  print_r($start_date); 
                                                     ?>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label for="bonus">Contract Duration</label>
                                            <!-- <input type="text" class="form-control" id="bonus" name="bonus" placeholder="Enter Bonus" value="<?php echo $bonus; ?>" > -->
                                            <!-- <input type="text" class="form-control" name="daterange" value="<?php echo date_format($start_date,"d/m/Y") ?> - <?php echo date_format($end_date,"d/m/Y") ?> " /> -->
                                            <input type="text" class="form-control" name="daterange" value="<?php echo $start_date?> - <?php echo $end_date ?>" />
                                        </div>
                                    </div>

                                   </div>   

                                <hr/>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h4>Buyer Details</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="role">Role</label>
                                          <input type="text" class="form-control" id="role" name="role" placeholder="Enter Role" value="<?php echo $role; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="payment_mode">Payment Mode</label>
                                          <input type="text" class="form-control" id="payment_mode" name="payment_mode" placeholder="Enter Payment Mode" value="<?php echo $payment_mode; ?>">
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="email">Email</label>
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="email">GSTIN</label>
                                          <input type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter GSTIN" value="<?php echo $gstin; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="email">Address</label>
                                          <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo $address; ?>">
                                        </div>
                                    </div>
                                  
                                </div>
                              
                                <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-primary mr-2" id="add_bottom" >Submit</button>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
<?php if($action == "edit"){ ?>
<script>

  
	// jQuery(document).ready(function(){
	// 	var depart_id = "<?php echo $depart_id; ?>";
	// 	$.ajax({
	// 		type:'post',
	// 		url:base_url+'contract_db.php',
	// 		data:"depart_id="+depart_id,
	// 		success:function(url){
	// 			// $("#e_sub_depart_id").html(url);
	// 			return false;
	// 		},
	// 	});
	// });
</script>
<?php } ?>
<script>
    jQuery('#contract_name,#depart_id,#designation_id,#wage_rate,#pf,#esic,#edli,#bonus,#epfo_charge,#service_charge,#working_days,#role,#payment_mode,#email,#gstin').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
        jQuery("#contract_name").removeClass("error-border");
        jQuery("#depart_id").removeClass("error-border");
        jQuery("#designation_id").removeClass("error-border");
        jQuery("#wage_rate").removeClass("error-border");
        jQuery("#pf").removeClass("error-border");
        jQuery("#esic").removeClass("error-border");
        jQuery("#edli").removeClass("error-border");
        jQuery("#bonus").removeClass("error-border");
    });
    // jQuery("#depart_id").change(function () {
    // 	$.ajax({
		// 	type:'post',
		// 	url:base_url+'contract_db.php',
		// 	data:"depart_id="+$(this).val(),
		// 	success:function(url){
		// 		$("#depart_id").html(url);
		// 		return false;
		// 	},
		// });
    // });
    
    
    jQuery("#add_bottom").click(function () {
      // console.log("contract add");
        lfg = 1;
        var name = jQuery.trim(jQuery("#contract_name").val());
        var depart_id = jQuery.trim(jQuery("#depart_id").val());
        var designation_id = jQuery.trim(jQuery("#designation_id").val());
        var wage_rate = jQuery.trim(jQuery("#wage_rate").val());
        var pf = jQuery.trim(jQuery("#pf").val());
        var esic = jQuery.trim(jQuery("#esic").val());
        var edli = jQuery.trim(jQuery("#edli").val());
        var bonus = jQuery.trim(jQuery("#bonus").val());
        var epfo_charge = jQuery.trim(jQuery("#epfo_charge").val());
        // var start_date = jQuery.trim(jQuery("#start_date").val());
        // var end_date = jQuery.trim(jQuery("#end_date").val());
        var service_charge = jQuery.trim(jQuery("#service_charge").val());
        var working_days = jQuery.trim(jQuery("#working_days").val());
        var role = jQuery.trim(jQuery("#role").val());
        var payment_mode = jQuery.trim(jQuery("#payment_mode").val());
        var email = jQuery.trim(jQuery("#email").val());
        var gstin = jQuery.trim(jQuery("#gstin").val());
        

        if (name == "") {
            lfg = 0;
            jQuery("#contract_name").addClass("error-border");
            jQuery("#contract_name").focus();
            return false;
        }else if (depart_id == "") {
            lfg = 0;
            jQuery("#depart_id").addClass("error-border");
            jQuery("#depart_id").focus();
            return false;
        }else if (designation_id == "") {
            lfg = 0;
            jQuery("#designation_id").addClass("error-border");
            jQuery("#designation_id").focus();
            return false;
        }else if (wage_rate == "") {
            lfg = 0;
            jQuery("#wage_rate").addClass("error-border");
            jQuery("#wage_rate").focus();
            return false;
        }else if (pf == "") {
            lfg = 0;
            jQuery("#pf").addClass("error-border");
            jQuery("#pf").focus();
            return false;
        }else if (esic == "") {
            lfg = 0;
            jQuery("#esic").addClass("error-border");
            jQuery("#esic").focus();
            return false;
        }else if (edli == "") {
            lfg = 0;
            jQuery("#edli").addClass("error-border");
            jQuery("#edli").focus();
            return false;
        }else if (bonus == "") {
            lfg = 0;
            jQuery("#bonus").addClass("error-border");
            jQuery("#bonus").focus();
            return false;
        }else if (epfo_charge == "") {
            lfg = 0;
            jQuery("#epfo_charge").addClass("error-border");
            jQuery("#epfo_charge").focus();
            return false;
        // }else if (start_date == "") {
        //     lfg = 0;
        //     jQuery("#start_date").addClass("error-border");
        //     jQuery("#start_date").focus();
        //     return false;
        // }else if (end_date == "") {
        //     lfg = 0;
        //     jQuery("#end_date").addClass("error-border");
        //     jQuery("#end_date").focus();
        //     return false;
        }else if (service_charge == "") {
            lfg = 0;
            jQuery("#service_charge").addClass("error-border");
            jQuery("#service_charge").focus();
            return false;
        }else if (working_days == "") {
            lfg = 0;
            jQuery("#working_days").addClass("error-border");
            jQuery("#working_days").focus();
            return false;
        }else if (role == "") {
            lfg = 0;
            jQuery("#role").addClass("error-border");
            jQuery("#role").focus();
            return false;
        }else if (payment_mode == "") {
            lfg = 0;
            jQuery("#payment_mode").addClass("error-border");
            jQuery("#payment_mode").focus();
            return false;
        }else if (email == "") {
            lfg = 0;
            jQuery("#email").addClass("error-border");
            jQuery("#email").focus();
            return false;
        }else if (gstin == "") {
            lfg = 0;
            jQuery("#gstin").addClass("error-border");
            jQuery("#gstin").focus();
            return false;
        }
    });
</script>
</body>
</html>