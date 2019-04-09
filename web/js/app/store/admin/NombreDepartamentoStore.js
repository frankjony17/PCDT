
Ext.define('CDT.store.admin.NombreDepartamentoStore', {
    extend : 'Ext.data.Store',
    
    fields   : ['nombre'],
    autoLoad: true,
    sorters: 'nombre',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/all/nomenclador/departamento/list_distinct_nombre',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});