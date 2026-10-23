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
############################################## id_slider ##########################################################
if (isset($_POST['id_slider'])&&!empty($_POST['id_slider']))
{
    $id_slider=intval($antiHack->filterAll($_POST['id_slider']));
    $slider=$init->dbc->select('`slider`',array('`folder`'),'`id`='.$id_slider);
    if (count($slider)!=1) {$init->back(30);}
}
else {$init->back(666);}
################################################## level ###########################################
if (isset($_POST['level'])&&!empty($_POST['level']))
{
    $level=intval($antiHack->filterAll($_POST['level']));
}
else {$level=0;}
################################################## link ###########################################
if (isset($_POST['link'])&&!empty($_POST['link']))
{
    $link=$_POST['link'];
}
else {$link=null;}
################################################## text ###########################################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang]))
{
    $text=$_POST['text_'.$init->lang];
}
else {$text=null;}
############################################ file ################################
$dir=$init->_DIR_.'/img/slider/'.$slider[0]['folder'].'/';
$loadFile=$init->loadFile('img',$name,$dir);
$name_img=null;
if ($loadFile['error']>0) {$init->back($loadFile['error']);} else {$name_img=$loadFile['name-file'];}
############################################## ok ##########################################################
if (!empty($name)&&($id_slider>0)&&!is_null($name_img)) {
    if ($init->dbc->insert('`slides`',array('`id_slider`','`link`','`img`','`level`'),array($id_slider,$link,$name_img,$level),true)) {
        $id=$init->dbc->lastID;
        if ($init->dbc->insert('`name`',array('`id_table`','`id_row`','`name_'.$init->lang.'`'),array(15,$id,$name))&&
            $init->dbc->insert('`text`',array('`id_table`','`id_row`','`text_'.$init->lang.'`'),array(15,$id,$text))
        ) {
            $init->dbc->cc();
            header('Location: '.$init->_ADMIN_.'/slider.php?idmenu=141&id_category='.$id_slider.'&error=0');
        } else {
            @unlink($dir.$name_img);
            $init->dbc->delete(array('`name`'),array('`id_table`=15 && `id_row`='.$id));
            $init->dbc->delete(array('`text`'),array('`id_table`=15 && `id_row`='.$id));
            $init->dbc->delete(array('`slides`'),array('`id`='.$id));
            $init->back(1010);
        }
    } else {
        @unlink($dir.$name_img);
        $init->back(1010);
    }
}
else {
    @unlink($dir.$name_img);
    $init->back(666);
    }
}
else {$init->back(10);}
?>