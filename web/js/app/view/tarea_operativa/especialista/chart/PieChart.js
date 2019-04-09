
Ext.define('CDT.view.tarea_operativa.especialista.chart.PieChart', {
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

        me.store = Ext.create('CDT.store.tarea_operativa.especialista.PieChartStore');

        me.series = [{
            type: 'pie',
            angleField: 'total',
            showInLegend: true,
            tips: {
                trackMouse: true,
                width: 175,
                height: 28,
                renderer: function(storeItem, item) {
                    var total = 0;
                    me.store.each(function(rec) {
                        total += rec.get('total');
                    });
                    this.setTitle(storeItem.get('depar') +': '+ storeItem.get('total') +' Tarea Op. '+ Math.round(storeItem.get('total') / total * 100) + '%');
                }
            },
            highlight: {
                segment: {
                    margin: 20
                }
            },
            label: {
                field: 'depar',
                display: 'rotate',
                contrast: true,
                font: '18px Arial'
            }
        }];
        me.callParent(arguments);
    }
});