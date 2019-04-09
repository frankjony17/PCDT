
Ext.define('CDT.store.indicador.CriterioMedidaTreeStore', {
    extend : 'Ext.data.TreeStore',

    fields: [
        { name: 'ID', type: 'int' },
        { name: 'nombre', type: 'string' },
        { name: 'progress', type: 'float' }
    ],
    proxy: {
        type: 'ajax',
        url: entorno+'/indicadores/cm/tree/list'
    },
    folderSort: true
});