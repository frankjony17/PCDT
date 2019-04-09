
Ext.define('CDT.store.tarea_operativa.responsable.PieChartStore', {
    extend : 'Ext.data.Store',

    fields: ['type', 'value'],
    autoLoad: true,

    proxy: {
        type: 'ajax',
        reader: {
            type: 'json'
        },
        url: entorno+'/tareasoperativas/to/chart/responsable/pie/list'
    }
});