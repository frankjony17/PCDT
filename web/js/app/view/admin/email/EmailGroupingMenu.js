
Ext.define('CDT.view.admin.email.EmailGroupingMenu', {
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
            text: 'Agregar usuario',
            iconCls: 'add-user'
        }]
//            '-',{
//            text: 'Editar remitente del Módulo',
//            iconCls: 'edit-address'
//        },'-',{
//            text: 'Eliminar remitente del Módulo',
//            iconCls: 'remove-address'
//        }];
        me.callParent(arguments);
    }
});