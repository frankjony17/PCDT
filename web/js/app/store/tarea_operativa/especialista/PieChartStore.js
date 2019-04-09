
Ext.define('CDT.store.tarea_operativa.especialista.PieChartStore', {
    extend : 'Ext.data.Store',

    fields: ['depar', 'total'],
    autoLoad: true,

    proxy: {
        type: 'ajax',
        reader: {
            type: 'json'
        },
        url: entorno+'/tareasoperativas/to/chart/especialista/pie/list'
    }
});