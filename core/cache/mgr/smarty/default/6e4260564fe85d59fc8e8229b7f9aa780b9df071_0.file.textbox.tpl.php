<?php
/* Smarty version 3.1.31, created on 2022-09-06 10:06:08
  from "/var/www/user2125514/data/www/minavto.by/manager/templates/default/element/tv/renders/input/textbox.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_6316f1602379c1_93920460',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e4260564fe85d59fc8e8229b7f9aa780b9df071' => 
    array (
      0 => '/var/www/user2125514/data/www/minavto.by/manager/templates/default/element/tv/renders/input/textbox.tpl',
      1 => 1552382657,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6316f1602379c1_93920460 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input id="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" name="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
"
	type="text" class="textfield"
	value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tv']->value->get('value'), ENT_QUOTES, 'UTF-8', true);?>
"
	<?php echo $_smarty_tpl->tpl_vars['style']->value;?>

	tvtype="<?php echo $_smarty_tpl->tpl_vars['tv']->value->type;?>
"
/>

<?php echo '<script'; ?>
 type="text/javascript">
// <![CDATA[

Ext.onReady(function() {
    var fld = MODx.load({
    
        xtype: 'textfield'
        ,applyTo: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,width: '99%'
        ,enableKeyEvents: true
        ,msgTarget: 'under'
        ,allowBlank: <?php if ($_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 1 || $_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 'true') {?>true<?php } else { ?>false<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['minLength']) {?>,minLength: <?php echo $_smarty_tpl->tpl_vars['params']->value['minLength'];
}?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['maxLength']) {?>,maxLength: <?php echo $_smarty_tpl->tpl_vars['params']->value['maxLength'];
}?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['regex']) {?>,regex: new RegExp('<?php echo $_smarty_tpl->tpl_vars['params']->value['regex'];?>
')<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['regexText']) {?>,regexText: '<?php echo $_smarty_tpl->tpl_vars['params']->value['regexText'];?>
'<?php }?>
    
        ,listeners: { 'keydown': { fn:MODx.fireResourceFormChange, scope:this}}
    });
    Ext.getCmp('modx-panel-resource').getForm().add(fld);
    MODx.makeDroppable(fld);
});

// ]]>
<?php echo '</script'; ?>
>
<?php }
}
