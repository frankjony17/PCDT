
Ext.define('CDT.view.indicador.especialista.cm.CriterioMedidaForm', {
    extend: 'Ext.window.Window',
    xtype: 'criterio-medida-form',

    title: 'Adicionar Criterio de Medida',
    iconCls: 'fa fa-area-chart',
    layout: 'fit',
    buttonAlign: 'center',
    width: 720,
    resizable: false,
    modal: true,

    initComponent: function ()
    {
        var me = this;
        
        me.items = [{
            xtype: 'form',
            url: entorno+'/indicadores/cm/add',
            bodyPadding: 10,
            fieldDefaults: {
                labelAlign: 'top',
                anchor: '100%',
                allowBlank: false
            },
            items: [{
                xtype: 'fieldset',
                defaults: {
                    anchor: '100%',
                    layout: 'hbox'
                },
                border: true,
                items: [{
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    items: [{
                        xtype: 'combobox',
                        fieldLabel: 'Objetivo',
                        name: 'objetivo',
                        emptyText: 'Seleccione!!!',
                        store: Ext.create("CDT.store.indicador.ObjetivoStore"),
                        queryMode: 'local',
                        displayField: 'descripcion',
                        valueField: 'id',
                        triggerAction: 'all',
                        editable: false,
                        margin: '0 5 0 0',
                        flex: 3,
                        listConfig: {
                            itemTpl: [
                                '<div data-qtip="{tipo_objetivo}: {descripcion}">({nombre}) {descripcion}</div>'
                            ]
                        }
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Nombre',
                        name: 'nombre',
                        emptyText: 'Criterio de Medida',
                        maxLength: 20,
                        flex: 1
                    }]
                }, {
                    xtype: 'textareafield',
                    fieldLabel: 'Descripción',
                    name: 'descripcion',
                    emptyText: 'Descripción del Criterio de Medida',
                    grow: true
                }]
            },{
                xtype: 'fieldset',
                defaults: {
                    anchor: '100%',
                    layout: 'hbox'
                },
                items: [{
                    xtype: 'fieldcontainer',
                    items: [{
                        xtype: 'numberfield',
                        fieldLabel: 'Plan',
                        name: 'plan',
                        emptyText: 'Plan',
                        minValue: 0,
                        margin: '0 5 0 0',
                        flex: 1
                    },{
                        xtype: 'combobox',
                        fieldLabel: 'Evaluación',
                        name: 'evaluacion',
                        emptyText: 'Seleccione!!!',
                        store: Ext.create("CDT.store.indicador.EvaluacionStore"),
                        queryMode: 'local',
                        displayField: 'nombre',
                        valueField: 'id',
                        triggerAction: 'all',
                        editable: false,
                        margin: '0 5 0 0',
                        flex: 1
                    },{
                        xtype: 'combobox',
                        fieldLabel: 'Responsable',
                        name: 'responsable',
                        emptyText: 'Seleccione!!!',
                        store: Ext.create("CDT.store.tarea_operativa.especialista.TrabajadorUsersStore"),
                        queryMode: 'local',
                        displayField: 'nombreApellidos',
                        valueField: 'id',
                        triggerAction: 'all',
                        editable: false,
                        flex: 3
                    },{
                        xtype: 'hiddenfield',
                        name: 'id'
                    }]
                }]
            }]
        }];
        me.buttons = [{
            text: 'Salvar',
            iconCls: 'fa fa-check'
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