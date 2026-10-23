<div class="span3 left-menu">
        <ul class="nav nav-list menu">
        <li><a href="<?php echo $init->_SITE_; ?>" target="_blank"><i class="icon-home"></i>Посмотреть сайт</a></li>
        <li<?php if (($_SERVER['PHP_SELF']=='/admin/article.php')||in_array($idmenu,$id_Article)) { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/article.php?idmenu=1"><i class="icon-book"></i>Статьи</a></li>
        <li<?php if (($_SERVER['PHP_SELF']=='/admin/news.php')/*||in_array($idmenu,$id_categoryNews)||in_array($idmenu,$id_News)*/) { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/news.php?idmenu=42"><i class="icon-pencil"></i>Новости</a></li>
        <li<?php if (($_SERVER['PHP_SELF']=='/admin/menu.php')||in_array($idmenu,$id_Menu)) { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/menu.php?idmenu=51"><i class="icon-list-alt"></i>Меню сайта</a></li>
        <li<?php if (($_SERVER['PHP_SELF']=='/admin/moduls.php')/*||in_array($idmenu,$id_Moduls)||($idmenu==62)*/) { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/moduls.php"><i class="icon-th-large"></i>Модули</a>
        <?php if (($_SERVER['PHP_SELF']=='/admin/moduls.php')/*||in_array($idmenu,$id_Moduls)||($idmenu==62)*/) { ?>
            <ul class="nav nav-list menu">
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/moduls.php?idmenu=61"<?php if (in_array($idmenu,$id_Moduls)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Модули сайта</a></li>
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/moduls.php?idmenu=62"<?php if ($idmenu==62) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Схема расположения модулей</a></li>
            </ul>
        <?php } ?>
        </li>
        <li<?php if ($_SERVER['PHP_SELF']=='/admin/global_url.php') { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/global_url.php?idmenu=161"><i class="icon-tag"></i>Доп. страницы</a></li>
        <li<?php if (($_SERVER['PHP_SELF']=='/admin/slider.php')/*||in_array($idmenu,$id_Sliders)||in_array($idmenu,$id_Slides)*/) { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/slider.php"><i class="icon-picture"></i>Слайдеры</a>
            <?php if (($_SERVER['PHP_SELF']=='/admin/slider.php')/*||in_array($idmenu,$id_Sliders)||in_array($idmenu,$id_Slides)*/) { ?>
            <ul class="nav nav-list menu">
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/slider.php?idmenu=131"<?php if (in_array($idmenu,$id_Sliders)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Слайдеры сайта</a></li>
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/slider.php?idmenu=141"<?php if (in_array($idmenu,$id_Slides)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Изображения слайдера</a></li>
            </ul>
            <?php } ?>
        </li>
        <?php if ($auth->checkRight(array(0,1))) { ?>
        <li<?php if (($_SERVER['PHP_SELF']=='/admin/admins.php')) { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/admins.php?idmenu=111"><i class="icon-fire"></i>Администраторы</a></li>
        <?php } ?>
        <li<?php if (($_SERVER['PHP_SELF']=='/admin/setting.php')) { ?> class="active"<?php } ?>><a href="<?php echo $init->_ADMIN_; ?>/setting.php"><i class="icon-wrench"></i>Настройки</a>
            <?php if (($_SERVER['PHP_SELF']=='/admin/setting.php')) { ?>
            <ul class="nav nav-list menu">
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/setting.php?idmenu=121"<?php if (($idmenu==121)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Основные настройки</a></li>
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/setting.php?idmenu=128"<?php if (in_array($idmenu,$id_indexText)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Текст на главной странице</a></li>
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/setting.php?idmenu=129"<?php if (in_array($idmenu,$id_Sitemap)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Файл Sitemap.xml</a></li>
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/setting.php?idmenu=191"<?php if (in_array($idmenu,$id_counters)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Счетчики | Метрика</a></li>
                <li class="active"><a href="<?php echo $init->_ADMIN_; ?>/setting.php?idmenu=195<?php echo '&button=today&start='.date('Y-m-d'); ?>"<?php if (in_array($idmenu,$id_stat)) { ?> class="active"<?php } ?>><i class="icon-chevron-right"></i>Статистика</a></li>
            </ul>
            <?php } ?>
        </li>
        <li class="text-center"><small>NVV-CMS.v220615</small></li>
        </ul>
    </div>