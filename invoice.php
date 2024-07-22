<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "Invoice";
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

        if (!isset ($_REQUEST['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_REQUEST['page'];  
        }  

        $where = "1&1 and inv_com_id='".$_SESSION['company_id']."'";
        if(isset($_REQUEST['search_data'])){
        	$where .= " and (inc_icre_id LIKE '%".$_REQUEST['search_data']."%' or inv_to LIKE '%".$_REQUEST['search_data']."%' or inv_to_add LIKE '%".$_REQUEST['search_data']."%') ";
        }
        $results_per_page = 20;  
        $page_first_result = ($page-1) * $results_per_page;  


        $query = "select * from invoice where $where ORDER BY inc_icre_id DESC";  
        $result = mysqli_query($link, $query);  
        $number_of_result = mysqli_num_rows($result);  

        $selectpackunit = mysqli_query($link,"select * from invoice where $where ORDER BY inc_icre_id DESC LIMIT ".$page_first_result.",".$results_per_page);
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
                        	<form action="invoice.php" method="post">
		                          <div class="row">
		                            <div class="col-md-6 col-xs-12">
		                              <h3 class="font-weight-bold">Invoice</h3>
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
		                              	<a class="btn btn-danger" href="invoice.php">Clear</a>
		                              </div>
		                            </div>
		                            <div class="col-md-2 col-xs-12 text-right">
		                              <a class="btn btn-primary" href="invoice_add.php">Add Invoice</a>
		                            </div>
		                          </div>
		                      </form>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Name</th>
                                      <th>Address</th>
                                      <th>Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if($nmselectpackunit > 0){ 
                                            while($rwselectpackunit = mysqli_fetch_array($selectpackunit)){
                                    ?>
                                            <tr>
                                              <td><?php echo $rwselectpackunit['inc_icre_id']; ?></td>
                                              <td><?php echo $rwselectpackunit['inv_to']; ?></td>
                                              <td><?php echo $rwselectpackunit['inv_to_add']." ".$rwselectpackunit['inv_to_city']; ?></td>
                                              <td><?php echo date("M d, Y",strtotime($rwselectpackunit['inv_date'])); ?></td>
                                              <td style="width: 40px">
                                                <a class="btn btn-sm btn-warning add_bottom" data-id="<?php echo $rwselectpackunit['inv_id']; ?>" style="padding-bottom: 5px;padding-top: 5px;" href="javascript:void(0);"><i class="mdi mdi-file-pdf" style="line-height: 28px;color: #ffffff"></i></a>
                                                <a class="btn btn-sm btn-primary" style="padding-bottom: 0;" href="invoice_add.php?id=<?php echo $rwselectpackunit['inv_id']; ?>"><i class="mdi mdi-border-color" style="line-height: 30px;"></i></a>
                                                <a class="btn btn-sm btn-danger delete_invoice" style="padding-bottom: 3px;padding-top: 5px;" href="javascript:void(0)"  data-id="<?php echo $rwselectpackunit['inv_id']; ?>"><i class="mdi mdi-delete" style="line-height: 30px;"></i></a>
                                              </td>
                                            </tr>
                                    <?php    }
                                          }else{ ?>
                                            <tr>
                                              <td class="text-danger text-center" colspan="5">No Invoice Found.</td>
                                            </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php if($number_of_page > 1){ ?>
                              <div class="row">
                                <div class="container-fluid">
                                    <ul class="pagination">
                                      <?php for($i = 1; $i<= $number_of_page; $i++) {   ?>
                                              <li class="page-item <?php if($i == $page){echo 'active';} ?>"><a class="page-link" href = "invoice.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
<script>
    jQuery(document).ready(function(){
        jQuery(document).on('click','.delete_invoice',function(){
            var dataid = jQuery(this).data("id");
            if (confirm("Are you sure you want to delete this invoice?") == true) {
                $.ajax({
                  type:'post',
                  url:base_url+'invoice_db.php',
                  data:"action=delete&id="+dataid,
                  success:function(url){
                    window.location.href = url;
                    return false;
                  },
                });
            }
        });
        jQuery(document).on('click','.add_bottom',function(){
            var id = jQuery(this).data("id");
            $.ajax({
              type:'post',
              url:base_url+'invoice_db.php',
              data:"action=print&id="+id,
              success:function(url){
                $(".preview_data").html(url);
                $(".previewpopup").trigger("click");
                return false;
              },
            });
        });
    });
</script>
</body>
</html>