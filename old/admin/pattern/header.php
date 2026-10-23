<!DOCTYPE html>
<html lang="<?php echo $init->lang; ?>">
<head>
<meta charset="utf-8" />
<title><?php echo mb_strtoupper($title,'UTF-8'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="<?php echo $init->_ADMIN_; ?>/css/normalize.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $init->_ADMIN_; ?>/css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $init->_ADMIN_; ?>/css/bootstrap-responsive.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $init->_ADMIN_; ?>/css/nvv-cms.css" />
<link href="<?php echo $init->_ADMIN_; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" src="<?php echo $init->_ADMIN_; ?>/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $init->_ADMIN_; ?>/js/bootstrap.min.js"></script>
<?php
if (in_array($idmenu,$ckeEditor)) {
?>
<script src="<?php echo $init->_ADMIN_; ?>/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">CKEDITOR.replaceClass = 'cke';</script>
<?php
}
?>
</head>
<body>
<div class="container">
  <div class="row">