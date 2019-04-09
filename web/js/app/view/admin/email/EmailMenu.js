
Ext.define('CDT.view.admin.email.EmailMenu', {
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
        var me = this;

        me.items = [{
            text: 'Eliminar usuario',
            iconCls: 'remove-user'
        }];
        me.callParent(arguments);
    }
});