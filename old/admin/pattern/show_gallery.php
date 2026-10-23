<?php
function showGallery($init,$idTable,$idRow) {
?>
<div class="span5 gallery popover bottom">
<div class="arrow"></div>
<h3 class="popover-title">Галерея изображений</h3>
<div class="popover-content">
<form enctype="multipart/form-data" action="<?php echo $init->_ADMIN_; ?>/performing/gallery/add_to_gallery.php" method="post">
<legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
<div class="disp_none">
<input type="hidden" name="id_table" value="<?php echo intval($idTable); ?>" />
    <input type="hidden" name="id_row" value="<?php echo intval($idRow); ?>" />
</div>
<?php
foreach ($init->core['languages'] as $langGal) {
?>
<div class="control-group">
    <label class="control-label" for="inputName<?php echo $langGal; ?>">Название изображения <span class="important">*</span>&nbsp;<small class="muted">(<?php echo mb_strtoupper($langGal,'UTF-8'); ?>) Не более 150 символов</small></label>
    <div class="controls"><input type="text" id="inputName<?php echo $langGal; ?>" class="span4" name="name_<?php echo $langGal; ?>"></div>
</div>
<?php
}
?>
<div class="control-group">
<label class="control-label" for="inputLevel">Уровень&nbsp;<small class="muted">Только цифры</small></label>
<div class="controls"><input type="text" id="inputLevel" class="span4" name="level"></div>
</div>
<div class="control-group">
<label class="control-label" for="inputImage">Изображение <span class="important">*</span>&nbsp;<small class="muted">Не более 2 Мб. Типы файлов: gif, jpg, jpe, jpeg, png.</small></label>
<div class="controls"><input type="file" id="inputImage" class="span4" name="img"></div>
</div>
<div class="control-group">
<div class="controls"><input type="submit" class="btn btn-primary" value="Добавить изображение" title="Добавить изображение"></div>
</div>
</form>
<?php
$columns=array('`g`.`id`','`g`.`img`','`g`.`level`');
foreach ($init->core['languages'] as $langCol) {$columns[]='`n`.`name_'.$langCol.'`';}
$resGal=$init->dbc->select('`gallery` `g`,`name` `n`',$columns,'`g`.`id_table`='.intval($idTable).' && `g`.`id_row`='.intval($idRow).' && `n`.`id_table`=9 && `n`.`id_row`=`g`.`id`','`g`.`level` DESC,`g`.`id` DESC');
if (count($resGal)>0) {
?>
<div class="control-group">
<div class="controls galimgs">
    <?php
    foreach ($resGal as $gallery) {
    ?>
    <div>
        <form method="post" action="<?php echo $init->_ADMIN_; ?>/performing/gallery/update_level.php">
            <input type="hidden" name="id" value="<?php echo $gallery['id']; ?>" />
            <input type="text" name="level" value="<?php echo $gallery['level']; ?>" class="span1" title="Уровень" />
            <a href="<?php echo $init->_ADMIN_; ?>/performing/gallery/delete_img_gallery.php?id=<?php echo $gallery['id']; ?>" class="btn btn-mini btn-danger" title="Удалить изображение">Удалить</a>
        </form>
        <a href="<?php echo $init->_SITE_; ?>/img/gallery/<?php echo $gallery['img']; ?>" rel="group"  class="fancybox" target="_blank" title="<?php echo $gallery['name_'.$init->lang]; ?>"><img src="<?php echo $init->_SITE_; ?>/img/gallery/<?php echo $gallery['img']; ?>" alt="<?php echo $gallery['name_'.$init->lang]; ?>" /></a>
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
</div>
<?php
}
?>