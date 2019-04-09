
Ext.define('CDT.store.admin.UnidadOrganizativaStore', {
    extend : 'Ext.data.Store',
    xtype  : 'uoStore',
    
    fields   : ['id', 'acronimo', 'nombre', 'telefonos'],
//    autoLoad: true,
    proxy : {
        type : 'ajax',
        url: entorno+'/all/nomenclador/uo/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});