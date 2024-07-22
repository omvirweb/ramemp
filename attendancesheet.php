<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "Attendance Sheet";
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
        }else if($ur_attendence_sheet == '0'){
            header("location:dashboard.php");
            exit();
        }

        $finalsatsundataone = "";
        $nmselectpackunit = 0;
        if(isset($_REQUEST['e_depart_id']) && isset($_REQUEST['e_sub_depart_id']) && isset($_REQUEST['e_month_id']) && isset($_REQUEST['e_year_id'])){
        	  $selectpackunit = mysqli_query($link,"select * from employee where 1&1 and e_company_id='".$_SESSION['company_id']."' and e_depart_id='".$_REQUEST['e_depart_id']."' and e_sub_depart_id='".$_REQUEST['e_sub_depart_id']."' ORDER BY e_id DESC");
            $nmselectpackunit = mysqli_num_rows($selectpackunit);
            
            if($_REQUEST['e_month_id'] == "1"){
                $e_month_id  = "01";
            }else if($_REQUEST['e_month_id'] == "2"){
                $e_month_id  = "02";
            }else if($_REQUEST['e_month_id'] == "3"){
                $e_month_id  = "03";
            }else if($_REQUEST['e_month_id'] == "4"){
                $e_month_id  = "04";
            }else if($_REQUEST['e_month_id'] == "5"){
                $e_month_id  = "05";
            }else if($_REQUEST['e_month_id'] == "6"){
                $e_month_id  = "06";
            }else if($_REQUEST['e_month_id'] == "7"){
                $e_month_id  = "07";
            }else if($_REQUEST['e_month_id'] == "8"){
                $e_month_id  = "08";
            }else if($_REQUEST['e_month_id'] == "9"){
                $e_month_id  = "09";
            }else{
                $e_month_id  = $_REQUEST['e_month_id'];
            }
            $str = $_REQUEST['e_year_id'].'-'.$e_month_id.'-';
            $satsundata = "";
            for($i2=1; $i2<=31; $i2++){
                $ddd = $str.$i2;
                $date = date('Y M D d', $time = strtotime($ddd) );
                if( strpos($date, 'Sat') || strpos($date, 'Sun') ){
                  $satsundata .= $date.",";
                }
              }
              $currentm = get_month($_REQUEST['e_month_id']);
              $finalsatsundata = rtrim($satsundata,",");
              $finalsatsundataone = str_replace('01',"1",str_replace('02',"2",str_replace('03',"3",str_replace('04',"4",str_replace('05',"5",str_replace('06',"6",str_replace('07',"7",str_replace('08',"8",str_replace('09',"9",str_replace($currentm,"",str_replace($_REQUEST['e_year_id'],"",str_replace("Sun","",str_replace("Sat","",$finalsatsundata)))))))))))));
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
                        	<form action="attendancesheet.php" method="post">
		                          <div class="row">
		                            <div class="col-md-3 col-xs-12">
		                              <h3 class="font-weight-bold">Attendance Sheet</h3>
		                            </div>
		                            <div class="col-md-2 col-xs-12">
		                              <div class="form-group mb-0">
                                    <select name="e_depart_id" id="e_depart_id" class="form-control">
                                      <option value="">Select Department</option>
                                      <?php $depart = mysqli_query($link,"select * from department where 1&1 and d_parent_id='0' and d_company_id='".$_SESSION['company_id']."' ORDER BY d_id DESC"); 
                                          while($rwdepart = mysqli_fetch_array($depart)){
                                      ?>
                                          <option value="<?php echo $rwdepart['d_id']; ?>" <?php if(isset($_REQUEST['e_depart_id']) && $_REQUEST['e_depart_id'] == $rwdepart['d_id']){echo 'selected';} ?>><?php echo $rwdepart['d_main']." ".$rwdepart['d_state']." ".$rwdepart['d_city']." ".$rwdepart['d_village']." ".$rwdepart['d_schema']; ?></option>
                                      <?php } ?>
                                    </select>
		                              </div>
		                            </div>
                                <div class="col-md-2 col-xs-12">
                                  <div class="form-group mb-0">
                                    <select name="e_sub_depart_id" id="e_sub_depart_id" class="form-control">
                                      <option value="">Select Sub Department</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                  <div class="form-group mb-0">
                                    <select name="e_month_id" id="e_month_id" class="form-control">
                                      <option value="">Select Month</option>
                                      <option value="1" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "1"){echo 'selected';} ?>>1</option>
                                      <option value="2" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "2"){echo 'selected';} ?>>2</option>
                                      <option value="3" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "3"){echo 'selected';} ?>>3</option>
                                      <option value="4" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "4"){echo 'selected';} ?>>4</option>
                                      <option value="5" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "5"){echo 'selected';} ?>>5</option>
                                      <option value="6" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "6"){echo 'selected';} ?>>6</option>
                                      <option value="7" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "7"){echo 'selected';} ?>>7</option>
                                      <option value="8" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "8"){echo 'selected';} ?>>8</option>
                                      <option value="9" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "9"){echo 'selected';} ?>>9</option>
                                      <option value="10" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "10"){echo 'selected';} ?>>10</option>
                                      <option value="11" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "11"){echo 'selected';} ?>>11</option>
                                      <option value="12" <?php if(isset($_REQUEST['e_month_id']) && $_REQUEST['e_month_id'] == "12"){echo 'selected';} ?>>12</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                  <div class="form-group mb-0">
                                    <select name="e_year_id" id="e_year_id" class="form-control">
                                      <option value="">Select Year</option>
                                      <?php for($i=date("Y");$i>=2020;$i--){ ?>
                                              <option value="<?php echo $i; ?>" <?php if(isset($_REQUEST['e_year_id']) && $_REQUEST['e_year_id'] == $i){echo 'selected';} ?>><?php echo $i; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
		                            <div class="col-md-1 col-xs-12">
		                              <div class="form-group mb-0">
		                              	<input type="submit" class="btn btn-primary" value="Go" id="search_btn">
		                              </div>
		                            </div>
		                          </div>
		                      </form>
                        </div>
                      </div>
                      <form id="change_profile" name="change_profile" action="attendancesheet_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                          <div class="row">
                            <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                            <div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Name</th>
                                          <?php for($i=1;$i<=31;$i++){ ?>
                                                <th><?php echo $i; ?></th>
                                          <?php } ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if($nmselectpackunit > 0){ 
                                                while($rwselectpackunit = mysqli_fetch_array($selectpackunit)){
                                        ?>
                                                <tr>
                                                  <td style="padding:15px"><?php echo $rwselectpackunit['e_firstname']." ".$rwselectpackunit['e_fathername']." ".$rwselectpackunit['e_lastname']; ?><input type="hidden" name="employee_id[]" value="<?php echo $rwselectpackunit['e_id']; ?>" />
                                                  <div class="row" style="margin-top:15px">
                                                      <div class="col-md-12"><div class="form-group" style="margin-bottom:0"><input type="number" placeholder="Enter Presents Number" style="padding:10px 5px;text-align: center;" class="form-control employee_t_p" id="employee_t_p<?php echo $rwselectpackunit['e_id']; ?>" data-id="<?php echo $rwselectpackunit['e_id']; ?>" /></div></div>
                                                      <div class="col-md-12"><div class="form-group" style="margin-bottom:0"><input type="button" style="text-align: center;width: 100%;margin-top: 10px;" class="btn btn-primary employee_t_p_btn" id="employee_t_p_btn<?php echo $rwselectpackunit['e_id']; ?>" value="Full Presents" data-id="<?php echo $rwselectpackunit['e_id']; ?>" /></div></div>
                                                  </div>
                                                  </td>
                                                  <?php for($i=1;$i<=31;$i++){ 
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
                                                        $selectattendence2 = mysqli_query($link,"select * from employee_attendance where ea_emp_id='".$rwselectpackunit['e_id']."' and ea_emp_date='".$_REQUEST['e_year_id']."-".$_REQUEST['e_month_id']."-".$day."'");
                                                        $checkattendence1 = "";
                                                        $checkattendence2 = "";
                                                        $checkattendence3 = "";
                                                        if(mysqli_num_rows($selectattendence2)>0){
                                                            $rwselectattendence = mysqli_fetch_array($selectattendence2);
                                                            if($rwselectattendence['ea_emp_attendance_type'] == "0"){
                                                                $checkattendence1 = "selected";
                                                            }
                                                            if($rwselectattendence['ea_emp_attendance_type'] == "1"){
                                                                $checkattendence2 = "selected";
                                                            }
                                                            if($rwselectattendence['ea_emp_attendance_type'] == "2"){
                                                                $checkattendence3 = "selected";
                                                            }
                                                        }
                                                  ?>
                                                        <td>
                                                          <select style="width: 70px" class="form-control" name="ea_emp_attendance_type<?php echo $rwselectpackunit['e_id']; ?>_<?php echo $i; ?>" id="ea_emp_attendance_type<?php echo $rwselectpackunit['e_id']; ?>_<?php echo $i; ?>">
                                                              <option value="1" <?php echo $checkattendence2; ?>>P</option>
                                                              <option value="0" <?php echo $checkattendence1; ?>>A</option>
                                                              
                                                              <option value="2" <?php echo $checkattendence3; ?>>PL</option>
                                                          </select>
                                                        </td>
                                                  <?php } ?>
                                                </tr>
                                        <?php    }
                                              }else{ ?>
                                                <tr>
                                                  <td class="text-danger text-center" colspan="32">No Employee Found.</td>
                                                </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php if($nmselectpackunit > 0){ ?>
                              <input type="hidden" name="year" id="year" value="<?php echo $_REQUEST['e_year_id']; ?>">
                              <input type="hidden" name="month" id="month" value="<?php echo $_REQUEST['e_month_id']; ?>">
                              <input type="hidden" name="depart_id" id="depart_id" value="<?php echo $_REQUEST['e_depart_id']; ?>">
                              <input type="hidden" name="sub_depart_id" id="sub_depart_id" value="<?php echo $_REQUEST['e_sub_depart_id']; ?>">
                              <button type="submit" class="btn btn-primary mr-2" id="add_bottom" style="float: right">Submit</button>
                          <?php } ?>
                           <button type="button" class="btn btn-primary mr-2" id="add_bottom_full_presents" style="float: right">Full Presents</button>
                        </form>
                  </div>
                  <?php include_once("inc/footer.php"); ?>
              </div>
          </div>
    </div>
<?php include_once("js.php"); ?>
<?php if(isset($_REQUEST['e_depart_id']) && isset($_REQUEST['e_sub_depart_id']) && isset($_REQUEST['e_month_id']) && isset($_REQUEST['e_year_id'])){ ?>
<script>
  jQuery(document).ready(function(){
    var e_depart_id = "<?php echo $_REQUEST['e_depart_id']; ?>";
    var e_sub_depart_id = "<?php echo $_REQUEST['e_sub_depart_id']; ?>";
    $.ajax({
      type:'post',
      url:base_url+'employee_db.php',
      data:"e_depart_id="+e_depart_id+"&action=get_sub_department&selecteddepart="+e_sub_depart_id,
      success:function(url){
        $("#e_sub_depart_id").html(url);
        return false;
      },
    });
  });
</script>
<?php } ?>
<script>
    jQuery(document).on("change",".employee_t_p",function(e) {
        var dataid = jQuery(this).data("id");
        var tp = jQuery("#employee_t_p"+dataid).val();
        if(tp == ""){
            tp = 0;
        }
        if(tp > 31){
            alert("Your presents number more than 31 days, Please enter correct.");
            return false;
        }else{
            totalprechange(dataid,tp);
            return false;
        }
    });
    function totalprechange(d,p){
        var dataid = d;
        var datap = p;
        var satsun = "<?php echo $finalsatsundataone; ?>";
        var datasatsun = satsun.split(",");
        var totallength = datasatsun.length;
        var arraydata = [];
        for(var m=0;m<totallength;m++){
            arraydata.push(parseInt(jQuery.trim(datasatsun[m])));
        }
       var pdataval =1;
        for(var i=1;i<=31;i++){
            if (pdataval<=datap && jQuery.inArray(i, arraydata) == -1)
            {
              jQuery("#ea_emp_attendance_type"+dataid+"_"+i).val('1');
              pdataval++;
            }else {
			jQuery("#ea_emp_attendance_type"+dataid+"_"+i).val('0');
			}
            
            
        }
    }
    jQuery(document).on("click",".employee_t_p_btn",function(e) {
        var dataid = jQuery(this).data("id");
        totalprechange2(dataid);
        return false;
    });
    function totalprechange2(d){
        var dataid = d;
        for(var i=1;i<=31;i++){
            jQuery("#ea_emp_attendance_type"+dataid+"_"+i).val('1');
        }
    }
    jQuery(document).on("click","#add_bottom_full_presents",function(e) {
        jQuery(".employee_t_p").each(function() {
            var dataid = jQuery(this).data("id");
            for(var i=1;i<=31;i++){
                jQuery("#ea_emp_attendance_type"+dataid+"_"+i).val('1');
            }
        });
        return false;
    });
    jQuery(document).ready(function(){
        jQuery(document).on('change','#e_depart_id',function(){
            $.ajax({
                type:'post',
                url:base_url+'employee_db.php',
                data:"e_depart_id="+$(this).val()+"&action=get_sub_department&selecteddepart=",
                success:function(url){
                  $("#e_sub_depart_id").html(url);
                  jQuery("#e_depart_id").removeClass("error-border");
                  return false;
                },
            });
        });
        jQuery(document).on('change','#e_sub_depart_id',function(){
            jQuery("#e_sub_depart_id").removeClass("error-border");
        });
        jQuery(document).on('change','#e_month_id',function(){
            jQuery("#e_month_id").removeClass("error-border");
        });
        jQuery(document).on('change','#e_year_id',function(){
            jQuery("#e_year_id").removeClass("error-border");
        });
        jQuery(document).on('click','#search_btn',function(){
            lfg = 1;
            jQuery("#e_depart_id").removeClass("error-border");
            jQuery("#e_sub_depart_id").removeClass("error-border");
            jQuery("#e_month_id").removeClass("error-border");
            jQuery("#e_year_id").removeClass("error-border");
            var e_depart_id = jQuery.trim(jQuery("#e_depart_id").val());
            var e_sub_depart_id = jQuery.trim(jQuery("#e_sub_depart_id").val());
            var e_month_id = jQuery.trim(jQuery("#e_month_id").val());
            var e_year_id = jQuery.trim(jQuery("#e_year_id").val());
            if (e_depart_id == "") {
                lfg = 0;
                jQuery("#e_depart_id").addClass("error-border");
                jQuery("#e_depart_id").focus();
                return false;
            }else if (e_sub_depart_id == "") {
                lfg = 0;
                jQuery("#e_sub_depart_id").addClass("error-border");
                jQuery("#e_sub_depart_id").focus();
                return false;
            }else if (e_month_id == "") {
                lfg = 0;
                jQuery("#e_month_id").addClass("error-border");
                jQuery("#e_month_id").focus();
                return false;
            }else if (e_year_id == "") {
                lfg = 0;
                jQuery("#e_year_id").addClass("error-border");
                jQuery("#e_year_id").focus();
                return false;
            }
        });
    });
</script>
</body>
</html>