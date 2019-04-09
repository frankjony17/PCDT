
Ext.define('CDT.controller.indicador.ObjetivoController', {
    extend: 'Ext.app.Controller',


    control: {
        'objetivo-grid': {
            resize: function (grid) {
                grid.setHeight(Ext.ex.height('south-panel-id', 50));
            },
            afterrender: "afterRenderGrid",
            edit: "onRowEditing"
        },
        'objetivo-grid button[text=Adicionar]': {
            click: "onAddObjetivoClick"
        },
        'objetivo-grid button[text=Eliminar]': {
            click: "onConfirmRemuve"
        },
        // Formulario
        'objetivo-form': {
            afterrender: "afterRenderForm"
        },
        'objetivo-form button[text=Salvar]': {
            click: "onSubmitClick"
        }
    },
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
    onAddObjetivoClick: function (btn)
    {
        Ext.create('CDT.view.indicador.especialista.objetivo.ObjetivoForm');
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
                            Ext.ex.MessageBox('Atención', 'Ya existe el Objetivo, con el nombre o la descripción: <br><b>"'+ record["Nombre"] +'/'+ record["Descripcion"] +'"</b>', 'question');
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
    // Editar registro.
    onRowEditing: function (editor, context, eOpts)
    {
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/indicadores/objetivo/edit',
            params: {
                Id           : context.record.get('id'),
                Nombre       : context.record.get('nombre'),
                Descripcion  : context.record.get('descripcion'),
                TipoObjetivo : context.record.get('tipo_objetivo')
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        me.loadStore();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el Objetivo, con el nombre o la descripción: <br><b>"'+ context.record.get('nombre') +'/'+ context.record.get('descripcion') +'"</b>', 'question');
                        context.grid.store.reload();
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
    },
    // Confirmar acción.
    onConfirmRemuve: function()
    {
        var me = this;

        if (me.grid.selModel.getCount() === 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.removeObjetivoClick, me);
        } else if (me.grid.selModel.getCount() > 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los registros seleccionados?', me.removeObjetivoClick, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el o los registro que desea eliminar.', 'question');
        }
    },
    // Eliminar registro.
    removeObjetivoClick: function (btn)
    {
        if (btn === 'yes') {
            var me = this, ids = [];
            Ext.Array.each(me.grid.selModel.getSelection(), function (row)
            {
                ids.push(row.get('id'));
            });
            Ext.Ajax.request({
                url: entorno+'/indicadores/objetivo/remove',
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


