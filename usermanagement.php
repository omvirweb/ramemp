<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "User Management";
        include_once("inc/head.php");
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }

        if (!isset ($_REQUEST['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_REQUEST['page'];  
        }  

        $where = "1&1 ";
        if(isset($_REQUEST['search_data'])){
        	$where .= " and (l_first_name LIKE '%".$_REQUEST['search_data']."%' or l_last_name LIKE '%".$_REQUEST['search_data']."%' or l_user_name LIKE '%".$_REQUEST['search_data']."%' or l_email LIKE '%".$_REQUEST['search_data']."%') ";
        }
        $results_per_page = 20;  
        $page_first_result = ($page-1) * $results_per_page;  


        $query = "select * from login_user where $where ORDER BY l_id DESC";  
        $result = mysqli_query($link, $query);  
        $number_of_result = mysqli_num_rows($result);  

        $selectpackunit = mysqli_query($link,"select * from login_user where $where ORDER BY l_id DESC LIMIT ".$page_first_result.",".$results_per_page);
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
                        	<form action="usermanagement.php" method="post">
		                          <div class="row">
		                            <div class="col-md-6 col-xs-12">
		                              <h3 class="font-weight-bold">User Management</h3>
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
		                              	<a class="btn btn-danger" href="usermanagement.php">Clear</a>
		                              </div>
		                            </div>
		                            <div class="col-md-2 col-xs-12 text-right">
		                              <a class="btn btn-primary" href="usermanagement_add.php">Add User</a>
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
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>User Name</th>
                                      <th>Email</th>
                                      <th>Type</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if($nmselectpackunit > 0){ 
                                            while($rwselectpackunit = mysqli_fetch_array($selectpackunit)){
                                    ?>
                                            <tr>
                                              <td><?php echo $rwselectpackunit['l_first_name']; ?></td>
                                              <td><?php echo $rwselectpackunit['l_last_name']; ?></td>
                                              <td><?php echo $rwselectpackunit['l_user_name']; ?></td>
                                              <td><?php echo $rwselectpackunit['l_email']; ?></td>
                                              <td><?php if($rwselectpackunit['l_type'] == "0"){echo 'Staff';}else{echo 'Manager';} ?></td>
                                              <td><?php if($rwselectpackunit['l_status'] == "0"){echo 'Active';}else{echo 'Inactive';} ?></td>
                                              <td style="width: 40px">
                                                <a class="btn btn-sm btn-primary" style="padding-bottom: 0;" href="usermanagement_add.php?id=<?php echo $rwselectpackunit['l_id']; ?>"><i class="mdi mdi-border-color" style="line-height: 30px;"></i></a>
                                                <a class="btn btn-sm btn-danger delete_user" style="padding-bottom: 3px;padding-top: 5px;" href="javascript:void(0)"  data-id="<?php echo $rwselectpackunit['l_id']; ?>"><i class="mdi mdi-delete" style="line-height: 30px;"></i></a>
                                              </td>
                                            </tr>
                                    <?php    }
                                          }else{ ?>
                                            <tr>
                                              <td class="text-danger text-center" colspan="7">No User Found.</td>
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
                                              <li class="page-item <?php if($i == $page){echo 'active';} ?>"><a class="page-link" href = "usermanagement.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
        jQuery(document).on('click','.delete_user',function(){
            var dataid = jQuery(this).data("id");
            if (confirm("Are you sure you want to delete this user?") == true) {
                $.ajax({
                  type:'post',
                  url:base_url+'usermanagement_db.php',
                  data:"action=delete&id="+dataid,
                  success:function(url){
                    window.location.href = url;
                    return false;
                  },
                });
            }
        });
    });
</script>
</body>
</html>