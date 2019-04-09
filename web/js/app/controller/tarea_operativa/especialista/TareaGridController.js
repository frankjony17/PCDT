
Ext.define('CDT.controller.tarea_operativa.especialista.TareaGridController', {
    extend: 'Ext.app.Controller',

    views: [
        'tarea_operativa.especialista.tarea.TareaGrid'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'tareaGrid': {
                resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 50)); },
                render: me.showLegend,
                afterrender: me.afterRenderGrid,
                itemcontextmenu: me.showMenuTarea
            },
            'tareaGrid button[iconCls=legend-user]': {
                click: me.showLegend
            },
            'tareaGrid button[iconCls=add]': {
                click: me.showTareasForm
            },
            'tareaGrid button[iconCls=edit]': {
                click: me.confirmEdit
            },
            'tareaGrid button[iconCls=remove]': {
                click: me.confirmRemuve
            },
            '#checkcolumn-prioridad-to': {
                checkchange: "checkChange"
            },
            '#resumen-prioridad-to-id': {
                click: "resumenPrioridad"
            }
        });
    },
    afterRenderGrid: function (grid, eOpts)
    { 
        var me = this;
        me.grid = grid;
        me.store = grid.store;
        me.storeTrabajador = Ext.create('CDT.store.tarea_operativa.especialista.TrabajadorUsersStore');
        me.loadStore();
    },
    loadStore: function () { var me = this; me.store.load(); },
    // Mostrar Windows Tareas.
    showTareasForm: function(action)
    {   
        var me = this;
        
        if (action !== 'edit')
        {
            var config = { store: me.store, btnText: 'Salvar', btnIconCls: 'ok', storeTrabajador: me.storeTrabajador },
            // Crear Window.
            win = Ext.create('CDT.view.tarea_operativa.especialista.tarea.TareaForm', config);
        }
        else
        {  //Obtener registro seleccionado del grid.
            var record = me.grid.selModel.getSelection()[0],
                // Crear ventana y configurarla para editar.
                config = { 
                    title: 'Editar Tarea Operativa', btnText: 'Editar', btnIconCls: 'edit',
                    storeTrabajador: me.storeTrabajador, tareaId: record.get('id'), store: me.store
                },
                // Crear Window.
                win = Ext.create('CDT.view.tarea_operativa.especialista.tarea.TareaForm',config),
                // Obtener formulario contenido en la ventana.
                form = win.down('form');
            // Cargar formulario con los datos del registro seleccionado del grid.
            form.loadRecord(record);
            // Cargar datos al Grid del formulario.
            me.getDataGridForm(record, win.gridTrabajadorStore, win);
        }
        // Mostrar ventana. 
        win.show();
    },
    getDataGridForm: function (record, gridTrabajadorStore, win)
    {
        var me = this, ids = record.get('trabajadores_ids').split('-'), index, row, myData = [];
                
        Ext.Array.each(ids, function(id, index)
        {
            index = me.storeTrabajador.find('id', id);
            row = me.storeTrabajador.getAt(index);
            //-!
            myData.push([row.get('id'), row.get('nombreApellidos'), row.get('departamento')]);
        });
        win.myData = myData; // Actualizo win.myData, para poder añadir desde el TareaFormController manteniendo la información que aki manipulo.
        gridTrabajadorStore.loadData(myData);
        me.getDataCheckBox(win.down('form'), record.get('chequeo'));
    },
    getDataCheckBox: function (form, chequeo)
    {
        var periodo = chequeo.split(', '), combo = form.down('[id=periodo-chequeo-combobox-id]');
        
        Ext.Array.each(periodo, function(modo)
        {
            switch (modo) {
                case "Lun":
                    form.down('[boxLabel=Lunes]').setValue(true);
                    break;
                case "Mar":
                    form.down('[boxLabel=Martes]').setValue(true);
                    break;
                case "Mié":
                    form.down('[boxLabel=Miércoles]').setValue(true);
                    break;
                case "Jue":
                    form.down('[boxLabel=Jueves]').setValue(true);
                    break;
                case "Vie":
                    form.down('[boxLabel=Viernes]').setValue(true);
                    break;
                case "<b>(Q)</b>":
                    combo.setValue("Quincenal");
                    break;
                case "<b>(M)</b>":
                    combo.setValue("Mensual");
                    break;
                default:
                    combo.setValue("Diario");
                    break;
            }
        });
    },
    // ToolTip Leyenda (Colores).
    showLegend: function (btn)
    {
        var me = this,
            legend_tip = Ext.create('Ext.tip.ToolTip', {
            autoHide: false,
            shadow: true,
            closable: true,
            closeAction: 'destroy',
            width: 160,
            height: 95,
            id: 'tool-tip-legend-tareas-id',
            title: '<div style="background:#c2edf9;"><center>LEYENDA</center></div>',
            html: '<table>'+
                    '<tr><th width=20 style="background:#fefdff;border: 1px solid #CCC !important;"></th><th style="text-align:left;">Pediente.</th></tr>'+
                    '<tr><th width=20 style="background:rgba(255, 223, 218, 0.88);border: 1px solid #CCC !important;"></th><th style="text-align:left;">Ultimo Día.</th></tr>'+
                    '<tr><th width=20 style="background:rgba(255, 251, 149, 0.62);border: 1px solid #CCC !important;"></th><th style="text-align:left;">Fuera de Término.</th></tr>'+
                  '</table>',
            listeners: {
                 hide: function (tip) {
                    tip.showAt(me.getXYPosition()); 
                 },
                 close: function () {
                     var obj = Ext.getCmp('legend-tarea-id-0000');
                     
                     if (Ext.isObject(obj))
                     {
                        obj.setDisabled(false);
                     }
                 }
            }
        });
        legend_tip.showAt(me.getXYPosition());
        Ext.getCmp('legend-tarea-id-0000').setDisabled(true);
    },
    // Obtener posicion para el tip leyenda.
    getXYPosition: function ()
    {
        var south_panel = Ext.getCmp('fecha-item-toolbar-status-bar-0000'), xy = [];
        
        xy.push([south_panel.getX() - 100, south_panel.getY() - 112]);
        
        return xy;
    },
    // Close ToolTip Legend cuando se cierre la pesteña que contiene el grid user.
    closeToolTipLegend: function ()
    {
        var tip = Ext.getCmp('tool-tip-legend-tareas-id');
        
        if (Ext.isObject(tip))
        {
            tip.close();
        }
    },
    // Verificar que se a seleccionado solo un registro.
    confirmEdit: function()
    {   
        var me = this;
        if (me.grid.selModel.getCount() === 1)
        {
            me.showTareasForm('edit');
        } 
        else if (me.grid.selModel.getCount() > 1)
        {
            Ext.ex.MessageBox('Atención', 'Solo puede editar un registro a la vez, por favor <b>seleccione solo uno</b>.', 'question');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el registro que desea editar.', 'question');
        }
    },
    // Confirmar antes de eliminar datos.
    confirmRemuve: function()
    {   
        var me = this;

        if (me.grid.selModel.getCount() === 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.remove, me);
        } else if (me.grid.selModel.getCount() > 1) {
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
                url: entorno+'/tareasoperativas/to/remove',
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
    // Mostrar Menu Tareas Operativas.
    showMenuTarea: function (view, record, item, index, e)
    {
        var me = this, idsTrabajadores = record.get('trabajadores_ids').split('-'), indexStore, rowTrabajador = [], responsables = [], row = me.store.getAt(index);
        
        Ext.Array.each(idsTrabajadores, function(id)
        {
            indexStore = me.storeTrabajador.find('id', id);
            rowTrabajador = me.storeTrabajador.getAt(indexStore);
            var area = rowTrabajador.get('area'), bool = me.isChecked(record, area);
            responsables.push({
                text: rowTrabajador.get('nombreApellidos') +"<b>("+area+")</b>",
                idTrab: ""+ rowTrabajador.get('id') +"",
                checked: bool,
                action: "menu-responsable-items"
            });
        });
        var menu = Ext.create('CDT.view.tarea_operativa.especialista.OperacionesTareaMenu', {
            title: '<b>['+record.get('numero')+']</b>',
            store: me.store,
            record: record,
            responsables: responsables,
            accion: row.get("accion"),
            accion_id: row.get("accion_id")
        });
        me.getDataCheckBoxMenu(menu, record.get("chequeo"));//record.get("fecha_final")
        menu.showAt(e.xy);
        e.stopEvent();
    },
    isChecked: function (record, areaTrabajador)
    {
        var areas = record.get('responsable').split(', '), bool = false;
        
        Ext.Array.each(areas, function(area)
        {
            if (area === "<b><u><i>"+areaTrabajador+"</u></i></b>")
            {
                bool = true;
            }
        });
        return bool;
    },
    getDataCheckBoxMenu: function (menu, chequeo)
    {
        var periodo = chequeo.split(', ');

        Ext.Array.each(periodo, function(modo)
        {
            var combo = menu.down('[id=menu-periodo-chequeo-combobox-id]');
            switch (modo) {
                case "Lun":
                    menu.down('[boxLabel=Lunes]').setValue(true);
                    break;
                case "Mar":
                    menu.down('[boxLabel=Martes]').setValue(true);
                    break;
                case "Mié":
                    menu.down('[boxLabel=Miércoles]').setValue(true);
                    break;
                case "Jue":
                    menu.down('[boxLabel=Jueves]').setValue(true);
                    break;
                case "Vie":
                    menu.down('[boxLabel=Viernes]').setValue(true);
                    break;
                case "Diario":
                    combo.setValue("Diario");
                    break;
                case "<b>(Q)</b>":
                    combo.setValue("Quincenal");
                    break;
                default:
                    combo.setValue("Mensual");
                    break;
            }
        });
    },
    checkChange: function (checkbox, rowIndex, checked) {
        var me = this, record = me.store.getAt(rowIndex);
        Ext.Ajax.request({
            url: entorno+'/tareasoperativas/to/prioridad',
            params: {
                id: record.get('id'),
                prioridad: checked
            },
            success: function(){
                me.store.reload();
            },
            failure: function(){
                Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
            }
        });
    },
    resumenPrioridad: function () {
        var me = this;
        me.store.load({
            params: { Prioridad: true }
        });
    }
});


