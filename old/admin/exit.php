<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/executables');
spl_autoload_extensions('.class.php');
spl_autoload_register();
$auth=new auth;
$auth->exitUser('admin');
header('Location: '.$auth->_SITE_.'/admin/login.php');
?>