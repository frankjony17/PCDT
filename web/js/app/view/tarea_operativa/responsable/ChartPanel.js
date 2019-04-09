
Ext.define('CDT.view.tarea_operativa.responsable.ChartPanel', {
    extend: 'Ext.panel.Panel',
    xtype: 'tarea-operativa-graficos-panel',

    bodyPadding: 10,
    unstyled: true,
    scrollable: true,
    defaults: {
        bodyPadding: 10
    },
    initComponent: function()
    {
        var me = this,
            chartpie = Ext.create('CDT.view.tarea_operativa.responsable.chart.PieChart'),
            chartbar = Ext.create('CDT.view.tarea_operativa.responsable.chart.BarChart');

        me.items = [{
            layout: {
                type: 'hbox'
            },
            bodyPadding: 10,
            unstyled: true,
            defaults: {
                frame: false,
                bodyPadding: 10
            },
            items: [{
                title: 'Total de tareas por tipo. (Año en curso)',
                flex: 4,
                margin: '0 10 0 0',
                items: [{
                    xtype: 'toolbar',
                    items: [{
                        iconCls: 'chart-exporting',
                        tooltip: 'Exportar gráfico en imagen PNG.',
                        handler: function() {
                            chartpie.save({type: 'image/png'});
                        }
                    },{
                        enableToggle: true,
                        text: 'Donut',
                        iconCls: 'chart-donut',
                        toggleHandler: function(btn, pressed) {
                            chartpie.series.first().donut = pressed ? 35 : false;
                            chartpie.refresh();
                        }
                    }]
                }, chartpie]
            },{
                title: 'Porciento de tareas por tipos. (Año en curso)',
                flex: 5,
                items: [{
                    xtype: 'toolbar',
                    items: [{
                        tooltip: 'Exportar gráfico en imagen PNG.',
                        iconCls: 'chart-exporting',
                        handler: function() {
                            chartbar.save({type: 'image/png'});
                        }
                    }]
                }, chartbar]
            }]
        }];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        this.callParent(arguments);
    }
});