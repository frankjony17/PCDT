
Ext.define('CDT.controller.tarea_operativa.especialista.TareaFormController', {
    extend: 'Ext.app.Controller',

    views: [
        'tarea_operativa.especialista.tarea.TareaForm'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'tareaForm': {
                close: me.cleanData,
                afterrender: me.afterRenderWindows,
                actioncolumnClick: me.removeRowGridForm
            },
            'tareaForm combobox[emptyText=Cargo]': {
                select: me.filterStoreTrabajador
            },
            'tareaForm combobox[emptyText=Trabajador]': {
                select: me.addTrabajadorGrid
            },
            '#periodo-chequeo-combobox-id': {
                select: me.selectComboDiario
            },
            'tareaForm [boxLabel=Lunes]': {
                change: me.changeBoxLabel
            },
            'tareaForm [boxLabel=Martes]': {
                change: me.changeBoxLabel
            },
            'tareaForm [boxLabel=Miércoles]': {
                change: me.changeBoxLabel
            },
            'tareaForm [boxLabel=Jueves]': {
                change: me.changeBoxLabel
            },
            'tareaForm [boxLabel=Viernes]': {
                change: me.changeBoxLabel
            },
            'tareaForm button[iconCls=ok]': {
                click: me.validateForm
            },
            'tareaForm button[iconCls=edit]': {
                click: me.validateForm
            }
        });
    },
    // Cuando la ventana del formulario es renderiada.
    afterRenderWindows: function (win, eOpts)
    {
        var me = this;
        me.win = win;
        me.form = win.down('form');
        me.store = win.store;
        me.storeTrabajador = win.storeTrabajador;
        me.gridTrabajadorStore = win.gridTrabajadorStore;
    },
    // Filtrar store.
    filterStoreTrabajador: function (cmb)
    {
        var me = this; 
        
        me.storeTrabajador.clearFilter();
        
        if (cmb.value)
        {
            me.storeTrabajador.filter({
                property: 'cargo',
                value: cmb.value,
                anyMatch: true
            });
        };
        me.form.down('[emptyText=Trabajador]').setValue();
    },
    // Añadir trabajadores al grid.
    addTrabajadorGrid: function (combo, records)
    {
        var me = this, data = records[0]['data'], row;
        
        row = [data['id'], data['nombreApellidos'], data['departamento']];
        
        if (me.inArray(data['id']))
        {
            me.win.myData.push(row);
            me.loadData();
        }
    },
    inArray: function(id)
    {
        var me = this;
        
        for (var i = 0; i < me.win.myData.length; i++)
        {
            if (me.win.myData[i][0] === id)
            {
                return false;
            }
        }
        return true;
    },
    // Eliminar fila del grid contenido en el formulario.
    removeRowGridForm: function (value)
    {
        var me = this, grid = value[0], rowIndex = value[1], rec = grid.getStore().getAt(rowIndex);
         
        for (var i = 0; i < me.win.myData.length; i++)
        {
            if (me.win.myData[i][0] === rec.data.id)
            {
                me.win.myData.splice(i,1);
                return me.loadData();
            }
        }
    },
    loadData: function ()
    {
        var me = this;
        me.gridTrabajadorStore.loadData(me.win.myData);
    },
    // BoxLabelDiario
    selectComboDiario: function (combo)
    {
        var me = this;
        
        if (combo.value === "Diario")
        {
            me.form.down('[boxLabel=Lunes]').setValue(false);
            me.form.down('[boxLabel=Martes]').setValue(false);
            me.form.down('[boxLabel=Miércoles]').setValue(false);
            me.form.down('[boxLabel=Jueves]').setValue(false);
            me.form.down('[boxLabel=Viernes]').setValue(false);
            combo.setValue("Diario");
        }
    },
    // BoxLabel, todos menos el Lunes.
    changeBoxLabel: function ()
    {
        var me = this, combo = me.form.down('[id=periodo-chequeo-combobox-id]');

        if (combo.value === "Diario")
        {
            combo.setValue();
        }
    },
    // Validar formulario.
    validateForm : function (btn)
    {  
        var me = this, record = me.form.getForm().getValues();

        if (me.isValid(record, btn) === 5) {
            if (me.win.title === 'Adicionar Tarea Operativa') {
                me.addTareaOperativa(record);
            } else {
                me.editTareaOperativa(record);
            }
        } else {
            Ext.ex.MessageBox('Atención', '<b>Formulario no válido</b>, verifique las siguientes acciones:<br>'+
                '<b>&nbsp;&nbsp;&nbsp;&nbsp;1. <span style="color:red;">Listado de responsables</span>.<br>'+
                '&nbsp;&nbsp;&nbsp;&nbsp;2. <span style="color:red;">Descripción de la Tarea Operativa</span>.<br>'+
                '&nbsp;&nbsp;&nbsp;&nbsp;3. <span style="color:red;">Periodo de chequeo</span>.<br>'+
                '&nbsp;&nbsp;&nbsp;&nbsp;4. <span style="color:red;">Casillas en rojo</span>.</b>.', 'info');
        }
    },
    isValid: function (record, btn)
    {
        var me = this, valid = 0, periodo = me.getPeriodoChequeo(record);
        
        btn.setDisabled(true);
        me.win.down('[iconCls=cancel]').setDisabled(true);
        
        if (me.win.myData.length > 0) {valid++;}
        if (record.descripcion !== '') {valid++;}
        if (record.fecha_inicial !== '') {valid++;}
        if (record.fecha_final !== '') {valid++;}
        if (periodo.length > 0) {valid++;}
        
        return valid;
    },
    // Adicionar Tarea Operativa.
    addTareaOperativa: function (record)
    {
        this.ajaxTareaOperativa(entorno+'/tareasoperativas/to/add', record);
    },
    // Editar Tarea operativa.
    editTareaOperativa: function (record)
    {
        this.ajaxTareaOperativa(entorno+'/tareasoperativas/to/edit', record);
    },
    // Ejecutar Ajax.
    ajaxTareaOperativa: function (url, record)
    {
        var me = this; 
        
        Ext.Ajax.request({
            url: url,
            params: {
                Id             : me.win.tareaId,
                Responsables   : me.getResponsable(),
                Descripcion    : record.descripcion,
                FechaInicial   : record.fecha_inicial,
                FechaFinal     : record.fecha_final,
                PeriodoChequeo : Ext.encode(me.getPeriodoChequeo(record))
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        me.cleanData();
                        me.store.load();
                        me.win.close();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe la Tarea Operativa: <br><b>'+record.fecha_inicial+': '+record.descripcion+'</b>', 'question');
                        me.resetFormTarea();
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
    getResponsable: function ()
    {
        var me = this, ids = [];
        
        Ext.Array.each(me.win.myData, function(row)
        {
            ids.push(row[0]);
        });
        return Ext.encode(ids);
    },
    getPeriodoChequeo: function (record)
    {
        var periodo = [], combo = this.form.down('[id=periodo-chequeo-combobox-id]');
        
        record.lun ? periodo.push(1) : null;
        record.mar ? periodo.push(2) : null;
        record.mie ? periodo.push(3) : null;
        record.jue ? periodo.push(4) : null;
        record.vie ? periodo.push(5) : null;

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
    resetFormTarea: function ()
    {
        var me = this;
        me.cleanData();
        me.form.down('[emptyText=Descripción]').setValue();
        me.selectComboDiario(me.form.down('[id=periodo-chequeo-combobox-id]'));
        
        Ext.isObject(me.win.down('[iconCls=ok]')) ? me.win.down('[iconCls=ok]').setDisabled(false) : me.win.down('[iconCls=edit]').setDisabled(false);
        
        me.win.down('[iconCls=cancel]').setDisabled(false);
    },
    cleanData: function ()
    {
        var me = this;
        me.win.myData = [];
        me.loadData();
    }
});


