
Ext.define('CDT.store.control_calidad.PlanAccionStore', {
    extend : 'Ext.data.Store',
    fields: ['id', 'descripcion', 'fechainicial', 'fechafinal', 'estado'],
    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: '/controlcalidad/planaccion/list'
    }
});