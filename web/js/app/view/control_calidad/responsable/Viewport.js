
Ext.define('CDT.view.control_calidad.responsable.Viewport', {
    extend: 'Ext.container.Viewport',
    xtype: 'viewport-control-calidad-responsable',
    
    layout: {
        type: 'border',
        padding: 4
    },
    id: 'view-viewport-id',
    style: {
        backgroundColor: '#5fa2dd'
    },
    initComponent: function() {
        var me = this; Ext.QuickTips.init();
        me.items = [{
            region: 'north',
            xtype: 'container',
            border: false,
            height: 54,
            layout: {
                type: 'hbox',
                align: 'center'
            },
            items:[{
                xtype: 'buttongroup',
                items: [{
                    text: 'Brecha | No Conformidades | Otros',
                    tooltip: 'Brecha | No Conformidades | Otros.',
                    xtype: 'button',
                    iconCls: 'fa fa-tty',
                    id: 'control-calidad-button-id'
                },{
                    xtype: 'tbspacer',
                    width: 7
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
                    //menu: Ext.create('CDT.view.AplicacionesMenu',{ appId: me.appId }),
                    iconCls: 'app'
                },{
                    text: 'Salir',
                    xtype: 'button',
                    iconCls: 'logout',
                    id: 'control-calidad-logout'
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
            items: Ext.create('CDT.view.StatusBarPanel', {
                style: { backgroundColor: '#5fa2dd' }
            })
        }];
       // Carga nuestra configuaración y se la pasa al componente del que heredamos. 
        me.callParent(arguments);
    }
});