
Ext.define('CDT.controller.nomenclador.TrabajadorExternoController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.trabajador.externo.TrabajadorExternoGrid',
        'admin.trabajador.externo.TrabajadorAreaForm'
    ],
    init: function()
    {  
        var me = this;
         
        me.control({
            'trabajadorExternoGrid': {
                resize: me.resize,
                afterrender: me.afterrender,
                itemcontextmenu: me.contextMenu
            },
            'trabajadorExternoGrid button[iconCls=trash]': {
                click: me.clearFilter
            },
            'trabajadorExternoGrid button[iconCls=add-area-trabajador]': {
                click: me.chequedSelection
            },
            'trabajadorAreaForm button[iconCls=ok]': {
                click: me.addAreaTrabajador
            },
            '#ID-column-numero-plaza-textfield-externo': {
                keyup: me.keyupFilter,
                focus: me.keyupFilter
            },
            '#ID-column-nombre-apellidos-textfield-externo': {
                keyup: me.keyupFilter,
                focus: me.keyupFilter
            },
            '#ID-column-departamento-textfield-externo': {
                keyup: me.keyupFilter,
                focus: me.keyupFilter
            },
            '#ID-pagingtoolbar-combobox-pagina-externo': {
                select: me.loadPage
            },
            '#ID-toolbar-combobox-departamento-externo': {
                select: me.loadStoreByDepartamento
            }
        });
    },
    // Cuando el Grid es renderiado
    afterrender: function (grid, eOpts)
    {
        var me = this;
        
        me.grid = grid;
        me.store = grid.store;
        me.uoStore = Ext.create('CDT.store.admin.UnidadOrganizativaStore');
        me.areaStore = Ext.create('CDT.store.admin.AreaStore');
        //-
        me.loadStore();
    },
    // Cargar Store local.
    loadStore: function ()
    {
        var me = this;
        me.store.load({ params:{ departamento: 'externo', start: me.startNumber(), limit: me.store.pageSize }});
    },
    // Load page from grid.
    loadPage: function (cmb)
    {
        var me = this;
        me.store.pageSize = cmb.getValue();
        me.store.loadPage(me.store.currentPage);
    },
    // Filtrar store por diferentes columnas del grid.
    keyupFilter: function (field, e)
    {
        var me = this;
        
        me.store.clearFilter();
        
        if (field.value)
        {
            me.store.filter({
                property: field.property,
                value: field.value,
                anyMatch: true,
                caseSensitive: false
            });
        };
    },
    // Load store by department name.
    loadStoreByDepartamento: function (cmb)
    {
        var me = this;
        
        me.store.load({ params:{ departamento: cmb.getValue(), start: me.startNumber(), limit: me.store.pageSize }});
        me.grid.down('pagingtoolbar').setDisabled(true);
        me.grid.down('button[iconCls=trash]').setDisabled(false);
    },
    // clear filter from combobox departamento and load store.
    clearFilter: function (btn)
    {
        var  me = this, combo = me.grid.down('[id=ID-toolbar-combobox-departamento-externo]');
        
        combo.reset();
        me.loadStore();
        me.grid.down('pagingtoolbar').setDisabled(false);
        btn.setDisabled(true);
    },
    // Verificar que existe almenos un trabajador seleccionado. 
    chequedSelection: function()
    {   
        var me = this;

        if (me.grid.selModel.getCount() >= 1)
        {
            me.showAsignarArea();
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione a los usuarios que desee asignarle un área.', 'question');
        }
    },
    // Mostrar windows asignar área.
    showAsignarArea: function (selection)
    {
        var me = this;
        Ext.create('CDT.view.admin.trabajador.externo.TrabajadorAreaForm',{
            combo: me.grid.down('[id=ID-toolbar-combobox-departamento-externo]')
        });
    },
    // Ubicar al trabajador en un área.
    addAreaTrabajador: function (btn)
    {
        var win = btn.up('window'), form = win.down('form'), me = this;
        
        if (form.getForm().isValid()) 
        {
            me.ajaxAreaTrabajador(form.down('[emptyText=Seleccione un área.]').getValue(), me.getSelection(), win.combo, win);
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    ajaxAreaTrabajador: function (id, ids, combo, win)
    {
        var me = this;
        
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/trabajador/add_area_trabajador',
            params: {
                Id : id,
                Ids: Ext.encode(ids)
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        (combo.getValue()) ? me.loadStoreByDepartamento(combo) : me.loadStore();
                        Ext.isObject(win) ? win.close() : null;
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
    // Obtener número de página.
    startNumber: function ()
    {
        var me = this,
            pagingtoolbar = me.grid.down('pagingtoolbar'),
            start = parseInt(me.store.pageSize * (pagingtoolbar.down('[itemId=inputItem]').getValue() - 1));
        
        return (start > 0) ? start : 0;
    },
    // Menu contextual Grid Trabajador Externo
    contextMenu: function (view, record, item, index, e, eOpts)
    {
        var me = this,
            combo = me.grid.down('[id=ID-toolbar-combobox-departamento-externo]'),
            menu = Ext.create('Ext.menu.Menu',{
                titleAlign: 'center',
                closeAction: 'destroy',
                floating: true,
                shadow: true,
                width: 380
            });
            
        me.areaStore.each(function(area)
        {
            menu.add({
                text: area.get('nombre'),
                iconCls: 'a' + (Math.floor(Math.random() * 10) + 1),
                listeners: { click: function(){ me.ajaxAreaTrabajador(area.get('id'), me.getSelection(), combo, null); }}
            });
        });
        if (me.areaStore.count() > 0)
        {
            menu.setTitle('Asignar / Mover al Área:');
            menu.showAt(e.xy);
        }
        e.stopEvent();
    },
    // Mantiene el grid en una altura de acuerdo al navegador.
    resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 80)); },
    // Obtener registros seleccionados del grid.
    getSelection: function ()
    {
        var ids = [], me = this;
        Ext.Array.each(me.grid.selModel.getSelection(), function (row)
        {    
            ids.push(row.get('id'));
        });
        return ids;
    }
});


