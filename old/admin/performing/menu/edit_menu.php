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
################################################# id #########################################################
if (isset($_POST['id'])&&!empty($_POST['id']))
{
    $id=intval($antiHack->filterAll($_POST['id']));
}
else {$init->back(666);}
########################################### now ##########################################################
$now=$init->dbc->select('`menu` `m`,`name` `n`',array('`m`.`parent`','`m`.`icon`','`m`.`level`','`m`.`click`','`m`.`link`','`n`.`name_'.$init->lang.'`'),'`m`.`id`='.$id.' && `n`.`id_row`=`m`.`id` && `n`.`id_table`=11',null,'LIMIT 1');
$nameIconNow=$now[0]['icon'];
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
############################################ icon ################################
if ($init->lang==$init->core['languages'][0]) {
    $dir=$init->_DIR_.'/img/menu/';
    $loadIcon=$init->loadFile('icon',$name,$dir);
    if ($loadIcon['error']>0) {$init->back($loadIcon['error']);} else {$name_icon=$loadIcon['name-file'];}
}
if (is_null($name_icon)) $name_icon=$nameIconNow;
################################################### name +, image - ########################################
if ($init->lang==$init->core['languages'][0]) {
    if (!empty($name)&&($name!=$now[0]['name_'.$init->lang])&&!is_null($nameIconNow)) {
        $nameNew=mb_strtolower($init->translit($name),'UTF-8');
        if ($name_icon==$nameIconNow) {
            $icon_old_tip=explode(".",$nameIconNow);
            $tipIcon = end($icon_old_tip);
            $name_icon_new = $nameNew.'.'.$tipIcon;
            $name_icon=$name_icon_new;
            @rename($dir.$nameIconNow, $dir.$name_icon_new);
        }
    }
}
####################################################### ok #####################################################
if (($name!='')&&is_int($parent)&&($id>0)) {
    if ($init->dbc->update('`menu`',array('`parent`','`icon`','`click`','`link`','`level`'),array($parent,$name_icon,$click,$link,$level),'`id`='.$id)&&
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($name),'`id_table`=11 && `id_row`='.$id)
    ) {
        if ($init->lang==$init->core['languages'][0]) {
            if (!is_null($nameIconNow)&&($name!==$now[0]['name_'.$init->lang])&&($name_icon!==$nameIconNow)) @unlink($dir.$nameIconNow);
            if (($name===$now[0]['name_'.$init->lang])&&($name_icon!==$nameIconNow)) @unlink($dir.$nameIconNow);
        }
        $init->back(0);
    }
    else
    {
        $init->dbc->update('`menu`',array('`parent`','`icon`','`click`','`link`','`level`'),array($now[0]['parent'],$now[0]['icon'],$now[0]['click'],$now[0]['link'],$now[0]['level']),'`id`='.$id);
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($now[0]['name_'.$init->lang]),'`id_table`=11 && `id_row`='.$id);
        if ($init->lang==$init->core['languages'][0]) {
            if (($name!==$now[0]['name_'.$init->lang])&&($name_icon==$nameIconNow)&&!is_null($nameIconNow)) {@rename($dir.$name_icon_new, $dir.$nameIconNow);}
            if (($name===$now[0]['name_'.$init->lang])&&($name_icon!==$nameIconNow)) @unlink($dir.$name_icon);
        }
        $init->back(1010);
    }
}
else {$init->back(666);}
}
else {$init->back(10);}
?>