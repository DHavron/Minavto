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
if (isset($_GET['id'])&&!empty($_GET['id'])&&isset($_GET['tab'])&& !empty($_GET['tab'])) {
    $antiHack=new antiHack;
    $id=intval($antiHack->filterAll($_GET['id']));
    $table=$antiHack->filterAll($_GET['tab']);
    if ($init->up_level($table,$id)) {$init->back(0);}
    else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>