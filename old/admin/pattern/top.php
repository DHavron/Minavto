<div class="container top navbar navbar-inverse navbar-fixed-top">
    <div class="row">
        <div class="span3 explorer">
            <?php
            if (!isset($_REQUEST['explorer'])) {
                $activeExp='';
                $forUrlExp=($_SERVER['QUERY_STRING']=='')?$init->_SITE_.$_SERVER['REQUEST_URI'].'?explorer':$init->_SITE_.$_SERVER['REQUEST_URI'].'&explorer';
            } else {
                $activeExp=' disabled';
                $forUrlExp=preg_replace('/(&|\?)?explorer/','',$init->_SITE_.$_SERVER['REQUEST_URI']);
            }
            ?>
            <a href="<?php echo $forUrlExp; ?>" title="Менеджер фалов" class="btn btn-info btn-small<?php echo $activeExp; ?>"><i class="icon-file"></i> Менеджер файлов</a>
            <?php
            if ($activeExp!='') {
                require_once($init->_DIR_.'/admin/pattern/show_explorer.php');
                showExplorer($init);
            }
            ?>
        </div>
        <div class="span6">
            <?php echo mb_strtoupper($title,'UTF-8'); ?>
        </div>
        <div class="span3 text-right">
            <b>nvvby</b>
            <a href="<?php echo $init->_ADMIN_; ?>/exit.php" title="Выйти" class="btn btn-inverse btn-small">Выход</a>
        </div>
    </div>
</div>
<div class="container null">&nbsp;</div>