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
$antiHack=new antiHack;
$trimText=new trimText;
$name=array();
foreach ($init->core['languages'] as $lang) {
    ############################################## name ##########################################################
    if (isset($_POST['name_'.$lang])&&!empty($_POST['name_'.$lang])) {
        $name[$lang]=$trimText->trim(240,$antiHack->filterAll($_POST['name_'.$lang]));
    }
    else {$init->back(666);}
}
############################################ file ################################
$name_file=null;
if (count($name)>0) {
$dir=$init->_DIR_.'/img/upload/';
$loadFile=$init->loadFile('file',$name[$init->lang],$dir,true);
if ($loadFile['error']>0) {$init->back($loadFile['error']);} else {$name_file=$loadFile['name-file'];}
}
############################################ icon ################################
$name_icon=null;
if (count($name)>0) {
$loadIcon=$init->loadFile('icon',$name[$init->lang],$dir.'icon/');
if ($loadIcon['error']>0) {@unlink($dir.$name_file);$init->back($loadIcon['error']);} else {$name_icon=$loadIcon['name-file'];}
}
if (!is_null($name_file)&&!is_null($name_icon)&&(count($name)>0)) {
    if ($init->dbc->insert('`upload`',array('`name_file`','`icon`','`date`'),array($name_file,$name_icon,date('Y-m-d H:i:s')),true)) {
        $id=$init->dbc->lastID;
        $names=array('`id_table`','`id_row`');
        $vals=array(22,$id);
        foreach ($init->core['languages'] as $val) {
            $names[]='`name_'.$val.'`';
            $vals[]=$name[$val];
        }
        if ($init->dbc->insert('`name`',$names,$vals)) {
            $init->back(0);
        }
        else {
            $init->dbc->delete(array('`upload`'),array('`id`='.$id));
            if (!is_null($name_file)) @unlink($dir.$name_file);
            if (!is_null($name_icon)) @unlink($dir.'icon/'.$name_icon);
            $init->back(1010);
        }
    }
    else {
        $init->back(1010);
        if (!is_null($name_file)) @unlink($dir.$name_file);
        if (!is_null($name_icon)) @unlink($dir.'icon/'.$name_icon);
    }
}
else {
    if (!is_null($name_icon)) @unlink($dir.'icon/'.$name_icon);
    if (!is_null($name_file)) @unlink($dir.$name_file);
    $init->back(666);
    }
}
else {$init->back(10);}
?>