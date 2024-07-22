<?php
$login_query = "select id,admin_name,admin_pass from login_admin";
$login_data=mysqli_query($link,$login_query) or die($login_query.mysqli_error($link));
$count = mysqli_num_rows($login_data);
if($count==1){
	$login_rows = mysqli_fetch_assoc($login_data);
	$username = $login_rows["admin_name"]; 
	$password = $login_rows["admin_pass"]; 
	$id = $login_rows["id"]; 
	$useroptions = ['cost' => 8,];
	$userhash    = password_hash($username, PASSWORD_BCRYPT, $useroptions);
	$pwoptions   = ['cost' => 8,];
	$passhash    = password_hash($password, PASSWORD_BCRYPT, $pwoptions);
	$userfile = fopen("stuff/user.txt", "w") or die("Unable to open file!");
	fwrite($userfile, $userhash);
	fclose($userfile);

	$passwordfile = fopen("stuff/pass.txt", "w") or die("Unable to open file!");
	fwrite($passwordfile, $passhash);
	fclose($passwordfile);

	$userIdfile = fopen("stuff/id.txt", "w") or die("Unable to open file!");
	fwrite($userIdfile, $id);
	fclose($userIdfile);
}
?>