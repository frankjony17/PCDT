
Ext.define('CDT.store.transporte.especialista.ChoferStore', {
    extend: 'Ext.data.Store',
    
    fields: ['id', 'trabajador', 'licencia', 'profecional', 'horaParqueo',  'area', 'trabajador_id'],
    autoLoad: true,
    sorters: 'trabajador',
    groupField: 'area',
    
    proxy: {
        type: 'ajax',
        url: entorno+'/transporte/chofer/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});