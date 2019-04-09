
Ext.define('CDT.view.indicador.especialista.cm.analisis.CriterioMedidaPanel', {
    extend: 'Ext.panel.Panel',
    xtype: 'cm-vertical-panel',

    layout: {
        type: 'vbox',
        pack: 'start',
        align: 'stretch'
    },
    bodyPadding: 10,
    scrollable: true,
    defaults: {
        bodyPadding: 10
    },
    initComponent: function()
    {
        var me = this;

        me.htmlCriterio = Ext.create('Ext.toolbar.TextItem', { id: 'cm-panel-grid-criteriom' });
        me.htmlPlanReal = Ext.create('Ext.toolbar.TextItem', { id: 'cm-panel-grid-plan-real' });

        me.items = [{
            margin: '0 0 10 0',
            items: me.htmlCriterio
        },{
            margin: '0 0 10 0',
            items: [
                Ext.create("CDT.view.indicador.especialista.cm.analisis.RealGrid"),
                me.htmlPlanReal
            ]
        },{
            layout: {
                type: 'hbox'
            },
            bodyPadding: 10,
            defaults: {
                frame: true,
                bodyPadding: 10
            },
            items: [{
                title: 'Grafico de Barra',
                flex: 5,
                margin: '0 10 0 0',
                id: 'panel-chart-column3d'
            },{
                title: 'Grafico de Pastel',
                flex: 4,
                id: 'panel-chart-pie'
            }]
        },{
            layout: {
                type: 'hbox'
            },
            bodyPadding: 10,
            defaults: {
                frame: true,
                bodyPadding: 10
            },
            items: [{
                title: 'Grafico de Barra',
                id: 'panel-chart-bar3d',
                flex: 5,
                margin: '0 10 0 0',
            },{
                title: 'Grafico de Pastel',
                flex: 4,
                id: 'panel-chart-pie-total'
            }]
        }];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});