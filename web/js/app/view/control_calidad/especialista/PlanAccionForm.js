
Ext.define('CDT.view.control_calidad.especialista.PlanAccionForm', {
    extend: 'Ext.window.Window',
    xtype: 'plan-accion-form',

    title: 'Acciones a realizar',
    iconCls: 'fa fa-life-bouy',
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
                xtype:'textareafield',
                fieldLabel: 'Descripción',
                emptyText: '?',
                labelAlign: 'top',
                anchor: '100%',
                grow: true,
                name: 'descripcion'
            },{
                xtype: 'datefield',
                fieldLabel: 'Inicial',
                allowBlank: false,
                value: new Date(),
                format: 'Y-m-d',
                editable: false,
                anchor: '100%',
                name: 'fechaInicial'
            },{
                xtype: 'datefield',
                fieldLabel: 'Final',
                allowBlank: false,
                value: new Date(),
                format: 'Y-m-d',
                editable: false,
                anchor: '100%',
                name: 'fechaFinal'
            }]
        }];
        me.buttons = ['->', {
            text: 'Salvar',
            iconCls: 'fa fa-check',
            id: 'save-plan-accion-id'
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