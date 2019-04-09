
Ext.define('CDT.view.admin.cargo.CargoForm', {
    extend: 'Ext.window.Window',
    xtype : 'cargoForm',

    title: 'Adicionar cargo',
    iconCls: 'tree-cargo',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'center',
    width: 320,
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
                name: 'Nombre',
                emptyText: 'Cargo',
                anchor: '100%',
                maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 43,
                allowBlank: false
            },{
                xtype: 'textarea',
                fieldLabel: 'Descripción',
                name: 'Descripcion',
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
            iconCls: 'ok',
            action: 'save'
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