
Ext.define('CDT.store.email.EmailStore', {
    extend : 'Ext.data.Store',

    fields   : ['user_id', 'email', 'trabajador', 'modulo', 'modulo_id', 'address_id'],
    
    autoLoad: true,
    sorters: 'email',
    groupField: 'modulo',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/util/email/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});