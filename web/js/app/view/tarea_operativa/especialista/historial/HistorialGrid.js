Ext.define('CDT.view.tarea_operativa.especialista.historial.HistorialGrid', {
        extend: 'Ext.grid.Panel',
        xtype: 'historialGrid',

        width: '100%',
        border: false,
        selType: 'checkboxmodel',
        autoScroll: true,

        features: [{
            groupHeaderTpl: '{name}',
            ftype: 'grouping',
            collapsible: true
        }],

        initComponent: function ()
        {
            var me = this; // Ambito del componente.
            // Store 
            me.store = Ext.create('CDT.store.tarea_operativa.especialista.HistorialStore');
            // Modelo de columna
            me.columns = [
                {
                    xtype: 'rownumberer',
                    text: 'No',
                    width: 35,
                    align: 'center'
                }, {
                    text: 'Id',
                    dataIndex: 'id',
                    width: 35,
                    hidden: true
                }, {
                    text: 'Fecha',
                    dataIndex: 'fecha',
                    flex: 1
                }, {
                    text: 'Descripción',
                    dataIndex: 'descripcion',
                    titleAlign: "center",
                    flex: 6
                }, {
                    text: 'Responsable',
                    dataIndex: 'areaResponsable',
                    flex: 1
                }, {
                    text: 'Estado',
                    dataIndex: 'estado',
                    hidden: true
                }
            ];
            // Articulos de topbar: barra superior    
            me.tbar = [{
                xtype: 'buttongroup',
                items: [{
                    xtype: 'combobox',
                    store: Ext.create('CDT.store.admin.AreaStore'),
                    valueField: 'id',
                    displayField: 'nombre',
                    editable: false,
                    emptyText: 'Área.', id: "historial-combobox-area-id",
                    width: 140
                }, {
                    xtype: 'combobox',
                    store: ["Pendiente", "Final"],
                    queryMode: 'local',
                    editable: false,
                    emptyText: 'Estado.', id: "historial-combobox-estado-id",
                    width: 125
                },{
                    iconCls: 'trash', id: "historial-combobox-trash-id"
                }]
            }, '->',{
                xtype: 'buttongroup',
                items: [{
                    xtype: 'datefield',
                    emptyText: 'Inicial',
                    format: 'Y-m-d',
                    editable: false,
                    width: 125
                },{
                    xtype: 'datefield',
                    emptyText: 'Final',
                    format: 'Y-m-d',
                    editable: false,
                    width: 125
                },{
                    iconCls: 'trash', id: "historial-datefield-trash-id"
                }]
            },'',{
                xtype: 'buttongroup',
                items: [{
                    tooltip: 'Ayuda acerca de historial',
                    iconCls: 'help'
                }]
            }];
            // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
            me.callParent(arguments);
        }
    }
);