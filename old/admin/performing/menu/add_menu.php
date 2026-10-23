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
$trimText=new trimText;
############################################## name ##########################################################
if (isset($_POST['name_'.$init->lang])&&!empty($_POST['name_'.$init->lang]))
{
    $name=$trimText->trim(240,$antiHack->filterAll($_POST['name_'.$init->lang]));
}
else {$init->back(666);}
################################################## level ###########################################
if (isset($_POST['level'])&&!empty($_POST['level']))
{
    $level=intval($antiHack->filterAll($_POST['level']));
}
else {$level=0;}
############################################ icon ################################
$dir=$init->_DIR_.'/img/menu/';
$loadIcon=$init->loadFile('icon',$name,$dir);
$name_icon=null;
if ($loadIcon['error']>0) {$init->back($loadIcon['error']);} else {$name_icon=$loadIcon['name-file'];}
###################################################### Родитель ############################
if (isset($_POST['parent'])&&!empty($_POST['parent']))
{
    $parent=intval($antiHack->filterAll($_POST['parent']));
}
else {$parent=0;}
###################################################### Кликабельность ############################
$click= (!isset($_POST['click'])||empty($_POST['click'])) ? 'of' : 'on';
###################################################### link ############################
if (isset($_POST['link']))
{
    $link=$antiHack->filterAll($_POST['link']);
}
else {$init->back(666);}
###################################################### ok ###################################
if (($name!='')&&(is_int($parent))) {
    if ($init->dbc->insert('`menu`',array('`parent`','`icon`','`click`','`show`','`link`','`level`'),array($parent,$name_icon,$click,'of',$link,$level),true)) {
        $id=$init->dbc->lastID;
        if ($init->dbc->insert('`name`',array('`id_table`','`id_row`','`name_'.$init->lang.'`'),array(11,$id,$name))) {
            $init->dbc->cc();
            header('Location: '.$init->_ADMIN_.'/menu.php?idmenu=51&error=0');
        } else {
            $init->dbc->delete(array('`name`'),array('`id_table`=11 && `id_row`='.$id));
            $init->dbc->delete(array('`menu`'),array('`id`='.$id));
            if (!is_null($name_icon)) @unlink($dir.$name_icon);
            $init->back(1010);
        }
    }
    else
    {
        if (!is_null($name_icon)) @unlink($dir.$name_icon);
        $init->back(1010);
    }
}
else {
    if (!is_null($name_icon)) @unlink($dir.$name_icon);
    $init->back(666);
    }
}
else {$init->back(10);}
?>