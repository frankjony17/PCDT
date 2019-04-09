
Ext.define('CDT.store.admin.SeguridadTreeStore', {
    extend : 'Ext.data.TreeStore',

    root: {
        expanded : true,
        children: [
        {
            text: '<b>Roles</b>',
            iconCls: 'tree-roles',
            id: 'tree-roles-id',
            leaf: true
        },{
            text: '<b>Usuarios</b>',
            iconCls: 'tree-usuarios',
            id: 'tree-usuarios-id',
            leaf: true
        }]
    }
});