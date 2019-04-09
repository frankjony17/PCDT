
Ext.define('CDT.view.tarea_operativa.TareasMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'tareasMenu',
    
    frame       : true,
    frameHeader : true,
    title       : 'Seleccione',
    titleAlign  : 'center',
    defaults: {
        padding: 2
    },
    style: {
        overflow: 'visible'
    },
    width: 245,
    closeAction : 'destroy',
    
    items: [{
        text: '<b>Historial de las Acciones</b>',
        iconCls: 'tarea-historial',
        id: 'tarea-historial-id'
    }, {
        text: '<b>Gráficos generales</b>',
        iconCls: 'chart',
        id: 'tarea-graficos-id'
    }]
});