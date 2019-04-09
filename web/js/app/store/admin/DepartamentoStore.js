
Ext.define('CDT.store.admin.DepartamentoStore', {
    extend : 'Ext.data.Store',
    
    fields: ['id', 'codigo', 'nombre', 'telefonos'],
    sorters: 'nombre',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/all/nomenclador/departamento/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});