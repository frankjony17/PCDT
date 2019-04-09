
Ext.define('CDT.store.indicador.CriterioMedidaStore', {
    extend : 'Ext.data.Store',

    fields: ['id', 'nombre', 'descripcion', 'responsable', 'plan', 'real', 'progress', 'pie', 'estado', 'evaluacion', 'objetivo', 'objetivo_descripcion', 'tabla_real'],
    sorters: 'nombre',
    groupField: 'objetivo_descripcion',
    autoLoad: true,

    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: entorno+'/indicadores/cm/list'
    }
});