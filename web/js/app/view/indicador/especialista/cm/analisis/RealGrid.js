
Ext.define('CDT.view.indicador.especialista.cm.analisis.RealGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'real-grid',

    title: '<b>Real año: '+ fecha_year +'</b>',
    columnLines: true,
    border: true,

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store
        me.store = Ext.create('CDT.store.indicador.RealStore');
        // Modelo de columna
        me.columns = [
            { text: 'Id', dataIndex: 'id', width: 35, hidden: true },
            { text: 'Enero', dataIndex: 'ene', flex: 1, align: 'center', sortable: false },
            { text: 'Febrero', dataIndex: 'feb', flex: 1, align: 'center', sortable: false },
            { text: 'Marzo', dataIndex: 'mar', flex: 1, align: 'center', sortable: false },
            { text: 'Abril', dataIndex: 'abr', flex: 1, align: 'center', sortable: false },
            { text: 'Mayo', dataIndex: 'may', flex: 1, align: 'center', sortable: false },
            { text: 'Junio', dataIndex: 'jun', flex: 1, align: 'center', sortable: false },
            { text: 'Julio', dataIndex: 'jul', flex: 1, align: 'center', sortable: false },
            { text: 'Agosto', dataIndex: 'ago', flex: 1, align: 'center', sortable: false },
            { text: 'Septiembre', dataIndex: 'sep', flex: 1, align: 'center', sortable: false },
            { text: 'Octubre', dataIndex: 'oct', flex: 1, align: 'center', sortable: false },
            { text: 'Noviembre', dataIndex: 'nov', flex: 1, align: 'center', sortable: false },
            { text: 'Diciembre', dataIndex: 'dic', flex: 1, align: 'center', sortable: false }
        ];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});