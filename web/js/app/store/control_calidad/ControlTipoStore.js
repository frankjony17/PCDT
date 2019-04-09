
Ext.define('CDT.store.control_calidad.ControlTipoStore', {
    extend : 'Ext.data.Store',
    fields: ['id', 'nombre', 'descripcion'],
    sorters: 'nombre',
    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: '/controlcalidad/control/tipo/list'
    },
    autoLoad: true
});