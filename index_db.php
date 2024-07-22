<?php require_once("inc/connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
 	$unm = $_POST["unm"];
 	$pass = $_POST["pass"];
 	$count = 0;
	$admin = "select id,admin_name,admin_pass from login_admin where admin_name = '".$unm."'";
	$adminQuery = mysqli_query($link,$admin) or die($admin.mysqli_error($link));
	$adminQuerycount = mysqli_num_rows($adminQuery);
	if($adminQuerycount == 1){
		$admin2 = "select id,admin_name,admin_pass from login_admin where admin_pass = '".$pass."'";
		$adminQuery2 = mysqli_query($link,$admin2) or die($admin2.mysqli_error($link));
		$adminQuerycount2 = mysqli_num_rows($adminQuery2);
		if($adminQuerycount2==1){		
			include("hash_generate.php");

			$useroptions = ['cost' => 8,]; 
			$pwoptions   = ['cost' => 8,]; 
			$userhash    = password_hash($unm, PASSWORD_BCRYPT, $useroptions); 
			$passhash    = password_hash($pass, PASSWORD_BCRYPT, $pwoptions);  
			$hasheduser  = file_get_contents("stuff/user.txt"); 
			$hashedpass  = file_get_contents("stuff/pass.txt"); 
			$hashedid  = file_get_contents("stuff/id.txt");

			if ((password_verify($unm, $hasheduser)) && (password_verify($pass,$hashedpass))) { 
			    if(isset($_POST["remember"]) && $_POST["remember"]==1){
			    	setcookie("remember", $_POST["remember"], time()+3600);
				    setcookie("user_name", $unm, time()+3600);
				    setcookie("password", $pass, time()+3600);
			    } 
			    $_SESSION[$user_project_name] = $unm;
				$_SESSION['ist_admin'] = $hashedid;
				$_SESSION["i_m_admin"] = "true";
				echo "success_admin";
				exit;
			}else{
				if (!(password_verify($unm, $hasheduser))) {
					echo "username_wrong";
					exit;
				}else if (!(password_verify($pass,$hashedpass))) {
					echo "password_wrong";
					exit;
				}
			}
		}else{
			echo "password_wrong";
			exit;
		}
	}else{
		$login_query1 = "select l_id,l_user_name,l_password from login_user where l_user_name = '".$unm."'";
		$login_data1=mysqli_query($link,$login_query1) or die($login_query1.mysqli_error($link));
		$count1 = mysqli_num_rows($login_data1);

		if($count1==1){
			$login_query2 = "select l_id,l_user_name,l_password from login_user where l_user_name = '".$unm."' AND l_password = '".$pass."'";
			$login_data2=mysqli_query($link,$login_query2) or die($login_query2.mysqli_error($link));
			$count2 = mysqli_num_rows($login_data2);
			if($count2==1){

				$login_rows1 = mysqli_fetch_assoc($login_data2);
				$login_query = "select l_id,l_user_name,l_password,l_status from login_user where l_id = ".$login_rows1['l_id']."";
				$login_data=mysqli_query($link,$login_query) or die($login_query.mysqli_error($link));
				$count = mysqli_num_rows($login_data);
				if($count==1){
					$login_rows = mysqli_fetch_assoc($login_data);
					$username = $login_rows["l_user_name"]; 
					$password = $login_rows["l_password"]; 
					$id = $login_rows["l_id"]; 
					$l_status = $login_rows["l_status"]; 
					if($l_status == "1"){
					    echo "username_inactive";
						exit;
					}

					$useroptions = ['cost' => 8,];
					$userhash    = password_hash($username, PASSWORD_BCRYPT, $useroptions);
					$pwoptions   = ['cost' => 8,];
					$passhash    = password_hash($password, PASSWORD_BCRYPT, $pwoptions);

					$userfile = fopen("stuff/user1.txt", "w") or die("Unable to open file!");
					fwrite($userfile, $userhash);
					fclose($userfile);

					$passwordfile = fopen("stuff/pass1.txt", "w") or die("Unable to open file!");
					fwrite($passwordfile, $passhash);
					fclose($passwordfile);

					$userIdfile = fopen("stuff/id1.txt", "w") or die("Unable to open file!");
					fwrite($userIdfile, $id);
					fclose($userIdfile);
				}

				$useroptions = ['cost' => 8,]; 
				$pwoptions   = ['cost' => 8,]; 
				$userhash    = password_hash($unm, PASSWORD_BCRYPT, $useroptions); 
				$passhash    = password_hash($pass, PASSWORD_BCRYPT, $pwoptions);  
				$hasheduser  = file_get_contents("stuff/user1.txt"); 
				$hashedpass  = file_get_contents("stuff/pass1.txt"); 
				$hashedid  = file_get_contents("stuff/id1.txt"); 
				
				if ((password_verify($unm, $hasheduser)) && (password_verify($pass,$hashedpass))) {  
					if(isset($_POST["remember"]) && $_POST["remember"]==1){
				    	setcookie("remember", $_POST["remember"], time()+3600);
					    setcookie("user_name", $unm, time()+3600);
					    setcookie("password", $pass, time()+3600);
				    } 
				    $_SESSION[$user_project_name] = $unm;
					$_SESSION['ist_admin'] = $hashedid;
					$_SESSION["i_m_admin"] = "false";
					echo "success";
					exit;
				}else{
					if (!(password_verify($unm, $hasheduser))) {
						echo "username_wrong";
						exit;
					}else if (!(password_verify($pass,$hashedpass))) {
						echo "password_wrong";
						exit;
					}
				}
			}else{
				echo "password_wrong";
				exit;
			}			
		}else{
			$admin = "select id,admin_name,admin_pass from login_admin where admin_name = '".$unm."' AND admin_pass = '".$pass."'";
			$adminQuery = mysqli_query($link,$admin) or die($admin.mysqli_error($link));
			$adminQuerycount = mysqli_num_rows($adminQuery);
			if($adminQuerycount==1){
				echo "username_wrong";
				exit;
			}else{
				echo "wrong";
				exit;
			}
		}
	}
}
?>
