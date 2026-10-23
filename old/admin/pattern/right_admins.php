    <div class="span9">
    <?php
    require_once($init->_DIR_.'/admin/pattern/errors.php');
    if ($auth->checkRight(0,1)) {
    if ($vivod===1) {
    ?>
        <p style="text-align: right;margin-top: 10px;"><a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $add; ?>" title="Добавить администратора" class="btn">Добавить администратора</a></p>
    <?php
        if (($idmenu==111)) {$where='`id`>0';}
        if ($search!='') {$where.=" &&".$search;}
        require_once($init->_DIR_.'/admin/pattern/show_admins.php');
    }
    //________________________________________________добавление администратора____________________________________________
    if ($idmenu===113) {
    ?>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/admin_users/add_admin.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputLogin">Логин <span class="important">*</span>&nbsp;<small class="muted">Не менее 5 и не более 50 символов</small></label>
                <div class="controls"><input type="text" id="inputLogin" class="span4" name="login"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPass">Пароль <span class="important">*</span>&nbsp;<small class="muted">Не менее 5 символов</small></label>
                <div class="controls"><input type="password" id="inputPass" class="span4" name="password"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLogin">ФИО <span class="important">*</span>&nbsp;<small class="muted">Не более 100 символов</small></label>
                <div class="controls"><input type="text" id="inputLogin" class="span4" name="fio"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputEmail">E-mail <span class="important">*</span>&nbsp;<small class="muted">Не более 100 символов</small></label>
                <div class="controls"><input type="text" id="inputEmail" class="span4" name="email"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectRight">Уровень доступа <span class="important">*</span></label>
                <div class="controls">
                <select class="span4" name="id_right" id="selectRight">
                <option value="0">Выбрать уровень доступа</option>
                <?php
                foreach ($init->dbc->select('`admin_right`',array('`id`','`name_ru`'),'`id`>0') as $adminRight) {
                    echo '<option value="'.$adminRight['id'].'">'.$adminRight['name_ru'].'</option>';
                }
                ?>
                </select>
                </div>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label" for="inputText">Примечание</label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke prim" name="prim"></textarea></div>
            </div>
          </div>
          <div class="span8 addsave">
            <div class="control-group">
                <div class="controls"><input type="submit" class="btn btn-primary" value="Добавить администратора" title="Добавить администратора"></div>
            </div>
          </div>
        </form>
    <?php
    }
    //________________________________________________редактирование администратора____________________________________________
    if ($idmenu===115) {
        $res115=$init->dbc->select('`admin_users`',array(),'`id`='.$id,null,'LIMIT 1');
    ?>
        <form action="<?php echo $init->_ADMIN_; ?>/performing/admin_users/edit_admin.php" method="post" class="form normal">
          <legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
          <div class="disp_none">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputLogin">Логин <span class="important">*</span>&nbsp;<small class="muted">Не менее 5 и не более 50 символов</small></label>
                <div class="controls"><input type="text" id="inputLogin" class="span4" name="login" value="<?php echo $res115[0]['login'] ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPass">Пароль <span class="important">*</span>&nbsp;<small class="muted">Не менее 5 символов</small></label>
                <div class="controls"><input type="password" id="inputPass" class="span4" name="password"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputFio">ФИО <span class="important">*</span>&nbsp;<small class="muted">Не более 100 символов</small></label>
                <div class="controls"><input type="text" id="inputFio" class="span4" name="fio" value="<?php echo $res115[0]['fio']; ?>"></div>
            </div>
          </div>
          <div class="span4">
            <div class="control-group">
                <label class="control-label" for="inputEmail">E-mail <span class="important">*</span>&nbsp;<small class="muted">Не более 100 символов</small></label>
                <div class="controls"><input type="text" id="inputEmail" class="span4" name="email" value="<?php echo $res115[0]['email'] ?>"></div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectRight">Уровень доступа <span class="important">*</span></label>
                <div class="controls">
                <select class="span4" name="id_right" id="selectRight">
                <option value="0">Выбрать уровень доступа</option>
                <?php
                foreach ($init->dbc->select('`admin_right`',array('`id`','`name_ru`'),'`id`>0') as $adminRight) {
                    $sel= ($adminRight['id']==$res115[0]['id_right']) ? ' selected="selected"' : '';
                    echo '<option value="'.$adminRight['id'].'"'.$sel.'>'.$adminRight['name_ru'].'</option>';
                }
                ?>
                </select>
                </div>
            </div>
          </div>
          <div class="span8">
            <div class="control-group">
                <label class="control-label" for="inputText">Примечание</label>
                <div class="controls"><textarea id="inputText" cols="100" rows="10" class="cke prim" name="prim"><?php echo $res115[0]['prim'] ?></textarea></div>
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
    }
    ?>
    </div>