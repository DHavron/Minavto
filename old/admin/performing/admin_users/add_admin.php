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
############################################## fio ##########################################################
if (isset($_POST['fio'])&&!empty($_POST['fio']))
{
    $fio=$trimText->trim(75,$antiHack->filterAll($_POST['fio']));
}
else {$init->back(666);}
################################################## url ###########################################
if (isset($_POST['email'])&&!empty($_POST['email']))
{
    $email=$trimText->trim(100,$antiHack->filterAll($_POST['email']));
}
else {$email=null;}
################################################## login ###########################################
if (isset($_POST['login'])&&!empty($_POST['login']))
{
    $login=$trimText->trim(30,$antiHack->filterAll($_POST['login']));
    if (strlen($login)<5) {$init->back(1020);}
}
else {$init->back(666);}
################################################## password ###########################################
if (isset($_POST['password'])&&!empty($_POST['password']))
{
    $password=$antiHack->filterAll($_POST['password']);
    if (strlen($password)<5) {$init->back(1020);}
    $password=sha1(md5($password));
}
else {$init->back(666);}
################################################## id_right ###########################################
if (isset($_POST['id_right'])&&!empty($_POST['id_right']))
{
    $id_right=intval($antiHack->filterAll($_POST['id_right']));
}
else {$init->back(666);}
################################################## prim ###########################################
if (isset($_POST['prim'])&&!empty($_POST['prim']))
{
    $prim=$trimText->trim(240,$antiHack->filterAll($_POST['prim']),true);
}
else {$prim=null;}
###################################################### ok ###################################
if (($login!='')&&($password!='')&&($id_right>0)) {
    if ($init->dbc->insert('`admin_users`',array('`login`','`password`','`fio`','`email`','`id_right`','`prim`'),array($login,$password,$fio,$email,$id_right,$prim))) {
        $init->dbc->cc();
        header('Location: '.$init->_ADMIN_.'/admins.php?idmenu=111&error=0');
    }
    else {$init->back(1010);}
}
else {$init->back(666);}
}
else {$init->back(10);}
?>