
Ext.define('CDT.store.admin.RolesUsersStore', {
    extend : 'Ext.data.Store',
    xtype  : 'rolesUsersStore',
    
    fields   : ['id', 'name', 'role', 'estado'],
    
    sorters: 'name',
    groupField: 'name',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/admin/roles/list_roles_users',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});