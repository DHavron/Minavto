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
############################################## email ##########################################################
if (isset($_POST['visible_block'])&&!empty($_POST['visible_block'])) {
    $visible_block=$antiHack->filterAll($_POST['visible_block']);
}
else {$visible_block=null;}
############################################## email ##########################################################
if (isset($_POST['hidden_block'])&&!empty($_POST['hidden_block'])) {
    $hidden_block=$antiHack->filterAll($_POST['hidden_block']);
}
else {$hidden_block=null;}
###################################################### link ############################
if (isset($_POST['link'])&&is_array($_POST['link']))
{
    $link=$_POST['link'];
}
else {$link=array();}
    if ($init->dbc->update('`counters`',array('`visible_block`','`hidden_block`'),array($visible_block,$hidden_block))) {
        $init->dbc->delete(array('`counters_block_links`'),array('`link`!=\'NULL\''));
        if (count($link)>0) {
            foreach ($link as $val) {
                $init->dbc->insert('`counters_block_links`',array('`link`'),array($val));
            }
        }
        $init->back(0);
    } else {$init->back(1010);}
}
else {$init->back(10);}
?>