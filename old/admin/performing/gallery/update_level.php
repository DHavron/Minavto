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
if (isset($_POST['id'])&&!empty($_POST['id'])&&isset($_POST['level'])) {
    $antiHack=new antiHack;
    $id=intval($antiHack->filterAll($_POST['id']));
    $level=intval($antiHack->filterAll($_POST['level']));
    if ($level<0) $level=0;
    if ($init->dbc->update('`gallery`',array('`level`'),array($level),'`id`='.$id)) {$init->back(0);}
    else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>