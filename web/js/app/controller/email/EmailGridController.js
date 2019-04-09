
Ext.define('CDT.controller.email.EmailGridController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.email.EmailGrid',
        'admin.email.EmailUsuarioForm'
    ],
    init: function ()
    {
        var me = this;

        me.control({
            'emailGrid': {
                resize: function (grid){grid.setHeight(Ext.ex.height('south-panel-id', 70));},
                afterrender: me.afterRenderGrid,
                itemcontextmenu: me.contextMenu,
                groupcontextmenu: me.groupcontextmenu
            },
            'emailGrid button[iconCls=add-modulo]': {
                click: me.showModulo
            },
            'emailGrid button[iconCls=add-user]': {
                click: me.showUsuario
            },
            'emailGrid button[iconCls=remove-user]': {
                click: me.confirmBtnRemuve
            },
            // Email Módulo Form
            'emailModuloForm': {
                afterrender: me.afterRenderModulo
            },
            'emailModuloForm  button[iconCls=ok]': {
                click: me.validateModuloForm
            },
            // Email Usuario Form
            'emailUsuarioForm': {
                afterrender: me.afterRenderUsuario
            },
            'emailUsuarioForm button[iconCls=load-user]': {
                click: me.loadUser
            }
        });
    },
    afterRenderGrid: function (grid, eOpts)
    {
        var me = this;
        me.grid = grid;
        me.store = grid.store;
    },
    loadStore: function ()
    {
        var me = this;
        me.store.load();
    },
    // Mostrar Windows modulo
    showModulo: function ()
    {
        Ext.create("CDT.view.admin.email.EmailModuloForm");
    },
    // Mostrar Windows usuario
    showUsuario: function ()
    {
        Ext.create("CDT.view.admin.email.EmailUsuarioForm");
    },
    afterRenderModulo: function (win, eOpts)
    {
        var me = this;
        me.winEmailModulo = win;
        me.gridEmailModulo = win.down("grid");
        me.storeEmailModulo = win.store;
    },
    // Validar Módulo Form
    validateModuloForm : function (btn)
    {
        var me = this, form = me.winEmailModulo.down('form');

        if (form.getForm().isValid()) {
            me.emailUsers(form.getForm().getValues(), form.getForm());
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    afterRenderUsuario: function (win, eOpts)
    {
        var me = this;
        me.gridEmailUsuario = win.down("grid");
        me.storeEmailUsuario = win.store;
    },
    // Usuarios a los que se le enviaran correos.
    emailUsers: function (record, form)
    {
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/util/email/add',
            params: {
                Modulo      : record['modulo'],
                Address     : record['email'],
                Descripcion : record['descripcion']
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        me.store.load();
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        me.winEmailModulo.close();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el email : <b>'+record['email']+'</b>', 'question');
                        form.reset();
                        break;
                    case 'UnicoModulo':
                        Ext.ex.MessageBox('Atención', 'Ya existe el Módulo: <b>'+record['modulo']+'</b>', 'question');
                        form.reset();
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
    // Menu contextual
    contextMenu: function (view, record, item, index, e, eOpts)
    {
        var me = this, menu = Ext.create('CDT.view.admin.email.EmailMenu',{
            listeners: {
                click: function (menu, item)
                {
                    switch (item.iconCls)
                    {
                        case 'remove-user':
                            me.confirmMenuRemuve([[record.get('user_id'), record.get('address_id')]]);
                            break;
                    }
                }
            }
        });
        menu.showAt(e.xy);
        e.stopEvent();
    },
    // Menu contextual
    groupcontextmenu: function (view, node, group, e, eOpts)
    {
        var data = group.split("<=>"), email = data[1].split(" Email: "), me = this,

        menu = Ext.create('CDT.view.admin.email.EmailGroupingMenu',{
            listeners: {
                click: function (menu, item)
                {
                    switch (item.iconCls)
                    {
                        case 'add-user':
                            me.addUser(email[1].replace(" ",""));
                            break;
//                        case 'remove-modulo':
//                            me.confirmMenuGroupRemuve(group/*[record.get('modulo_id')]*/);
//                            break;
                    }
                }
            }
        });
        menu.showAt(e.xy);
        e.stopEvent();
    },
    // Confirmar antes de eliminar.
    confirmMenuRemuve: function(ids)
    {
        var me = this;

        Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los usuarios seleccionados?', function(btn) {
            if (btn === "yes") { me.removeUser(ids); }
        }, me);
    },
    // Confirmar antes de eliminar.
//    confirmMenuGroupRemuve: function(ids)
//    {
//        var me = this;
//
//        Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los usuarios seleccionados?', function(btn) {
//            if (btn === "yes") { console.log(ids);/*me.removeUser(ids);*/ }
//        }, me);
//    },
    // Confirmar antes de eliminar.
    confirmBtnRemuve: function(btn)
    {
        var me = this;

        if (me.grid.selModel.getCount() === 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el usuario seleccionado?', me.idsToRemove, me);
        } else if (me.grid.selModel.getCount() > 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los usuarios seleccionados?', me.idsToRemove, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione los usuarios que desee eliminar.', 'question');
        }
    },
    // Agregar usuarios
    addUser: function (val)
    {
        Ext.create("CDT.view.admin.email.EmailUsuarioForm", {
            address: val
        });
    },
    // IDS de los registros a eliminar
    idsToRemove: function (btn)
    {
        if (btn === 'yes')
        {
            var me = this, ids = [];

            Ext.Array.each(me.grid.selModel.getSelection(), function (row)
            {
                ids.push([row.get('user_id'), row.get('address_id')]);
            });
            me.removeUser(ids);
        }
    },
    // Remove usuarios
    removeUser: function (ids)
    {
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/util/email/remove',
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
    },
    loadUser: function (btn)
    {
        var me = this, data = [], win = btn.up("window");

        Ext.Array.each(me.gridEmailUsuario.selModel.getSelection(), function (row)
        {
            data.push(row.get('id'));
        });
        if (data.length > 0)
        {
            Ext.Ajax.request({
                url: entorno+'/util/email/add_user',
                params: {
                    Users  : Ext.encode(data),
                    Address: win.address
                },
                success: function (response) {
                    switch (response.responseText) {
                        case '':
                        case '0':
                            Ext.ex.msg('Acción OK', 'Operación realizada exitosamente.');
                            me.loadStore();
                            break;
                        default:
                            if(parseInt(response.responseText) > 0)
                            {
                                me.loadStore();
                                Ext.ex.MessageBox('Atención', '<b>No se cargaron '+ response.responseText +' usuarios.</b><br>!No se conoce el email de estos usuarios¡', 'question');
                            } else {
                                Ext.ex.MessageBox('Error', response.responseText, 'error');
                            }
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
    }
});


