
Ext.define('CDT.store.tarea_operativa.responsable.BarChartStore', {
    extend : 'Ext.data.Store',

    fields: [
        { name: 'Mes', type: 'string' },
        { name: 'Pendiente', type: 'int'},
        { name: 'Ultimo_día', type: 'int' },
        { name: 'Fuera_termino', type: 'int' },
        { name: 'Cumplidas', type: 'int' }
    ],
    autoLoad: true,

    proxy: {
        type: 'ajax',
        reader: {
            type: 'json'
        },
        url: entorno+'/tareasoperativas/to/chart/responsable/bar/list'
    }
});