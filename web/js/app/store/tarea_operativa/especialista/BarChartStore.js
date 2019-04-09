
Ext.define('CDT.store.tarea_operativa.especialista.BarChartStore', {
    extend : 'Ext.data.Store',

    fields: [
        { name: 'Departamento', type: 'string' },
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
        url: entorno+'/tareasoperativas/to/chart/especialista/bar/list'
    }
});