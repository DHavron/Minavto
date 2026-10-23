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
if (isset($_GET['id'])&&!empty($_GET['id']))
{
    $antiHack=new antiHack;
    $id=intval($antiHack->filterAll($_GET['id']));
    //Проверка входимых категорий
    $result_child=$init->dbc->select('`menu`',array('`id`'),'`parent`='.$id);
    if (count($result_child)==0) {
        $result=$init->dbc->select('`menu`',array(),'`id`='.$id,null,'LIMIT 1');
        if ($init->dbc->delete(array('`name`','`menu`'),array('`id_table`=11 && `id_row`='.$id,'`id`='.$id))) {
                if (!is_null($result[0]['icon'])) {@unlink($init->_DIR_.'/img/menu/'.$result[0]['icon']);}
                $init->back(0);
        }
        else {$init->back(1010);}
    }
    else {$init->back(202);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>