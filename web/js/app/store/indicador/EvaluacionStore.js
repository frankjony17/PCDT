
Ext.define('CDT.store.indicador.EvaluacionStore', {
    extend : 'Ext.data.Store',

    fields: ['id', 'nombre', 'descripcion'],
    sorters: 'nombre',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: entorno+'/indicadores/evaluacion/list'
    }
});