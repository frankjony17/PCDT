
Ext.define('CDT.store.indicador.ObjetivoStore', {
    extend : 'Ext.data.Store',

    fields: ['id', 'nombre', 'descripcion', 'tipo_objetivo', 'arc'],
    sorters: 'nombre',
    groupField: 'arc',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: entorno+'/indicadores/objetivo/list'
    }
});