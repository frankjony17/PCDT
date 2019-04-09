
Ext.define('CDT.store.admin.UsersDataBaseOrLDAPStore', {
    extend: 'Ext.data.Store',
    
    fields: ['id', 'uid', 'cn', 'mail'],
    sorters: 'cn',
    pageSize: 17,
    
    proxy : {
        type : 'ajax',
        url: entorno+'/admin/users/list_user_db',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});