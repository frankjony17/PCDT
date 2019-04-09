
Ext.define('CDT.view.transporte.PlanificadorViewport', {
    extend: 'Ext.container.Viewport',
    
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
                    text: 'Planificación de Transporte',
                    tooltip: 'Planificar la circulación del transporte para los <b>fines de semana y días feriados</b>. ',
                    xtype: 'button',
                    iconCls: 'menu-planificacion',
                    id: 'menu-planificacion-id'
                },{
                    text: 'Acciones de Control',
                    tooltip: 'Acciones de transporte tales como:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1-Parqueo Eventual.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2-Circulación Eventual.</b>',
                    xtype: 'button',
                    menu: Ext.create('CDT.view.transporte.planificador.AccionesControlMenu'),
                    iconCls: 'menu-eventual'
                }]
            },{
                xtype: 'tbfill'
            },{
                xtype: 'buttongroup',
                items: [{
                    text: 'Reportes',
                    xtype: 'button',
                    menu: Ext.create('CDT.view.transporte.planificador.ReporteMenu'),
                    iconCls: 'reporte'
                }]
            },{
                xtype: 'tbspacer',
                width: 7
            },{
                xtype: 'buttongroup',
                items: [{
                    text: 'Aplicaciones',
                    xtype: 'button',
                    menu: Ext.create('CDT.view.AplicacionesMenu',{ appId: 'transporte-app-planificador-id' }),
                    iconCls: 'app'
                },{
                    text: 'Salir',
                    xtype: 'button',
                    iconCls: 'logout',
                    id: 'transporte-logout'
                }]
            }]
        },{
            region: 'center',
            xtype: 'panel',
            border: false,
            bodyStyle: 'background-image:url(../../images/portal/square.gif);',
            id: 'center-panel-id'
        },{
            region: 'south',
            id: 'south-panel-id',
            items: Ext.create('CDT.view.StatusBarPanel')
        }];
       // Carga nuestra configuaración y se la pasa al componente del que heredamos. 
        me.callParent(arguments);
    }
});