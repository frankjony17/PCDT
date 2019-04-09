
Ext.define('CDT.view.tarea_operativa.responsable.chart.PieChart', {
    extend: 'Ext.chart.Chart',

    animate: true,
    shadow: true,
    theme: 'Base:gradients',
    width: 500,
    height: 387,
    legend: {
        position: 'right',
    },
    margin: '0 0 0 45',

    initComponent: function ()
    {
        var me = this;

        me.store = Ext.create('CDT.store.tarea_operativa.responsable.PieChartStore');

        me.series = [{
            type: 'pie',
            angleField: 'value',
            showInLegend: true,
            tips: {
                trackMouse: true,
                width: 220,
                height: 28,
                renderer: function(storeItem, item) {
                    var total = 0;
                    me.store.each(function(rec) {
                        total += rec.get('value');
                    });
                    this.setTitle(storeItem.get('type') +': '+ storeItem.get('value') +' Tarea Op. '+ Math.round(storeItem.get('value') / total * 100) + '%');
                }
            },
            highlight: {
                segment: {
                    margin: 20
                }
            },
            label: {
                field: 'type',
                display: 'rotate',
                contrast: true,
                font: '18px Arial'
            }
        }];
        me.callParent(arguments);
    }
});