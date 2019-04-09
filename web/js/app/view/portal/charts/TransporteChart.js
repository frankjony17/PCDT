
Ext.define('CDT.view.portal.charts.TransporteChart', {
    extend : 'Ext.chart.Chart',
     
    animate: true,
    shadow: true,
    legend: {
        position: 'right'
    },
    insetPadding: 5,
    theme: 'Base:gradients',
    
    initComponent: function()
    {
        var me = this;
        
        me.store = Ext.create('CDT.store.portal.TransporteStore');
        
        me.series = [
        {
            type: 'pie',
            field: 'incidencia',
            showInLegend: true,
            donut: 20,
            tips: {
                trackMouse: true,
                width: 180,
                height: 45,

                renderer: function(storeItem, item)
                {
                    this.setTitle(storeItem.get('mes') + ': ' + storeItem.get('incidencia') +'<br>incidencias de transporte.');
                }
            },
            highlight: {
                segment: {
                    margin: 20
                }
            },
            label: {
                field: 'mes',
                display: 'rotate',
                contrast: true,
                font: '12px Arial',
                renderer: function (val)
                {
                    var inc;
                    
                    me.store.each(function(rec)
                    {
                        if(val === rec.get('mes'))
                        {
                            inc = rec.get('incidencia');
                        }
                    });
                    return inc;
                }
            }
        }];
       // Carga nuestra configuaración y se la pasa al componente del que heredamos. 
        me.callParent(arguments);
    }    
});