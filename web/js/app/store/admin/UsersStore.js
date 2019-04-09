
Ext.define('CDT.store.admin.UsersStore', {
    extend : 'Ext.data.Store',
    xtype  : 'usersStore',
    
    fields   : [
        'id', 'username', 'last_login', 'is_active', 'roles',
        'nombre', 'movil', 'cargo', 'area', 'email'
    ],
    autoLoad: true,
    sorters: 'area',
    groupField: 'area',
    proxy : {
        type : 'ajax',
        url: entorno+'/admin/users/list',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});