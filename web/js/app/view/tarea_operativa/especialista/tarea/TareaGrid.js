
Ext.define('CDT.view.tarea_operativa.especialista.tarea.TareaGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'tareaGrid',

    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,
    stripeRows: true,
    // Row Expander
    plugins: [{
        ptype: 'rowexpander',
        rowBodyTpl: ['{acciones}']
    }],

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store
        me.store = Ext.create('CDT.store.tarea_operativa.especialista.TareaStore');
        // Aplicar CSS a las Tareas Operativas pendientes. 
        me.viewConfig = {
            getRowClass: function(record)
            {
                date = new Date(), final = new Date(record.get('fecha_final'));
                date.setHours(0); date.setMinutes(0); date.setSeconds(0);
                final.setHours(0); final.setMinutes(0); final.setSeconds(0);

                if (final > date) {
                    return 'x-grid-row-color-pendiente';
                }
                else if((final.getFullYear() === date.getFullYear()) && (final.getMonth() === date.getMonth()) && (final.getDate()+1 === date.getDate()))
                {
                    return 'x-grid-row-color-presente';
                }
                return 'x-grid-row-color-pasado';
            }
        };
        // Modelo de columna
        me.columns = [{
            xtype : 'rownumberer',
            text  : 'No',
            width : 35,
            align : 'center'
        }, {
            text: 'Id',
            dataIndex: 'id',
            width: 35,
            hidden: true
        }, {
            text: 'Número',
            dataIndex: 'numero',
            width: 100,
        }, {
            text: 'Responsable',
            dataIndex: 'responsable',
            flex: 2,
            autoWidth: true
        }, {
            text: 'Descripción',
            dataIndex: 'descripcion',
            flex: 8,
            autoWidth: true
        }, {
            text: 'Chequeo',
            dataIndex: 'chequeo',
            flex: 2,
            autoWidth: true
        }, {
            text: 'Fecha',
            columns: [{
                text     : 'Inicial',
                width    : 85,
                sortable : true,
                align: 'center',
                dataIndex: 'fecha_inicial'
            },{
                text     : 'Final',
                width    : 85,
                sortable : true,
                align: 'center',
                dataIndex: 'fecha_final'
            }]
        }, {
            xtype: 'checkcolumn',
            text: '(P)',
            dataIndex: 'prioridad',
            width: 75,
            id: 'checkcolumn-prioridad-to'
        }, {
            text: 'Estado',
            dataIndex: 'estado',
            width: 50,
            hidden: true
        }, {
            text: 'TrabajadoresIds',
            dataIndex: 'trabajadores_ids',
            width: 50,
            hidden: true
        }];               
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});