
Ext.define('CDT.view.indicador.Viewport', {
    extend: 'Ext.container.Viewport',
    
    layout: {
        type: 'border'
    },
    id: 'view-viewport-id',
    
    initComponent: function()
    {
        var me = this; 
        
        me.items = [{
            region: 'west',
            collapsible: true,
            split: true,
            width: 250,
            title: '<b>INDICADORES</b>',
            items:[{
                xtype: 'buttongroup',
                border: false,
                frame: false,
                items: [{
                    text: 'Área de Resultado Clave',
                    tooltip: 'Listado de las Áreas de Resultado Clave (ARC).',
                    xtype: 'splitbutton',
                    menu: Ext.create('CDT.view.indicador.especialista.arc.ArcMenu', { arc: me.arc}),
                    iconCls: 'fa fa-sitemap',
                    width: 240,
                    id: 'arc-splitbutton-viewport'
                }]
            },{
                xtype: 'buttongroup',
                border: false,
                frame: false,
                items: [{
                    text: 'Objetivos (Estratégico-Anual)',
                    tooltip: 'Listado de los Objetivos (Estratégicos/Anuales).',
                    xtype: 'button',
                    iconCls: 'fa fa-tasks',
                    width: 240,
                    id: 'objetivo-button-viewport'
                }]
            },{
                xtype: 'buttongroup',
                frame: false,
                items: Ext.create('CDT.view.indicador.especialista.cm.CriterioMedidaTreePanel')
            }]
        },{
            region: 'center',
            xtype: 'panel',
            items: [{
                title: '<b>Propósito</b>',
                height: 3000,
                html: '<p>&nbsp;&nbsp;&nbsp;&nbsp;¿Qué es esto. Poner algo aquí tío…?</p>'
            }],
            id: 'center-panel-id'
        },{
            region: 'south',
            id: 'south-panel-id',
            items: Ext.create('CDT.view.StatusBarPanel', {
                style: {
                    backgroundColor: '#60A3DD'
                },
                border: true
            })
        }];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});