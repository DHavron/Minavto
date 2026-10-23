<?php
function showFiles($init,$idTable,$idRow) {
?>
<div class="span5 gallery files popover bottom">
<div class="arrow"></div>
<h3 class="popover-title">Прикрепленные файлы</h3>
<div class="popover-content">
<form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/files/add_to_gallery_files.php" method="post">
<legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
<div class="disp_none">
<input type="hidden" name="id_table" value="<?php echo intval($idTable); ?>" />
    <input type="hidden" name="id_row" value="<?php echo intval($idRow); ?>" />
</div>
<?php
foreach ($init->core['languages'] as $langFile) {
?>
<div class="control-group">
    <label class="control-label" for="inputName<?php echo $langFile; ?>">Название файла <span class="important">*</span>&nbsp;<small class="muted">(<?php echo mb_strtoupper($langFile,'UTF-8'); ?>) Не более 150 символов</small></label>
    <div class="controls"><input type="text" id="inputName<?php echo $langFile; ?>" class="span4" name="name_<?php echo $langFile; ?>"></div>
</div>
<?php
}
?>
<div class="control-group">
<label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
<div class="controls"><input type="text" id="inputLevel" class="span4" name="level"></div>
</div>
<div class="control-group">
<label class="control-label" for="inputFile">Файл <span class="important">*</span></label>
<div class="controls"><input type="file" id="inputFile" class="span4" name="file"></div>
</div>
<div class="control-group">
<label class="control-label" for="inputImage">Иконка для файла&nbsp;<small class="muted">Не более 1 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
<div class="controls"><input type="file" id="inputImage" class="span4" name="icon"></div>
</div>
<div class="control-group">
<div class="controls"><input type="submit" class="btn btn-primary" value="Добавить файл" title="Добавить файл"></div>
</div>
</form>
<?php
$columns=array('`f`.`id`','`f`.`name_file`','`f`.`icon`','`f`.`level`');
foreach ($init->core['languages'] as $langCol) {$columns[]='`n`.`name_'.$langCol.'`';}
$resFiles=$init->dbc->select('`files` `f`,`name` `n`',$columns,'`f`.`id_table`='.intval($idTable).' && `f`.`id_row`='.intval($idRow).' && `n`.`id_table`=8 && `n`.`id_row`=`f`.`id`','`f`.`level` DESC,`f`.`id` DESC');
if (count($resFiles)>0) {
?>
<div class="control-group">
<table class="table table-condensed table-bordered">
    <tr><thead><th>Иконка</th><th>Название файла</th><th>Уровень</th><th>&nbsp;</th></thead></tr>
    <tbody>
    <?php
    foreach ($resFiles as $file) {
    ?>
    <tr>
        <td><?php if (!is_null($file['icon'])) {?><img src="<?php echo $init->_SITE_; ?>/img/files/icon/<?php echo $file['icon']; ?>" /><?php } else { ?>&nbsp;<?php } ?></td>
        <td><a href="<?php echo $init->_SITE_; ?>/img/files/<?php echo $file['name_file']; ?>" target="_blank" title="<?php echo $file['name_'.$init->lang]; ?>"><?php echo $file['name_'.$init->lang]; ?></a></td>
        <td class="td-center">
            <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/down_level.php?tab=files&id=<?php echo $file['id']; ?>" title="-1" class="btn btn-mini"><i class="icon-minus"></i></a>
            <?php echo $file['level']; ?>
            <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_level.php?tab=files&id=<?php echo $file['id']; ?>" title="+1" class="btn btn-mini"><i class="icon-plus"></i></a>
        </td>
        <td class="td-center"><a href="<?php echo $init->_ADMIN_; ?>/performing/files/delete_gallery_files.php?id=<?php echo $file['id']; ?>" title="Удалить" class="btn btn-mini"><i class="icon-trash"></i></a></td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
</div>
<?php
}
?>
</div>
</div>
<?php
}
?>