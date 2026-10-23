    <div class="span9">
        <p style="text-align: right;margin-top: 10px;"></p>
    <?php
    require_once($init->_DIR_.'/admin/pattern/errors.php');
    if (($idmenu===121)&&$auth->checkRight(array(0,1,2))) {
        $res121=$init->dbc->select('`setting`',array(),null,null,'LIMIT 1');
    ?>
    <form action="<?php echo $init->_ADMIN_; ?>/performing/setting/edit_setting.php" method="post" class="form normal">
        <div class="span8" style="padding-top: 30px;">
            <div class="control-group">
                <label class="control-label" for="inputEmail">E-mail: <span class="important">*</span>&nbsp;<small class="muted">Адрес электронной почты, на который будут приходить уведомления о новых заказах, вопросах, записях на сайте...</small></label>
                <div class="controls"><input type="text" id="inputEmail" class="span8" name="email" value="<?php echo $res121[0]['email']; ?>"></div>
            </div>
        </div>
        <div class="span8 addsave" style="margin-top: 0px;">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Обновить E-mail" title="Обновить E-mail"></div>
            </div>
        </div>
    </form>
    <?php
    }
    if (($idmenu===128)&&$auth->checkRight(array(0,1,2))) {
        $res128=$init->dbc->select('`setting`',array('`text_'.$init->lang.'`'),null,null,'LIMIT 1');
    ?>
    <div class="span8 onsite">
    <?php
    if ($init->core['multilanguage']=='on') {
        for($i=0;$i<count($init->core['languages']);++$i) {
            $activeLang=($init->core['languages'][$i]==$init->lang)?' btn-info disabled':'';
            $urlLang=($init->core['languages'][$i]!=$init->core['languages'][0])?'&lang='.$init->core['languages'][$i]:'';
    ?>
            <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=128'.$urlLang; ?>" title="<?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?>" class="btn btn-mini<?php echo $activeLang; ?>"><?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?></a>
    <?php
        }
    }
    ?>
    </div>
    <form action="<?php echo $init->_ADMIN_; ?>/performing/setting/edit_text.php" method="post" class="form normal">
    <div class="disp_none">
        <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
    </div>
    <div class="span8">
        <div class="control-group">
        <label class="control-label" for="inputText">Текст на главной странице <span class="important">*</span></label>
        <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"><?php echo $res128[0]['text_'.$init->lang]; ?></textarea></div>
        </div>
    </div>
    <div class="span8 addsave" style="margin-top: 0px;">
        <div class="control-group">
            <div class="controls"><input type="submit" class="btn btn-primary" value="Сохранить изменения" title="Сохранить изменения"></div>
        </div>
    </div>
    </form>
    <?php
    }
    if (($idmenu===129)&&$auth->checkRight(array(0,1,2))) {
    ?>
    <form action="<?php echo $init->_ADMIN_; ?>/performing/setting/edit_sitemap.php" method="post" class="form normal">
    <div class="span8 addsave">
        <div class="control-group">
            <div class="controls"><input type="submit" class="btn btn-primary" value="Обновить SITEMAP.xml" title="Обновить SITEMAP.xml"></div>
        </div>
    </div>
    </form>
    <?php
    }
    if (($idmenu===191)&&$auth->checkRight(array(0,1,2))) {
        $res191=$init->dbc->select('`counters`',array(),null,null,'LIMIT 1');
        $link=array();
        foreach ($init->dbc->select('`counters_block_links`',array('`link`')) as $links) {$link[]=$links['link'];}
    ?>
    <form action="<?php echo $init->_ADMIN_; ?>/performing/setting/edit_counters.php" method="post" class="form normal">
    <div class="span8">
        <div class="control-group">
        <label class="control-label" for="inputVisible">Видимый блок</label>
        <div class="controls"><textarea id="inputVisible" cols="100" rows="10" name="visible_block" class="span8"><?php echo $res191[0]['visible_block']; ?></textarea></div>
        </div>
        <div class="control-group">
        <label class="control-label" for="inputHidden">Невидимый блок</label>
        <div class="controls"><textarea id="inputHidden" cols="100" rows="10" name="hidden_block" class="span8"><?php echo $res191[0]['hidden_block']; ?></textarea></div>
        </div>
        <div class="span8">
            <div class="control-group">
                <label class="control-label">Не показывать на страницах:</label>
            </div>
        </div>
        <?php $init->checkLinks($link); ?>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Сохранить изменения" title="Сохранить изменения"></div>
            </div>
          </div>
    </div>
    </form>
    <?php
    }
    //_______________________________________statistics________________________________________
    if ($idmenu==195) {
    $button=(isset($_REQUEST['button']))?$_REQUEST['button']:'today';
    $today=(!is_null($button)&&($button=='today'))?' btn-info disabled':'';
    $yestoday=(!is_null($button)&&($button=='yestoday'))?' btn-info disabled':'';
    $week=(!is_null($button)&&($button=='week'))?' btn-info disabled':'';
    $month=(!is_null($button)&&($button=='month'))?' btn-info disabled':'';
    $year=(!is_null($button)&&($button=='year'))?' btn-info disabled':'';
    $end=(isset($_REQUEST['end']))?$antiHack->filterAll($_REQUEST['end']):date('Y-m-d');
    $start=(isset($_REQUEST['start']))?$_REQUEST['start']:date('Y-m-d');
    if (!isset($_REQUEST['show_filters'])) {$shFil='';$forUrlFil='&show_filters';} else {$shFil=' btn-info disabled';$forUrlFil='';}
    ?>
    <div class="span8 onsite">
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button='.$button.'&start='.$start.'&end='.$end.$forUrlFil; ?>" class="btn btn-mini<?php echo $shFil; ?>" style="margin-left: 30px;">Фильтры</a>
    <?php
    if ($shFil!='') {
        require_once($init->_DIR_.'/admin/pattern/show_filters.php');
        showFilters($init);
    }
    ?>
        &nbsp;&nbsp;&nbsp;Показать&nbsp;за:&nbsp;
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button=today&start='.date('Y-m-d'); ?>" class="btn btn-mini<?php echo $today; ?>">Сегодня</a>
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button=yestoday&start='.date('Y-m-d',strtotime("-1 day")).'&end='.date('Y-m-d',strtotime("-1 day")); ?>" class="btn btn-mini<?php echo $yestoday; ?>">Вчера</a>
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button=week&start='.date('Y-m-d',strtotime("-1 week")); ?>" class="btn btn-mini<?php echo $week; ?>">Неделя</a>
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button=month&start='.date('Y-m-d',strtotime("-1 month")); ?>" class="btn btn-mini<?php echo $month; ?>">Месяц</a>
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button=year&start='.date('Y-m-d',strtotime("-1 year")); ?>" class="btn btn-mini<?php echo $year; ?>">Год</a>
    </div>
    <form action="<?php echo $init->_ADMIN_; ?>/setting.php" method="get" class="form normal">
    <div class="disp_none"><input type="hidden" name="idmenu" value="195"></div>
    <div class="span8 onsite filters">
    <label>Показать с <input type="date" name="start" value="<?php echo $start; ?>" class="span2"> по <input type="date" name="end" value="<?php echo $end; ?>" class="span2"> <input type="submit" value="Показать" title="Показать" class="btn"></label>
    </div>
    </form>
    <?php
    $filterUse=(isset($_REQUEST['filter']))?$antiHack->filterAll($_REQUEST['filter']):null;
    $dopWhere=(is_null($filterUse))?'':' && `user_agent` '.$noFilter.'LIKE \'%'.$filterUse.'%\'';
    $resFilters=$init->dbc->select('`filters_statistics`',array('`name_user_agent`','`name`'),null,'`name`');
    $ativeNoFilters=(isset($_REQUEST['nofilters']))?' btn-info disabled':null;
    if (count($resFilters)>0) {
    ?>
    <div class="span8 onsite">Применить фильтр:
        <?php
        foreach ($resFilters as $filter) {
        $actFilt=(!is_null($filterUse)&&($filterUse==$filter['name_user_agent']))?' btn-info disabled':null;
        ?>
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button='.$button.'&start='.$start.'&end='.$end.'&filter='.$filter['name_user_agent']; ?>" class="btn btn-mini<?php echo $actFilt; ?>"><?php echo $filter['name']; ?></a>
        <?php
        }
        ?>
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button='.$button.'&start='.$start.'&end='.$end; ?>&nofilters" class="btn btn-mini<?php echo $ativeNoFilters; ?>">Исключить фильтры</a>
        <a href="<?php echo $init->_ADMIN_.'/setting.php?idmenu=195&button='.$button.'&start='.$start.'&end='.$end; ?>" class="btn btn-mini btn-warning">Очистить фильтр</a>
    </div>
    <?php
    }
    $noFilter=array();
    if (isset($_REQUEST['nofilters'])) {
        $bots=$resFilters;
        for($i=0;$i<count($resFilters);++$i) {
            $noFilter[]='`user_agent` NOT LIKE \'%'.$resFilters[$i]['name_user_agent'].'%\'';
        }
    }
    if (($dopWhere=='')&&(count($noFilter)>0)) $dopWhere=' && '.implode(' && ',$noFilter);
    $res195=$init->dbc->select('`statistics`',array('`user_agent`','`ip`','`date-date`','`date-time`','`refer_domain`','`refer`','`refer_enc`','`start_page`','`country`','`city`'),'`date-date`>=\''.$start.'\' && `date-date`<=\''.$end.'\''.$dopWhere,'`date-date` DESC, `date-time` DESC');
    ?>
    <div class="span8">
    <table class="table table-bordered statictic">
    <head>
        <tr><th colspan="8">User-Agent</th></tr>
        <tr><th>IP</th><th>Дата/Время</th><th>Домен источника</th><th>URL</th><th>URL (decode)</th><th>Посещенная страница</th><th>Страна</th><th>Город</th></tr>
    </head>
    <tbody>
    <tr><td colspan="8">Посещений: <?php echo count($res195);?></td></tr>
    <?php
    if (count($res195)>0) {
    foreach($res195 as $result) {
    ?>
        <tr><td colspan="8"><?php echo $result['user_agent']; ?></td></tr>
        <tr><td><?php echo long2ip($result['ip']); ?></td><td><?php echo $result['date-date'].'&nbsp;'.$result['date-time']; ?></td><td><a href="<?php echo $result['refer_domain']; ?>" target="_blank"><?php echo $result['refer_domain']; ?></a></td><td><a href="<?php echo $result['refer']; ?>" target="_blank"><?php echo $result['refer']; ?></a></td><td><?php echo $result['refer_enc']; ?></td><td><?php echo $result['start_page']; ?></td><td><?php echo $result['country']; ?></td><td><?php echo $result['city']; ?></td></tr>
    <?php
    }
    }
    ?>
    </tbody>
    </table>
    </div>
    <?php
    }
    ?>
    </div>