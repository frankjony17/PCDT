
Ext.define('CDT.controller.transporte.especialista.ChoferController', {
    extend: 'Ext.app.Controller',

    views: [
        'transporte.especialista.chofer.ChoferGrid',
        'transporte.especialista.chofer.ChoferForm',
        'transporte.especialista.chofer.ChangeHorarioParqueoForm'
    ],

    init: function()
    {   
        var me = this;
        
        me.control({
            'choferGrid': {
                resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 50)); },
                afterrender: function (grid, eOpts) { var me = this; me.grid = grid; me.store = grid.store; }
            },
            'choferGrid button[iconCls=add]': {
                click: me.showChofer
            },
            'choferGrid button[iconCls=remove]': {
                click: me.confirmRemuve
            },
            'choferGrid button[iconCls=edit]': {
                click: me.confirmEdit
            },
            'choferGrid button[iconCls=change]': {
                click: me.showChangeWindows
            },
            // Formulario
            'choferForm': {
                afterrender: me.afterRenderWin
            },
            'choferForm combobox[emptyText=Área]': {
                select: me.filterTrabajador
            },
            'choferForm button[iconCls=trash]': {
                click: me.cleanComboArea
            },
            'choferForm button[action=save]': {
                click: me.validateForm
            },
            'choferForm combobox[name=trabajador]': {
                select: function (cmb) { me.trabajadorId = cmb.value; }
            },
            'choferForm button[iconCls=edit]': {
                click: me.validateForm
            },
            'changeHorarioParqueoForm button[text=Salvar]': {
                click: me.validateChange
            }
        });
    },
    loadStore: function () { var me = this; me.store.load(); },
    // Mostrar Windows chofer.
    showChofer: function(action)
    {   
        var me = this;
        if (action !== 'edit')
        {
            var config = { btnText: 'Salvar', btnIconCls: 'ok', btnAction: 'save' },
                // Crear Window.
                win = Ext.create('CDT.view.transporte.especialista.chofer.ChoferForm', config);
        }
        else
        {   // Obtener registro seleccionado del grid.
            var record = me.grid.selModel.getSelection()[0],
                // Crear ventana y configurarla para editar.
                config = { title: 'Editar chofer', btnText: 'Editar', btnIconCls: 'edit', btnAction: 'edit', choferId: record.get('id')},
                // Crear Window.
                win = Ext.create('CDT.view.transporte.especialista.chofer.ChoferForm', config),
                // Obtener formulario contenido en la ventana.
                form = win.down('form');
                // ID trabajador.
                me.trabajadorId = record.get('trabajador_id');
            // Cargar formulario con los datos del registro seleccionado del grid.
            form.loadRecord(record);
        }
        // Mostrar ventana.
        win.show();
    },
    // Cuando la ventana del formulario es renderiada.
    afterRenderWin: function (win, eOpts)
    {
        var me = this;
        me.win = win;
        me.form = win.down('form');
        me.storeTrabajador = win.trabajadorStore;
        //-!
        me.storeTrabajador.proxy.url = entorno+'/all/nomenclador/trabajador/interno';
        me.storeTrabajador.load();
        me.filterTrabajadorNoChofer();
    },
    // Filtrar store Trabajador de manera que solo queden los trabajadores que no son choferes.
    filterTrabajadorNoChofer: function (id)
    {
        var me = this;
        if (!id)
        {
            me.store.each(function(chofer)
            {
                me.storeTrabajador.addFilter(Ext.create('Ext.util.Filter', {filterFn: function(item) { return item.get("id") !== chofer.get("trabajador_id"); }, root: 'data'}));
            });
        } else {
            me.storeTrabajador.addFilter(Ext.create('Ext.util.Filter', {filterFn: function(item) { return item.get("id") !== id; }, root: 'data'}));
        }
    },
    // Filtrar combobox trabajador.
    filterTrabajador: function (cmb)
    {
        var me = this;
        me.storeTrabajador.clearFilter();
        if (cmb.value)
        {
            me.storeTrabajador.filter({
                property: 'area',
                value: cmb.value,
                anyMatch: true,
                caseSensitive: true
            });
        };
        me.filterTrabajadorNoChofer();
        me.win.down('[name=trabajador]').setValue();
        me.win.down('[iconCls=trash]').setDisabled(false);
    },
    // Limpiar combobox Area y quitar filtro a Combo Trabajador.
    cleanComboArea: function ()
    {
        var me = this;
        me.win.down('[id=chofer-fieldset-area]').collapse();
        me.win.down('[iconCls=trash]').setDisabled(true);
        me.win.down('[emptyText=Área]').setValue();
        me.win.down('[name=trabajador]').setValue();
        me.storeTrabajador.clearFilter();
        me.filterTrabajadorNoChofer();
    },
    // Limpiar los componentes unicos del formulario.
    cleanComponentesUnicosForm: function (value)
    {
        var me = this, lic = me.win.down('[name=licencia]');
        if (value !== 'edit')
        {
            me.win.down('[name=trabajador]').setValue();
        }
        lic.setValue();
        lic.markInvalid('Verifique que la licencia no exista!');
    },
/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    // Validar formulario.
    validateForm: function ()
    {   
        var me = this;
        if (me.form.getForm().isValid())
        {
            if (me.win.title === 'Adicionar chofer')
            {
                me.addChofer(me.form.getForm().getValues(), me.form.getForm());
            } else {
                me.editChofer(me.form.getForm().getValues());
            }
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    // Insertar datos del chofer.
    addChofer: function (record, form)
    {   
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/transporte/chofer/add',
            params: {
                Licencia     : record['licencia'],
                Profecional  : record['profecional'],
                HoraParqueo  : record['horaParqueo'],
                TrabajadorId : me.trabajadorId
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        me.loadStore();
                        me.filterTrabajadorNoChofer(me.trabajadorId);
                        form.reset();
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el chofer o el número de licencia, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'question');
                        me.cleanComponentesUnicosForm();
                        break;
                    default:
                        Ext.ex.MessageBox('Error', response.responseText, 'error');
                        break;
                }
            },
            failure: function () {
                Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
            }
        });
    },
    // Verificar que se a seleccionado solo un registro.
    confirmEdit: function()
    {   
        var me = this;
        if (me.grid.selModel.getCount() === 1)
        {
            me.showChofer('edit');
        } 
        else if (me.grid.selModel.getCount() > 1)
        {
            Ext.ex.MessageBox('Atención', 'Solo puede editar un registro a la vez, por favor <b>seleccione solo uno</b>.', 'question');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el registro que desea editar.', 'question');
        }
    },     
    // Editar datos del chofer.  
    editChofer:  function (record)
    {   
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/transporte/chofer/edit',
            params: {
                Id           : me.win.choferId,
                Licencia     : record['licencia'],
                Profecional  : record['profecional'],
                HoraParqueo  : record['horaParqueo'],
                TrabajadorId : me.trabajadorId
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        me.loadStore();
                        me.win.close();
                        me.grid.selModel.deselectAll();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el número de licencia, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'question');
                        me.cleanComponentesUnicosForm('edit');
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
    confirmRemuve: function()
    {   
        var me = this;
        if (me.grid.selModel.getCount() === 1)
        {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.remove, me);
        }
        else if (me.grid.selModel.getCount() > 1)
        {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los registros seleccionados?', me.remove, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el o los registro que desea eliminar.', 'question');
        }
    },
    // Eliminar datos.
    remove: function (btn)
    {   
        if (btn === 'yes')
        {
            var me = this, ids = [];
            
            Ext.Array.each(me.grid.selModel.getSelection(), function (row)
            {    
                ids.push(row.get('id'));
            });
            Ext.Ajax.request({
                url: entorno+'/transporte/chofer/remove',
                params: {
                    ids:  Ext.encode(ids)
                },
                success: function(response){
                    switch (response.responseText) {
                        case '':
                            me.loadStore();
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
/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    // Mostrar Window CambiarHorarioDeParqueo.
    showChangeWindows: function ()
    {   
        Ext.create('CDT.view.transporte.especialista.chofer.ChangeHorarioParqueoForm');
    }, 
    // Validar los cambios que se decean hacer.
    validateChange: function(btn)
    {   
        var me = this,
            win = btn.up('window'),
            form = win.down('form'),
            record = form.getForm().getValues();
        
        if (form.getForm().isValid())
        {
            switch (record['Opciones']) {
                case 'Seleccionados':
                    me.getSelectedIds(record['horaParqueo'], win);
                    break;
                case 'No seleccionados':
                    me.changeChofer('No seleccionados', me.getNotSelectedIds(), record['horaParqueo'], win);
                    break;
                case 'Todos':
                    me.changeChofer('Todos', me.getAllIds(), record['horaParqueo'], win);
                    break;
                default:
                    if (record['Cargo'] !== '') {    
                        me.changeChofer('Cargo', record['Cargo'], record['horaParqueo'], win);
                    } else { // Formulario en blanco.
                        Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, seleccione un criterio.', 'info');
                    } break;
            }
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },    
    // Cambiar horario de parqueo a múltiples choferes.
    changeChofer: function (action, values, horaParqueo, win)
    {   
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/transporte/chofer/change',
            params: {
                Accion      : action,
                HoraParqueo : horaParqueo,
                ChoferId    : values
            },
            success: function(response){
                var string = response.responseText.split('/#/');
                switch(string[0]){
                    case '':
                        me.loadStore();
                        win.close();
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
    // // Obtener todos los ID.
    getAllIds: function ()
    {
        var me = this, ids = [];
        me.store.each(function(chofer)
        {
            ids.push(chofer.get('id'));
        });
        return Ext.encode(ids);
    },
    // Obtener los ID según la opcion seleccionada en el formulario.
    getSelectedIds: function(horaParqueo, win)
    {   
        var me = this, ids = [], i, 
            count = me.grid.selModel.getCount(), selection = me.grid.selModel.getSelection();

        if (count === 0)
        {
            Ext.MessageBox.confirm('Confirmación', 'Usted no ha seleccionado ningún registro.<br> ¿Desea seleccionarlos?', me.closeWindow, me);
        }
        else //Si existen registros seleccionados.
        {
            for(i = 0; i < count; i++)
            {
                ids.push(selection[i].get('id'));
            }//Retorno los IDs seleccionados...
            me.changeChofer('Seleccionados', Ext.encode(ids), horaParqueo, win);
        }
    },
    // Obtener los IDs no seleccionados.
    getNotSelectedIds: function()
    {   
        var me = this, ids = [], i,
            count = me.grid.selModel.getCount(), selection = me.grid.selModel.getSelection(),
            // IDs Seleccionados por el usuario.
            rowIds = me.getRowIds();
        // Si no se selecciono ningun registro se retornan todos los IDs.
        if (selection.length > 0)
        {    
            for(i = 0; i < count; i++)
            {   // La primera ves busco los IDs que no furon seleccionados.
                // en el arreglo que contiene todos los IDs.
                if(i === 0)
                {
                    ids = me.inArray(rowIds, selection[i].get('id'));
                } // Busco los ID en el arreglo que contiene los que no coinceden con los seleccionados.
                else
                {
                    ids = me.inArray(ids, selection[i].get('id'));
                }
            } // Retorno los IDs no seleccionados.
            return Ext.encode(ids);
        }
        else // Retorno todos los IDs.
        {
            return Ext.encode(rowIds);
        }
    },    
    // Obtener todos los ID de los registros del store.
    getRowIds: function ()
    {   
        var me = this, i, tmpId = [], row;
        
        for(i = 0; i < me.store.getTotalCount(); i++)
        {
            row = me.store.getAt(i);
            tmpId.push(row.get('id'));
        }
        return tmpId;
    },
    // Buscar los ID que coinciden y devolver los que no.
    inArray: function (array, id)
    {   
        var tmpId = [];
        for (var i = 0; i < array.length; i++)
        {
            if (array[i] !== id)
            {    
                tmpId.push(array[i]);
            }
        }
        return tmpId;
    },
    // Cerrar ventana.
    closeWindow: function(btn)
    {   
        if(btn === 'yes')
        {
            var win = Ext.getCmp('changeHorarioParqueoForm-id');
            win.close();
        }
    }
});