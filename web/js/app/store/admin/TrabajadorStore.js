
Ext.define('CDT.store.admin.TrabajadorStore', {
    extend : 'Ext.data.Store',
    xtype  : 'trabajadorStore',
    
    fields : ['id', 'numeroPlaza', 'nombreApellidos', 'movil', 'cargo', 'area', 'departamento'],
    
    sorters: 'area',
    groupField: 'area',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/all/nomenclador/trabajador/externo',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});