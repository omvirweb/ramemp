<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "Contract";
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
        }else if($ur_contract == '0'){
            header("location:dashboard.php");
            exit();
        }
        if (!isset ($_REQUEST['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_REQUEST['page'];  
        }  

        $where = "1&1";
        if(isset($_REQUEST['search_data'])){
        	$where .= " and (id LIKE '%".$_REQUEST['search_data']."%' or name LIKE '%".$_REQUEST['search_data']."%' or designation_id LIKE '%".$_REQUEST['search_data']."%' or depart_id LIKE '%".$_REQUEST['search_data']."%' or wage_rate LIKE '%".$_REQUEST['search_data']."%' or pf LIKE '%".$_REQUEST['search_data']."%' or esic LIKE '%".$_REQUEST['search_data']."%' or edli LIKE '%".$_REQUEST['search_data']."%' or bonus LIKE '%".$_REQUEST['search_data']."%' or epfo_charge LIKE '%".$_REQUEST['search_data']."%' or service_charge LIKE '%".$_REQUEST['search_data']."%' or working_days LIKE '%".$_REQUEST['search_data']."%' or role LIKE '%".$_REQUEST['search_data']."%' or payment_mode LIKE '%".$_REQUEST['search_data']."%' or email LIKE '%".$_REQUEST['search_data']."%' or gstin LIKE '%".$_REQUEST['search_data']."%' or address LIKE '%".$_REQUEST['search_data']."%') ";
        }
        // or start_date LIKE '%".$_REQUEST['search_data']."%' or end_date LIKE '%".$_REQUEST['search_data']."%'
        $results_per_page = 20;  
        $page_first_result = ($page-1) * $results_per_page;  


        $query = "select * from contract where $where ORDER BY id DESC";  
        $result = mysqli_query($link, $query);  
        $number_of_result = mysqli_num_rows($result);  
        $selectpackunit = mysqli_query($link,"select * from contract where $where ORDER BY id DESC LIMIT ".$page_first_result.",".$results_per_page);
        $nmselectpackunit = mysqli_num_rows($selectpackunit);

        $number_of_page = ceil ($number_of_result / $results_per_page);  
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
                        	<form action="contract.php" method="post">
		                          <div class="row">
		                            <div class="col-md-6 col-xs-12">
		                              <h3 class="font-weight-bold">Contract</h3>
		                            </div>
		                            <div class="col-md-2 col-xs-12">
		                              <div class="form-group mb-0">
		                              	<input type="text" name="search_data" class="form-control" value="<?php if(isset($_REQUEST['search_data'])){echo $_REQUEST['search_data'];} ?>" placeholder="Search...">
		                              </div>
		                            </div>
		                            <div class="col-md-1 col-xs-12">
		                              <div class="form-group mb-0">
		                              	<input type="submit" class="btn btn-primary" value="Submit">
		                              </div>
		                            </div>
		                            <div class="col-md-1 col-xs-12">
		                              <div class="form-group mb-0">
		                              	<a class="btn btn-danger" href="contract.php">Clear</a>
		                              </div>
		                            </div>
		                            <div class="col-md-2 col-xs-12 text-right">
		                              <a class="btn btn-primary" href="contract_add.php">Add Contract</a>
		                            </div>
		                          </div>
		                      </form>
                        </div>
                      </div>
                      <form id="change_profile" name="change_profile" action="contract_db.php" method="post" autocomplete="off" enctype="multipart/form-data">
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th></th>
                                      <th>Name</th>
                                      <th>Designation</th>
                                      <th>Department</th>
                                      <th>Wage Rate</th>
                                      <th>PF</th>
                                      <th>ESIC</th>
                                      <th>Edli</th>
                                      <th>Bonus</th>
                                      <th>ADMIN EPFO CHARGE</th>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                      <th>Service Charge Rate</th>
                                      <th>Working Days</th>
                                      <th>Role</th>
                                      <th>Payment Mode</th>
                                      <th>Email</th>
                                      <th>GSTIN</th>
                                      <th>Address</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if($nmselectpackunit > 0){ 
                                            while($rwselectpackunit = mysqli_fetch_array($selectpackunit)){
                                    ?>
                                            <tr>
                                              <td><input type="checkbox" name="contract_id[]" value="<?php echo $rwselectpackunit['id']; ?>" onClick="counter_val('<?php echo $rwselectpackunit['id']; ?>')" class="individually_delete"></td>
                                              <!-- <td><?php echo $rwselectpackunit['id']; ?></td> -->
                                              <td><?php echo $rwselectpackunit['name']; ?></td>
                                              <td><?php echo $rwselectpackunit['designation_id']; ?></td>
                                              <td><?php echo $rwselectpackunit['depart_id']; ?></td>
                                              <td><?php echo $rwselectpackunit['wage_rate']; ?></td>
                                              <td><?php echo $rwselectpackunit['pf']; ?></td>
                                              <td><?php echo $rwselectpackunit['esic']; ?></td>
                                              <td><?php echo $rwselectpackunit['edli']; ?></td>
                                              <td><?php echo $rwselectpackunit['bonus']; ?></td>
                                              <td><?php echo $rwselectpackunit['epfo_charge']; ?></td>
                                              <td><?php echo date("m/d/Y", strtotime($rwselectpackunit['start_date'])); ?></td>
                                              <td><?php echo date("m/d/Y", strtotime($rwselectpackunit['end_date'])); ?></td>
                                              <td><?php echo $rwselectpackunit['service_charge']; ?></td>
                                              <td><?php echo $rwselectpackunit['working_days']; ?></td>
                                              <td><?php echo $rwselectpackunit['role']; ?></td>
                                              <td><?php echo $rwselectpackunit['payment_mode']; ?></td>
                                              <td><?php echo $rwselectpackunit['email']; ?></td>
                                              <td><?php echo $rwselectpackunit['gstin']; ?></td>
                                              <td><?php echo $rwselectpackunit['address']; ?></td>

                                              <td style="width: 40px">
                                                <a class="btn btn-sm btn-primary" style="padding-bottom: 0;" href="contract_add.php?id=<?php echo $rwselectpackunit['id']; ?>"><i class="mdi mdi-border-color" style="line-height: 30px;"></i></a>
                                                <a class="btn btn-sm btn-danger delete_contract" style="padding-bottom: 3px;padding-top: 5px;" href="javascript:void(0)"  data-id="<?php echo $rwselectpackunit['id']; ?>"><i class="mdi mdi-delete" style="line-height: 30px;"></i></a>
                                              </td>
                                            </tr>
                                    <?php    }
                                          }else{ ?>
                                            <tr>
                                              <td class="text-danger text-center" colspan="19">No Contract Found.</td>
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
                              <div class="generate_btn">
                                <input type="hidden" name="action" id="action" value="" />
                                <div style="margin: 0 auto !important;text-align: center;display: block;">
                                <button type="submit" class="btn btn-primary mr-2 btn_click" data-id="1">Letter of allotment</button>
                                <button type="submit" class="btn btn-primary mr-2 btn_click" data-id="2">Releaving Letter</button>
                                <button type="submit" class="btn btn-primary mr-2 btn_click" data-id="3">Experience Letter</button>
                                <button type="submit" class="btn btn-primary mr-2 btn_click" data-id="4">Termination Letter</button>
                                </div>
                              </div>
                          <?php } ?>
                        </form>
                      <?php if($number_of_page > 1){ ?>
                              <div class="row">
                                <div class="container-fluid">
                                    <ul class="pagination">
                                      <?php for($i = 1; $i<= $number_of_page; $i++) {   ?>
                                              <li class="page-item <?php if($i == $page){echo 'active';} ?>"><a class="page-link" href = "contract.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                      <?php } ?>
                                    </ul>
                                </div>
                              </div>
                      <?php } ?>
                  </div>
                  <?php include_once("inc/footer.php"); ?>
              </div>
          </div>
    </div>
<?php include_once("js.php"); ?>
<script>
    jQuery(document).ready(function(){
        jQuery(document).on('click','.delete_contract',function(){
            var dataid = jQuery(this).data("id");
            if (confirm("Are you sure you want to delete this contract?") == true) {
                $.ajax({
                  type:'post',
                  url:base_url+'contract_db.php',
                  data:"action=delete&id="+dataid,
                  success:function(url){
                    window.location.href = url;
                    return false;
                  },
                });
            }
        });
        jQuery(document).on('click','.btn_click',function(){
            var dataid = jQuery(this).data("id");
            if(dataid == "1"){
                jQuery("#action").val("letterofallotment");
            }else if(dataid == "2"){
                jQuery("#action").val("releavingletter");
            }else if(dataid == "3"){
                jQuery("#action").val("experienceletter");
            }else if(dataid == "4"){
                jQuery("#action").val("terminationletter");
            }
            
        });
    });
</script>
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
</script>
</body>
</html>