<!DOCTYPE html>
<html>
<head>
<?php
        $page_name = "Edit Profile";
        include_once("inc/head.php");
        if(!isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] == ""){
            header("location:index.php");
            exit();
        }
 
        if ($_SESSION["i_m_admin"] == "true") { 
            $selectpackunit = mysqli_query($link,"select * from login_admin where id='".$_SESSION['ist_admin']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
            $id = $_SESSION['ist_admin'];
            $admin_name = $rwselectpackunit['admin_name'];
            $admin_pass = $rwselectpackunit['admin_pass'];
            $admin_email = $rwselectpackunit['admin_email'];
            $username = "";
            $password = "";
            $email = "";
            $first_name = "";
            $last_name = "";
        }else{
            $selectpackunit = mysqli_query($link,"select * from login_user where l_id='".$_SESSION['ist_admin']."'");
            $rwselectpackunit = mysqli_fetch_array($selectpackunit);
            $id = $_SESSION['ist_admin'];
            $admin_name = "";
            $admin_pass = "";
            $admin_email = "";
            $username = $rwselectpackunit['l_user_name'];
            $password = $rwselectpackunit['l_password'];
            $email = $rwselectpackunit['l_email'];
            $first_name = $rwselectpackunit['l_first_name'];
            $last_name = $rwselectpackunit['l_last_name'];
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
                            <div class="col-md-12 col-xs-12">
                              <h3 class="font-weight-bold"><?php echo $page_name; ?></h3>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if(isset($_SESSION["msg"])){echo '<div class="container-fluid">'.$_SESSION["msg"].'</div>';}unset($_SESSION["msg"]); ?>
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <form id="change_profile" name="change_profile" action="profile_edit_db.php" method="post" autocomplete="off">
                                <?php if ($_SESSION["i_m_admin"] == "true") { ?>
                                        <div class="form-group">
                                          <label for="admin_name">Username <span>*</span></label>
                                          <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="User Name" value="<?php echo $admin_name; ?>">
                                        </div>
                                        <div class="form-group">
                                          <label for="admin_pass">Password <span>*</span></label>
                                          <input type="text" class="form-control" id="admin_pass" name="admin_pass" placeholder="Password" value="<?php echo $admin_pass; ?>">
                                        </div>
                                        <div class="form-group">
                                          <label for="admin_email">Email <span>*</span></label>
                                          <input type="email" class="form-control" id="admin_email" name="admin_email" placeholder="Email Address" value="<?php echo $admin_email; ?>">
                                        </div>
                                <?php }else{ ?>
                                        <div class="form-group">
                                          <label for="username">Username <span>*</span></label>
                                          <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="<?php echo $username; ?>">
                                        </div>
                                        <div class="form-group">
                                          <label for="password">Password <span>*</span></label>
                                          <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                                        </div>
                                        <div class="form-group">
                                          <label for="email">Email <span>*</span></label>
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="form-group">
                                          <label for="first_name">First Name <span>*</span></label>
                                          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>">
                                        </div>
                                        <div class="form-group">
                                          <label for="last_name">Last Name <span>*</span></label>
                                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">
                                        </div>
                                <?php } ?>
                                <input type="hidden" name="is_admin" id="is_admin" value="<?php echo $_SESSION["i_m_admin"]; ?>">
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
    jQuery('#admin_name,#admin_pass,#admin_email,#username,#password,#email,#first_name,#last_name').on("keyup change",function(){
        jQuery("#add_bottom").removeAttr('disabled');
    });
    jQuery("#add_bottom").click(function () {
        lfg = 1;
        var is_admin = jQuery.trim(jQuery("#is_admin").val());
        if(is_admin == "true"){
              var admin_name = jQuery.trim(jQuery("#admin_name").val());
              var admin_pass = jQuery.trim(jQuery("#admin_pass").val());
              var admin_email = jQuery.trim(jQuery("#admin_email").val());
              if (admin_name == "") {
                  lfg = 0;
                  jQuery("#admin_name").addClass("error-border");
                  jQuery("#admin_name").focus();
                  return false;
              }
              if (admin_pass == "") {
                  lfg = 0;
                  jQuery("#admin_pass").addClass("error-border");
                  jQuery("#admin_pass").focus();
                  return false;
              }
              if (admin_email == "") {
                  lfg = 0;
                  jQuery("#admin_email").addClass("error-border");
                  jQuery("#admin_email").focus();
                  return false;
              }else if (!/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/.test(admin_email)) {
                  lfg = 0;
                  jQuery("#admin_email").addClass("error-border");
                  jQuery("#admin_email").focus();
                  return false;
              }
        }else{
              var username = jQuery.trim(jQuery("#username").val());
              var password = jQuery.trim(jQuery("#password").val());
              var email = jQuery.trim(jQuery("#email").val());
              var first_name = jQuery.trim(jQuery("#first_name").val());
              var last_name = jQuery.trim(jQuery("#last_name").val());
              if (username == "") {
                  lfg = 0;
                  jQuery("#username").addClass("error-border");
                  jQuery("#username").focus();
                  return false;
              }
              if (password == "") {
                  lfg = 0;
                  jQuery("#password").addClass("error-border");
                  jQuery("#password").focus();
                  return false;
              }
              if (email == "") {
                  lfg = 0;
                  jQuery("#email").addClass("error-border");
                  jQuery("#email").focus();
                  return false;
              }else if (!/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/.test(email)) {
                  lfg = 0;
                  jQuery("#email").addClass("error-border");
                  jQuery("#email").focus();
                  return false;
              }
              if (first_name == "") {
                  lfg = 0;
                  jQuery("#first_name").addClass("error-border");
                  jQuery("#first_name").focus();
                  return false;
              }
              if (last_name == "") {
                  lfg = 0;
                  jQuery("#last_name").addClass("error-border");
                  jQuery("#last_name").focus();
                  return false;
              }
        }
        
    });
</script>
</body>
</html>