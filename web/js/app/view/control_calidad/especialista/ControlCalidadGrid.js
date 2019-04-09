
Ext.define('CDT.view.control_calidad.especialista.ControlCalidadGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'control-calidad-grid',

    width: '100%',
    selType: 'checkboxmodel',
    autoScroll: true,

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store
        me.store = Ext.create('CDT.store.control_calidad.ControlCalidadStore');
        me.viewConfig = {
            getRowClass: function(record) {
                if (record.get('estado') == true) {
                    return 'x-grid-row-final';
                }
            }
        };
        // Modelo de columna      
        me.columns = [{
            xtype : 'rownumberer',
            text  : 'No',
            width : 40,
            align : 'center'
        },{
            text: 'Id',
            dataIndex: 'id',
            width: 35,
            hidden: true
        },{
            text: 'Brechas | No Conformidades | Otros',
            dataIndex: 'nombre',
            flex: 5
        },{
            text: 'Ejecuta',
            dataIndex: 'ejecuta',
            flex: 2
        },{
            text: 'Fecha',
            dataIndex: 'fecha',
            flex: 1
        },{
            text: 'Estado',
            xtype: 'widgetcolumn',
            width: 120,
            widget: {
                bind: '{record.progress}',
                xtype: 'progressbarwidget',
                textTpl: [
                    '{percent:number("0")} %'
                ]
            }
        },{
            xtype:'actioncolumn',
            text: '(PA)',
            width: 50,
            align: 'center',
            sortable: false,
            menuDisabled: true,
            items: [{
                iconCls: 'grid-plan-accion',
                tooltip: 'Plan de Acción',
                handler: function(grid, rowIndex) {
                    var rec = grid.getStore().getAt(rowIndex);
                    if (rec.get('estado') == false) {
                        Ext.create('Ext.window.Window', {
                            iconCls: 'grid-plan-accion',
                            title: rec.get('nombre'),
                            autoShow: true,
                            items: Ext.create('CDT.view.control_calidad.especialista.PlanAccionGrid', { pk: rec.get('id'), controlCalidadStore: grid.store }),
                            constrain: true,
                            closable: true,
                            maximized: true
                        })
                    } else {
                        Ext.ex.MessageBox('Atención', 'Esta acción no puede realizarse debido a que<br> el seguimiento del elemento ('+rec.get('tipo')+') ha culminado.', 'question');
                    }
                }
            }]
        },{
            text: 'participan',
            dataIndex: 'participan',
            width: 100,
            hidden: true
        },{
            text: 'observaciones',
            dataIndex: 'observaciones',
            width: 100,
            hidden: true
        },{
            text: 'controlcalidad',
            dataIndex: 'controlcalidad',
            width: 100,
            hidden: true
        },{
            text: 'tipo',
            dataIndex: 'tipo',
            width: 100,
            hidden: true
        },{
            text: 'trabajadores_ids',
            dataIndex: 'trabajadores_ids',
            width: 100,
            hidden: true
        },{
            text: 'estado',
            dataIndex: 'estado',
            width: 50,
            hidden: true
        }];
        // Articulos de leftbar: barra izquierda
        me.lbar = [{
            xtype: 'button',
            iconCls: 'fa fa-plus',
            tooltip: 'Adicionar Control Calidad',
            id: 'add-grid-id'
        },{
            xtype: 'button',
            iconCls: 'fa fa-edit',
            tooltip: 'Editar Control Calidad',
            id: 'edit-grid-id'
        },'-',{
            xtype: 'button',
            disabled: true,
            iconCls: 'fa fa-remove',
            tooltip: 'Eliminar Control Calidad',
            id: 'remove-grid-id'
        }];
        // Articulos de topbar: barra superior
        me.tbar = [{
            xtype: 'combobox',
            store: [ 'BRECHAS', 'NO CONFORMIDADES', 'OTROS' ],
            width: 270,
            emptyText: 'Filtro=(BRECHAS, NO CONF, OTROS)',
            editable: false,
            id: 'toolbar-combobox-tipo'
        },'-',{
            xtype: 'combobox',
            store: [ 'Pendiente', 'Culminado' ],
            width: 150,
            emptyText: 'Filtro=(ESTADO)',
            editable: false,
            id: 'toolbar-combobox-estado'
        },'->',{
            xtype: 'datefield',
            emptyText: 'Inicio (F)',
            name: 'fechaInicial',
            format: 'Y-m-d',
            editable: false,
            width: 130,
            afterLabelTextTpl: [
                '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>'
            ],
            id: 'fecha-inicial-date',
            listeners: {
                select: function (date) {
                    var date2 = Ext.getCmp('fecha-final-date');
                    if (date.getValue() > date2.getValue()) {
                        date2.setValue();
                    }
                }
            }
        },{
            xtype: 'datefield',
            emptyText: 'Final (F)',
            name: 'fechaFinal',
            format: 'Y-m-d',
            editable: false,
            width: 130,
            afterLabelTextTpl: [
                '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>'
            ],
            id: 'fecha-final-date',
            listeners: {
                select: function (date) {
                    var date1 = Ext.getCmp('fecha-inicial-date');
                    if (date.getValue() < date1.getValue()) {
                        date1.setValue();
                    }
                }
            }
        },'-',{
            tooltip: 'Quitar filtros.',
            iconCls: 'fa fa-filter',
            id: 'fecha-remove-filter'
        },'-',{
            tooltip: 'Ayuda acerca de Área de Resultado Clave (ARC).',
            iconCls: 'fa fa-question'
        }];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});