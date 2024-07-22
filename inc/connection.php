<?php
ob_start();
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
$user_project_name="Ram Employee";
$project_name_display = "Ram Employee";
$link = mysqli_connect("localhost","huma_employee","Hx&1CBge+_&V","huma_employee") or die(mysqli_connect_error());
$project_name="employee/";


if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	$uri = 'https://';
} else {
	$uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
$site = $uri;
define("SITE_ROOT_FRONT",$site."/".$project_name);
define("SITE_ROOT_FRONT2",$site);
define("SITE_ROOT_FRONT_URL",$_SERVER['HTTP_HOST']."/");
define("SITE_ROOT_BACK",$site."/".$project_name."siteadmin/");
define("RECAPTCHA_SITE_KEY","6Ldr-5MUAAAAAEUR3-ePpFOIQY2fASG8fL_laaS_");
define("RECAPTCHA_SECRET_KEY","6Ldr-5MUAAAAAL5bHE77BIBWTcTEE12EOn3oVhvk");
define("_SERVER_HTTP_HOST","192.168.1.251");
define("_SMTP_MAIL_HOST","istweb.com.au");
define("_SMTP_MAIL_USERNAME","noreply@istweb.com.au");
define("_SMTP_MAIL_PASSWORD","p840_myI");
define("_SMTP_SMTPSECURE","tls");
define("_SMTP_NOREPLY_SEND","noreply@istweb.com.au");
define('CASH_ACCOUNT_ID', 7);
define('CASH_IN_HAND_ACC_GROUP_ID', 26);
define('SUNDRY_DEBTORS_ACC_GROUP_ID', 42);
define('KG_PACK_UNIT_ID',1);
?>