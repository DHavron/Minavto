<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/executables');
spl_autoload_extensions('.class.php');
spl_autoload_register();
$init=new admin();
if ($init->validateSender()) {
$antiHack=new antiHack;
############################################## login ##########################################################
if (isset($_POST['login'])&&!empty($_POST['login']))
{
    $login=$antiHack->filterAll($_POST['login']);
}
else {$init->back(1);}
############################################## password ###################################################
if (isset($_POST['password'])&&!empty($_POST['password']))
{
    $password=$antiHack->filterAll($_POST['password']);
}
else {$init->back(2);}
###############################################################
if (!empty($login)&&!empty($password)) {
    $pass=sha1(md5($password));
    $query=$init->dbc->select('`admin_users`',array('`id`','`id_right`'),'`login`=\''.$login.'\' && `password`=\''.$pass.'\' LIMIT 1');
    if (count($query)>0) {
        $init->dbc->cc();
        $auth=new auth(1800,true);
        $auth->clearUsers('admin');
        $auth->setAuth('admin',$query[0]['id'],$pass,$query[0]['id_right']);
        $_SESSION['search']=$_SESSION['search_self']="";
        $_SESSION['mf']=0;
        header("Location: ".$init->_ADMIN_);
    }
    else {$init->back(3);}
}
else {$init->back(3);}
}
else {$init->back(3);}
?>