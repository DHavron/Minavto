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
############################################## name ##########################################################
if (isset($_POST['name_'.$init->lang])&&!empty($_POST['name_'.$init->lang]))
{
    $name=$trimText->trim(240,$antiHack->filterAll($_POST['name_'.$init->lang]));
}
else {$init->back(666);}
###################################################### text ############################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang]))
{
    $text=$_POST['text_'.$init->lang];
}
else {$text=null;}
###################################################### link ############################
if (isset($_POST['link'])&&is_array($_POST['link']))
{
    $link=$_POST['link'];
}
else {$link=array();}
################################################## level ###########################################
if (isset($_POST['level'])&&!empty($_POST['level']))
{
    $level=intval($antiHack->filterAll($_POST['level']));
}
else {$level=0;}
###################################################### position ############################
if (isset($_POST['position'])&&!empty($_POST['position'])&&$init->isPosInSlider($_POST['position']))
{
    $position=intval($antiHack->filterAll($_POST['position']));
}
else {$init->back(666);}
###################################################### ok ###################################
if (!empty($name)&&($position>0)) {
    $nameFolder=mb_strtolower($init->translit($name),'UTF-8');
    $dirNew=$init->_DIR_.'/img/slider/'.$nameFolder;
    if (mkdir($dirNew,0755)) {
        if ($init->dbc->insert('`slider`',array('`id_position`','`folder`','`show`','`date`','`level`'),array($position,$nameFolder,'of',date('Y-m-d H:i:s'),$level),true)) {
            $id=$init->dbc->lastID;
            if ($init->dbc->insert('`name`',array('`id_table`','`id_row`','`name_'.$init->lang.'`'),array(14,$id,$name))&&
                $init->dbc->insert('`text`',array('`id_table`','`id_row`','`text_'.$init->lang.'`'),array(14,$id,$text))
            ) {
                if (count($link)>0) {
                    foreach ($link as $val) {
                        $init->dbc->insert('`slider_links`',array('`id_slider`','`link`'),array($id,$val));
                    }
                }
                $init->dbc->cc();
                header('Location: '.$init->_ADMIN_.'/slider.php?idmenu=131&error=0');
            }
            else {
                $init->dbc->delete(array('`name`','`text`','`slider`'),array('`id_table`=14 && `id_row`='.$id,'`id_table`=14 && `id_row`='.$id,'`id`='.$id));
                @rmdir($dirNew);
                $init->back(1010);
            }
        }
        else {
            @rmdir($dirNew);
            $init->back(1010);
        }
    }
    else {
        $init->back(555);
    }
}
else {$init->back(666);}
}
else {$init->back(10);}
?>