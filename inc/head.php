<?php   include_once("inc/connection.php");
		include_once("inc/functions.php");
?>
<title><?php echo isset($page_name)?ucwords($page_name):""; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/feather/feather.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>css/vertical-layout-light/style.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>js/select.dataTables.min.css">
<link rel="stylesheet" href="<?php echo SITE_ROOT_FRONT;?>css/custom.css">

<link rel="apple-touch-icon" sizes="57x57" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo SITE_ROOT_FRONT;?>img/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_ROOT_FRONT;?>img/favicon/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo SITE_ROOT_FRONT;?>img/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">