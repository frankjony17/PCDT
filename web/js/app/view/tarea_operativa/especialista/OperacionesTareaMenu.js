
Ext.define('CDT.view.tarea_operativa.especialista.OperacionesTareaMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'operacionesMenu',
    
    frame: true,
    titleAlign: 'center',
    
    defaults: {
        padding: 2
    },
    style: {
        overflow: 'visible'
    },
    width: 265,
    closeAction : 'destroy',

    initComponent: function ()
    {
        var me = this;

        me.items = [{
            text: 'Acciones',
            iconCls: 'tareas-acciones',
            menu: {
                width: 200,
                items: [{
                    text: 'Adicionar',
                    iconCls: 'add',
                    id: 'tareas-acciones-add'
                },{
                    text: 'Editar (<b>ultima acción</b>)',
                    iconCls: 'edit',
                    id: 'tareas-acciones-edit'
                },{
                    text: 'Eliminar (<b>ultima acción</b>)',
                    iconCls: 'remove',
                    id: 'tareas-acciones-remove'
                }]
            }
        }, {
            text: 'Periodo de chequeo',
            iconCls: 'tareas-periodo-chequeo',
            menu: {
                items: [{
                    xtype: 'checkbox',
                    boxLabel: 'Lunes'
                },{
                    xtype: 'checkbox',
                    boxLabel: 'Martes'
                },{
                    xtype: 'checkbox',
                    boxLabel: 'Miércoles'
                },{
                    xtype: 'checkbox',
                    boxLabel: 'Jueves'
                },{
                    xtype: 'checkbox',
                    boxLabel: 'Viernes'
                },{
                    xtype: 'combobox',
                    store: ["Diario", "Quincenal", "Mensual"],
                    queryMode: 'local',
                    editable: false,
                    emptyText: 'Otros.',
                    width: 125, id: "menu-periodo-chequeo-combobox-id"
                }, '-', {
                    xtype: 'button',
                    text : 'Salvar',
                    iconCls: 'ok'
                }]
            }
        }, {
            text: 'Estado',
            iconCls: 'tareas-estado',
            menu: {
                items: [{
                    text: 'Pendiente <b>(Seleccione fecha final)</b>',
                    iconCls: 'tareas-estado-pendiente',
                    menu: Ext.create('Ext.menu.DatePicker', {
                        format: 'Y-m-d',
                        value: new Date(me.record.get("fecha_final")),
                        minDate: new Date(me.record.get("fecha_inicial")),
                        id: "menu-date-picker-id"
                    })
                },{
                    text: 'Final <b>(Culminación de la Tarea)</b>',
                    id: "estado-final-checked-id",
                    checked: false
                }]
            }
        }, {
            text: 'Pendiente por:',
            iconCls: 'tareas-pendiente-por',
            menu: {
                width: 380,
                items: me.responsables
            }
        }, {
            text: 'Enviar correo a:',
            iconCls: 'message',
            menu: {
                items: [{
                    text: 'Responsables',
                    iconCls: 'tareas-correo-responsables',
                    id: 'tareas-correo-responsables-id'
                }, {
                    text: 'Otros',
                    iconCls: 'tareas-correo-otros',
                    id: 'tareas-correo-otros-id'
                }]
            }
        }];
        
        me.callParent(arguments);
    }
});