
Ext.define('CDT.view.control_calidad.especialista.ControlCalidadForm', {
    extend: 'Ext.window.Window',
    xtype: 'control-calidad-form',

    title: 'Brechas | No Conformidades | Otros',
    iconCls: 'fa fa-tty',
    layout: 'fit',
    autoShow: true,
    width: 980,
    resizable: false,
    modal: true,

    initComponent: function ()
    {
        var me = this;
        me.myData = [];
        me.addStateEvents('actioncolumnClick');
        me.gridTrabajadorStore = Ext.create('Ext.data.ArrayStore', {
            fields: [ 'id', 'nombre' ]
        });
        me.items = [{
            xtype: 'panel',
            layout: {
                type: 'hbox',
                pack: 'start',
                align: 'stretch'
            },
            padding: '8 8 0 8',
            items: [{
                flex: 5,
                margin: '0 5 0 0',
                items: [{
                    xtype: 'fieldset',
                    layout: 'anchor',
                    items: [{
                        xtype: 'textareafield',
                        fieldLabel: 'Brechas | No Conformidades | Otros',
                        labelAlign: 'top', allowBlank: false, anchor: '100%', grow: true, emptyText: 'Nombre',
                        id: 'panel-name-id'
                    },{
                        xtype:'textareafield',
                        fieldLabel: 'Observaciones', labelAlign: 'top', anchor: '100%', grow: true, emptyText: '?',
                        id: 'panel-observaciones-id'
                    },{
                        xtype:'textareafield',
                        fieldLabel: 'Participantes', labelAlign: 'top', anchor: '100%', grow: true, emptyText: '?',
                        id: 'panel-participantes-id'
                    }]
                },{
                    xtype: 'fieldset',
                    layout: 'hbox',
                    items: [{
                        xtype: 'combobox',
                        fieldLabel: 'Control', labelAlign: 'top', allowBlank: false, flex: 4, emptyText: 'CONTROL',
                        store: Ext.create('CDT.store.control_calidad.ControlStore'),
                        queryMode: 'local', displayField: 'nombre', valueField: 'id', editable: false, margin: '0 5 0 0',
                        id: 'panel-control-id'
                    },{
                        xtype:'combobox',
                        fieldLabel: 'Tipo', labelAlign: 'top', allowBlank: false, flex: 3, emptyText: 'TIPO',
                        store: [ "BRECHAS", "NO CONFORMIDADES", "OTROS" ],
                        editable: false, margin: '0 5 0 0',
                        id: 'panel-tipo-id'
                    },{
                        xtype:'datefield',
                        fieldLabel: 'Fecha', labelAlign: 'top', allowBlank: false, flex: 2, value: new Date(),
                        editable: false,
                        id: 'panel-fecha-id'
                    }]
                }]
            },{
                flex: 3,
                items: [{
                    xtype: 'fieldset',
                    layout: 'anchor',
                    items: [{
                        xtype: 'combobox',
                        emptyText: 'Ejecuta (TRABAJADOR)',
                        store: me.storeTrabajador,
                        queryMode: 'local', displayField: 'nombreApellidos', valueField: 'id', anchor: '100%', editable: false,
                        id: 'panel-ejecuta-id',
                    },{
                        xtype: 'grid',
                        store: me.gridTrabajadorStore,
                        columns: [
                        { text: 'Id', dataIndex: 'id', hidden: true },
                        { text: 'Nombre',  dataIndex: 'nombre', flex: 1 },
                        {
                            xtype: 'actioncolumn', width: 25,
                            items: [{
                                icon: '/images/tarea_operativa/remove.png',
                                tooltip: 'Elimanar fila.',
                                handler: function(grid, rowIndex, colIndex){
                                    me.fireEvent('actioncolumnClick', [grid, rowIndex]);
                                }
                            }]
                        }]
                    }]
                }]
            }]
        }];
        me.buttons = ['->', {
            text: me.btnText,
            iconCls: 'fa fa-check',
            id: 'save-control-calidad'
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