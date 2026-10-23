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
############################################## h1 ##########################################################
if (isset($_POST['h1_'.$init->lang])&&!empty($_POST['h1_'.$init->lang]))
{
    $h1=$trimText->trim(240,$antiHack->filterAll($_POST['h1_'.$init->lang]));
}
else {$init->back(666);}
################################################## url ###########################################
if (isset($_POST['url'])&&!empty($_POST['url']))
{
    $url=$trimText->trim(240,mb_strtolower(preg_replace('/\//','',$antiHack->filterAll($_POST['url'])),'UTF-8'));
}
else {$init->back(666);}
################################################## description ###########################################
if (isset($_POST['description_'.$init->lang])&&!empty($_POST['description_'.$init->lang]))
{
    $description=$trimText->trim(240,$antiHack->filterAll($_POST['description_'.$init->lang]),true);
}
else {$description=null;}
################################################## keywords ###########################################
if (isset($_POST['keywords_'.$init->lang])&&!empty($_POST['keywords_'.$init->lang]))
{
    $keywords=$trimText->trim(240,$antiHack->filterAll($_POST['keywords_'.$init->lang]),true);
}
else {$keywords=null;}
################################################## title ###########################################
if (isset($_POST['title_'.$init->lang])&&!empty($_POST['title_'.$init->lang]))
{
    $title=$trimText->trim(65,$antiHack->filterAll($_POST['title_'.$init->lang]));
}
else {$title=null;}
################################################## level ###########################################
if (isset($_POST['level'])&&!empty($_POST['level']))
{
    $level=intval($antiHack->filterAll($_POST['level']));
}
else {$level=0;}
################################################## text ###########################################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang]))
{
    $text=$_POST['text_'.$init->lang];
}
else {$text=null;}
############################################ file ################################
$dir=$init->_DIR_.'/img/news/';
$loadFile=$init->loadFile('img',$name,$dir);
$name_img=null;
if ($loadFile['error']>0) {$init->back($loadFile['error']);} else {$name_img=$loadFile['name-file'];}
###################################################### ok ###################################
if (($name!='')&&($url!='')&&!empty($h1)) {
    if ($init->dbc->insert('`news`',array('`url`','`date`','`img`','`level`','`show`'),array($url,date('Y-m-d H:i:s'),$name_img,$level,'of'),true)) {
        $id=$init->dbc->lastID;
        if ($init->dbc->insert('`name`',array('`id_table`','`id_row`','`name_'.$init->lang.'`'),array(7,$id,$name))&&
            $init->dbc->insert('`h1`',array('`id_table`','`id_row`','`h1_'.$init->lang.'`'),array(7,$id,$h1))&&
            $init->dbc->insert('`title`',array('`id_table`','`id_row`','`title_'.$init->lang.'`'),array(7,$id,$title))&&
            $init->dbc->insert('`keywords`',array('`id_table`','`id_row`','`keywords_'.$init->lang.'`'),array(7,$id,$keywords))&&
            $init->dbc->insert('`description`',array('`id_table`','`id_row`','`description_'.$init->lang.'`'),array(7,$id,$description))&&
            $init->dbc->insert('`text`',array('`id_table`','`id_row`','`text_'.$init->lang.'`'),array(7,$id,$text))
        ) {
            $init->dbc->cc();
            header('Location: '.$init->_ADMIN_.'/news.php?idmenu=42&error=0');
        } else {
            $init->dbc->delete(array('`name`','`h1`','`title`','`description`','`keywords`','`text`','`news`'),array('`id_table`=7 && `id_row`='.$id,'`id_table`=7 && `id_row`='.$id,'`id_table`=7 && `id_row`='.$id,'`id_table`=7 && `id_row`='.$id,'`id_table`=7 && `id_row`='.$id,'`id_table`=7 && `id_row`='.$id,'`id`='.$id));
            if (!is_null($name_img)) @unlink($dir.$name_img);
            $init->back(1010);
        }
    }
    else
    {
        if (!is_null($name_img)) @unlink($dir.$name_img);
        $init->back(1010);
    }
}
else {
    if (!is_null($name_img)) @unlink($dir.$name_img);
    $init->back(666);
    }
}
else {$init->back(10);}
?>