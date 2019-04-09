
Ext.define('CDT.view.control_calidad.especialista.ControlTipoForm', {
    extend: 'Ext.window.Window',
    xtype: 'control-tipo-form',

    title: 'Control a realizar',
    iconCls: 'fa fa-wrench',
    layout: 'fit',
    autoShow: true,
    width: 520,
    resizable: false,
    modal: true,

    initComponent: function () {
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
                name: 'nombre',
                emptyText: '?',
                anchor: '100%',
                maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 48,
                allowBlank: false
            },{
                xtype:'textareafield',
                fieldLabel: 'Descripción',
                emptyText: '?',
                anchor: '100%',
                grow: true,
                name: 'descripcion'
            }]
        }];
        me.buttons = ['->', {
            text: 'Salvar',
            iconCls: 'fa fa-check',
            id: 'save-control-tipo-id'
        },{
            text: 'Cancelar',
            iconCls: 'fa fa-ban',
            listeners: {
                click: function(){ 
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});