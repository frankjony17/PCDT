
Ext.define('CDT.view.admin.users.UsersMenu', {
    extend: 'Ext.menu.Menu',
    
    frame: true,
    frameHeader: true,
    title: 'Acciones',
    titleAlign: 'center',
    style: {
        overflow: 'visible'
    },
    width: 200,
    closeAction : 'destroy',
    
    initComponent: function ()
    {
        var me = this, item1;
        
        if (me.option)
        {
            item1 = {
                text: 'Desactivar usuario',
                iconCls: 'menu-dasactivar-item'
            };
        } else {
            item1 = {
                text: 'Activar usuario',
                iconCls: 'menu-active-item'
            };
        }
        me.items = [ item1, '-',
        {
            text: 'Editar usuario',
            iconCls: 'menu-edit-item'
        },'-',{
            text: 'Añadir o quitar Roles',
            iconCls: 'menu-roles-item'
        }];
    
        me.callParent(arguments);
    }
});