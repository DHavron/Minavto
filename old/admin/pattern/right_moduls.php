    <div class="span9">
    <?php
    require_once($init->_DIR_.'/admin/pattern/errors.php');
    if (($vivod===1)&&$auth->checkRight(0,1,2)) {
    ?>
        <p style="text-align: right;margin-top: 10px;"><a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $add; ?>" title="Добавить модуль" class="btn">Добавить модуль</a></p>
    <?php
    }
    if ($vivod===1) {require_once($init->_DIR_.'/admin/pattern/show_all.php'); }
    //________________________________________________добавление модуля____________________________________________
    if ($idmenu===63) {
    ?>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/moduls/add_modul.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название модуля <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="selectPosition">Позиция модуля <span class="important">*</span></label>
                <div class="controls"><?php echo $init->positionModul();?></div>
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
                <label class="control-label" for="inputText">Содержимое модуля <span class="important">*</span></label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"></textarea></div>
            </div>
          </div>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Добавить модуль" title="Добавить модуль"></div>
            </div>
          </div>
        </form>
    <?php
    }
    //________________________________________________редактирование модуля____________________________________________
    if ($idmenu===65) {
        $res65=$init->dbc->select('`moduls` `m`,`name` `n`,`text` `t`',array('`m`.`id_position`','`m`.`level`','`n`.`name_'.$init->lang.'`','`t`.`text_'.$init->lang.'`'),"`m`.`id`=".$id." && `n`.`id_table`=13 && `n`.`id_row`=`m`.`id` && `t`.`id_table`=13 && `t`.`id_row`=`m`.`id`",null,'LIMIT 1');
    ?>
        <div class="span8 onsite">
    <?php
    if ($init->core['multilanguage']=='on') {
        for($i=0;$i<count($init->core['languages']);++$i) {
            $activeLang=($init->core['languages'][$i]==$init->lang)?' btn-info disabled':'';
            $urlLang=($init->core['languages'][$i]!=$init->core['languages'][0])?'&lang='.$init->core['languages'][$i]:'';
    ?>
            <a href="<?php echo $init->_ADMIN_.'/moduls.php?idmenu=65&id='.$id.$urlLang; ?>" title="<?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?>" class="btn btn-mini<?php echo $activeLang; ?>"><?php echo mb_strtoupper($init->core['languages'][$i],"UTF-8"); ?></a>
    <?php
        }
    }
    ?>
        </div>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/moduls/edit_modul.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="lang" value="<?php echo $init->lang; ?>">
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputName">Название модуля <span class="important">*</span>&nbsp;<small class="muted">Не более 150 символов</small></label>
                <div class="controls"><input type="text" id="inputName" class="span4" name="name_<?php echo $init->lang; ?>" value="<?php echo $res65[0]['name_'.$init->lang]; ?>"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="selectPosition">Позиция модуля <span class="important">*</span></label>
                <div class="controls"><?php echo $init->positionModul($res65[0]['id_position']);?></div>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label">Показывать на страницах:</label>
            </div>
          </div>
          <?php 
          $link=array();
          foreach ($init->dbc->select('`moduls_links`',array('`link`'),'`id_modul`='.$id) as $links) {$link[]=$links['link'];}
          $init->checkLinks($link);
          ?>
          <div class="span8">
            <div class="control-group">
                <label class="control-label" for="inputText">Содержимое модуля <span class="important">*</span></label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke" name="text_<?php echo $init->lang; ?>"><?php echo $res65[0]['text_'.$init->lang]; ?></textarea></div>
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