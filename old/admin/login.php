<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/executables');
spl_autoload_extensions('.class.php');
spl_autoload_register();
$errlogin=$errpass='';
if (isset($_GET['error'])&&!empty($_GET['error'])) {
$antiHack=new antiHack;
$err=intval($antiHack->filterAll($_GET['error']));
switch ($err)
{
    case 1:
        $errlogin=' error';
        break;
    case 2:
        $errlogin=' success';
        $errpass=' error';
        break;
    case 3:
        $errlogin=' error';
        $errpass=' error';
        break;
}
}
$init=new prepend;
$coreLoad=new core($init->_DIR_.'/core/core.xml');
$core=$coreLoad->core;
$lang=$core['languages'][0];
unset($coreLoad,$core);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<meta charset="utf-8" />
<title>Авторизация | NVV-CMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="<?php echo $init->_SITE_; ?>/admin/css/normalize.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $init->_SITE_; ?>/admin/css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $init->_SITE_; ?>/admin/css/bootstrap-responsive.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $init->_SITE_; ?>/admin/css/login.css" />
<link href="<?php echo $init->_SITE_; ?>/admin/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" src="<?php echo $init->_SITE_; ?>/admin/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $init->_SITE_; ?>/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="table-responsive">
  <table class="table"><tr><td>&nbsp;</td><td class="span4">
    <form method="post" action="<?php echo $init->_SITE_; ?>/admin/performing/login.php">
    <div class="popover login">
      <h3 class="popover-title"><b>NVV-CMS</b><hr>Авторизация</h3>
      <div class="popover-content">
        <div class="form-group">
            <label for="inputLogin">Логин</label>
            <div class="input-append">
                <input type="text" class="span2" name="login" id="inputLogin">
                <span class="add-on<?php echo $errlogin; ?>"><i class="icon-user"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword">Пароль</label>
            <div class="input-append">
                <input class="span2" type="password" name="password" id="inputPassword">
                <span class="add-on<?php echo $errpass; ?>"><i class="icon-star"></i></span>
            </div>
        </div>
        <div class="form-group">
                <input class="btn btn-primary" value="Войти" type="submit">
        </div>
      </div>
    </div>
    </form>
  </td><td>&nbsp;</td></tr></table>
  </div>
</div>
</body>
</html>