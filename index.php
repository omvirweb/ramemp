<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		$page_name = "Login";
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
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post" autocomplete="off">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username" value="<?php if(isset($_COOKIE['user_name'])){echo $_COOKIE['user_name'];} ?>">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>">
                </div>
                <div class="mt-3">
                	<input type="submit" value="SIGN IN" id="login_btn" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" value="1" id="remember" <?php if(isset($_COOKIE['remember'])){echo "checked";} ?> name="remember">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="<?php echo SITE_ROOT_FRONT; ?>forgot_password.php" class="auth-link text-black">Forgot password?</a>
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
  	$("#login_btn").click(function(){
		lfg = 1;
		var unm = $.trim($("#username").val());
		if(unm==""){
			lfg = 0;
			$("#username").addClass("login-error");
			$("#password").removeClass("login-error");
			$("#username").focus();
			return false;
		}else{
			$("#username").removeClass("login-error");
		}

		var pass = $.trim($("#password").val());
		if(pass==""){
			lfg = 0;
			
			$("#username").removeClass("login-error");
			$("#password").addClass("login-error");
			$("#password").focus();
			return false;
		}else{
			$("#password").removeClass("login-error");
		}
		
		var remember = $.trim($("#remember").val());
		$.ajax({

			type	: "POST",
			url		: "index_db.php",
			data	: { 
						myaction:"verification",
						unm : unm,
						pass : pass,
						remember : remember
					  },
			success	: function(result){
				lfg = 0;			
				if($.trim(result)=="wrong"){
					alert("Username is not exists.");
					$("#username").addClass("login-error");
					$("#password").addClass("login-error");
					$("#password").removeClass("login-error");
					$("#username").focus();
				}else if($.trim(result)=="username_wrong"){
					alert("Username is not exists.");
					$("#username").addClass("login-error");
				}else if($.trim(result)=="username_inactive"){
					alert("Username is inactive. contact admin for login.");
					$("#username").addClass("login-error");
				}else if($.trim(result)=="password_wrong"){
					alert("Password is not exists.");
					$("#login_btn").removeAttr('disabled');
					$("#password").addClass("login-error");
				}else if($.trim(result)=="success_admin"){
					$("#username").removeClass("login-error");
					$("#password").removeClass("login-error");
					window.location='dashboard.php';
				}else if($.trim(result)=="success"){
					$("#username").removeClass("login-error");
					$("#password").removeClass("login-error");
					window.location='dashboard.php';
				}
				return false;
			}
		});
		return false;
	});
  </script>
</body>
</html>