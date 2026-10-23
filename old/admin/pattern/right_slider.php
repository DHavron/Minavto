    <div class="span9">
    <?php
    require_once($init->_DIR_.'/admin/pattern/errors.php');
    if (($vivod===1)&&$auth->checkRight(0,1,2)&&($idmenu===131)) {
    ?>
        <p style="text-align: right;margin-top: 10px;"><a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $add; ?>" title="Создать слайдер" class="btn">Создать слайдер</a></p>
    <?php
    }
    if (($idmenu==141)||($idmenu==143)||($idmenu==145)) {echo '<p style="text-align: right;margin-top: 10px;">&nbsp;</p>';}
    if (($vivod===1)&&($idmenu===131)) {require_once($init->_DIR_.'/admin/pattern/show_all.php'); }
    //________________________________________________добавление слайдера____________________________________________
    if ($idmenu===133) {
    ?>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/slider/add_slider.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название слайдера <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span4" name="level"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="selectPosition">Позиция слайдера<span class="important">*</span></label>
                <div class="controls"><?php echo $init->positionSlider(); ?></div>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label">Показывать на страницах:</label>
            </div>
          </div>
          <?php $init->checkLinks(); ?>
          <div class="span8">
            <div class="control-group">
                <label class="control-label" for="inputText">Текст</label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"></textarea></div>
            </div>
          </div>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Создать слайдер" title="Создать слайдер"></div>
            </div>
          </div>
        </form>
    <?php
    }
    //________________________________________________редактирование слайдера____________________________________________
    if ($idmenu===135) {
        $res135=$init->dbc->select('`slider` `s`,`name` `n`,`text` `t`',array('`s`.`level`','`s`.`id_position`','`n`.`name_'.$init->lang.'`','`t`.`text_'.$init->lang.'`'),'`s`.`id`='.$id.' && `n`.`id_table`=14 && `n`.`id_row`=`s`.`id` && `t`.`id_table`=14 && `t`.`id_row`=`s`.`id`',null,'LIMIT 1');
    ?>
        <div class="span8 onsite">
    <?php
    if ($init->core['multilanguage']=='on') {
        for($i=0;$i<count($init->core['languages']);++$i) {
            $activeLang=($init->core['languages'][$i]==$init->lang)?' btn-info disabled':'';
            $urlLang=($init->core['languages'][$i]!=$init->core['languages'][0])?'&lang='.$init->core['languages'][$i]:'';
    ?>
            <a href="<?php echo $init->_ADMIN_.'/slider.php?idmenu=135&id='.$id.$urlLang; ?>" title="<?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?>" class="btn btn-mini<?php echo $activeLang; ?>"><?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?></a>
    <?php
        }
    }
    ?>
        </div>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/slider/edit_slider.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название слайдера <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>" value="<?php echo $res135[0]['name_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span4" name="level" value="<?php echo $res135[0]['level']; ?>"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="selectPosition">Позиция слайдера<span class="important">*</span></label>
                <div class="controls"><?php echo $init->positionSlider($res135[0]['id_position']); ?></div>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label">Показывать на страницах:</label>
            </div>
          </div>
          <?php
          $link=array();
          foreach ($init->dbc->select('`slider_links`',array('`link`'),'`id_slider`='.$id) as $links) {$link[]=$links['link'];}
          $init->checkLinks($link);
          ?>
          <div class="span8">
            <div class="control-group">
                <label class="control-label" for="inputText">Текст</label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"><?php echo $res135[0]['text_'.$init->lang]; ?></textarea></div>
            </div>
          </div>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Сохранить изменения" title="Сохранить изменения"></div>
            </div>
          </div>
        </form>
    <?php
    }
    if (($idmenu==141)||($idmenu==143)||($idmenu==145)) {
    ?>
    <div class="row">
        <div class="span3">
        <ul class="nav nav-list">
        <li><a>Список слайдеров&nbsp;&nbsp;<i class="icon-chevron-down"></i></a></li>
        <?php
        $resultSlider=$init->dbc->select('`slider` `s`,`name` `n`',array('`s`.`id`','`n`.`name_'.$init->lang.'`'),'`n`.`id_row`=`s`.`id` && `n`.`id_table`=14','`s`.`level` DESC,`s`.`id` DESC');
        for($i=0;$i<count($resultSlider);++$i) {
            $select=($resultSlider[$i]['id']==$idCat)?' class="active"':null;
            $arrow=($resultSlider[$i]['id']==$idCat)?' <i class="icon-arrow-right icon-white"></i>':null;
        ?>
        <li<?php echo $select; ?>><a href="<?php echo $init->_ADMIN_; ?>/slider.php?idmenu=141&id_category=<?php echo $resultSlider[$i]['id']; ?>" title="Смотреть изображения слайдера"><?php echo $resultSlider[$i]['name_'.$init->lang].$arrow; ?></a></li>
        <?php
        }
        ?>
        </ul>
        </div>
        <div class="span5">
            <div class="onsite"><?php if (($idCat>0)&&($id==0)) { ?><a href="<?php echo $init->_ADMIN_.'/slider.php?idmenu='.$add.'&id_category='.$idCat.'&id='.$idCat; ?>" class="btn to-right">Добавить слайд</a><?php } ?></div>
            <?php
            if (($idmenu==143)&&($id>0)) {
            ?>
            <form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/slides/add_slide.php" method="post" class="form normal">
            <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id_slider" value="<?php echo $idCat; ?>">
            <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
          </div>
            <div class="control-group">
                <label class="control-label" for="inputName">Название слайда <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span5" name="name_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputUrl">URL ссылка <span class="important">*</span>&nbsp;<small class="muted">Не более 200 символов</small></label>
                <div class="controls"><input type="text" id="inputUrl" class="span5" name="link"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span5" name="level"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputImage">Изображение <span class="important">*</span>&nbsp;<small class="muted">Не более 2 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
                <div class="controls"><input type="file" id="inputImage" class="span5" name="img"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputText">Текст слайда</label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"></textarea></div>
            </div>
            <div class="control-group addsave">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Добавить слайд" title="Добавить слайд"></div>
            </div>
            </form>
            <?php
            } elseif (($idmenu===145)&&($id>0)){
                $res145=$init->dbc->select('`slides` `sl`,`name` `n`,`text` `t`',array('`sl`.`link`','`sl`.`level`','`n`.`name_'.$init->lang.'`','`t`.`text_'.$init->lang.'`'),'`sl`.`id`='.$id.' && `n`.`id_table`=15 && `n`.`id_row`=`sl`.`id` && `t`.`id_table`=15 && `t`.`id_row`=`sl`.`id`',null,'LIMIT 1');
            ?>
        <div class="span5 onsite">
        <?php
        if ($init->core['multilanguage']=='on') {
        for($i=0;$i<count($init->core['languages']);++$i) {
            $activeLang=($init->core['languages'][$i]==$init->lang)?' btn-info disabled':'';
            $urlLang=($init->core['languages'][$i]!=$init->core['languages'][0])?'&lang='.$init->core['languages'][$i]:'';
        ?>
            <a href="<?php echo $init->_ADMIN_.'/slider.php?idmenu=145&&id_category='.$idCat.'&id='.$id.$urlLang; ?>" title="<?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?>" class="btn btn-mini<?php echo $activeLang; ?>"><?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?></a>
        <?php
                }
            }
        ?>
        </div>
            <form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/slides/edit_slide.php" method="post" class="form normal">
            <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
          </div>
            <div class="control-group">
                <label class="control-label" for="inputName">Название слайда <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span5" name="name_<?php echo $init->lang; ?>" value="<?php echo $res145[0]['name_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputUrl">URL ссылка <span class="important">*</span>&nbsp;<small class="muted">Не более 200 символов</small></label>
                <div class="controls"><input type="text" id="inputUrl" class="span5" name="link" value="<?php echo $res145[0]['link']; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span5" name="level" value="<?php echo $res145[0]['level']; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputText">Текст слайда</label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"><?php echo $res145[0]['text_'.$init->lang]; ?></textarea></div>
            </div>
            <div class="control-group addsave">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Сохранить изменения" title="Сохранить изменения"></div>
            </div>
            </form>
            <?php
            } else {
            $resSlides=$init->dbc->select('`slides` `sl`,`slider` `s`,`name` `n`',array('`sl`.`id`','`sl`.`link`','`sl`.`img`','`sl`.`level`','`s`.`folder`','`n`.`name_'.$init->lang.'`'),'`sl`.`id_slider`='.$idCat.' && `s`.`id`='.$idCat.' && `n`.`id_table`=15 && `n`.`id_row`=`sl`.`id`','`sl`.`level` DESC,`sl`.`id` DESC');
            if (count($resSlides)>0) {
            ?>
            <div class="span5" style="margin-top: 10px;">
            <link type="text/css" rel="stylesheet" href="<?php echo $init->_ADMIN_; ?>/js/fancybox/fancybox.css" />
            <script src="<?php echo $init->_ADMIN_; ?>/js/fancybox/jquery.fancybox.pack.js"></script>
            <div class="slides">
            <?php
                for($i=0;$i<count($resSlides);++$i) {
                ?>
                <div>
                <a href="<?php echo $init->_SITE_; ?>/img/slider/<?php echo $resSlides[$i]['folder']; ?>/<?php echo $resSlides[$i]['img']; ?>" rel="group" class="fancybox" target="_blank" title="<?php echo $resSlides[$i]['name_'.$init->lang]; ?>"><img src="<?php echo $init->_SITE_; ?>/img/slider/<?php echo $resSlides[$i]['folder']; ?>/<?php echo $resSlides[$i]['img']; ?>" alt="<?php echo $resSlides[$i]['name_'.$init->lang]; ?>" /></a>
                <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $edit; ?>&id=<?php echo $resSlides[$i]['id']; ?>&id_category=<?php echo $idCat; ?>" class="btn btn-mini" title="Редактировать">Редактировать</a>
                <a href="<?php echo $init->_ADMIN_; ?>/performing/slides/delete_<?php echo $table; ?>.php?id=<?php echo $resSlides[$i]['id']; ?>" class="btn btn-mini btn-danger" title="Удалить изображение">Удалить</a>
                </div>
                <?php
                }
            ?>
            </div>
            <script>$(".fancybox").fancybox();</script>
            <?php
            }
            ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    }
    ?>
    </div>