
Ext.define('CDT.controller.transporte.especialista.VehiculoController', {
    extend: 'Ext.app.Controller',

    views: [
        'transporte.especialista.vehiculo.VehiculoGrid',
        'transporte.especialista.vehiculo.VehiculoForm',
        'transporte.especialista.vehiculo.SitOpeVehiculoForm'
    ],

    init: function()
    {   
        var me = this;
        me.control({
            'vehiculoGrid': {
                resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 50)); },
                afterrender: function (grid, eOpts) { var me = this; me.grid = grid; me.store = grid.store; }
            },
            'vehiculoGrid button[iconCls=add]': {
                click: me.showVehiculo
            },
//            'vehiculoGrid button[iconCls=remove]': {
//                click: me.confirmRemuve
//            },
            'vehiculoGrid button[iconCls=edit]': {
                click: me.confirmEdit
            },
//            'vehiculoGrid button[iconCls=so]': {
//                click: me.validateSituacionOperativa
//            },
            // Formularios
            'vehiculoForm': {
                afterrender: me.afterRenderWin
            },
            'vehiculoForm button[action=save]': {
                click: me.validateForm
            },
            'vehiculoForm button[action=edit]': {
                click: me.validateForm
            },
            'vehiculoForm combobox[name=area]': {
                select: function (cmb) { me.areaId = cmb.value; }
            },
            'vehiculoForm combobox[name=areaParqueo]': {
                select: function (cmb) { me.areaParqueoId = cmb.value; }
            }
//            '#edit-id': {
//                click: me.editSituacionOperativa
//            }
        });
    },
    loadStore: function () { var me = this; me.store.load(); },
    // Mostrar Windows vehiculo.
    showVehiculo: function(action)
    {   
        var me = this;
        if (action !== 'edit')
        {
            var config = { btnText: 'Salvar', btnIconCls: 'ok', btnAction: 'save' },
                // Crear Window.
                win = Ext.create('CDT.view.transporte.especialista.vehiculo.VehiculoForm', config);
        }
        else
        {  //Obtener registro seleccionado del grid.
            var record = me.grid.selModel.getSelection()[0],
                // Crear ventana y configurarla para editar.
                config = { title: 'Editar vehículo', btnText: 'Editar', btnIconCls: 'edit', btnAction: 'edit', vehiculoId: record.get('id') },
                // Crear Window.
                win = Ext.create('CDT.view.transporte.especialista.vehiculo.VehiculoForm',config),
                // Obtener formulario contenido en la ventana.
                form = win.down('form');
                // ID Area.
                me.areaId = record.get('area_id');
                // ID Area parqueo.
                me.areaParqueoId = record.get('area_parqueo_id');
            // Cargar formulario con los datos del registro seleccionado del grid.
            form.loadRecord(record);
            form.down('[name=matriculaId]').setDisabled(true);
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
    },
    // Limpiar los componentes unicos del formulario.
    cleanComponentesUnicosForm: function ()
    {
        var me = this, chapa = me.form.down('[name=chapa]'), idApp = me.form.down('[name=matriculaId]');

        chapa.setValue();
        chapa.markInvalid('Verifique que la chapa no exista!');
        idApp.setValue();
        idApp.markInvalid('Verifique que el ID no exista!');
    },
    // Validar formulario.
    validateForm : function ()
    {   
        var me = this;

        if (me.form.getForm().isValid())
        {
            if (me.win.title === 'Adicionar vehículo')
            {
                me.addVehiculo(me.form.getForm().getValues(), me.form.getForm());
            } 
            else {
                me.editVehiculo(me.form.getForm().getValues());
            }
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    // Insertar datos.
    addVehiculo: function (record, form)
    {
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/transporte/vehiculo/add',
            params: {
                ID          : record['matriculaId'],
                Chapa       : record['chapa'],
                ChapaVieja  : record['chapaVieja'],
                Circulacion : record['circulacion'],
                Vencimiento : record['vencimiento'],
                Area        : record['area'],
                AreaParqueo : record['areaParqueo'],
                Marca       : record['marca'],
                Modelo      : record['modelo'],
                Tipo        : record['tipo']
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        form.reset();
                        me.loadStore();
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe una Matrícula con estos datos, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'question');
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
            me.showVehiculo('edit');
        } 
        else if (me.grid.selModel.getCount() > 1)
        {
            Ext.ex.MessageBox('Atención', 'Solo puede editar un registro a la vez, por favor <b>seleccione solo uno</b>.', 'question');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el registro que desea editar.', 'question');
        }
    },
    // Editar vehículos.
    editVehiculo: function (record)
    {   
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/transporte/vehiculo/edit',
            params: {
                Id          : me.win.vehiculoId,
                Chapa       : record['chapa'],
                ChapaVieja  : record['chapaVieja'],
                Circulacion : record['circulacion'],
                Vencimiento : record['vencimiento'],
                Area        : me.areaId,
                AreaParqueo : me.areaParqueoId,
                Marca       : record['marca'],
                Modelo      : record['modelo'],
                Tipo        : record['tipo']
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        me.loadStore();
                        me.win.close();
                        me.grid.selModel.deselectAll();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe un Vehículo con esta chapa: <b>'+record['chapa']+'</b>', 'question');
                        me.cleanComponentesUnicosForm();
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
//   // 
//    validateSituacionOperativa: function(btn)
//    {   
//        var me = this, grid = btn.up('grid');
//
//        if (grid.selModel.getCount() > 0) {
//            btn.setDisabled(true);
//            me.showSituacionOperativa(btn, grid);
//        } else {
//            Ext.ex.MessageBox('Atención', 'Seleccione el, ó los registro que desee editar.', 'question');
//        }
//    },
//   //mostrar ventana SituacionOperativa 
//    showSituacionOperativa: function (btn, grid)
//    {   
//        var ids = [], i;
//
//        for(i = 0; i < grid.selModel.getCount(); i++)
//        {
//            ids.push(grid.selModel.getSelection()[i].get('id'));
//        }
//        Ext.create('CDT.view.transporte.especialista.vehiculo.SitOpeVehiculoForm',{
//            btn: btn,
//            store: grid.store,
//            vehiculoids: Ext.encode(ids)
//        });
//    },
//   //Editar datos... 
//    editSituacionOperativa: function (btn)
//    {   
//        var win = btn.up('window');
//        
//        Ext.Ajax.request({
//            waitMsg: 'Please wait...',
//            url: '../transporte/vehiculo/edit_situacion_operativa',
//            params: {
//                Ids  : win.vehiculoids,
//                IdSO : win.down('[name=so]').getValue()
//            },
//            success: function(response){
//                switch(response.responseText){
//                    case '':
//                        win.btn.setDisabled(false);
//                        win.store.load();
//                        win.close();
//                        break;
//                    default:
//                        Ext.ex.MessageBox('Error', response.responseText, 'error');
//                        break;
//                }
//            },
//            failure: function(){
//                Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
//            }
//        }); 
//    },

//   //Confirmar antes de eliminar datos... 
//    confirmRemuve: function(btn)
//    {   
//        var me = this; me.grid = btn.up('grid');
//
//        if (me.grid.selModel.getCount() === 1) {
//            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.remove, me);
//        } else if (me.grid.selModel.getCount() > 1) {
//            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los registros seleccionados?', me.remove, me);
//        } else {
//            Ext.ex.MessageBox('Atención', 'Seleccione el o los registro que desea eliminar.', 'question');
//        }
//    },
//   //Eliminar datos... 
//    remove: function (btn)
//    {   
//        if (btn === 'yes')
//        {
//            var me = this, ids = [], i;
//
//            for(i = 0; i < me.grid.selModel.getCount(); i++)
//            {
//                ids.push(me.grid.selModel.getSelection()[i].get('id'));
//            }
//            Ext.Ajax.request({
//                waitMsg: 'Please Wait',
//                url: '../transporte/vehiculo/remove',
//                params: {
//                    ids:  Ext.encode(ids)
//                },
//                success: function(response){
//                    switch (response.responseText) {
//                        case '':
//                            me.grid.store.load();
//                            break;
//                        default:
//                            Ext.ex.MessageBox('Error', response.responseText, 'error');
//                            break;
//                    }
//                },
//                failure: function(){
//                    Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
//                }
//            }); 
//        }
//    }
});


