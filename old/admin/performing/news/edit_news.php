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
$now=$init->dbc->select('`news` `с`,`name` `n`,`h1` `h`,`description` `d`,`keywords` `k`,`title` `tit`,`text` `t`',array('`с`.`url`','`с`.`img`','`с`.`date`','`с`.`level`','`n`.`name_'.$init->lang.'`','`h`.`h1_'.$init->lang.'`','`d`.`description_'.$init->lang.'`','`k`.`keywords_'.$init->lang.'`','`tit`.`title_'.$init->lang.'`','`t`.`text_'.$init->lang.'`'),'`с`.`id`='.$id.' && `n`.`id_row`='.$id.' && `n`.`id_table`=7 && `h`.`id_row`='.$id.' && `h`.`id_table`=7 && `d`.`id_row`='.$id.' && `d`.`id_table`=7 && `k`.`id_row`='.$id.' && `k`.`id_table`=7 && `tit`.`id_row`='.$id.' && `tit`.`id_table`=7 && `t`.`id_table`=7 && `t`.`id_row`='.$id,null,'LIMIT 1');
$nameImgNow=$now[0]['img'];
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
############################################ file ################################
$dir=$init->_DIR_.'/img/news/';
if ($init->lang==$init->core['languages'][0]) {
    $loadFile=$init->loadFile('img',$name,$dir);
    if ($loadFile['error']>0) {$init->back($loadFile['error']);} else {$name_img=$loadFile['name-file'];}
}
if (is_null($name_img)) $name_img=$nameImgNow;
################################################## text ###########################################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang])) {
    $text=$_POST['text_'.$init->lang];
}
else {$text=null;}
################################################### name +, image - ########################################
if ($init->lang==$init->core['languages'][0]) {
    if (!empty($name)&&($name!=$now[0]['name_'.$init->lang])&&($name_img==$nameImgNow)&&!is_null($nameImgNow)) {
        $img_old_tip=explode(".",$nameImgNow);
        $tip=end($img_old_tip);
        $nameNew=mb_strtolower($init->translit($name),'UTF-8');
        $name_img_new=$nameNew.'.'.$tip;
        $name_img=$name_img_new;
        @rename($dir.$nameImgNow, $dir.$name_img_new);
    }
}
if ($url!=$now[0]['url']) {
    $createUrl=new createUrl($init->dbc,$init->core);
    $linkNow=$createUrl->url('news',$id);
}
####################################################### ok #####################################################
if (!empty($name)&&($id>0)&&!empty($url)&&!empty($h1)) {
    if ($init->dbc->update('`news`',array('`url`','`date`','`img`','`level`'),array($url,date('Y-m-d H:i:s'),$name_img,$level),'`id`='.$id)&&
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($name),'`id_table`=7 && `id_row`='.$id)&&
        $init->dbc->update('`h1`',array('`h1_'.$init->lang.'`'),array($h1),'`id_table`=7 && `id_row`='.$id)&&
        $init->dbc->update('`description`',array('`description_'.$init->lang.'`'),array($description),'`id_table`=7 && `id_row`='.$id)&&
        $init->dbc->update('`keywords`',array('`keywords_'.$init->lang.'`'),array($keywords),'`id_table`=7 && `id_row`='.$id)&&
        $init->dbc->update('`title`',array('`title_'.$init->lang.'`'),array($title),'`id_table`=7 && `id_row`='.$id)&&
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($text),'`id_table`=7 && `id_row`='.$id)
    ) {
        if ($url!=$now[0]['url']) {
            $linkNew=$createUrl->url('news',$id);
            $init->updateLinks('news',$linkNow,$linkNew);
        }
        if ($init->lang==$init->core['languages'][0]) {
            if (!is_null($nameImgNow)&&($name!==$now[0]['name_'.$init->lang])&&($name_img!==$nameImgNow)) @unlink($dir.$nameImgNow);
            if (($name===$now[0]['name_'.$init->lang])&&($name_img!==$nameImgNow)) @unlink($dir.$nameImgNow);
        }
        $init->back(0);
    }
    else
    {
        $init->dbc->update('`news`',array('`url`','`date`','`img`','`level`'),array($now[0]['url'],$now[0]['date'],$now[0]['img'],$now[0]['level']),'`id`='.$id);
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($now[0]['name_'.$init->lang]),'`id_table`=7 && `id_row`='.$id);
        $init->dbc->update('`h1`',array('`h1_'.$init->lang.'`'),array($now[0]['h1_'.$init->lang]),'`id_table`=7 && `id_row`='.$id);
        $init->dbc->update('`description`',array('`description_'.$init->lang.'`'),array($now[0]['description_'.$init->lang]),'`id_table`=7 && `id_row`='.$id);
        $init->dbc->update('`keywords`',array('`keywords_'.$init->lang.'`'),array($now[0]['keywords_'.$init->lang]),'`id_table`=7 && `id_row`='.$id);
        $init->dbc->update('`title`',array('`title_'.$init->lang.'`'),array($now[0]['title_'.$init->lang]),'`id_table`=7 && `id_row`='.$id);
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($now[0]['text_'.$init->lang]),'`id_table`=7 && `id_row`='.$id);
        if ($init->lang==$init->core['languages'][0]) {
            if (($name!==$now[0]['name_'.$init->lang])&&($name_img==$nameImgNow)&&!is_null($nameImgNow)) {@rename($dir.$name_img_new, $dir.$nameImgNow);}
            if (($name===$now[0]['name_'.$init->lang])&&($name_img!==$nameImgNow)) @unlink($dir.$name_img);
        }
        $init->back(1010);
    }
}
else {$init->back(666);}
}
else {$init->back(10);}
?>