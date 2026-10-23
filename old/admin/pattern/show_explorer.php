<?php
function showExplorer($init) {
?>
<div class="span5 gallery files popover bottom">
<div class="arrow"></div>
<h3 class="popover-title">Загруженные файлы</h3>
<div class="popover-content">
<form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/files/add_file.php" method="post">
<legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
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
<label class="control-label" for="inputFile">Файл <span class="important">*</span></label>
<div class="controls"><input type="file" id="inputFile" class="span4" name="file"></div>
</div>
<div class="control-group">
<label class="control-label" for="inputImage">Иконка для файла <span class="important">*</span>&nbsp;<small class="muted">Не более 1 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
<div class="controls"><input type="file" id="inputImage" class="span4" name="icon"></div>
</div>
<div class="control-group">
<div class="controls"><input type="submit" class="btn btn-primary" value="Добавить файл" title="Добавить файл"></div>
</div>
</form>
<?php
$columns=array('`u`.`id`','`u`.`name_file`','`u`.`icon`','`u`.`date`');
foreach ($init->core['languages'] as $langCol) {$columns[]='`n`.`name_'.$langCol.'`';}
$resFiles=$init->dbc->select('`upload` `u`,`name` `n`',$columns,'`u`.`id`>0 && `n`.`id_table`=22 && `n`.`id_row`=`u`.`id`','`u`.`name_file`');
if (count($resFiles)>0) {
?>
<div class="control-group">
<table class="table table-condensed table-bordered">
    <tr><thead><th>Иконка</th><th>Название файла</th><th>&nbsp;</th></thead></tr>
    <tbody>
    <?php
    foreach ($resFiles as $file) {
    ?>
    <tr>
        <td><?php if (!is_null($file['icon'])) {?><img src="<?php echo $init->_SITE_; ?>/img/upload/icon/<?php echo $file['icon']; ?>" /><?php } else { ?>&nbsp;<?php } ?></td>
        <td><?php echo $file['name_'.$init->lang]; ?> <a href="<?php echo $init->_SITE_; ?>/img/upload/<?php echo $file['name_file']; ?>" target="_blank" title="<?php echo $file['name_'.$init->lang]; ?>"><i class="icon-share"></i></a><br />(URL: <?php echo $init->_SITE_; ?>/img/upload/<?php echo $file['name_file']; ?>)</td>
        <td class="td-center"><a href="<?php echo $init->_ADMIN_; ?>/performing/files/delete_file.php?id=<?php echo $file['id']; ?>" title="Удалить" class="btn btn-mini"><i class="icon-trash"></i></a></td>
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