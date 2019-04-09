
Ext.define('CDT.store.tarea_operativa.especialista.TareaStore', {
    extend: 'Ext.data.Store',
    
    fields: ['id', 'numero', 'responsable', 'descripcion', 'chequeo', 'fecha_inicial',  'fecha_final', 'estado', 'acciones', 'trabajadores_ids', "accion", "accion_id"],
    //autoLoad: true,
    sorters: 'numero',
    storeId: 'tareaStore',

    proxy: {
        type: 'ajax',
        url: entorno+'/tareasoperativas/to/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});