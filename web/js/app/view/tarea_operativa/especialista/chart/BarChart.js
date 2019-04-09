
Ext.define('CDT.view.tarea_operativa.especialista.chart.BarChart', {
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

        me.store = Ext.create('CDT.store.tarea_operativa.especialista.BarChartStore'),

        me.axes = [{
            type: 'Numeric',
            position: 'bottom',
            fields: ['Cumplidas', 'Pendiente', 'Ultimo_día', 'Fuera_termino'],
            title: false,
            grid: true,
            label: {
                renderer: function(v) {
                    return String(v);
                }
            }
        }, {
            type: 'Category',
            position: 'left',
            fields: ['Departamento'],
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
            type: 'bar',
            axis: 'bottom',
            gutter: 80,
            xField: 'Departamento',
            yField: ['Cumplidas', 'Pendiente', 'Ultimo_día', 'Fuera_termino'],
            stacked: true,
            tips: {
                trackMouse: true,
                width: 150,
                height: 28,
                renderer: function(storeItem, item) {
                    var total = storeItem.get('Pendiente') + storeItem.get('Cumplidas');
                    this.setTitle(String(item.value[1]) +' Tarea Op. '+ Math.round(item.value[1] * 100 / total) + '%');
                }
            },
            label: {
                display: 'insideEnd',
                field: ['Cumplidas', 'Pendiente', 'Ultimo_día', 'Fuera_termino'],
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