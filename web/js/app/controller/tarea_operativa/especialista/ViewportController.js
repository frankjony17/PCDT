
Ext.define('CDT.controller.tarea_operativa.especialista.ViewportController', {
    extend: 'Ext.app.Controller',
    
    init: function()
    {   
        var me = this;
        
        me.control({
            'viewport-tarea-operativa': {
                afterrender: me.showCharts
            },
            '#tarea-operativa-logout': {
                click: me.logout
            },
            '#tareas-operativas-id': {
                click: me.tareaSplitbuttonClick
            },
            '#tarea-historial-id': {
                click: me.tareaHistorialClick
            },
            '#tarea-graficos-id': {
                click: me.showCharts
            }
        });
    },
    showCharts: function ()
    {
        this.closeToolTipLegend();
        this.addComponent(Ext.create('CDT.view.tarea_operativa.especialista.ChartPanel'));
        this.updateStatusBar('<b>Gráficos > Comportamiento de Tareas Operativas por Áreas</b>');
    },
    // Menu Nomenclador, button chofer.
    tareaSplitbuttonClick: function ()
    {
        this.closeToolTipLegend();
        this.addComponent(Ext.create('CDT.view.tarea_operativa.especialista.tarea.TareaGrid', {
            tbar: [{
                text: 'Adicionar',
                tooltip: 'Adicionar tarea',
                iconCls: 'add'
            },{
                text: 'Editar',
                tooltip: 'Editar tarea',
                iconCls: 'edit'
            },'',{
                text: 'Eliminar',
                tooltip: 'Eliminar tarea',
                iconCls: 'remove'
            },'->',{
                text: 'A Chequear',
                tooltip: 'Chequear TO priorizadas por el Jefe de CDT.',
                iconCls: 'reporte',
                id: 'resumen-prioridad-to-id'
            },'',{
                tooltip: 'Leyenda.',
                iconCls: 'legend-user',
                id: 'legend-tarea-id-0000'
            },{
                tooltip: 'Ayuda acerca de trabajador.',
                iconCls: 'help'
            }]
        }));
        this.updateStatusBar('<b>Gestionar > Tareas</b>');
    },
    // Menu Nomenclador, button chofer.
    tareaHistorialClick: function ()
    {
        this.closeToolTipLegend();
        this.addComponent(Ext.create('CDT.view.tarea_operativa.especialista.historial.HistorialGrid'));
        this.updateStatusBar('<b>Gestionar > Historial de Tareas Operativas</b>');
    },
    // Desloguar usuario.
    logout: function ()
    {
        location.href = entorno+'/secured/logout';
    },
    // Add component in the panel.
    addComponent: function (cmp)
    {
        var center_panel = Ext.getCmp('center-panel-id');
        
        center_panel.removeAll();
        center_panel.add(cmp);
    },
    // Eliminar componente del center panel.
    removeComponent: function (cmp)
    {
        var center_panel = Ext.getCmp('center-panel-id');
        
        center_panel.removeAll();
        
        this.updateStatusBar('>');
    },
    // Update detalle de barra de estado.
    updateStatusBar: function (texto)
    {
        var status_bar = Ext.getCmp('status-bar-detalles');
        
        status_bar.update('<b><span style="color:#000;">'+texto+'</span></b>');
    },
    // Close ToolTip Legend cuando se cierre la pesteña que contiene el grid user.
    closeToolTipLegend: function ()
    {
        var tip = Ext.getCmp('tool-tip-legend-tareas-id');
        
        if (Ext.isObject(tip))
        {
            tip.close();
        }
    }
});


