
Ext.define('CDT.controller.indicador.ArcController', {
    extend: 'Ext.app.Controller',

    control: {
        'arcgrid': {
            resize: function (grid) {
                grid.setHeight(Ext.ex.height('south-panel-id', 50));
            },
            afterrender: "afterRenderGrid",
            edit: "onRowEditing"
        },
        'arcgrid button[text=Adicionar]': {
            click: "onAddArcClick"
        },
        'arcgrid button[text=Eliminar]': {
            click: "onConfirmRemuve"
        },
        // Formulario
        'arcform': {
            afterrender: "afterRenderForm"
        },
        'arcform button[text=Salvar]': {
            click: "onSubmitClick"
        }
    },

    loadStore: function (date) {
        this.store.load({ params: { Date: date }});
    },
    afterRenderGrid: function(grid)
    {
        this.store = grid.store;
        this.loadStore(fecha_year);
        this.grid = grid;
    },
    afterRenderForm: function(win)
    {
        this.win = win;
        this.form = win.down("form");
    },
    // Mostrar Formulario.
    onAddArcClick: function (btn)
    {
        Ext.create('CDT.view.indicador.especialista.arc.ArcForm');
    },
    // Adicionar ARC
    onSubmitClick: function (btn)
    {
        var me = this, form = me.form.getForm(), record = form.getValues();;

        if (form.isValid())
        {
           form.submit({
                success: function(form, action) {
                    me.store.reload();
                    form.reset();
                    Ext.ex.toast('Creación OK', 'Operación realizada exitosamente.');
                },
                failure: function(form, action) {
                    switch(action.response.responseText) {
                        case 'Unico':
                            Ext.ex.MessageBox('Atención', 'Ya existe el ARC, con el nombre o la descripción: <br><b>"'+ record["Nombre"] +'/'+ record["Descripcion"] +'"</b>', 'question');
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
        Ext.Ajax.request({
            url: entorno+'/indicadores/arc/edit',
            params: {
                Id          : context.record.get('id'),
                Nombre      : context.record.get('nombre'),
                Descripcion : context.record.get('descripcion')
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        context.grid.store.reload();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el ARC, con el nombre o la descripción: <br><b>"'+ context.record.get('nombre') +'/'+ context.record.get('descripcion') +'"</b>', 'question');
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
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.removeArcClick, me);
        } else if (me.grid.selModel.getCount() > 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los registros seleccionados?', me.removeArcClick, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el o los registro que desea eliminar.', 'question');
        }
    },
    // Eliminar registro.
    removeArcClick: function (btn)
    {
        if (btn === 'yes') {
            var me = this, ids = [];
            Ext.Array.each(me.grid.selModel.getSelection(), function (row)
            {
                ids.push(row.get('id'));
            });
            Ext.Ajax.request({
                url: entorno+'/indicadores/arc/remove',
                params: {
                    ids:  Ext.encode(ids)
                },
                success: function(response){
                    switch (response.responseText) {
                        case '':
                            me.grid.store.reload();
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


