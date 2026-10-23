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
/*_________________________________________________id_______________________________________________________*/
if (isset($_POST['id'])&&!empty($_POST['id']))
{
    $id=intval($antiHack->filterAll($_POST['id']));
}
else {$init->back(666);}
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
###################################################### link ############################
if (isset($_POST['link'])&&is_array($_POST['link']))
{
    $link=$_POST['link'];
}
else {$link=array();}
###################################################### position ############################
if (isset($_POST['position'])&&!empty($_POST['position'])&&$init->isPosInModul($_POST['position']))
{
    $position=intval($antiHack->filterAll($_POST['position']));
}
else {$init->back(666);}
###################################################### text_ru ############################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang]))
{
    $text=$_POST['text_'.$init->lang];
}
else {$init->back(666);}
########################################### now ##########################################################
$now=$init->dbc->select('`moduls` `m`,`name` `n`,`text` `t`',array('`m`.`id_position`','`m`.`level`','`n`.`name_'.$init->lang.'`','`t`.`text_'.$init->lang.'`'),'`m`.`id`='.$id.' && `n`.`id_row`=`m`.`id` && `n`.`id_table`=13',null,'LIMIT 1');
####################################################### ok #####################################################
if (($name!='')&&!empty($text)&&($id>0)) {
    if ($init->dbc->update('`moduls`',array('`id_position`','`level`'),array($position,$level),'`id`='.$id)&&
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($name),'`id_table`=13 && `id_row`='.$id)&&
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($text),'`id_table`=13 && `id_row`='.$id)
    ) {
        $init->dbc->delete(array('`moduls_links`'),array('`id_modul`='.$id));
        if (count($link)>0) {
            foreach ($link as $val) {
                $init->dbc->insert('`moduls_links`',array('`id_modul`','`link`'),array($id,$val));
            }
        }
        $init->back(0);
    }
    else
    {
        $init->dbc->update('`moduls`',array('`id_position`','`level`'),array($now[0]['id_position'],$now[0]['level']),'`id`='.$id);
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($now[0]['name_'.$init->lang]),'`id_table`=13 && `id_row`='.$id);
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($now[0]['text_'.$init->lang]),'`id_table`=13 && `id_row`='.$id);
        $init->back(1010);
    }
}
else {$init->back(666);}
}
else {$init->back(10);}
?>