    <div class="span9">
    <?php
    require_once($init->_DIR_.'/admin/pattern/errors.php');
    if (($vivod===1)&&$auth->checkRight(0,1)) {
    ?>
        <p style="text-align: right;margin-top: 10px;"><a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $add; ?>" title="Добавить страницу" class="btn">Добавить страницу</a></p>
    <?php
    }
    if ($vivod===1) {require_once($init->_DIR_.'/admin/pattern/show_all.php'); }
    //________________________________________________добавление страницы____________________________________________
    if ($idmenu===163) {
    ?>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/global_url/add_global_url.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название страницы <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
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
          </div>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Добавить страницу" title="Добавить страницу"></div>
            </div>
          </div>
        </form>
    <?php
    }
    //________________________________________________редактирование страницы____________________________________________
    if ($idmenu===165) {
        $res165=$init->dbc->select('`global_url` `u`,`name` `n`,`h1` `h`,`title` `tit`,`keywords` `k`,`description` `d`',array('`u`.`url`','`n`.`name_'.$init->lang.'`','`tit`.`title_'.$init->lang.'`','`h`.`h1_'.$init->lang.'`','`k`.`keywords_'.$init->lang.'`','`d`.`description_'.$init->lang.'`'),'`u`.`id`='.$id.' && `n`.`id_table`=10 && `n`.`id_row`=`u`.`id` && `h`.`id_table`=10 && `h`.`id_row`=`u`.`id` && `tit`.`id_table`=10 && `tit`.`id_row`=`u`.`id` && `d`.`id_table`=10 && `d`.`id_row`=`u`.`id` && `k`.`id_table`=10 && `k`.`id_row`=`u`.`id`',null,'LIMIT 1');
    ?>
        <div class="span8 onsite">
    <?php
    if ($init->core['multilanguage']=='on') {
        for($i=0;$i<count($init->core['languages']);++$i) {
            $activeLang=($init->core['languages'][$i]==$init->lang)?' btn-info disabled':'';
            $urlLang=($init->core['languages'][$i]!=$init->core['languages'][0])?'&lang='.$init->core['languages'][$i]:'';
    ?>
            <a href="<?php echo $init->_ADMIN_.'/global_url.php?idmenu=165&id='.$id.$urlLang; ?>" title="<?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?>" class="btn btn-mini<?php echo $activeLang; ?>"><?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?></a>
    <?php
        }
    }
    ?>
        </div>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/global_url/edit_global_url.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название страницы <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>" value="<?php echo $res165[0]['name_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputH1">Мета-тег H1 <span class="important">*</span>&nbsp;<small class="muted">Не более 250 символов</small></label>
                <div class="controls"><input type="text" id="inputH1" class="span4" name="h1_<?php echo $init->lang; ?>" value="<?php echo $res165[0]['h1_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDescription">Мета-тег DESCRIPTION&nbsp;<small class="muted">Не более 250 символов</small></label>
                <div class="controls"><input type="text" id="inputDescription" class="span4" name="description_<?php echo $init->lang; ?>" value="<?php echo $res165[0]['description_'.$init->lang]; ?>"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputURL">СЕО URL <span class="important">*</span>&nbsp;<small class="muted">Должен быть уникальным</small></label>
                <div class="controls"><input type="text" id="inputURL" class="span4" name="url" value="<?php echo $res165[0]['url']; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputTitle">Мета-тег TITLE <span class="important">*</span>&nbsp;<small class="muted">Не более: 65 символов или 12 слов</small></label>
                <div class="controls"><input type="text" id="inputTitle" class="span4" name="title_<?php echo $init->lang; ?>" value="<?php echo $res165[0]['title_'.$init->lang]; ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputKeywords">Мета-тег KEYWORDS&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputKeywords" class="span4" name="keywords_<?php echo $init->lang; ?>" value="<?php echo $res165[0]['keywords_'.$init->lang]; ?>"></div>
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