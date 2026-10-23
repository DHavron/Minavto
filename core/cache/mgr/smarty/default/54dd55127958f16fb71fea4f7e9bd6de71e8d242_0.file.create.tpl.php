<?php
/* Smarty version 3.1.31, created on 2024-01-08 12:38:43
  from "/var/www/user2125514/data/www/minavto.by/manager/templates/default/resource/staticresource/create.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_659bc2a3ef6f29_19691199',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54dd55127958f16fb71fea4f7e9bd6de71e8d242' => 
    array (
      0 => '/var/www/user2125514/data/www/minavto.by/manager/templates/default/resource/staticresource/create.tpl',
      1 => 1552382674,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659bc2a3ef6f29_19691199 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="modx-panel-static-div"></div>
<div id="modx-resource-tvs-div" class="modx-resource-tab x-form-label-left x-panel"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tvOutput']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>

<?php echo $_smarty_tpl->tpl_vars['onDocFormPrerender']->value;?>

<?php if ($_smarty_tpl->tpl_vars['resource']->value->richtext && $_smarty_tpl->tpl_vars['_config']->value['use_editor']) {?>
    <?php echo $_smarty_tpl->tpl_vars['onRichTextEditorInit']->value;?>

<?php }
}
}
