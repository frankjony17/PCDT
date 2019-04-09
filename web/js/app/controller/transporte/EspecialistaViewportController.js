
Ext.define('CDT.controller.transporte.EspecialistaViewportController', {
    extend: 'Ext.app.Controller',
    
    views: 'transporte.EspecialistaViewport',
    
    init: function()
    {   
        var me = this;
        
        me.control({
            '#transporte-logout': {
                click: me.logout
            },
            '#chofer-id': {
                click: me.choferMenuClick
            },
            '#matricula-id': {
                click: me.matriculaMenuClick
            },
            '#vehiculo-id': {
                click: me.vehiculoMenuClick
            },
//            '#chofer-vehiculo-id': {
//                click: me.choferVehiculoMenuClick
//            },
            '#area-parqueo-id': {
                click: me.areaParqueoMenuClick
            }
//            '#situacion-operativa-id': {
//                click: me.situacionOperativaMenuClick
//            },
//            '#menu-planificacion-id': {
//                click: me.planificacionMenuClick
//            },
//            '#menu-close-id': {
//                click: me.removeComponent
//            }
        });
    },
    // Desloguar usuario.
    logout: function ()
    {
        location.href = entorno+'/secured/logout';
    },
    // Menu Nomenclador, button chofer.
    choferMenuClick: function ()
    {
        this.addComponent(Ext.create('CDT.view.transporte.especialista.chofer.ChoferGrid'));
        this.updateStatusBar('<b>Gestionar > Choferes</b>');
    },
    // Menu Nomenclador, button chofer.
    matriculaMenuClick: function ()
    {
        this.addComponent(Ext.create('CDT.view.transporte.especialista.matricula.MatriculaGrid'));
        this.updateStatusBar('<b>Gestionar > Matrícula</b>');
    },
    // Menu Nomenclador, button chofer.
    vehiculoMenuClick: function ()
    {
        this.addComponent(Ext.create('CDT.view.transporte.especialista.vehiculo.VehiculoGrid'));
        this.updateStatusBar('<b>Gestionar > Vehículo</b>');
    },
//    // Menu Nomenclador, button chofer.
//    choferVehiculoMenuClick: function ()
//    {
//        this.addComponent(Ext.create('CDT.view.transporte.especialista.chofer_vehiculo.ChoferVehiculoGrid'));
//        this.updateStatusBar('<b>Gestionar > Chofer-Vehículo</b>');
//    },
    // Menu Nomenclador, button chofer.
    areaParqueoMenuClick: function ()
    {
        this.addComponent(Ext.create('CDT.view.transporte.especialista.area_parqueo.AreaParqueoGrid'));
        this.updateStatusBar('<b>Gestionar > Área de parqueo</b>');
    },
//    // Menu Nomenclador, button chofer.
//    situacionOperativaMenuClick: function ()
//    {
//        this.addComponent(Ext.create('CDT.view.transporte.especialista.situacion_operativa.SituacionOperativaGrid'));
//        this.updateStatusBar('<b>Gestionar > Situación operativa</b>');
//    },
//    // Menu Nomenclador, button chofer.
//    planificacionMenuClick: function ()
//    {
//        this.addComponent(Ext.create('CDT.view.transporte.especialista.planificacion.PlanificacionGrid'));
//        this.updateStatusBar('<b>Gestionar > Planificación</b>');
//    },
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
    }
});


