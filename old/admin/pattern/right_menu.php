    <div class="span9">
    <?php
    require_once($init->_DIR_.'/admin/pattern/errors.php');
    if (($vivod===1)&&$auth->checkRight(0,1)) {
    ?>
        <p style="text-align: right;margin-top: 10px;"><a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $add; ?>" title="Добавить пункт меню" class="btn">Добавить пункт меню</a></p>
    <?php
    }
    if (($vivod===1)&&($idmenu==51)) {
        require_once($init->_DIR_.'/admin/pattern/show_ierarh.php');
    }
    //________________________________________________добавление пункт меню____________________________________________
    if ($idmenu===53) {
    ?>
        <form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/menu/add_menu.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название пункта меню <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span4" name="level"></div>
            </div>
            <div class="control-group">
                <label class="checkbox" for="inputNew">Отобразить ссылку&nbsp;<input type="checkbox" id="inputNew" name="click" checked="checked">&nbsp;<small class="muted">Определяет кликабельность ссылки</small></label>
                <div class="controls">&nbsp;<br />&nbsp;</div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputH1">Вложенность меню</label>
                <div class="controls"><?php echo $init->selectParent('menu'); ?></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputImage">Иконка&nbsp;<small class="muted">Не более 2 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
                <div class="controls"><input type="file" id="inputImage" class="span4" name="icon"></div>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label">Выберите ссылку</label>
            </div>
          </div>
          <?php $init->selectLink(); ?>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Добавить пункт меню" title="Добавить пункт меню"></div>
            </div>
          </div>
        </form>
    <?php
    }
    //________________________________________________редактирование пункта меню____________________________________________
    if ($idmenu===55) {
        $res55=$init->dbc->select('`menu` `m`,`name` `n`',array('`m`.`parent`','`m`.`icon`','`m`.`click`','`m`.`link`','`m`.`level`','`n`.`name_'.$init->lang.'`'),'`m`.`id`='.$id.' && `n`.`id_table`=11 && `n`.`id_row`=`m`.`id`',null,'LIMIT 1');
        $icon=new admin_img($init->_SITE_,$init->_DIR_,'/menu/',$res55[0]['icon']);
    ?>
        <div class="span8 onsite">
    <?php
    if ($init->core['multilanguage']=='on') {
        for($i=0;$i<count($init->core['languages']);++$i) {
            $activeLang=($init->core['languages'][$i]==$init->lang)?' btn-info disabled':'';
            $urlLang=($init->core['languages'][$i]!=$init->core['languages'][0])?'&lang='.$init->core['languages'][$i]:'';
    ?>
            <a href="<?php echo $init->_ADMIN_.'/menu.php?idmenu=55&id='.$id.$urlLang; ?>" title="<?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?>" class="btn btn-mini<?php echo $activeLang; ?>"><?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?></a>
    <?php
        }
    }
    ?>
        </div>
        <form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/menu/edit_menu.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название пункта меню <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>" value="<?php echo $res55[0]['name_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span4" name="level" value="<?php echo $res55[0]['level']; ?>"></div>
            </div>
            <div class="control-group">
                <label class="checkbox" for="inputNew">Отобразить ссылку&nbsp;<input type="checkbox" id="inputNew" name="click"<?php if ($res55[0]['click']=='on') { ?> checked="checked"<?php } ?>>&nbsp;<small class="muted">Определяет кликабельность ссылки</small></label>
                <div class="controls">&nbsp;<br />&nbsp;</div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputH1">Вложенность меню</label>
                <div class="controls"><?php echo $init->selectParent('menu',$res55[0]['parent'],$id); ?></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputImage">Иконка&nbsp;<small class="muted">Не более 2 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
                <div class="controls"><input type="file" id="inputImage" class="span4" name="icon"<?php echo ($init->lang==$init->core['languages'][0])?'':' disabled="disabled"'; ?>></div>
                <?php if (!is_null($res55[0]['icon'])) { ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $init->_ADMIN_; ?>/js/fancybox/fancybox.css" />
                <script src="<?php echo $init->_ADMIN_; ?>/js/fancybox/jquery.fancybox.pack.js"></script>
                <div class="image"><a href="<?php echo $init->_SITE_.'/img/menu/'.$res55[0]['icon']; ?>" title="<?php echo $res55[0]['name_'.$init->lang]; ?>" target="_blank" class="fancybox"><?php $icon->show_image(); ?></a><br><a href="<?php echo $init->_ADMIN_; ?>/performing/menu/delete_icon_menu.php?id=<?php echo $id; ?>" class="btn btn-mini btn-danger" title="Удалить изображение">Удалить изображение</a></div>
                <script>
                $(".fancybox").fancybox();
                </script>
                <?php } ?>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label">Выберите ссылку</label>
            </div>
          </div>
          <?php $init->selectLink($res55[0]['link']); ?>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Сохранить изменения" title="Сохранить изменения"></div>
            </div>
          </div>
        </form>
    <?php
    }
    ?>
    </div>