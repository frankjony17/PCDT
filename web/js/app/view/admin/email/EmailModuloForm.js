
Ext.define('CDT.view.admin.email.EmailModuloForm', {
    extend: 'Ext.window.Window',
    xtype: 'emailModuloForm',

    title: 'Adicionar módulo',
    iconCls: 'add-modulo',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'center',
    width: 475,
    resizable: false,
    modal: true,

    initComponent: function ()
    {
        var me = this;

        me.items = [{
            xtype: 'form',
            padding: '10 10 10 10',
            border: false,
            style: 'background-color: #fff;',
            fieldDefaults: {
                labelAlign: 'top'
            },
            items: [{
                xtype: 'textfield',
                fieldLabel: 'Nombre',
                name: 'modulo',
                emptyText: 'Módulo',
                anchor: '100%',
                maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 48,
                allowBlank: false
            },{
                xtype: 'textfield',
                fieldLabel: 'Correo electrónico',
                emptyText: 'Correo electrónico',
                name: 'email',
                anchor: '100%',
                vtype:'email',
                maxLength: 48,
                allowBlank: false
            },{
                xtype: 'textarea',
                fieldLabel: 'Descripción',
                name: 'descripcion',
                emptyText: 'Descripción',
                anchor: '100%',
                grow: true,
                maskRe: /[aA-zZ\áéíóúñÁÉÍÓÚÑ\ \.\,]/,
                regex: /[aA-zZ]/,
                maxLength: 118
            }]
        }];
        me.buttons = [{
            text: 'Salvar',
            iconCls: 'ok'
        },{
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: function(){
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});