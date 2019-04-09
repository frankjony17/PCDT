
Ext.define('CDT.store.indicador.RealStore', {
    extend : 'Ext.data.Store',

    fields: [
        'id', 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic',
        'cm', 'responsable', 'objetivo', 'arc',
        'plan', 'real', 'estado'
    ],
    proxy: {
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        },
        url: entorno+'/indicadores/cm/real/list'
    }
});