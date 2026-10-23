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
if (isset($_POST['level'])&&!empty($_POST['level'])) {
    $level=intval($antiHack->filterAll($_POST['level']));
}
else {$level=0;}
###################################################### link ############################
if (isset($_POST['link'])&&is_array($_POST['link'])) {
    $link=$_POST['link'];
} else {$link=array();}
###################################################### position ############################
if (isset($_POST['position'])&&!empty($_POST['position'])&&$init->isPosInModul($_POST['position']))
{
    $position=intval($antiHack->filterAll($_POST['position']));
}
else {$init->back(666);}
###################################################### text ############################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang]))
{
    $text=$_POST['text_'.$init->lang];
}
else {$init->back(666);}
###################################################### ok ###################################
if (($name!='')&&!empty($text)) {
    if ($init->dbc->insert('`moduls`',array('`id_position`','`show`','`level`'),array($position,'of',$level),true)) {
        $id=$init->dbc->lastID;
        if ($init->dbc->insert('`name`',array('`id_table`','`id_row`','`name_'.$init->lang.'`'),array(13,$id,$name))&&
            $init->dbc->insert('`text`',array('`id_table`','`id_row`','`text_'.$init->lang.'`'),array(13,$id,$text))
        ) {
            if (count($link)>0) {
                foreach ($link as $val) {
                    $init->dbc->insert('`moduls_links`',array('`id_modul`','`link`'),array($id,$val));
                }
            }
            $init->dbc->cc();
            header('Location: '.$init->_ADMIN_.'/moduls.php?idmenu=61&error=0');
        } else {
            $init->dbc->delete(array('`name`'),array('`id_table`=13 && `id_row`='.$id));
            $init->dbc->delete(array('`text`'),array('`id_table`=13 && `id_row`='.$id));
            $init->dbc->delete(array('`moduls`'),array('`id`='.$id));
            $init->back(1010);
        }
    }
    else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>