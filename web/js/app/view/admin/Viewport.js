
Ext.define('CDT.view.admin.Viewport', {
    extend: 'Ext.container.Viewport',
    xtype : 'viewportTransporte',
    
    layout: 'border',
    id: 'view-viewport-id',
    
    initComponent: function()
    {
        var me = this; Ext.QuickTips.init();
        
        me.items = [
        {
            region: 'north',
            xtype: 'container',
            border: false,
            height: 35,
            
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            id: 'admin-header',
            
            items:[{
                xtype: 'component',
                id: 'admin-header-title',
                html: 'Administrador de la '+unidadorganizativa,
                flex: 1
            },{
                text: 'Aplicaciones',
                xtype: 'button',
                menu: Ext.create('CDT.view.AplicacionesMenu', { appId: 'admin-app-id' }),
                iconCls: 'app'
            },{
                xtype: 'tbspacer',
                width: 7
            },{
                xtype: 'button',
                text: 'Salir',
                iconCls: 'logout',
                id: 'admin-logout'
            },{
                xtype: 'tbspacer',
                width: 10
            }]
        },{
            region: 'west',
            title: '<center><b>Nomencladores</b></center>',
            width: 250,
            split: true,
            collapsible: true,
            id: 'west-panel-id',

            items: [
            {
               region: 'north',
               xtype: 'nomencladorTreePanel',
               border: false,
               height: 215
            }, {
               title: '<center><b>Seguridad</b></center>',
               region: 'center',
               xtype: 'seguridadTreePanel',
               border: false,
               height: 150
            }, {
               title: '<center><b>Otros</b></center>',
               region: 'south',
               border: false,
               items: Ext.create('CDT.view.admin.OtrosTreePanel')
            }]
        }, {
            region: 'center',
            xtype: 'tabpanel',
            activeTab: 0,
                
            items: [{
                title: 'Propósito',
                height: 3000,
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                html: '<p>&nbsp;&nbsp;&nbsp;&nbsp;¿Qué es esto. Poner algo aquí tío…?</p>',
                id: 'tab-inicial-id'
            }],
            id: 'center-panel-id'
        }, {
            region: 'south',
            id: 'south-panel-id',
            items: Ext.create('CDT.view.StatusBarPanel')
        }];
        // Variables usadas por los controladores de los Tree.
        me.itemstab = []; me.counttab = 0;
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});