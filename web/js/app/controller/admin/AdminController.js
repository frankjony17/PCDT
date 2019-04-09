
Ext.define('CDT.controller.admin.AdminController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.roles.RolesGrid',
        'admin.roles.RolesForm',
        'admin.users.UsersGrid',
        'admin.users.UsersDataBaseLDAPForm',
        'admin.users.UsersEditForm'
    ],

    init: function()
    {  
        var me = this;
        
        me.control({
            'rolesGrid': {
                resize: me.resize
            },
            'usersGrid': {
                resize: me.resize,
                render: me.showLegend,
                itemcontextmenu: me.contextMenu,
                destroy: me.closeToolTipLegend,
                beforedeactivate: me.closeToolTipLegend
            },
            'usersGrid button[iconCls=add-user]': {
                click: me.showUsersDataBaseLDAPForm
            },
            'usersGrid button[iconCls=remove-user]': {
                click: me.confirmRemuveUsers
            },
            'usersGrid button[iconCls=legend-user]': {
                click: me.showLegend
            },
            'usersEditForm button[iconCls=ok]': {
                click: me.editUsers
            },
            //------------------------------------------------------------------
            'rolesForm button[iconCls=ok]': {
                click: me.addRoles
            },
            //------------------------------------------------------------------
            'usersDataBaseLDAPForm': {
                afterrender: me.afterrender
            },
            'usersDataBaseLDAPForm button[iconCls=load-user-db]': {
                click: me.loadStore
            },
            'usersDataBaseLDAPForm button[iconCls=load-user]': {
                click: me.loadUsers
            },
            'usersDataBaseLDAPForm [xtype=combobox]': {
                select: me.loadStore
            }
        });
    },
    // Cuando el Grid es renderiado
    afterrender: function (window, eOpts)
    {
        var me = this;
        
        me.grid = window.down('grid');
        me.store = window.store;
        me.window = window;
    },
    // Cargar usuarios from DB or LDAP... 
    loadStore: function(objeto)
    {   
        var me = this;
        
        if (objeto.xtype === 'combobox')
        {
            me.store.proxy.url = entorno+'/admin/users/list_user_db';
            me.store.load({ params:{ Option: 'DB', Area: objeto.value, start: me.startNumber(), limit: me.store.pageSize }});
            me.grid.down('pagingtoolbar').setDisabled(true);
        }
        else
        {
            if (objeto.iconCls === 'load-user-db')
            {
               me.store.proxy.url = entorno+'/admin/users/list_user_db';
               me.store.load({ params:{ Option: 'DB', start: me.startNumber(), limit: me.store.pageSize }});
            }
            else if (objeto.iconCls === 'load-user-ldap')
            {
                me.store.proxy.url = entorno+'/admin/users/list_user_ldap';
                me.store.load({ params:{ start: me.startNumber(), limit: me.store.pageSize }});
            }
            me.window.down('combobox').setValue();
            me.grid.down('pagingtoolbar').setDisabled(false);
            me.window.down('button[iconCls=load-user]').enable();
        }
    },   
    // Load page from grid.
    loadPage: function (cmb)
    {
        var me = this;
        me.store.pageSize = cmb.getValue();
        me.store.loadPage(me.store.currentPage);
    },
    // Obtener número de página.
    startNumber: function ()
    {
        var me = this,
            pagingtoolbar = me.grid.down('pagingtoolbar'),
            start = parseInt(me.store.pageSize * (pagingtoolbar.down('[itemId=inputItem]').getValue() - 1));
        
        return (start > 0) ? start : 0;
    },    
    // Mantiene el grid en una altura de acuerdo al navegador...
    resize: function (grid) 
    { 
        grid.setHeight(Ext.ex.height('south-panel-id', 70));
    },
    // Mostrar Windows cargo... 
    showUsersDataBaseLDAPForm: function(btn)
    {   
        var grid = btn.up('grid');
        
        Ext.create('CDT.view.admin.users.UsersDataBaseLDAPForm',{
            storeUsers: grid.store
        });
    },
    // Crear nuevos usuarios a partir de selección...
    loadUsers: function (btn)
    {
        var data = [], grid = btn.up('grid'), win = btn.up('window'), me = this;
        
        Ext.Array.each(grid.selModel.getSelection(), function (row)
        {    
            data.push([row.get('id'), row.get('cn'), row.get('uid'), row.get('mail')]);
        });
        
        if (data.length > 0 && data[0][0] !== 'FALSE')
        {
            Ext.Ajax.request({
                url: entorno+'/admin/users/load_new_users',
                params: {
                    Users: Ext.encode(data)
                },
                success: function (response) {
                    switch (response.responseText) {
                        case '':
                            Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                            me.store.load({ params:{ Option: 'DB', start: me.startNumber(), limit: me.store.pageSize }});
                            win.storeUsers.load();
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
        } else {
            Ext.ex.MessageBox('Atención', '<b>Por favor:</b> selecione los usuarios que decee cargar.', 'question');
        }
    },
    // Confirmar antes de eliminar datos... 
    confirmRemuveUsers: function(btn)
    {   
        var me = this; me.grid = btn.up('grid');

        if (me.grid.selModel.getCount() === 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el usuario seleccionado?', me.removeUsers, me);
        } else if (me.grid.selModel.getCount() > 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los usuarios seleccionados?', me.removeUsers, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione los usuarios que desee eliminar.', 'question');
        }
    },
    // Eliminar Usuarios... 
    removeUsers: function (btn)
    {   
        if (btn === 'yes')
        {
            var me = this, ids = [];
            
            Ext.Array.each(me.grid.selModel.getSelection(), function (row)
            {    
                ids.push(row.get('id'));
            });
            
            Ext.Ajax.request({
                url: entorno+'/admin/users/remove_users',
                params: {
                    ids:  Ext.encode(ids)
                },
                success: function(response){
                    switch (response.responseText) {
                        case '':
                            me.grid.store.load();
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
        }
    },
    // Leyenda de usuario (colores)
    showLegend: function (btn)
    {
        var me = this,
            legend_tip = Ext.create('Ext.tip.ToolTip', {
            autoHide: false,
            shadow: true,
            closable: true,
            closeAction: 'destroy',
            width: 160,
            height: 80,
            id: 'tool-tip-legend-user-id',
            title: '<div style="background:#c2edf9;"><center>LEYENDA</center></div>',
            html: '<table>'+
                    '<tr><th width=20 style="background:#ffff99;border: 1px solid #CCC !important;"></th><th style="text-align:left;">Usuario sin roles.</th></tr>'+
                    '<tr><th width=20 style="background:#ff9999;border: 1px solid #CCC !important;"></th><th style="text-align:left;">Usuario inactivo.</th></tr>'+
                  '</table>',
            listeners: {
                 hide: function (tip) {
                    tip.showAt(me.getXYPosition()); 
                 },
                 close: function () {
                     var obj = Ext.getCmp('legend-user-id-0000');
                     
                     if (Ext.isObject(obj))
                     {
                        obj.setDisabled(false);
                     }
                 }
            }
        });
        legend_tip.showAt(me.getXYPosition());
        Ext.getCmp('legend-user-id-0000').setDisabled(true);
    },
    // Obtener posicion del tip legend
    getXYPosition: function ()
    {
        var south_panel = Ext.getCmp('fecha-item-toolbar-status-bar-0000'), xy = [];
        
        xy.push([south_panel.getX() - 100, south_panel.getY() - 100]);
        
        return xy;
    },
    // Menu contextual
    contextMenu: function (view, record, item, index, e, eOpts)
    {
        var me = this, grid = view.up('grid'),
                
        menu = Ext.create('CDT.view.admin.users.UsersMenu',{
            option: record.get('is_active'), 
            listeners: {
                click: function (menu, item)
                {
                    switch (item.iconCls)
                    {
                        case 'menu-active-item':
                        case 'menu-dasactivar-item':    
                            me.activeUsers(record, grid.store);
                            break;
                        case 'menu-password-item':
                            break;
                        case 'menu-edit-item':
                            me.showFormEditUsers(record, grid.store);
                            break;
                        case 'menu-roles-item':
                            me.showRoles(record, grid.store);
                            break;
                    }
                }
            }
        });
        menu.showAt(e.xy);
        e.stopEvent();
    },
    // Activar o desactivar Usuarios.
    activeUsers: function (record, store)
    {
        Ext.Ajax.request({
            url: entorno+'/admin/users/active_users',
            params: {
                Id: record.get('id')
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        Ext.ex.msg('Acción OK', 'Operación realizada exitosamente.');
                        store.load();
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
    // Show Form edit Users.
    showFormEditUsers: function (record, store)
    {
        var win = Ext.create('CDT.view.admin.users.UsersEditForm'),
            form = win.down('form');
            
        form.down('[fieldLabel=Alias]').setValue(record.get('username'));
        form.down('[fieldLabel=Correo electrónico]').setValue(record.get('email'));
        
        win.usersId = record.get('id');
        win.store = store;
        win.show();
    },
    // Editar usuario
    editUsers: function (btn)
    {
        var win = btn.up('window'), form = win.down('form'),
        alias = form.down('[fieldLabel=Alias]').getValue(),
        correo = form.down('[fieldLabel=Correo electrónico]').getValue();
        
        Ext.Ajax.request({
            url: entorno+'/admin/users/edit_users',
            params: {
                Id    : win.usersId,
                Alias : alias,
                Correo: correo
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        win.store.load();
                        win.close();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe un usuario con los siguientes datos:<br><b>Alias: '+alias+'<br>Correo: '+correo+'.</b>', 'question');
                        form.getForm().reset();
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
    // Mostrar win Roles
    showRoles: function (record, store)
    {
        Ext.create('CDT.view.admin.roles.RolesForm',{
            usersId: record.get('id'),
            usersStore: store
        });
    },
    // Click a los row del grid RolesForm.
    addRoles: function (btn)
    {
        var win = btn.up('window'), dataRows = [];
        
        win.rolesStore.each(function(rec)
        {
            dataRows.push({'id': rec.get('id'), 'estado': rec.get('estado')});
        });
        
        Ext.Ajax.request({
            url: entorno+'/admin/users/add_roles_users',
            params: {
                Id: win.usersId,
                Roles: Ext.encode(dataRows)
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        win.usersStore.load();
                        win.close();
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
    // Close ToolTip Legend cuando se cierre la pesteña que contiene el grid user.
    closeToolTipLegend: function ()
    {
        var tip = Ext.getCmp('tool-tip-legend-user-id');
        
        if (Ext.isObject(tip))
        {
            tip.close();
        }
    }
});


