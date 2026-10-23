<!DOCTYPE html>
<html lang="<?php echo $this->lang; ?>">
<head>
    <meta charset="utf-8" />
    <title><?php echo $this->tdk['title']; ?></title>
    <meta name="author" content="<?php echo $this->_SITE_; ?>" />
    <meta name="generator" content="NVV-CMS" />
    <meta name="description" content="<?php echo $this->tdk['description']; ?>" />
    <meta name="keywords" content="<?php echo $this->tdk['keywords']; ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->_SITE_; ?>/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" media="all" href="<?php echo $this->_SITE_; ?>/css/index.css" />
    <!--[if lte IE 8]><link href="<?php echo $this->_SITE_; ?>/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
    <script type="text/javascript" src="<?php echo $this->_SITE_; ?>/js/jquery-1.10.2.min.js"></script>
<?php
    $this->hrefLang();
    $this->getStyles();
    $this->getScripts();
?>
</head>
<body>
<div id="up"></div><div id="content">
<?php
$modul=new moduls($this->dbc,$this->_SITE_,$this->url,$this->lang);
?>