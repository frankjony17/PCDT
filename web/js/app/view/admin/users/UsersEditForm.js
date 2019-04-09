
Ext.define('CDT.view.admin.users.UsersEditForm', {
    extend: 'Ext.window.Window',
    xtype: 'usersEditForm',

    title: 'Editar usuario',
    iconCls: 'menu-edit-item',
    buttonAlign: 'center',
    
    layout: 'fit',
    resizable: false,
    closable: false,
    modal: true,
    
    width: 320,
    headerPosition: 'bottom',

    initComponent: function ()
    {
        var me = this;
        
        me.items = [
        {
            xtype: 'form',

            padding: '10 10 10 10',
            border: false,
            style: 'background-color: #fff;',

            fieldDefaults: {
                labelAlign: 'top',
                margin: 2
            },
            items: [
            {
                xtype: 'textfield',
                fieldLabel: 'Alias',
                emptyText: 'Alias del usuario.',
                anchor: '100%',
                maskRe: /[aA-zZ\.\áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 23,
                allowBlank: false
            },{
                xtype: 'textfield',
                fieldLabel: 'Correo electrónico',
                emptyText: 'Correo electrónico',
                anchor: '100%',
                vtype:'email',
                maxLength: 48,
                allowBlank: true
            }]
        }];
        me.tools = [{
            xtype: 'button',
            text: 'Salvar',
            iconCls: 'ok'
        },{
            xtype: 'tbspacer', width: 5
        },{
            xtype: 'button',
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: function () { 
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});