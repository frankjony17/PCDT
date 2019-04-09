
Ext.define('CDT.store.admin.AreaStore', {
    extend : 'Ext.data.Store',
    xtype  : 'areaStore',
    
    fields   : ['id', 'nombre', 'unidadOrganizativa'],
    
    autoLoad: true,
    sorters: 'nombre',
    groupField: 'unidadOrganizativa',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/all/nomenclador/area/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});