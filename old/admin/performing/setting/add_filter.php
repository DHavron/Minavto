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
if (isset($_POST['name'])&&!empty($_POST['name']))
{
    $name=$trimText->trim(95,$antiHack->filterAll($_POST['name']));
}
else {$init->back(666);}
############################################## name_user_agent ##########################################################
if (isset($_POST['name_user_agent'])&&!empty($_POST['name_user_agent']))
{
    $name_user_agent=$trimText->trim(95,$antiHack->filterAll($_POST['name_user_agent']));
}
else {$init->back(666);}
###################################################### ok ###################################
if (($name!='')&&($name_user_agent!='')) {
    if ($init->dbc->insert('`filters_statistics`',array('`name_user_agent`','`name`'),array($name_user_agent,$name))) {
        $init->dbc->cc();
        header('Location: '.$init->_ADMIN_.'/setting.php?idmenu=195&error=0&show_filters&button=today&start='.date('Y-m-d'));
    }
    else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>