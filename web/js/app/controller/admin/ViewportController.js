
Ext.define('CDT.controller.admin.ViewportController', {
    extend: 'Ext.app.Controller',
    
    views: 'admin.Viewport',
    
    init: function()
    {   
        var me = this;
        
        me.control({
            '#admin-logout': {
                click: me.logout
            }
        });
    },
    // Desloguar usuario.
    logout: function ()
    {
        location.href = entorno+'/secured/logout';
    }
});


