
Ext.define('CDT.controller.indicador.CriterioMedidaPanelController', {
    extend: 'Ext.app.Controller',

    control: {
        'cm-vertical-panel': {
            beforerender: 'beforeRenderPanel',
            resize: function (grid) {
                grid.setHeight(Ext.ex.height('south-panel-id', 50));
            }
        },
        'real-grid': {
            beforerender: 'beforeRenderGrid',
            viewready: 'setHtmlPanel'
        }
    },

    beforeRenderPanel: function(panel)
    {
        this.panel = panel;
    },
    beforeRenderGrid: function(grid)
    {
        var me = this;
        this.grid = grid;
        this.store = grid.store;
        this.loadStore(me.panel.idCriterioMedida);
    },
    loadStore: function (id)
    {
        this.store.load({
            params: { Id: id }
        });
    },
    setHtmlPanel: function ()
    {
        var item_plan_real = this.panel.down("[id=cm-panel-grid-plan-real]"),
            item_criteriom = this.panel.down("[id=cm-panel-grid-criteriom]"),
            record = this.store.getAt(0); record = record["data"], color = "<span style='color:green;'>";

        item_criteriom.update(//<i style='background-color: #60a3dd;'>
            "<div class='tablestayle-cm'>"+
            "<table><tr>"+
                  "<td>ARC</td><td>"+ record.arc +"</td>"+
                "</tr><tr>"+
                  "<td>Objetivo</td><td>"+ record.objetivo +"</td>"+
                "</tr><tr>"+
                    "<td>Criterio de Medida</td><td>"+ record.cm +"</td>"+
                "</tr><tr>"+
                    "<td>Responsable</td><td>"+ record.responsable +"</td>"+
            "</tr></table></div>"
        );
        if (record.estado === false) {
            color = "<span style='color:red;'>";
        }
        item_plan_real.update(
            "<p id='text-item-cm'><b>Plan: <span style='color:blue;'><b>" + record.plan +"</span><br>Real: "+ color + record.real +"</span></b></p>"
        );
        // Mostrar Graficos.
        this.showColumnChart(record);
        this.showPieChart(record);
        this.showBarrasChart(record);
        this.showPieTotalChart(record);
    },
    showColumnChart: function (record)
    {
        var item = this.panel.down("[id=panel-chart-column3d]"),
            html = Ext.create('Ext.toolbar.TextItem');

        item.add({
            xtype: 'cartesian',
            width: '100%',
            height: 450,
            innerPadding: '0 10 0 10',
            interactions: ['itemhighlight'],
            animation: Ext.isIE8 ? false : {
                easing: 'backOut',
                duration: 500
            },
            store: {
                fields: ['mes', 'real'],
                data: [
                    { mes: 'Ene', real: record.ene },
                    { mes: 'Feb', real: record.feb },
                    { mes: 'Mar', real: record.mar },
                    { mes: 'Abr', real: record.abr },
                    { mes: 'May', real: record.may },
                    { mes: 'Jun', real: record.jun },
                    { mes: 'Jul', real: record.jul },
                    { mes: 'Ago', real: record.ago },
                    { mes: 'Sep', real: record.sep },
                    { mes: 'Oct', real: record.oct },
                    { mes: 'Nov', real: record.nov },
                    { mes: 'Dic', real: record.dic }
                ]
            },
            axes: [{
                type: 'numeric3d',
                position: 'left',
                fields: 'real',
                grid: {
                    odd: {
                        fillStyle: 'rgba(255, 255, 255, 0.06)'
                    },
                    even: {
                        fillStyle: 'rgba(0, 0, 0, 0.03)'
                    }
                }
            }, {
                type: 'category3d',
                position: 'bottom',
                grid: true,
                fields: 'mes'
            }],
            series: {
                type: 'bar3d',
                xField: 'mes',
                yField: 'real',
                style: {
                    minGapWidth: 20
                },
                highlightCfg: {
                    saturationFactor: 1.5
                },
                label: {
                    field: 'real',
                    display: 'insideEnd',
                    style: 'font-weight: bold',
                    font: '16px Helvetica'
                },
                tooltip: {
                    trackMouse: true,
                    style: 'background: #fff',
                    items: html,
                    renderer: function(storeItem, item) {
                        html.update("<b>"+ item.data['mes'] + ': ' + item.data['real'] +"</b>");
                    }
                }
            }
        });
    },
    showPieChart: function (record)
    {
        var item = this.panel.down("[id=panel-chart-pie]"),
            html = Ext.create('Ext.toolbar.TextItem');

        item.add({
            xtype: 'polar',
            theme: 'default-gradients',
            width: '100%',
            height: 450,
            interactions: ['rotate', 'itemhighlight'],
            animation: {
                duration: 500,
                easing: 'easeIn'
            },
            store: {
                fields: ['mes', 'real'],
                data: [
                    { mes: 'Ene', real: record.ene },
                    { mes: 'Feb', real: record.feb },
                    { mes: 'Mar', real: record.mar },
                    { mes: 'Abr', real: record.abr },
                    { mes: 'May', real: record.may },
                    { mes: 'Jun', real: record.jun },
                    { mes: 'Jul', real: record.jul },
                    { mes: 'Ago', real: record.ago },
                    { mes: 'Sep', real: record.sep },
                    { mes: 'Oct', real: record.oct },
                    { mes: 'Nov', real: record.nov },
                    { mes: 'Dic', real: record.dic }
                ]
            },
            innerPadding: 20,
            legend: {
                docked: 'left'
            },
            series: [{
                type: 'pie',
                highlight: true,
                angleField: 'real',
                label: {
                    field: 'mes',
                    style: 'font-weight: bold',
                    font: '16px Helvetica',
                    calloutLine: {
                        length: 30,
                        width: 3
                    }
                },
                donut: 10,
                tooltip: {
                    trackMouse: true,
                    style: 'background: #fff',
                    items: html,
                    renderer: function(storeItem, item) {
                        html.update("<b>"+ item.data['mes'] + ': ' + item.data['real'] +"</b>");
                    }
                }
            }]
        });
    },
    // Chart Barra
    showBarrasChart: function (record)
    {
        var item = this.panel.down("[id=panel-chart-bar3d]"),
            html = Ext.create('Ext.toolbar.TextItem');

        item.add({
            xtype: 'cartesian',
            flipXY: true,
            reference: 'chart',
            width: '100%',
            height: 500,
            innerPadding: '3 0 0 0',
            theme: {
                type: 'muted'
            },
            store: {
                fields: ['mes', 'real'],
                data: [
                    { mes: 'Ene', real: record.ene }, { mes: 'Feb', real: record.feb }, { mes: 'Mar', real: record.mar },
                    { mes: 'Abr', real: record.abr }, { mes: 'May', real: record.may }, { mes: 'Jun', real: record.jun },
                    { mes: 'Jul', real: record.jul }, { mes: 'Ago', real: record.ago }, { mes: 'Sep', real: record.sep },
                    { mes: 'Oct', real: record.oct }, { mes: 'Nov', real: record.nov }, { mes: 'Dic', real: record.dic }
                ]
            },
            animation: {
                easing: 'easeOut',
                duration: 500
            },
            interactions: ['itemhighlight'],
            axes: [{
                type: 'numeric3d',
                position: 'bottom',
                fields: 'real',
                majorTickSteps: 10,
                grid: {
                    odd: {
                        fillStyle: 'rgba(245, 245, 245, 1.0)'
                    },
                    even: {
                        fillStyle: 'rgba(255, 255, 255, 1.0)'
                    }
                }
            }, {
                type: 'category3d',
                position: 'left',
                fields: 'mes',
                label: {
                    textAlign: 'right'
                },
                grid: true
            }],
            series: [{
                type: 'bar3d',
                xField: 'mes',
                yField: 'real',
                style: {
                    minGapWidth: 10
                },
                highlight: true,
                label: {
                    field: 'real',
                    display: 'insideEnd',
                    font: '18px Helvetica'
                },
                tooltip: {
                    trackMouse: true,
                    style: 'background: #fff',
                    items: html,
                    renderer: function(storeItem, item) {
                        html.update("<b>"+ item.data['mes'] + ': ' + item.data['real'] +"</b>");
                    }
                }
            }]
        });
    },
    showPieTotalChart: function (record)
    {
        var item = this.panel.down("[id=panel-chart-pie-total]"),
            html = Ext.create('Ext.toolbar.TextItem');

        item.add({
            xtype: 'polar',
            width: '100%',
            height: 500,
            theme: 'default-gradients',
            innerPadding: 10,
            interactions: ['rotate', 'itemhighlight'],
            store: {
                fields: ['name', 'data'],
                data: [{
                    name: 'Plan',
                    data: record.plan
                }, {
                    name: 'Real',
                    data: record.real
                }]
            },
            series: {
                type: 'pie',
                highlight: true,
                angleField: 'data',
                label: {
                    field: 'name',
                    display: 'rotate',
                    font: '18px Helvetica',
                    renderer: function(text) {
                        if (text === "Plan") {
                            return text +" ("+ record.plan +")";
                        } else {
                            return text +" ("+ record.real +")";
                        }
                    }
                },
                donut: 25,
                tooltip: {
                    trackMouse: true,
                    style: 'background: #fff',
                    items: html,
                    renderer: function(storeItem, item) {
                        html.update("<b>"+ item.data['name'] + ': ' + item.data['data'] +"</b>");
                    }
                }
            }
        });
    }
});


