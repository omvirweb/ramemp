<?php   require_once("inc/connection.php");
	    require_once("inc/functions.php");

		$unm = $_REQUEST["unm"];
		$myaction = $_REQUEST["myaction"];

		function generatepass($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}

	
		$frgt_qry = "select * from `login_admin` where admin_name = '".$unm."'";
		$frgt_data=mysqli_query($link,$frgt_qry) or die(mysqli_error($link));
		$count_frgt = mysqli_num_rows($frgt_data);
		$frgt_rows = mysqli_fetch_assoc($frgt_data);

		if($count_frgt==1){
			$password = generatepass(6);

			$qry="UPDATE login_admin SET admin_pass ='".$password."' WHERE admin_name = '".$unm."'";
			$qry_dta=mysqli_query($link,$qry) or die(mysqli_error());

			$to = $frgt_rows['admin_email'];
			$subject = "Forgot Password";
			$message = "
			<html>
			<head>
			<title>Forgot Pasword</title>
			</head>
			<body>
			<p>Dear Admin</p>
			<p>Your Password has been successfully changed in Employee and the new Password is ".$password."</p>
			<p> Kind regards,<br/><br/>		
			<img src='".SITE_ROOT_FRONT."img/ram-logo.png'>

			</p>
			</body>
			</html>";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <Employee>' . "\r\n";
			mail($to,$subject,$message,$headers);
			echo "success";
			exit;
		}else{
			$log_query1 = "select * from `login_user` where username = '".$unm."'";
			$frgt_data=mysqli_query($link,$log_query1) or die(mysqli_error($link));
			$count1 = mysqli_num_rows($frgt_data);
			$login_rows1 = mysqli_fetch_array($frgt_data);

			if($count1==1){
				$password = generatepass(6);
				$qry="UPDATE login_user SET password ='".$password."' WHERE username = '".$unm."'";
				$qry_dta=mysqli_query($link,$qry) or die($qry.mysqli_error($link));

				$to =	$login_rows1['email'];
				$subject = "Forgot Password";
				$message = "
				<html>
				<head>
				<title>Forgot Password</title>
				</head>
				<body>
				<p>Dear ".$login_rows1['username'].",</p>
				<p>Your Password has been successfully changed in Employee and the new Password is ".$password."</p>
				<p>Kind regards,<br/><br/>
				
				<img src='".SITE_ROOT_FRONT."img/ram-logo.png'>
				</p>
				</body>
				</html>";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				$headers .= 'From: <Employee>' . "\r\n";

				mail($to,$subject,$message,$headers);
				echo "success";
				exit;
			}else{
				echo "wrong";
				exit;
			}
		}
		exit;
?>
