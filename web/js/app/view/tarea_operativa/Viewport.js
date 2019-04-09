
Ext.define('CDT.view.tarea_operativa.Viewport', {
    extend: 'Ext.container.Viewport',
    xtype: 'viewport-tarea-operativa',
    
    layout : {
        type    : 'border',
        padding : 4
    },
    id: 'view-viewport-id',
    
    initComponent: function()
    {
        var me = this; Ext.QuickTips.init();

        me.items = [
        {
            region: 'north',
            xtype: 'container',
            border: false,
            height: 45,
            
            layout: {
                type: 'hbox',
                align: 'center'
            },
            items:[{
                xtype: 'buttongroup',
                items: [{
                    text: 'Tareas Operativas',
                    tooltip: 'Listado de tareas.',
                    xtype: 'splitbutton',
                    menu: Ext.create('CDT.view.tarea_operativa.TareasMenu'),
                    iconCls: 'tareas-operativas',
                    id: 'tareas-operativas-id'
                }]
            },{
                xtype: 'tbfill'
            },{
                xtype: 'tbspacer',
                width: 7
            },{
                xtype: 'buttongroup',
                items: [{
                    text: 'Aplicaciones',
                    xtype: 'button',
                    menu: Ext.create('CDT.view.AplicacionesMenu',{ appId: me.appId }),
                    iconCls: 'app'
                },{
                    text: 'Salir',
                    xtype: 'button',
                    iconCls: 'logout',
                    id: 'tarea-operativa-logout'
                }]
            }]
        },{
            region: 'center',
            xtype: 'panel',
            border: false,
            bodyStyle: 'background-image:url(../../images/portal/square.gif);',
            id: 'center-panel-id',
        },{
            region: 'south',
            id: 'south-panel-id',
            items: Ext.create('CDT.view.StatusBarPanel')
        }];
       // Carga nuestra configuaración y se la pasa al componente del que heredamos. 
        me.callParent(arguments);
    }
});