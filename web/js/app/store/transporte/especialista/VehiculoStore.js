
Ext.define('CDT.store.transporte.especialista.VehiculoStore', {
    extend: 'Ext.data.Store',
    
    fields: ['id', 'marca', 'modelo', 'tipo', 'area', 'areaParqueo', 'chapa', 'area_id', 'area_parqueo_id'],
    autoLoad: true,
    sorters: 'areaParqueo',
    groupField: 'areaParqueo',
    
    proxy: {
        type: 'ajax',
        url: entorno+'/transporte/vehiculo/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});