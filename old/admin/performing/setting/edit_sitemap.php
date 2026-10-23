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
    $sitemap=new sitemap($init);
    if ($sitemap->updateSitemapFile($init->_DIR_.'/sitemap.xml')) {$init->back(0);} else {$init->back(20);}
}
else {$init->back(10);}
?>