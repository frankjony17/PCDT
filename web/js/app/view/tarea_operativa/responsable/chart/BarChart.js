
Ext.define('CDT.view.tarea_operativa.responsable.chart.BarChart', {
    extend: 'Ext.chart.Chart',

    animate: true,
    shadow: true,
    width: 700,
    height: 387,
    legend: {
        position: 'right'
    },

    initComponent: function ()
    {
        var me = this;

        me.store = Ext.create('CDT.store.tarea_operativa.responsable.BarChartStore'),

        me.axes = [{
            type: 'Numeric',
            position: 'left',
            fields: ['Pendiente', 'Ultimo_día', 'Fuera_termino', 'Cumplidas'],
            title: false,
            grid: true,
            label: {
                renderer: function(v) {
                    return String(v);
                }
            }
        }, {
            type: 'Category',
            position: 'bottom',
            fields: ['Mes'],
            grid: true,
            title: false,
            label: {
                renderer: function(v) {
                    return String(v);
                },
                font: 'bold 12px Arial',
                'text-anchor': 'middle'
            }
        }];

        me.series = [{
            type: 'column',
            axis: 'left',
            gutter: 80,
            xField: 'Mes',
            yField: ['Pendiente', 'Ultimo_día', 'Fuera_termino', 'Cumplidas'],
            stacked: true,
            tips: {
                trackMouse: true,
                width: 150,
                height: 28,
                renderer: function(storeItem, item)
                {
                    var total = storeItem.get('Pendiente') + storeItem.get('Cumplidas');
                    this.setTitle(String(item.value[1]) +' Tarea Op. '+ Math.round(item.value[1] * 100 / total) + '%');
                }
            },
            label: {
                display: 'insideEnd',
                field: ['Pendiente', 'Ultimo_día', 'Fuera_termino', 'Cumplidas'],
                renderer: Ext.util.Format.numberRenderer('0'),
                orientation: 'horizontal',
                color: '#333',
                font: 'bold 16px Arial',
                'text-anchor': 'middle'
            }
        }];
        me.callParent(arguments);
    }
});