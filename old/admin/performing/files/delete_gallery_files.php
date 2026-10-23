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
    $now=$init->dbc->select('`files`',array('`icon`','`name_file`'),'`id`='.$id);
    if ($init->dbc->delete(array('`name`','`files`'),array('`id_table`=8 && `id_row`='.$id,'`id`='.$id))) {
        @unlink($init->_DIR_.'/img/files/icon/'.$now[0]['icon']);
        @unlink($init->_DIR_.'/img/files/'.$now[0]['name_file']);
        $init->back(0);
    } else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>