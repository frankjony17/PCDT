
Ext.define('CDT.store.control_calidad.ControlStore', {
    extend : 'Ext.data.Store',
    fields: ['id', 'fecha', 'tipo', 'nombre', 'ejecutores'],
    sorters: 'fecha',
    groupField: 'tipo',
    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: '/controlcalidad/control/list'
    },
    autoLoad: true
});