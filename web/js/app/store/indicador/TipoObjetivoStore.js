
Ext.define('CDT.store.indicador.TipoObjetivoStore', {
    extend : 'Ext.data.Store',

    fields: ['id', 'nombre'],
    sorters: 'nombre',
    autoLoad: true,

    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: entorno+'/indicadores/objetivo/tipo/list'
    }
});