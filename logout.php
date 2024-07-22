<?php @session_start();
      unset($_SESSION[$user_project_name]);
      unset($_SESSION['ist_admin']);
      unset($_SESSION["i_m_admin"]);
      unset($_SESSION["company_name"]);
      unset($_SESSION["company_id"]);
      unset($_SESSION['company_add']);
      header("location:index.php");
      exit;
?>