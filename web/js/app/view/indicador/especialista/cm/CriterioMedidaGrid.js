
Ext.define('CDT.view.indicador.especialista.cm.CriterioMedidaGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'criterio-medida-grid',

    width: '100%',
    selType: 'checkboxmodel',
    autoScroll: true,

    features: [{
        groupHeaderTpl: 'Objetivo: {name}',
        ftype: 'groupingsummary',
        collapsible: false
    }],
    plugins: [{
        ptype: 'rowexpander',
        rowBodyTpl : new Ext.XTemplate('{tabla_real}','<br>Nombre: {objetivo}')
    }],
    columnLines: true,
    animCollapse: true,

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store
        me.store = Ext.create('CDT.store.indicador.CriterioMedidaStore');
        // Modelo de columna
        me.columns = [{
            text: 'Id',
            dataIndex: 'id',
            width: 35,
            hidden: true
        },{
            dataIndex: 'objetivo',
            hidden: true
        },{
            dataIndex: 'evaluacion',
            hidden: true
        },{
            text: 'Nombre',
            dataIndex: 'nombre',
            flex: 2,
            editor: {
                xtype: 'textfield',
                maxLength: 20,
                allowBlank: false
            },
            hidden: true
        },{
            text: 'Descripción',
            dataIndex: 'descripcion',
            flex: 8,
            editor: {
                xtype: 'textareafield',
                grow: true,
                allowBlank: false
            }
        },{
            text: 'Responsable',
            dataIndex: 'responsable',
            flex: 2,
            editor: {
                xtype: 'combobox',
                store: Ext.create("CDT.store.tarea_operativa.especialista.TrabajadorUsersStore"),
                queryMode: 'local',
                displayField: 'nombreApellidos',
                valueField: 'id',
                editable: false
            }
        },{
            text: 'Plan',
            dataIndex: 'plan',
            flex: 1,
            renderer : function(value) {
                return '<span style="color:blue;"><b>' + value + '</b></span>';
            },
            editor: {
                xtype: 'numberfield',
                minValue: 0,
                allowBlank: false
            }
        },{
            text: 'Real',
            dataIndex: 'real',
            flex: 1,
            renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                if (store.getAt(rowIndex).get("estado") === true) {
                    return '<span style="color:green;"><b>' + value + '</b></span>';
                } else {
                    return '<span style="color:red;"><b>' + value + '</b></span>';
                }
            }
        },{
            text: 'Comportamiento',
            columns: [{
                text: 'Progress',
                xtype: 'widgetcolumn',
                width: 100,
                dataIndex: 'progress',
                widget: {
                    xtype: 'progressbarwidget',
                    textTpl: [
                        '{percent:number("0")}%'
                    ]
                }
            },{
                xtype: 'widgetcolumn',
                text: 'Pie',
                width: 50,
                dataIndex: 'pie',
                widget: {
                    xtype: 'sparklinepie',
                    sliceColors: ['#60A3DD', '#FFC860']
                }
            }]
        }];
        // Articulos de topbar: barra superior
        me.tbar = [{
            text: 'Adicionar',
            tooltip: 'Adicionar Criterio de Medida.',
            iconCls:  'fa fa-plus'
        },{
            text: 'Editar',
            tooltip: 'Editar Criterio de Medida.',
            iconCls: 'fa fa-edit'
        },'',{
            text: 'Eliminar',
            tooltip: 'Eliminar Criterios de Medida.',
            iconCls: 'fa fa-trash'
        },'->',
        {
            tooltip: 'Ayuda acerca de Criterios de Medida.',
            iconCls: 'fa fa-question'
        }];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});