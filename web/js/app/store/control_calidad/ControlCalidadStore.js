
Ext.define('CDT.store.control_calidad.ControlCalidadStore', {
    extend : 'Ext.data.Store',
    fields: ['id', 'nombre', 'ejecuta', 'fecha', 'progress', 'observaciones', 'participan', 'tipo', 'controlcalidad', 'trabajadores_ids', 'estado'],
    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: '/controlcalidad/cc/list'
    },
    autoLoad: true
});