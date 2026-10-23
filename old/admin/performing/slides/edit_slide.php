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
$now=$init->dbc->select('`slides` `sl`,`name` `n`,`slider` `s`,`text` `t`',array('`sl`.`id_slider`','`sl`.`img`','`sl`.`level`','`n`.`name_'.$init->lang.'`','`t`.`text_'.$init->lang.'`','`s`.`folder`'),'`sl`.`id`='.$id.' && `n`.`id_row`='.$id.' && `n`.`id_table`=15 && `s`.`id`=`sl`.`id_slider` && `t`.`id_table`=15 && `t`.`id_row`=`sl`.`id`',null,'LIMIT 1');
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
############################################## ok ##########################################################
if (!empty($name)&&($id>0)) {
    if ($init->dbc->update('`slides`',array('`link`','`level`'),array($link,$level),'`id`='.$id)&&
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($name),'`id_table`=15 && `id_row`='.$id)&&
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($text),'`id_table`=15 && `id_row`='.$id)
    ) {
        if ($init->lang==$init->core['languages'][0]) {
            if ($name!=$now[0]['name_'.$init->lang]) {
                $dir=$init->_DIR_.'/img/slider/'.$now[0]['folder'].'/';
                $img_old_tip=explode(".",$now[0]['img']);
                $tip = end($img_old_tip);
                $nameNew=mb_strtolower($init->translit($name),'UTF-8');
                $name_img_new = $nameNew.'.'.$tip;
                if (rename($dir.$now[0]['img'], $dir.$name_img_new)) $init->dbc->update('`slides`',array('`img`'),array($name_img_new),'`id`='.$id);
            }
        }
        $init->back(0);
    } else {
        $init->dbc->update('`slides`',array('`link`','`level`'),array($now[0]['link'],$now[0]['level']),'`id`='.$id);
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($now[0]['name_'.$init->lang]),'`id_table`=15 && `id_row`='.$id);
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($now[0]['text_'.$init->lang]),'`id_table`=15 && `id_row`='.$id);
        $init->back(1010);
    }
}
else {$init->back(666);}
}
else {$init->back(10);}
?>