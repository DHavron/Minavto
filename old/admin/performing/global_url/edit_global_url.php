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
$now=$init->dbc->select('`global_url` `u`,`name` `n`,`h1` `h`,`description` `d`,`keywords` `k`,`title` `tit`',array('`u`.`url`','`u`.`date`','`n`.`name_'.$init->lang.'`','`h`.`h1_'.$init->lang.'`','`d`.`description_'.$init->lang.'`','`k`.`keywords_'.$init->lang.'`','`tit`.`title_'.$init->lang.'`'),'`u`.`id`='.$id.' && `n`.`id_row`='.$id.' && `n`.`id_table`=10 && `h`.`id_row`='.$id.' && `h`.`id_table`=10 && `d`.`id_row`='.$id.' && `d`.`id_table`=10 && `k`.`id_row`='.$id.' && `k`.`id_table`=10 && `tit`.`id_row`='.$id.' && `tit`.`id_table`=10',null,'LIMIT 1');
$name=$url=null;
################################################## url ###########################################
if (isset($_POST['url'])&&!empty($_POST['url']))
{
    $url=$trimText->trim(240,mb_strtolower(preg_replace('/\//','',$antiHack->filterAll($_POST['url'])),'UTF-8'));
}
else {$init->back(666);}
################################################## name ###########################################
if (isset($_POST['name_'.$init->lang])&&!empty($_POST['name_'.$init->lang]))
{
    $name=$trimText->trim(240,$antiHack->filterAll($_POST['name_'.$init->lang]),true);
}
else {$init->back(666);}
################################################## h1 ###########################################
if (isset($_POST['h1_'.$init->lang])&&!empty($_POST['h1_'.$init->lang]))
{
    $h1=$trimText->trim(240,$antiHack->filterAll($_POST['h1_'.$init->lang]),true);
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
else {$init->back(666);}
###################################################### ok ###################################
if (!empty($url)&&!empty($name)&&!empty($h1)&&($id>0)) {
    $date=date('Y-m-d H:i:s');
    if ($init->dbc->update('`global_url`',array('`url`','`date`'),array($url,$date),'`id`='.$id)&&
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($name),'`id_table`=10 && `id_row`='.$id)&&
        $init->dbc->update('`h1`',array('`h1_'.$init->lang.'`'),array($h1),'`id_table`=10 && `id_row`='.$id)&&
        $init->dbc->update('`title`',array('`title_'.$init->lang.'`'),array($title),'`id_table`=10 && `id_row`='.$id)&&
        $init->dbc->update('`description`',array('`description_'.$init->lang.'`'),array($description),'`id_table`=10 && `id_row`='.$id)&&
        $init->dbc->update('`keywords`',array('`keywords_'.$init->lang.'`'),array($keywords),'`id_table`=10 && `id_row`='.$id)
    ) {
        $init->back(0);
    }
    else {
        $init->dbc->update('`global_url`',array('`url`','`date`'),array($now[0]['url'],$now[0]['date']),'`id`='.$id);
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($now[0]['name_'.$init->lang]),'`id_table`=10 && `id_row`='.$id);
        $init->dbc->update('`h1`',array('`h1_'.$init->lang.'`'),array($now[0]['h1_'.$init->lang]),'`id_table`=10 && `id_row`='.$id);
        $init->dbc->update('`title`',array('`title_'.$init->lang.'`'),array($now[0]['title_'.$init->lang]),'`id_table`=10 && `id_row`='.$id);
        $init->dbc->update('`description`',array('`description_'.$init->lang.'`'),array($now[0]['description_'.$init->lang]),'`id_table`=10 && `id_row`='.$id);
        $init->dbc->update('`keywords`',array('`keywords_'.$init->lang.'`'),array($now[0]['keywords_'.$init->lang]),'`id_table`=10 && `id_row`='.$id);
        $init->back(1010);
    }
}
else {$init->back(666);}
}
else {$init->back(10);}
?>