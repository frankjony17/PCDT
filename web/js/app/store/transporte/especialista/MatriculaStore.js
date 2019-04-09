
Ext.define('CDT.store.transporte.especialista.MatriculaStore', {
    extend   : 'Ext.data.Store',
    fields   : ['id', 'chapa', 'chapaVieja', 'circulacion', 'vencimiento'],
    
    sorters: 'chapa',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/transporte/matricula/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});