<?php   include_once 'inc/connection.php';
		$action = $_POST['action'];
        if($action == "set_company"){
        	$_SESSION['company_name'] = $_POST['company_name'];
        	$_SESSION['company_id'] = $_POST['company_id'];
        	$selectcompany = mysqli_query($link,"select * from company where c_id='".$_SESSION['company_id']."'");
        	$rwselectcompany = mysqli_fetch_array($selectcompany);
        	$_SESSION['company_add'] = $rwselectcompany['c_address'];
        	$_SESSION['company_establishment'] = $rwselectcompany['c_establishment'];
        	$_SESSION['company_owner'] = $rwselectcompany['c_owner'];
        	$_SESSION['company_logo'] = $rwselectcompany['c_logo'];
        	$_SESSION['company_phone'] = $rwselectcompany['c_phone'];
        	$_SESSION['company_email'] = $rwselectcompany['c_email'];
        } 
?>