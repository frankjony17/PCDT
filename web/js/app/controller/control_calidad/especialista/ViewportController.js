
Ext.define('CDT.controller.control_calidad.especialista.ViewportController', {
    extend: 'Ext.app.Controller',
    
    control: {
        '#control-calidad-logout': {
            click: "logout"
        },
        '#tipo-control-button-id': {
            click: "tipoControlClick"
        },
        '#control-button-id': {
            click: "controlClick"
        },
        '#control-calidad-button-id': {
            click: "controlCalidadClick"
        },
    },
    tipoControlClick: function () {
        this.addComponent(Ext.create('CDT.view.control_calidad.especialista.ControlTipoGrid'));
        this.updateStatusBar('<b>Gestionar > Tipo de Control</b>');
    },
    controlClick: function () {
        this.addComponent(Ext.create('CDT.view.control_calidad.especialista.ControlGrid'));
        this.updateStatusBar('<b>Gestionar > Control</b>');
    },
    controlCalidadClick: function () {
        this.addComponent(Ext.create('CDT.view.control_calidad.especialista.ControlCalidadGrid'));
        this.updateStatusBar('<b>Gestionar > Brechas, No Conformidades y Otros</b>');
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
    }
});


