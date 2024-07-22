<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "Salary Register";
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
        }else if($ur_salary_register == '0'){
            header("location:dashboard.php");
            exit();
        }

        $nmselectpackunit = 0;
        if(isset($_REQUEST['e_depart_id']) && isset($_REQUEST['e_sub_depart_id']) && isset($_REQUEST['e_month_id']) && isset($_REQUEST['e_year_id'])){
            $selectpackunit = mysqli_query($link,"select * from employee where 1&1 and e_company_id='".$_SESSION['company_id']."' and e_depart_id='".$_REQUEST['e_depart_id']."' and e_sub_depart_id='".$_REQUEST['e_sub_depart_id']."' ORDER BY e_id DESC");
            $nmselectpackunit = mysqli_num_rows($selectpackunit);
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
                          <form action="salaryregister.php" method="post">
                              <div class="row">
                                <div class="col-md-3 col-xs-12">
                                  <h3 class="font-weight-bold">Salary Register</h3>
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
                      <form id="change_profile" name="change_profile" action="salaryregister_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                          <div class="row">
                            <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                            <div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th><input type="checkbox" class="checkAll" /></th>
                                          <th>Code</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Mobile</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if($nmselectpackunit > 0){ 
                                                while($rwselectpackunit = mysqli_fetch_array($selectpackunit)){
                                        ?>
                                                <tr>
                                                  <td><input type="checkbox" name="employee_id[]" value="<?php echo $rwselectpackunit['e_id']; ?>" onClick="counter_val('<?php echo $rwselectpackunit['e_id']; ?>')" class="individually_delete"></td>
                                                  <td style="padding:15px"><?php echo $rwselectpackunit['e_id']; ?></td>
                                                  <td style="padding:15px"><?php echo $rwselectpackunit['e_firstname']." ".$rwselectpackunit['e_fathername']." ".$rwselectpackunit['e_lastname']; ?></td>
                                                  <td style="padding:15px"><?php echo $rwselectpackunit['e_email']; ?></td>
                                                  <td style="padding:15px"><?php echo $rwselectpackunit['e_mobile_no']; ?></td>
                                                </tr>
                                        <?php    }
                                              }else{ ?>
                                                <tr>
                                                  <td class="text-danger text-center" colspan="5">No Employee Found.</td>
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
                              <div class="generate_btn">
                                <button type="button" class="btn btn-primary mr-2" id="add_bottom" style="margin: 0 auto !important;text-align: center;display: block;">Preview</button>
                              </div>
                          <?php } ?>
                        </form>
                  </div>
                  <?php include_once("inc/footer.php"); ?>
              </div>
          </div>
    </div>
    <button type="button" style="display:none" class="previewpopup" data-toggle="modal" data-keyboard="false" data-target="#previewpopup">test</button>
    <div class="modal" id="previewpopup">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Preview</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body preview_data">
            
          </div>
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
    function counter_val(id){
        var inputElems = document.getElementsByClassName("individually_delete"),count = 0;
        for (var i=0; i<inputElems.length; i++) { 
            if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
              count++;
            }
        }
        if(count > 0){
          $(".generate_btn").show();
        }else{
          $(".generate_btn").hide();
        }
        return false;
    }
    jQuery(document).ready(function(){
        jQuery('.checkAll').on('click',function(){
            if(this.checked){
                $('.individually_delete').each(function(){
                    this.checked = true;
                });
            }else{
                 $('.individually_delete').each(function(){
                    this.checked = false;
                });
            }
            
            var inputElems = document.getElementsByClassName("individually_delete"),count = 0;
            for (var i=0; i<inputElems.length; i++) { 
                if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
                  count++;
                }
            }
            if(count > 0){
              $(".generate_btn").show();
            }else{
              $(".generate_btn").hide();
            }
        });
        jQuery('.checkAll').on('click',function(){
            if(this.checked){
                $('.individually_delete').each(function(){
                    this.checked = true;
                });
            }else{
                 $('.individually_delete').each(function(){
                    this.checked = false;
                });
            }
            
            var inputElems = document.getElementsByClassName("individually_delete"),count = 0;
            for (var i=0; i<inputElems.length; i++) { 
                if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
                  count++;
                }
            }
            if(count > 0){
              $(".generate_btn").show();
            }else{
              $(".generate_btn").hide();
            }
        });
        jQuery(document).on('click','#add_bottom',function(){
            $.ajax({
              type:'post',
              url:base_url+'salaryregister_db.php',
              data:$( "#change_profile" ).serialize(),
              success:function(url){
                $(".preview_data").html(url);
                $(".previewpopup").trigger("click");
                return false;
              },
            });
        });
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
    });
</script>
</body>
</html>