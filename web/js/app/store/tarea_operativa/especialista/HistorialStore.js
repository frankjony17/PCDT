
Ext.define('CDT.store.tarea_operativa.especialista.HistorialStore', {
        extend: 'Ext.data.Store',

        fields: ['id', 'fecha', 'descripcion', 'areaResponsable', 'tarea', 'estado'],

        autoLoad: true,
        groupField: 'tarea',

        proxy: {
            type: 'ajax',
            url: entorno + '/tareasoperativas/accion/list',
            reader: {
                type: 'json',
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            }
        }
    }
);