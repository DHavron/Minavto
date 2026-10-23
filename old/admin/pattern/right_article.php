    <div class="span9">
    <?php
    require_once($init->_DIR_.'/admin/pattern/errors.php');
    if (($vivod===1)&&$auth->checkRight(0,1)) {
    ?>
        <p style="text-align: right;margin-top: 10px;"><a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $add; ?>" title="Добавить статью" class="btn">Добавить статью</a></p>
    <?php
    }
    if ($vivod===1) {require_once($init->_DIR_.'/admin/pattern/show_all.php'); }
    //________________________________________________добавление статьи____________________________________________
    if ($idmenu===3) {
    ?>
        <form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/article/add_article.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название статьи <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputH1">Мета-тег H1 <span class="important">*</span>&nbsp;<small class="muted">Не более 250 символов</small></label>
                <div class="controls"><input type="text" id="inputH1" class="span4" name="h1_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDescription">Мета-тег DESCRIPTION&nbsp;<small class="muted">Не более 250 символов</small></label>
                <div class="controls"><input type="text" id="inputDescription" class="span4" name="description_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span4" name="level"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputURL">СЕО URL <span class="important">*</span>&nbsp;<small class="muted">Должен быть уникальным</small></label>
                <div class="controls"><input type="text" id="inputURL" class="span4" name="url"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputTitle">Мета-тег TITLE <span class="important">*</span>&nbsp;<small class="muted">Не более: 65 символов или 12 слов</small></label>
                <div class="controls"><input type="text" id="inputTitle" class="span4" name="title_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputKeywords">Мета-тег KEYWORDS&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputKeywords" class="span4" name="keywords_<?php echo $init->lang; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputImage">Изображение&nbsp;<small class="muted">Не более 2 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
                <div class="controls"><input type="file" id="inputImage" class="span4" name="img"></div>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label" for="inputText">Текст <span class="important">*</span></label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"></textarea></div>
            </div>
          </div>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Добавить статью" title="Добавить статью"></div>
            </div>
          </div>
        </form>
    <?php
    }
    //_______________________________________редактирование статьи________________________________________
    if ($idmenu===5) {
        $res5=$init->dbc->select('`article` `a`,`name` `n`,`h1` `h`,`title` `tit`,`description` `d`,`keywords` `k`,`text` `t`',array('`a`.`url`','`a`.`img`','`a`.`level`','`a`.`show`','`n`.`name_'.$init->lang.'`','`h`.`h1_'.$init->lang.'`','`tit`.`title_'.$init->lang.'`','`d`.`description_'.$init->lang.'`','`k`.`keywords_'.$init->lang.'`','`t`.`text_'.$init->lang.'`'),"`a`.`id`=".$id." && `n`.`id_table`=1 && `n`.`id_row`=`a`.`id` && `h`.`id_table`=1 && `h`.`id_row`=`a`.`id` && `tit`.`id_table`=1 && `tit`.`id_row`=`a`.`id` && `d`.`id_table`=1 && `d`.`id_row`=`a`.`id` && `k`.`id_table`=1 && `k`.`id_row`=`a`.`id` && `t`.`id_table`=1 && `t`.`id_row`=`a`.`id`",null,'LIMIT 1');
        $image=new admin_img($init->_SITE_,$init->_DIR_,'/article/',$res5[0]['img']);
    ?>
        <div class="span8 onsite">
    <?php
    if ($init->core['multilanguage']=='on') {
        for($i=0;$i<count($init->core['languages']);++$i) {
            $activeLang=($init->core['languages'][$i]==$init->lang)?' btn-info disabled':'';
            $urlLang=($init->core['languages'][$i]!=$init->core['languages'][0])?'&lang='.$init->core['languages'][$i]:'';
    ?>
            <a href="<?php echo $init->_ADMIN_.'/article.php?idmenu=5&id='.$id.$urlLang; ?>" title="<?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?>" class="btn btn-mini<?php echo $activeLang; ?>"><?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?></a>
    <?php
        }
    }
    if ($res5[0]['show']==='on') {
        $createUrl=new createUrl($init->dbc,$init->core);
        $toSite=($init->core['multilanguage']=='on')?$init->_SITE_.'/'.$init->lang:$init->_SITE_;
    ?>
            <a href="<?php echo $toSite.$createUrl->url('article',$id); ?>" class="btn btn-info btn-mini to-right" target="_blank">Посмотреть на сайте</a>
    <?php } ?>
        </div>
        <form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/article/edit_article.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название статьи <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>" value="<?php echo $res5[0]['name_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputH1">Мета-тег H1 <span class="important">*</span>&nbsp;<small class="muted">Не более 250 символов</small></label>
                <div class="controls"><input type="text" id="inputH1" class="span4" name="h1_<?php echo $init->lang; ?>" value="<?php echo $res5[0]['h1_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDescription">Мета-тег DESCRIPTION&nbsp;<small class="muted">Не более 250 символов</small></label>
                <div class="controls"><input type="text" id="inputDescription" class="span4" name="description_<?php echo $init->lang; ?>" value="<?php echo $res5[0]['description_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
                <div class="controls"><input type="text" id="inputLevel" class="span4" name="level" value="<?php echo $res5[0]['level']; ?>"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputURL">СЕО URL <span class="important">*</span>&nbsp;<small class="muted">Должен быть уникальным</small></label>
                <div class="controls"><input type="text" id="inputURL" class="span4" name="url" value="<?php echo $res5[0]['url']; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputTitle">Мета-тег TITLE <span class="important">*</span>&nbsp;<small class="muted">Не более: 65 символов или 12 слов</small></label>
                <div class="controls"><input type="text" id="inputTitle" class="span4" name="title_<?php echo $init->lang; ?>" value="<?php echo $res5[0]['title_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputKeywords">Мета-тег KEYWORDS&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputKeywords" class="span4" name="keywords_<?php echo $init->lang; ?>" value="<?php echo $res5[0]['keywords_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputImage">Изображение&nbsp;<small class="muted">Не более 2 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
                <div class="controls"><input type="file" id="inputImage" class="span4" name="img"<?php echo ($init->lang==$init->core['languages'][0])?'':' disabled="disabled"'; ?>></div>
                <?php if (!is_null($res5[0]['img'])) { ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $init->_ADMIN_; ?>/js/fancybox/fancybox.css" />
                <script src="<?php echo $init->_ADMIN_; ?>/js/fancybox/jquery.fancybox.pack.js"></script>
                <div class="image"><a href="<?php echo $init->_SITE_.'/img/article/'.$res5[0]['img']; ?>" title="<?php echo $res5[0]['name_'.$init->lang]; ?>" target="_blank" class="fancybox"><?php $image->show_image(); ?></a><br><a href="<?php echo $init->_ADMIN_; ?>/performing/article/delete_img_article.php?id=<?php echo $id; ?>" class="btn btn-mini btn-danger" title="Удалить изображение">Удалить изображение</a></div>
                <script>
                $(".fancybox").fancybox();
                </script>
                <?php } ?>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label" for="inputText">Текст <span class="important">*</span></label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"><?php echo $res5[0]['text_'.$init->lang]; ?></textarea></div>
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
    ?>
    </div>