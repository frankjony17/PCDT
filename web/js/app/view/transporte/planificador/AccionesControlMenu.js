
Ext.define('CDT.view.transporte.planificador.AccionesControlMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'eventualMenu',
    
    frame       : true,
    frameHeader : true,
    title       : 'Seleccione',
    titleAlign  : 'center',
    defaults: {
        padding: 5
    },
    style: {
        overflow: 'visible'
    },
    closeAction : 'destroy',

    items: [{
        text: '<b>Parqueo Eventual</b>',
        tooltip: 'Solicitud para parquear el vehículo fuera del área de parqueo establecida para este.',
        iconCls: 'parqueo-eventual',
        id: 'parqueo-eventual-id'
    },{
        text: '<b>Circulación Eventual</b>',
        tooltip: 'Solicitud para circular el vehículo en horario extra laboral.',
        iconCls: 'circulacion-eventual',
        id: 'circulacion-eventual-id'
    }]
});