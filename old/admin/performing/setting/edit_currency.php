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
##############################################  ##########################################################
if (isset($_POST['id'])&&!empty($_POST['id'])) {
    $ids=explode('%',$_POST['id']);
}
else {$init->back(666);}
if (isset($_POST['symb'])&&(count($_POST['symb'])>0)&&isset($_POST['rate'])&&(count($_POST['rate'])>0)&&(count($_POST['symb'])==count($_POST['rate'])&&(count($_POST['symb'])==count($ids))))
{
    $error=false;
    $mainTrue=false;
    foreach ($ids as $id) {
        $symb=$_POST['symb'][$id];
        $show=(isset($_POST['show'][$id])&&($_POST['show'][$id]=='on'))?'on':'of';
        $rate=$_POST['rate'][$id];
        $rest=$_POST['rest'][$id];
        if (isset($_POST['main'][$id])&&($_POST['main'][$id]=='on')&&($mainTrue==false)) {
            $main='on';
            $mainTrue=true;
        }else {$main='of';}
        $level=(intval($_POST['level'][$id])<0)?0:intval($_POST['level'][$id]);
        if (!$init->dbc->update('`currencies`',array('`symb`','`rate`','`rest`','`main`','`show`','`level`'),array($symb,$rate,$rest,$main,$show,$level),'`id`='.$id)) {$error=true;break;}
    }
    $selectShowCurrency=$init->dbc->select('`currencies`',array('`id`'),'`show`=\'on\'',null,'LIMIT 1');
    if (count($selectShowCurrency)==0) {
        $selectCurrency=$init->dbc->select('`currencies`',array('`id`'),null,'`level` DESC','LIMIT 1');
        $selectShowCurrency=$init->dbc->update('`currencies`',array('`show`'),array('on'),'`id`='.$selectCurrency[0]['id']);
    }
    if (!$error) {$init->back(0);} else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>