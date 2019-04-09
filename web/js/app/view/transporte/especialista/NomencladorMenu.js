
Ext.define('CDT.view.transporte.especialista.NomencladorMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'nomencladorMenu',
    
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
    width: 200,
    closeAction : 'destroy',
    
    items: [{
        text: '<b>Chofer</b>',
        iconCls: 'chofer',
        id: 'chofer-id'
    },{
        text: '<b>Matrícula</b>',
        iconCls: 'matricula',
        id: 'matricula-id'
    },{
        text: '<b>Vehículo</b>',
        iconCls: 'vehiculo',
        id: 'vehiculo-id'
    },{
        text: '<b>Chofer-Vehículo</b>',
        iconCls: 'chofer-vehiculo',
        id: 'chofer-vehiculo-id'
    },{
        text: '<b>Área de parqueo</b>',
        iconCls: 'area-parqueo',
        id: 'area-parqueo-id'
    },{
        text: '<b>Situación operativa</b>',
        iconCls: 'situacion-operativa',
        id: 'situacion-operativa-id'
    }]
});