<?php
/* Smarty version 3.1.31, created on 2026-02-23 13:29:11
  from "/var/www/user2125514/data/www/minavto.by/core/components/migx/templates/mgr/packagemanagertab.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_699c2bf7ec0660_78471170',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ced001c9181119c1aa6441eb7ded172686866d4e' => 
    array (
      0 => '/var/www/user2125514/data/www/minavto.by/core/components/migx/templates/mgr/packagemanagertab.tpl',
      1 => 1552382295,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_699c2bf7ec0660_78471170 (Smarty_Internal_Template $_smarty_tpl) {
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
        id: 'migx_packagemanager_form',
        standardSubmit: true,
        url: config.src,
        items: [{
            xtype: 'textfield',
            name: 'packageName',
            id: 'migxpm_packageName',
            fieldLabel: 'Package Name'
        },
        {
            xtype: 'combo',
            name: 'use_custom_prefix',
            id: 'migxpm_use_custom_prefix',
            fieldLabel: 'table-prefix',
            store: [['0', 'Default Prefix'],['1', 'Custom Prefix']],
            typeAhead: false,
            editable: false,
            forceSelection: true,
            triggerAction: 'all',
            selectOnFocus:true,
            mode: 'local',
            value: '0'            
        },        
        {
            xtype: 'textfield',
            name: 'prefix',
            id: 'migxpm_prefix',
            fieldLabel: 'custom-prefix'
        },
        {
            xtype: 'modx-tabs',
            id: 'migx-tab-packagemanager',
            defaults: {
                border: false,
                autoHeight: true
            },
            border: true,
            items: [{
                title: 'Package',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Create new package-directory and an empty schema-file with <strong>Create Package</strong></p><p>Add this package to Extension-Packages with <strong>Add Extension Package</strong></p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('createPackage')},
                    text: 'Create Package',
                    scope: this
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('addExtensionPackage')},
                    text: 'Add Extension Package',
                    scope: this
                }]
            },{
                title: 'Schema',
                layout:'form',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Write schema from existing tables with <strong>Write Schema</strong></p><p>Create xpdo-classes and maps if new or manipulate existing maps from schema with <strong>Parse Schema</strong></p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('writeSchema')},
                    text: 'Write schema',
                    scope: this
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('parseSchema')},
                    text: 'parse Schema',
                    scope: this
                }]
            },{
                title: 'create Tables',
                layout:'form',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Create tables from schema </p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('createTables')},
                    text: 'create Tables',
                    scope: this
                }]
            },{
                title: 'Add fields',
                layout:'form',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Add missing fields to package-tables from schema</p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('addmissing')},
                    text: 'Add fields',
                    scope: this
                }]
            },{
                title: 'Remove fields',
                layout:'form',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Remove in schema not existing fields from package-tables</p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('removedeleted')},
                    text: 'Remove fields',
                    scope: this
                }]
            },{
                title: 'Update indexes',
                layout:'form',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Add new indexes from schema</p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('checkindexes')},
                    text: 'Update indexes',
                    scope: this
                }]
            },{
                title: 'Alter fields',
                layout:'form',
                defaults: {
                    autoHeight: true
                },
                items: [{
                    html: '<p>Alter fields from schema</p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('alterfields')},
                    text: 'Alter fields',
                    scope: this
                }]
            },{
                title: 'Xml Schema',
                layout:'form',
                defaults: {
                    autoHeight: false
                },
                items: [{
                    html: '<p>Load/Edit schema</p>',
                    bodyCssClass: 'panel-desc',
                    border: false
                },
                {
                    xtype: 'textarea',
                    name: 'schema',
                    height: '350' ,
                    width: '800' ,
                    id: 'migxpm_schema',
                    fieldLabel: 'Schema'
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('loadSchema')},
                    text: 'Load schema',
                    scope: this
                },
                {
                    xtype: 'button',
                    handler: function(){this.updatePackage('saveSchema')},
                    text: 'Save schema',
                    scope: this
                }]
            }]
        }]
    }]
}





<?php }
}
