
Ext.define('CDT.controller.nomenclador.TrabajadorInternoController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.trabajador.interno.TrabajadorInternoGrid',
        'admin.trabajador.interno.TrabajadorCargoForm'
    ],
    stores: [
        'admin.TrabajadorStore'
    ],
    init: function()
    {  
        var me = this;
         
        me.control({
            'trabajadorInternoGrid': {
                edit: me.edit,
                resize: me.resize,
                afterrender: me.afterRender,
                itemcontextmenu: me.contextMenu
            },
            'trabajadorInternoGrid button[iconCls=add-cargo-trabajador]': {
                click: me.chequedSelection
            },
            'trabajadorInternoGrid button[iconCls=remove]': {
                click: me.confirmRemuve
            },
            'trabajadorCargoForm button[iconCls=ok]': {
                click: me.addCargoTrabajador
            },
            '#ID-column-numero-plaza-textfield': {
                keyup: me.keyupFilter,
                focus: me.keyupFilter
            },
            '#ID-column-nombre-apellidos-textfield': {
                keyup: me.keyupFilter,
                focus: me.keyupFilter
            },
            '#ID-pagingtoolbar-combobox-pagina': {
                select: me.loadPage
            }
        });
    },
    // Cuando el Grid es renderiado
    afterRender: function (grid, eOpts)
    {
        var me = this;
        
        me.grid = grid;
        me.store = grid.store;
        me.cargoStore = Ext.create('CDT.store.admin.CargoStore');
        //-
        me.store.proxy.url = entorno+'/all/nomenclador/trabajador/interno';
        me.loadStore();
    },
    // Cargar Store local.
    loadStore: function ()
    {
        var me = this;
        me.store.load({ params:{ start: me.startNumber(), limit: me.store.pageSize }});
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
    // Verificar que existe almenos un trabajador seleccionado. 
    chequedSelection: function()
    {   
        var me = this;
        
        if (me.grid.selModel.getCount() >= 1)
        {
            Ext.create('CDT.view.admin.trabajador.interno.TrabajadorCargoForm');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione a los usuarios que desee asignarle un cargo.', 'question');
        }
    },
    // Editar numero de móvil.
    edit: function (editor, context, eOpts)
    {   
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/trabajador/edit',
            params: {
                Id   : context.record.get('id'),
                Movil: context.record.get('movil')
            },
            success: function(response)
            {
                switch(response.responseText)
                {
                    case '':
                        context.grid.store.load();
                        break;
                    default:
                        Ext.ex.MessageBox('Error', response.responseText, 'error');
                        break;
                }
            },
            failure: function(){
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
    // Menu contextual Grid Trabajador Interno
    contextMenu: function (view, record, item, index, e, eOpts)
    {
        var me = this,
            menu = Ext.create('Ext.menu.Menu',{
                title: 'Asignar Cargo:',
                titleAlign: 'center',
                closeAction: 'destroy'
            });
        me.cargoStore.each(function(cargo)
        {
            menu.add({
                text: cargo.get('nombre'),
                iconCls: 'a' + (Math.floor(Math.random() * 10) + 1),
                listeners: { click: function(){ me.ajaxCargoTrabajador(cargo.get('id'), me.getSelection(), null); }}
            });
        });
        menu.showAt(e.xy);
        e.stopEvent();        
    },
    // Ubicar al trabajador en un área.
    addCargoTrabajador: function (btn)
    {
        var win = btn.up('window'), form = win.down('form'), me = this;
        
        if (form.getForm().isValid()) 
        {
            me.ajaxCargoTrabajador(form.down('[xtype=combobox]').getValue(), me.getSelection(), win);
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    // Añadir cargo al trabajador
    ajaxCargoTrabajador: function (id, ids, win)
    {
        var me = this;
        
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/trabajador/add_cargo_trabajador',
            params: {
                Id : id,
                Ids: Ext.encode(ids)
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        me.loadStore();
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
    // Confirmar antes de eliminar trabajador.
    confirmRemuve: function(btn)
    {   
        var me = this;

        if (me.grid.selModel.getCount() === 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.removeTrabajador, me);
        } else if (me.grid.selModel.getCount() > 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los registros seleccionados?', me.removeTrabajador, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el o los registro que desea eliminar.', 'question');
        }
    },
    // No se elimina sino que se le quita el área a la que pertenece.
    removeTrabajador: function (btn)
    {
        if (btn === 'yes')
        {
            var me = this, ids = [];
            
            Ext.Array.each(me.grid.selModel.getSelection(), function (row)
            {    
                ids.push(row.get('id'));
            });
            Ext.Ajax.request({
                url: entorno+'/all/nomenclador/trabajador/remove_area_trabajador',
                params: {
                    Ids: Ext.encode(ids)
                },
                success: function (response) {
                    switch (response.responseText) {
                        case '':
                            Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                            me.loadStore();
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
        }
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


