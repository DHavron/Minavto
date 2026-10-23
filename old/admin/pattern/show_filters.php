<?php
function showFilters($init) {
?>
<div class="span5 gallery popover bottom">
<div class="arrow"></div>
<h3 class="popover-title">ФИЛЬТРЫ</h3>
<div class="popover-content">
<form action="<?php echo $init->_ADMIN_; ?>/performing/setting/add_filter.php" method="post">
<legend class="small"><span class="important">*</span> &ndash; обязательные поля для заполнения.</legend>
<div class="control-group">
    <label class="control-label" for="inputName">Название фильтра <span class="important">*</span>&nbsp;<small class="muted">Не более 100 символов</small></label>
    <div class="controls"><input type="text" id="inputName" class="span4" name="name"></div>
</div>
<div class="control-group">
    <label class="control-label" for="inputName">User-Agent фильтра <span class="important">*</span>&nbsp;<small class="muted">Не более 100 символов</small></label>
    <div class="controls"><input type="text" id="inputName" class="span4" name="name_user_agent"></div>
</div>
<div class="control-group">
<div class="controls"><input type="submit" class="btn btn-primary" value="Добавить фильтр" title="Добавить фильтр"></div>
</div>
</form>
<?php
$resFilters=$init->dbc->select('`filters_statistics`',array('`id`','`name_user_agent`','`name`'),null,'`name`,`id` DESC');
if (count($resFilters)>0) {
?>
<div class="control-group">
<table class="table table-condensed table-bordered">
    <tr><thead><th>Название фильтра</th><th>User-Agent</th><th>&nbsp;</th></thead></tr>
    <tbody>
    <?php
    foreach ($resFilters as $filter) {
    ?>
    <tr>
        <td><?php echo $filter['name']; ?></td>
        <td><?php echo $filter['name_user_agent']; ?></td>
        <td class="td-center"><a href="<?php echo $init->_ADMIN_; ?>/performing/setting/delete_filter.php?id=<?php echo $filter['id']; ?>" title="Удалить" class="btn btn-mini"><i class="icon-trash"></i></a></td>
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