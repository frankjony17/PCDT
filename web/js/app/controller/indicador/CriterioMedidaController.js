
Ext.define('CDT.controller.indicador.CriterioMedidaController', {
    extend: 'Ext.app.Controller',
    // Control de Eventos
    control: {
        'criterio-medida-grid': {
            resize: function (grid) {
                grid.setHeight(Ext.ex.height('south-panel-id', 50));
            },
            afterrender: "afterRenderGrid"
        },
        'criterio-medida-grid button[text=Adicionar]': {
            click: "onAddClick"
        },
        'criterio-medida-grid button[text=Editar]': {
            click: "confirmEdit"
        },
        'criterio-medida-grid button[text=Eliminar]': {
            click: "onConfirmRemuve"
        },
        // Formulario
        'criterio-medida-form': {
            afterrender: "afterRenderForm"
        },
        'criterio-medida-form button[text=Salvar]': {
            click: "onSubmitClick"
        }
    },
    // Acciones.
    afterRenderGrid: function(grid)
    {
        this.store = grid.store;
        this.grid = grid;
    },
    afterRenderForm: function(win)
    {
        this.win = win;
        this.form = win.down("form");
    },
    loadStore: function () {
        this.store.reload();
        this.grid.treeStore.reload();
    },
    onAddClick: function (btn)
    {
        Ext.create('CDT.view.indicador.especialista.cm.CriterioMedidaForm').show();
    },
    // Verificar que se a seleccionado solo un registro.
    confirmEdit: function()
    {
        if (this.grid.selModel.getCount() === 1) {
            this.showWindows();
        } else if (this.grid.selModel.getCount() > 1) {
            Ext.ex.MessageBox('Atención', 'Solo puede editar un registro a la vez, por favor <b>seleccione solo uno</b>.', 'question');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el registro que desea editar.', 'question');
        }
    },
    showWindows: function ()
    {
        var win = Ext.create('CDT.view.indicador.especialista.cm.CriterioMedidaForm',{title:'Editar Criterio de Medida'}),
            form = win.down("form"),
            record = this.grid.selModel.getLastSelected();
        form = form.getForm();
        form.loadRecord(record);
        form.url = entorno+'/indicadores/cm/edit';
        win.show();
    },
    // Adicionar Objetivo
    onSubmitClick: function (btn)
    {
        var me = this, form = me.form.getForm(), record = form.getValues();;

        if (form.isValid())
        {
           form.submit({
                success: function(form, action) {
                    me.loadStore();
                    form.reset();
                    Ext.ex.toast('Creación OK', 'Operación realizada exitosamente.');
                },
                failure: function(form, action) {
                    switch(action.response.responseText) {
                        case 'Unico':
                            Ext.ex.MessageBox('Atención', 'Ya existe el Criterio de Medida, con el nombre o la descripción: <br><b>"'+ record["nombre"] +'/'+ record["descripcion"] +'"</b>', 'question');
                            break;
                        default:
                            Ext.ex.MessageBox('Error', action.response.responseText, 'error');
                            break;
                    }
                }
            });
        }
        else
        {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    // Confirmar acción.
    onConfirmRemuve: function()
    {
        var me = this;

        if (me.grid.selModel.getCount() === 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.removeClick, me);
        } else if (me.grid.selModel.getCount() > 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los registros seleccionados?', me.removeClick, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el o los registro que desea eliminar.', 'question');
        }
    },
    // Eliminar registro.
    removeClick: function (btn)
    {
        if (btn === 'yes') {
            var me = this, ids = [];
            Ext.Array.each(me.grid.selModel.getSelection(), function (row)
            {
                ids.push(row.get('id'));
            });
            Ext.Ajax.request({
                url: entorno+'/indicadores/cm/remove',
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
                failure: function(response){
                    Ext.ex.MessageBox('Error', response.responseText, 'error');
                }
            });
        }
    }
});


