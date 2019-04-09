
Ext.define('CDT.view.AplicacionesMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'appMenu',
    
    frame       : true,
    title       : 'Cambiar a:',
    titleAlign  : 'center',
    
    defaults: {
        padding: 5
    },
    style: {
        overflow: 'visible'
    },
    width: 265,
    closeAction : 'destroy',

    initComponent: function ()
    {
        var me = this, menu = [];
        
        Ext.Array.each(aplicaciones, function(item)
        {
            if (item.id !== me.appId)
            {
                menu.push(item); 
            }
        });
        me.items = menu;
        
        me.listeners = {
            click: function (menu, item)
            {
                switch (item.id) {
                    case 'admin-app-id':
                        location.href = entorno+'/admin';
                        break;
                    // Transporte
                    case 'transporte-app-especialista-id':
                        location.href = entorno+'/transporte/especialista';
                        break;   
                    case 'transporte-app-planificador-id':
                        location.href = entorno+'/transporte/planificador';
                        break;
                    case 'transporte-app-tecnico-id':
                        location.href = entorno+'/transporte/operativo';
                        break;
                    // Tareas Operativas
                    case 'tareas-operativas-app-especialist-id':
                        location.href = entorno+'/tareasoperativas/especialista';
                        break;   
                    case 'tareas-operativas-app-supervisor-id':
                        location.href = entorno+'/tareasoperativas/supervisor';
                        break;
                    case 'tareas-operativas-app-tecnico-id':
                        location.href = entorno+'/tareasoperativas/operativo';
                        break;
                    case 'tareas-operativas-app-supervisor-id':
                        location.href = entorno+'/tareasoperativas/supervisor';
                        break;
                    case 'tareas-operativas-app-responsable-id':
                        location.href = entorno+'/tareasoperativas/responsable';
                        break;
                }
            }
        };
        me.callParent(arguments);
    }
});