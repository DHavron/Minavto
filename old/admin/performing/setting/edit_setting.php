<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/executables');
spl_autoload_extensions('.class.php');
spl_autoload_register();
$auth=new auth();
if (!$auth->validAuth('admin')) {
    header ("Location: ".$auth->_SITE_."/admin/login.php");
    exit();
}
$init=new admin();
if ($auth->checkRight(array(0,1))&&$init->validateSender()) {
$antiHack=new antiHack;
############################################## email ##########################################################
if (isset($_POST['email'])&&!empty($_POST['email']))
{
    $email=$antiHack->filterAll($_POST['email']);
    if ($init->dbc->update('`setting`',array('`email`'),array($email))) {$init->back(0);} else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>