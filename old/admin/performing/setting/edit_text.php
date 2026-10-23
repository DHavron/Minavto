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
if ($auth->checkRight(array(0,1,2))&&$init->validateSender()) {
############################################## text ##########################################################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang])) {
    $text=$_POST['text_'.$init->lang];
}
else {$text=null;}
if ($init->dbc->update('`setting`',array('`text_'.$init->lang.'`'),array($text))) {$init->back(0);}
else {$init->back(1010);}
}
else {$init->back(10);}
?>