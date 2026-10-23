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
if (isset($_GET['id'])&&!empty($_GET['id']))
{
    $antiHack=new antiHack;
    $id=intval($antiHack->filterAll($_GET['id']));
    $dir=$init->_DIR_.'/img/news/';
    if ($init->delete_img('`news`','`img`',$id,$dir)) {$init->back(0);} else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>