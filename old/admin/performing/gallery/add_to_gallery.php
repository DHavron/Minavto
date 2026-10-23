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
################################################# id_table #########################################################
if (isset($_POST['id_table'])&&!empty($_POST['id_table']))
{
    $id_table=intval($antiHack->filterAll($_POST['id_table']));
    $arrayId=array();
    $arratIdTables=$init->dbc->select('`tables`',array('`id`'));
    foreach ($arratIdTables as $idTable) {$arrayId[]=$idTable['id'];}
    if (!in_array($id_table,$arrayId)) $init->back(666);
}
else {$init->back(666);}
################################################# id_row #########################################################
if (isset($_POST['id_row'])&&!empty($_POST['id_row']))
{
    $id_row=intval($antiHack->filterAll($_POST['id_row']));
}
else {$init->back(666);}
################################################## level ###########################################
if (isset($_POST['level'])&&!empty($_POST['level']))
{
    $level=intval($antiHack->filterAll($_POST['level']));
}
else {$level=0;}
############################################ file ################################
$name_img=null;
if (count($name)>0) {
$dir=$init->_DIR_.'/img/gallery/';
$loadFile=$init->loadFile('img',$name[$init->lang],$dir);
if ($loadFile['error']>0) {$init->back($loadFile['error']);} else {$name_img=$loadFile['name-file'];}
}
if (!is_null($name_img)&&(count($name)>0)) {
    if ($init->dbc->insert('`gallery`',array('`id_table`','`id_row`','`img`','`level`','`date`'),array($id_table,$id_row,$name_img,$level,date('Y-m-d H:i:s')),true)) {
        $id=$init->dbc->lastID;
        $names=array('`id_table`','`id_row`');
        $vals=array(9,$id);
        foreach ($init->core['languages'] as $val) {
            $names[]='`name_'.$val.'`';
            $vals[]=$name[$val];
        }
        if ($init->dbc->insert('`name`',$names,$vals)) {
            $init->back(0);
        }
        else {
            $init->dbc->delete(array('`gallery`'),array('`id`='.$id));
            if (!is_null($name_img)) @unlink($dir.$name_img);
            $init->back(1010);
        }
    }
    else {
        $init->back(1010);
        if (!is_null($name_img)) @unlink($dir.$name_img);
    }
}
else {
    if (!is_null($name_img)) @unlink($dir.$name_img);
    $init->back(666);
    }
}
else {$init->back(10);}
?>