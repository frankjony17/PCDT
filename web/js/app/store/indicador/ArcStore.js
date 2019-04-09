
Ext.define('CDT.store.indicador.ArcStore', {
    extend : 'Ext.data.Store',

    fields: ['id', 'nombre', 'descripcion', 'fecha'],
    sorters: 'nombre',
    groupField: 'fecha',

    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: entorno+'/indicadores/arc/list'
    }
});