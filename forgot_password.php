<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		$page_name = "Forgot Password";
		include_once("inc/head.php");
		if(isset($_SESSION['ist_admin']) && $_SESSION['ist_admin'] != ""){
			header("location:dashboard.php");
			exit();
		}
	?>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper" >
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-image: url('<?php echo SITE_ROOT_FRONT;?>img/bg.png');background-repeat: no-repeat;background-size: 100% 100%;">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo SITE_ROOT_FRONT;?>img/ram-logo.png" alt="Ram Construction">
              </div>
              <h4>Enter your username we will sent you new password to your email.</h4>
              <form class="pt-3" method="post" autocomplete="off">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                </div>
                <div class="mt-3">
                	<input type="submit" value="Submit" id="forgot_btn" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    &nbsp;
                  </div>
                  <a href="<?php echo SITE_ROOT_FRONT; ?>" class="auth-link text-black">Sign In</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once("js.php"); ?>
  <script>
  	$("#forgot_btn").click(function(){
		lfg = 1;
		var unm = $.trim($("#username").val());
		if(unm==""){
			lfg = 0;
			$("#username").addClass("login-error");
			$("#username").focus();
			return false;
		}else{
			$("#username").removeClass("login-error");
		}

		
		$.ajax({

			type	: "POST",
			url		: "forgot_password_db.php",
			data	: { 
						myaction:"verification",
						unm : unm
					  },
			success	: function(result){
				lfg = 0;	
				if($.trim(result)=="success"){
					alert("Email successfully sent.");
					window.location='index.php';
				}else{
					alert("Username is not exist.");
					$("#username").addClass("login-error");
					$("#username").focus();
				} 
				return false;
			}
		});
		return false;
	});
  </script>
</body>
</html>