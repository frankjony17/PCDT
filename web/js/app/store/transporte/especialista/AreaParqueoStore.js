
Ext.define('CDT.store.transporte.especialista.AreaParqueoStore', {
    extend: 'Ext.data.Store',
    
    fields: ['id', 'nombre', 'telefonos', 'direccion', 'unidadOrganizativa'],
    autoLoad: true,
    sorters: 'nombre',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/transporte/area_parqueo/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});