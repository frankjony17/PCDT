
Ext.define('CDT.controller.admin.OtrosTreeController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.OtrosTreePanel'
    ],
    init: function ()
    {   
        var me = this;
        
        me.control({
            'otrosTreePanel': {
                itemclick: me.addTabpanel
            }
        });
    },
    // Identificar nodo seleccionado
    nodoClick: function (iconCls)
    {   
        var item = null;
        
        switch (iconCls) {
            case 'message':
                item = Ext.create('CDT.view.admin.email.EmailGrid');
                break;
        }
        return item;
    },    
    //Gestionar Tabs...
    addTabpanel: function (view, record)
    {   
        var me = this, centerpanel = me.getCmp('center-panel-id');
        //Si el tab ya existe lo activo...
        if (Ext.ex.findId(record.data.id + '-tab') === true)
        {
            centerpanel.setActiveTab(record.data.id + '-tab');
            me.closeToolTipLegendFromUser(record.data.id);
        }
        else
        {   //--Elimino el tab por defecto...
            centerpanel.remove('tab-inicial-id');
            //--
            if (Ext.ex.items('length') < 3)
            {
                me.addTab(record.data.text, record.data.iconCls, record.data.id);
                me.closeToolTipLegendFromUser(record.data.id);
            }
            else//--Como no hay espacio elimino el primer tab y agrego uno nuevo...
            {
                centerpanel.remove(Ext.ex.items('0'));
                Ext.ex.removeId(Ext.ex.items('0'));
                me.addTab(record.data.text, record.data.iconCls, record.data.id);
            }
        }
    },
    // Añadir tabpanel...
    addTab: function (text, iconCls, id)
    {   
        var me = this, westpanel = me.getCmp('west-panel-id'),
            centerpanel = me.getCmp('center-panel-id'),
            title = 'Gestionar [' + text + ']';
        
        if(text === '<b>Roles</b>')
        {
            title = 'Listar [' + text + ']';
        }
        var tab = centerpanel.add(
        {
            title: title,
            iconCls: iconCls,
            items: me.nodoClick(iconCls),
            id: id + '-tab',
            closable: true,
            listeners: {
                close: function (obj)
                {
                    Ext.ex.removeId(obj.id);
                    //Esconder el area este.
                    if (westpanel.getCollapsed())
                    {
                        westpanel.expand();
                    }
                    me.defaultTab();
                },
                activate: function (obj)
                {
                    me.updateStatusBar(obj.title);
                    me.closeToolTipLegendFromUser(obj.id);
                }
            }
        });
        centerpanel.setActiveTab(tab);
        Ext.ex.items('push', tab.id);
        //----------------------------------------------------------------------
        me.updateStatusBar(text);
    },
    //Obtener componente dado un identificador
    getCmp: function (id)
    {
        return Ext.getCmp(id);
    },
    // Update detalle de barra de estado.
    updateStatusBar: function (texto)
    {
        var status_bar = Ext.getCmp('status-bar-detalles');
        
        switch (texto) {
            case 'Listar [<b>Roles</b>]':
            case '<b>Roles</b>':
                status_bar.update('<b><span style="color:#000;"><b>Listar > Roles</b></span></b>');
                break;
            case '---':
                status_bar.update('<b><span style="color:#000;"><b>Propósito > Léeme?</b></span></b>');
                break;
            default:
                var arreglo = texto.split('>'); arreglo = arreglo[1].split('<');
                status_bar.update('<b><span style="color:#000;"><b>Gestionar > '+ arreglo[0] +'</b></span></b>');
                break;
        }   
    },
    // Si no hay ningun tab se crea el tab por defecto...
    defaultTab: function ()
    {
        var me = this, centerpanel = me.getCmp('center-panel-id');
        
        if (Ext.ex.items('length') === 0)
        {
            var tab = centerpanel.add(
            {
                title: 'Propósito',
                height: 3000,
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                html: '<p>&nbsp;&nbsp;&nbsp;&nbsp;¿Qué es esto. Poner algo aquí tío…?</p>',
                id: 'tab-inicial-id'
            });
            centerpanel.setActiveTab(tab);
            //-
            me.updateStatusBar('---');
        }
    },
    // Close ToolTip Leyenda cuando se cierre la pesteña que contiene el grid user.
    closeToolTipLegendFromUser: function (id)
    {
        if (id !== 'tree-usuarios-id')
        {
            var tip = Ext.getCmp('tool-tip-legend-user-id');

            if (Ext.isObject(tip))
            {
                tip.close();
            }
        }
    }    
});