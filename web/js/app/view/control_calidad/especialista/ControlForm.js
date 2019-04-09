
Ext.define('CDT.view.control_calidad.especialista.ControlForm', {
    extend: 'Ext.window.Window',
    xtype: 'control-form',

    title: 'Control a realizar',
    iconCls: 'fa fa-cogs',
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
                xtype: 'datefield',
                fieldLabel: 'Fecha',
                allowBlank: false,
                value: new Date(),
                format: 'Y-m-d',
                editable: false,
                anchor: '100%',
                name: 'fecha'
            },{
                xtype:'textareafield',
                fieldLabel: 'Ejecutores',
                emptyText: '?',
                anchor: '100%',
                grow: true,
                name: 'ejecutores'
            },{
                xtype: 'combobox',
                fieldLabel: 'Control',
                emptyText: 'Seleccione..',
                store: Ext.create('CDT.store.control_calidad.ControlTipoStore'),
                allowBlank: false,
                anchor: '100%',
                queryMode: 'local',
                displayField: 'nombre',
                valueField: 'id',
                editable: false,
                name: 'tipo'
            }]
        }];
        me.buttons = ['->', {
            text: 'Salvar',
            iconCls: 'fa fa-check',
            id: 'save-control-id'
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