
Ext.define('CDT.store.admin.CargoStore', {
    extend: 'Ext.data.Store',
    xtype : 'cargoStore',
    
    fields   : ['id', 'nombre', 'descripcion'],
    
    autoLoad: true,
    sorters: 'nombre',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/all/nomenclador/cargo/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});