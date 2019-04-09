
Ext.define('CDT.view.transporte.especialista.ReporteMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'reporteMenu',
    
    frame       : true,
    frameHeader : true,
    title       : 'Opciones',
    titleAlign  : 'center',
    
    defaults: {
        padding: 5
    },
    style: {
        overflow: 'visible'
    },
    width: 200,
    closeAction : 'destroy',

    items: [{
        text: '<b>CCCCCCCCCC</b>'
//        iconCls: 'parqueo-eventual',
//        id: 'parqueo-eventual-id'
    },{
        text: '<b>DDDDDDDDDDD</b>'
//        iconCls: 'circulacion-eventual',
//        id: 'circulacion-eventual-id'
    }]
});