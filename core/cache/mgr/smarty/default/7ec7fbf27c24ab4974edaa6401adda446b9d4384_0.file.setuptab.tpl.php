<?php
/* Smarty version 3.1.31, created on 2026-02-23 13:29:12
  from "/var/www/user2125514/data/www/minavto.by/core/components/migx/templates/mgr/setuptab.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_699c2bf802e680_50348321',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ec7fbf27c24ab4974edaa6401adda446b9d4384' => 
    array (
      0 => '/var/www/user2125514/data/www/minavto.by/core/components/migx/templates/mgr/setuptab.tpl',
      1 => 1552382295,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_699c2bf802e680_50348321 (Smarty_Internal_Template $_smarty_tpl) {
?>
 
{
    title: '<?php echo $_smarty_tpl->tpl_vars['cmptabcaption']->value;?>
',
    defaults: {
        autoHeight: true
    },
    items: [{
        html: '<p><?php echo $_smarty_tpl->tpl_vars['cmptabdescription']->value;?>
</p>',
        border: false,
        bodyCssClass: 'panel-desc'
    },
    {
        xtype: 'form',
        id: 'migx_setup_form',
        standardSubmit: true,
        url: config.src,
        items: [{
            xtype: 'modx-tabs',
            id: 'migx-tab-setup',
            defaults: {
                border: false,
                autoHeight: true
            },
            border: true,
            items: [{
                title: 'Setup',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Setup MIGX-Configurator. (Creates/upgrades Configurations-table)</p>'
                         +'<p>Make allways backups before upgrading!</p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.setupmigx('setupmigx')},
                    text: 'Setup',
                    scope: this
                }]
            },{
                title: 'Upgrade MIGX',
                layout:'form',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Adds the autoinc-field MIGX_id to all existing MIGX-TVs from older Versions</p>'
                    +'<p>Make allways backups before upgrading!</p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.setupmigx('upgrademigx')},
                    text: 'Upgrade',
                    scope: this
                }]
            }]
        }]
    }]
}





<?php }
}
