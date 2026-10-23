<?php
/* Smarty version 3.1.31, created on 2024-02-22 10:29:17
  from "/var/www/user2125514/data/www/minavto.by/manager/templates/default/resource/weblink/update.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_65d6f7cdcb6645_40247237',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56beb2ec673965d7421698fed003ca70b571144f' => 
    array (
      0 => '/var/www/user2125514/data/www/minavto.by/manager/templates/default/resource/weblink/update.tpl',
      1 => 1552382674,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65d6f7cdcb6645_40247237 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="modx-panel-weblink-div"></div>
<div id="modx-resource-tvs-div" class="modx-resource-tab x-form-label-left x-panel"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tvOutput']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>

<?php echo $_smarty_tpl->tpl_vars['onDocFormPrerender']->value;?>

<?php if ($_smarty_tpl->tpl_vars['resource']->value->richtext && $_smarty_tpl->tpl_vars['_config']->value['use_editor']) {?>
    <?php echo $_smarty_tpl->tpl_vars['onRichTextEditorInit']->value;?>

<?php }
}
}
