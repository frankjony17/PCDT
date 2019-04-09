
Ext.define('CDT.controller.tarea_operativa.especialista.OperacionesMenuController', {
    extend: 'Ext.app.Controller',

    views: [
        'tarea_operativa.especialista.OperacionesTareaMenu'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'operacionesMenu': {
                hide: me.closeMenu,
                afterrender: me.afterRenderMenu
            },
            '#tareas-acciones-add': {
                click: me.addAccionTarea
            },
            '#tareas-acciones-edit': {
                click: me.editAccionTarea
            },
            '#tareas-acciones-remove': {
                click: me.confirmRemuve
            },
            'operacionesMenu button[text=Salvar]': {
                click: me.editPeriodoChequeo
            },
            '#menu-periodo-chequeo-combobox-id': {
                select: me.comboBoxDiario
            },
            'operacionesMenu [boxLabel=Lunes]': {
                change: me.changeBoxLabel
            },
            'operacionesMenu [boxLabel=Martes]': {
                change: me.changeBoxLabel
            },
            'operacionesMenu [boxLabel=Miércoles]': {
                change: me.changeBoxLabel
            },
            'operacionesMenu [boxLabel=Jueves]': {
                change: me.changeBoxLabel
            },
            'operacionesMenu [boxLabel=Viernes]': {
                change: me.changeBoxLabel
            },
            '#menu-date-picker-id': {
                select: me.addFechaFinalEstado
            },
            '#estado-final-checked-id': {
                click: me.addEstadoFinal
            },
            'operacionesMenu [action=menu-responsable-items]': {
                click: me.editResponsable
            },
            '#tareas-correo-otros-id': {
                click: me.showOtrosEmailForm
            },
            '#tareas-correo-responsables-id': {
                click: me.showResponsableEmailForm
            }
        });
    },
    // Cuando la menu es renderiado.
    afterRenderMenu: function (menu)
    {
        var me = this;
        me.menu = menu;
        me.store = menu.store;
        me.tareaId = menu.record.get('id');
        me.tareaName = menu.record.get('numero');
    },
    // Adivionar Accioón.
    addAccionTarea: function (item)
    {
        var me = this;
        Ext.create('CDT.view.tarea_operativa.especialista.accion.AccionForm', {
            btnText: 'Salvar',
            btnIconCls: 'ok',
            title: 'Adicionar acción : <b>[ '+me.tareaName+' ]</b>',
            myId: me.tareaId
        });
    },
    // Adivionar Accioón.
    editAccionTarea: function (item)
    {
        var me = this,
            win = Ext.create('CDT.view.tarea_operativa.especialista.accion.AccionForm', {
                btnText: 'Editar&nbsp;',
                btnIconCls: 'edit',
                title: 'Editar ultima acción creada: <b>[ '+me.tareaName+' ]</b>',
                myId: me.menu.accion_id,
                autoShow: false
            });
        if (me.menu.accion_id !== '')
        {
            win.down("[emptyText=Descripción]").setValue(me.menu.accion);
            win.show();
        } else {
            Ext.ex.MessageBox('Atención', 'La <b>Tarea Operativa</b> seleccionada no tiene asociada ninguna <b>ACCIÓN</b>.', 'question');
        }
    },
    // Editar preriodo de chequeo.
    editPeriodoChequeo: function (btn)
    {
        var me = this;

        Ext.Ajax.request({
            url: entorno+'/tareasoperativas/chequeo/edit',
            params: {
                Id             : me.tareaId,
                PeriodoChequeo : Ext.encode(me.getPeriodoChequeo())
            },
            success: function(response){
                switch (response.responseText) {
                    case '':
                        me.closeMenu(me.menu);
                        me.store.load();
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
    // Confirmar antes de eliminar datos.
    confirmRemuve: function(item)
    {
        var me = this;

        if (me.menu.accion_id !== '')
        {
            Ext.MessageBox.confirm('Confirmación', '<b><font color="red">Desea eliminar la acción:</font></b><br>'+me.menu.accion+'<font color="red">?</font>', me.remove, me);
        } else {
            Ext.ex.MessageBox('Atención', 'La <b>Tarea Operativa</b> seleccionada no tiene asociada ninguna <b>ACCIÓN</b>.', 'question');
        }
    },
    // Eliminar datos.
    remove: function (btn)
    {
        if (btn === 'yes')
        {
            var me = this;

            Ext.Ajax.request({
                url: entorno+'/tareasoperativas/accion/remove',
                params: {
                    Id: Ext.encode([me.menu.accion_id])
                },
                success: function(response){
                    switch (response.responseText) {
                        case '':
                            me.store.load();
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
    // Cerrar menu al ocultarse.
    closeMenu: function (menu)
    {
        menu.close();
    },
    getPeriodoChequeo: function ()
    {
        var me = this, periodo = [], combo = this.menu.down('[id=menu-periodo-chequeo-combobox-id]');

        me.menu.down("[boxLabel=Lunes]").getValue()     !== false ? periodo.push(1) : null;
        me.menu.down("[boxLabel=Martes]").getValue()    !== false ? periodo.push(2) : null;
        me.menu.down("[boxLabel=Miércoles]").getValue() !== false ? periodo.push(3) : null;
        me.menu.down("[boxLabel=Jueves]").getValue()    !== false ? periodo.push(4) : null;
        me.menu.down("[boxLabel=Viernes]").getValue()   !== false ? periodo.push(5) : null;

        switch (combo.value)
        {
            case "Diario":
                periodo.push(0);
                break
            case "Quincenal":
                periodo.push(6);
                break
            case "Mensual":
                periodo.push(7);
                break
        }
        return periodo;
    },
    // BoxLabelDiario
    comboBoxDiario: function (combo)
    {
        var me = this, menu = combo.up("menu");

        if (combo.value === "Diario")
        {
            menu.down('[boxLabel=Lunes]').setValue(false);
            menu.down('[boxLabel=Martes]').setValue(false);
            menu.down('[boxLabel=Miércoles]').setValue(false);
            menu.down('[boxLabel=Jueves]').setValue(false);
            menu.down('[boxLabel=Viernes]').setValue(false);
            combo.setValue("Diario");
        }
    },
    // BoxLabel, todos menos el Lunes.
    changeBoxLabel: function (checkbox)
    {
        var me = this, combo = Ext.getCmp('menu-periodo-chequeo-combobox-id');

        if (combo.value === "Diario")
        {
            combo.setValue();
        }
    },
    addFechaFinalEstado: function (picker, date)
    {
        var me = this;
        me.editEstado(entorno+'/tareasoperativas/estado/add_fecha_final_estado',{Id:me.tareaId,Fecha:date});
    },
    addEstadoFinal: function (checkbox)
    {
        var me = this;
        if (checkbox.checked === true)
        {
            me.editEstado(entorno+'/tareasoperativas/estado/add_estado_final',{Id:me.tareaId});
        }
    },
    // Editar estado.
    editEstado: function (url, params)
    {
        var me = this;

        Ext.Ajax.request({
            url: url,
            params: params,
            success: function(response){
                switch (response.responseText) {
                    case '':
                        me.closeMenu(me.menu);
                        me.store.load();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el Estado para la : <b>Tarea Operativa</b> seleccionada.', 'question');
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
    // Activar responsable.
    editResponsable: function (item)
    {
        var me = this; me.closeMenu(me.menu);

        Ext.Ajax.request({
            url: entorno+'/tareasoperativas/responsable/add',
            params: {
                Id           : me.tareaId,
                TrabajadorId : item.idTrab,
                Estado       : item.checked
            },
            success: function(response){
                switch (response.responseText) {
                    case '':
                        me.store.load();
                        break;
                    case 'Unico':
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
    showOtrosEmailForm: function (item)
    {
        var me = this;
        Ext.create("CDT.view.admin.email.EmailForm", {
            store: Ext.create("CDT.store.tarea_operativa.especialista.TrabajadorUsersStore"),
            tarea: me.tareaName
        });
    },
    showResponsableEmailForm: function (item)
    {
        var me = this, win = Ext.create("CDT.view.admin.email.EmailForm", {
            tarea: me.tareaId,
            autoShow: false,
            tipo: "Responsables",
            title: 'Enviar correo (Responsables de Tarea Operativa)'
        });
        win.down("form").remove("fieldset-para-id");
        win.show();
    }
});