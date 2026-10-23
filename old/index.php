<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/executables');
spl_autoload_extensions('.class.php');
spl_autoload_register();
$init=new init();
$init->urlVerify();
$init->sendHeaders();
$init->loadTpl();
$init->dbc->cc();
?>