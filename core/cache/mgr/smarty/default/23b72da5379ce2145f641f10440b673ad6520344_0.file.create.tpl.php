<?php
/* Smarty version 3.1.31, created on 2024-01-08 12:39:05
  from "/var/www/user2125514/data/www/minavto.by/manager/templates/default/resource/symlink/create.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_659bc2b9778e97_75694177',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23b72da5379ce2145f641f10440b673ad6520344' => 
    array (
      0 => '/var/www/user2125514/data/www/minavto.by/manager/templates/default/resource/symlink/create.tpl',
      1 => 1552382674,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659bc2b9778e97_75694177 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="modx-panel-symlink-div"></div>
<div id="modx-resource-tvs-div" class="modx-resource-tab x-form-label-left x-panel"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tvOutput']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>

<?php echo $_smarty_tpl->tpl_vars['onDocFormPrerender']->value;?>

<?php if ($_smarty_tpl->tpl_vars['resource']->value->richtext && $_smarty_tpl->tpl_vars['_config']->value['use_editor']) {?>
    <?php echo $_smarty_tpl->tpl_vars['onRichTextEditorInit']->value;?>

<?php }
}
}
