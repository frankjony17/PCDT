
Ext.define('CDT.controller.nomenclador.NomencladorTreeController', {
    extend: 'Ext.app.Controller',

    views: 'admin.NomencladorTreePanel',
    
    init: function ()
    {   
        var me = this;
       
        me.control({
            'nomencladorTreePanel': {
                itemclick: me.isTabs,
                cellcontextmenu: me.isTabMenu
            },
            '#menu-combobox-update-trabajadores': {
                select: me.updateTrabajador
            },
            '#update-all-trabajadores-id': {
                click: me.updateTrabajador
            }
        });
    },
    //Verificar si el tab es el correcto para crear un menu contextual.
    isTabMenu: function (view, td, cellIndex, record, tr, rowIndex, e, eOpts)
    {
        var me = this;
        //-
        switch (record.data.iconCls) {
            case 'tree-estructura-externa':
                me.showMenuEstructuraExterna(record, e);
                break;
            default:
                e.stopEvent();
                break;
        }
    },
    showMenuEstructuraExterna: function (record, e)
    {
        var me = this;
        
        if (!Ext.isObject(me.menu))
        {
            me.menu = Ext.create('CDT.view.admin.estructura.EstructuraExternaMenu');
        }
        me.menu.showAt(e.xy);
        e.stopEvent();        
    },
    //Verificar si el tab es el correcto.
    isTabs: function (view, record)
    {
        var me = this;
        
        if (record.data.iconCls !== 'tree-estructura-interna' && record.data.iconCls !== 'tree-estructura-externa')
        {
            me.addTabpanel(view, record);
        }
    },
    //Identificar nodo seleccionado... 
    nodoClick: function (iconCls)
    {   
        var item = null;
        
        switch (iconCls) {
            case 'tree-unidad-organizativa':
                item = Ext.create('CDT.view.admin.uo.UnidadOrganizativaGrid');
                break;
            case 'tree-area':
                item = Ext.create('CDT.view.admin.area.AreaGrid');
                break;
            case 'tree-cargo':
                item = Ext.create('CDT.view.admin.cargo.CargoGrid');
                break;
            case 'tree-trabajador-interno':
                item = Ext.create('CDT.view.admin.trabajador.interno.TrabajadorInternoGrid');
                break;
            case 'tree-departamento':
                item = Ext.create('CDT.view.admin.departamento.DepartamentoGrid');
                break;
            case 'tree-trabajador-externo':
                item = Ext.create('CDT.view.admin.trabajador.externo.TrabajadorExternoGrid');
                break;
        }
        return item;
    },
    //Gestionar Tabs...
    addTabpanel: function (view, record)
    {   
        var me = this, westpanel = me.getCmp('west-panel-id'), centerpanel = me.getCmp('center-panel-id');
        //Si el tab ya existe lo activo...
        if (Ext.ex.findId(record.data.id + '-tab') === true)
        {
            centerpanel.setActiveTab(record.data.id + '-tab');
        }
        else
        {   //--Elimino el tab por defecto...
            centerpanel.remove('tab-inicial-id');
            //Añado Tabs si hay espacio, solo se permiten 3 Tabs...
            if (Ext.ex.items('length') < 3)
            {
                me.addTab(record.data.text, record.data.iconCls, record.data.id);
            }//Como no hay espacio elimino el primer tab y agrego uno nuevo...
            else
            {
                centerpanel.remove(Ext.ex.items('0'));
                Ext.ex.removeId(Ext.ex.items('0'));
                me.addTab(record.data.text, record.data.iconCls, record.data.id);
            }
            //Esconder el area este.
            if (record.data.text === '<b>Trabajador (externo)</b>' || record.data.text === '<b>Trabajador (interno)</b>')
            {
                westpanel.collapse();
            }
        }
    },
    // Añadir tabpanel...
    addTab: function (text, iconCls, id)
    {   
        var me = this, westpanel = me.getCmp('west-panel-id'), centerpanel = me.getCmp('center-panel-id');
        
        var tab = centerpanel.add(
        {
            title: 'Gestionar [' + text + ']',
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
                }
            }
        });
        centerpanel.setActiveTab(tab);
        Ext.ex.items('push', tab.id);
        //----------------------------------------------------------------------
        me.updateStatusBar(text);
    },
    // Obtener componente dado un identificador
    getCmp: function (id)
    {
        return Ext.getCmp(id);
    },
    // Update detalle de barra de estado.
    updateStatusBar: function (texto)
    {
        var status_bar = Ext.getCmp('status-bar-detalles');
        
        switch (texto) {
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
    // Actualizar trabajadores de una Unidad Organizativa.
    updateTrabajador: function (combo, records)
    {
        var me = this,
            parm = 'All', 
            prog = me.progress();
        
        if (combo.id === "menu-combobox-update-trabajadores")
        {
            parm = records[0]['data']['acronimo'];
            combo.reset();
            me.menu.hide();
        }
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/sap/read_txt_sap_rh',
            timeout: 216000,
            params: {
                UO: parm
            },
            success: function (response) {
                switch (response.responseText) {
                    case 'Base de datos actualizada correctamente a partir del fichero SAP':
                        Ext.ex.msg('Operación OK', 'Base de datos actualizada correctamente a partir del fichero SAP.');
                        prog.close();
                        break;
                    default:
                        Ext.ex.MessageBox('Error', response.responseText, 'error');
                        break;
                }
            },
            failure: function ()
            {
                Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
            }
        });        
    },
    // Progreso
    progress: function ()
    {
        return Ext.MessageBox.show({
           msg: 'Salvando sus datos, por favor espere...',
           wait: true,
           waitConfig: {
               interval: 200
           },
           icon: 'ext-mb-download',
           iconHeight: 50
       });
    }
});