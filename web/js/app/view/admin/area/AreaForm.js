
Ext.define('CDT.view.admin.area.AreaForm', {
    extend: 'Ext.window.Window',
    xtype: 'areaForm',

    title: 'Adicionar área',
    iconCls: 'tree-area',
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
            bodyPadding: 10,
            border: false,
            style: 'background-color: #fff;',
            fieldDefaults: {
                labelAlign: 'top'
            },
            items: [{
                xtype: 'textfield',
                fieldLabel: 'Nombre',
                name: 'Nombre',
                emptyText: 'Área',
                anchor: '100%',
                maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 48,
                allowBlank: false
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