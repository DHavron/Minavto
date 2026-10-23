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
$name=$url=$h1=null;
################################################## url ###########################################
if (isset($_POST['url'])&&!empty($_POST['url'])) {
    $url=$trimText->trim(240,mb_strtolower(preg_replace('/\//','',$antiHack->filterAll($_POST['url'])),'UTF-8'));
} else {$init->back(666);}
################################################## name ###########################################
if (isset($_POST['name_'.$init->lang])&&!empty($_POST['name_'.$init->lang])) {
    $name=$trimText->trim(240,$antiHack->filterAll($_POST['name_'.$init->lang]),true);
} else {$init->back(666);}
################################################## h1 ###########################################
if (isset($_POST['h1_'.$init->lang])&&!empty($_POST['h1_'.$init->lang])) {
    $h1=$trimText->trim(240,$antiHack->filterAll($_POST['h1_'.$init->lang]),true);
} else {$init->back(666);}
################################################## description ###########################################
if (isset($_POST['description_'.$init->lang])&&!empty($_POST['description_'.$init->lang])) {
    $description=$trimText->trim(240,$antiHack->filterAll($_POST['description_'.$init->lang]),true);
} else {$description=null;}
################################################## keywords ###########################################
if (isset($_POST['keywords_'.$init->lang])&&!empty($_POST['keywords_'.$init->lang])) {
    $keywords=$trimText->trim(240,$antiHack->filterAll($_POST['keywords_'.$init->lang]),true);
} else {$keywords=null;}
################################################## title ###########################################
if (isset($_POST['title_'.$init->lang])&&!empty($_POST['title_'.$init->lang])) {
    $title=$trimText->trim(65,$antiHack->filterAll($_POST['title_'.$init->lang]));
} else {$init->back(666);}
###################################################### ok ###################################
if (!is_null($url)&&!is_null($name)&&!is_null($h1)) {
    $date=date('Y-m-d H:i:s');
    if ($init->dbc->insert('`global_url`',array('`url`','`date`'),array($url,$date),true)) {
        $id=$init->dbc->lastID;
        if ($init->dbc->insert('`name`',array('`id_table`','`id_row`','`name_'.$init->lang.'`'),array(10,$id,$name))&&
            $init->dbc->insert('`h1`',array('`id_table`','`id_row`','`h1_'.$init->lang.'`'),array(10,$id,$h1))&&
            $init->dbc->insert('`title`',array('`id_table`','`id_row`','`title_'.$init->lang.'`'),array(10,$id,$title))&&
            $init->dbc->insert('`description`',array('`id_table`','`id_row`','`description_'.$init->lang.'`'),array(10,$id,$description))&&
            $init->dbc->insert('`keywords`',array('`id_table`','`id_row`','`keywords_'.$init->lang.'`'),array(10,$id,$keywords))
        ) {
            $init->dbc->cc();
            header('Location: '.$init->_ADMIN_.'/global_url.php?idmenu=161&error=0');
        } else {
            $init->dbc->delete(array('`name`','`h1`','`title`','`description`','`keywords`','`global_url`'),array('`id_table`=10 && `id_row`='.$id,'`id_table`=10 && `id_row`='.$id,'`id_table`=10 && `id_row`='.$id,'`id_table`=10 && `id_row`='.$id,'`id_table`=10 && `id_row`='.$id,'`id`='.$id));
            $init->back(1010);
        }
    }
    else {$init->back(1010);}
} else {$init->back(666);}
} else {$init->back(10);}
?>