
Ext.define('CDT.controller.nomenclador.CargoController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.cargo.CargoGrid',
        'admin.cargo.CargoForm'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'cargoGrid button[action=save]': {
                click: me.showCargo
            },
            'cargoGrid button[action=remove]': {
                click: me.confirmRemuve
            },
            'cargoGrid': {
                edit: me.edit,
                resize: me.resize
            },
            // Formulario 
            'cargoForm button[action=save]': {
                click: me.validateForm
            }
        });
    },
    // Mostrar Windows cargo.
    showCargo: function(btn)
    {   
        Ext.create('CDT.view.admin.cargo.CargoForm', {
            store: btn.up('grid').store
        });
    },
    // Validar formulario.
    validateForm : function (btn)
    {   
        var me = this, win = btn.up('window'), form = win.down('form');

        if (form.getForm().isValid()) {
            me.addCargo(form.getForm().getValues(), win.store, form.getForm());
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    // Insertar datos.
    addCargo: function (record, store, form)
    {   
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/cargo/add',
            params: {
                Nombre      : record['Nombre'],
                Descripcion : record['Descripcion']
            },
            success: function (response)
            {
                switch (response.responseText)
                {
                    case '':
                        store.load();
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        form.reset();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el Cargo: <b>'+record['Nombre']+'</b>', 'question');
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
    // Editar datos.
    edit: function (editor, context, eOpts)
    {   
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/cargo/edit',
            params: {
                Id          : context.record.get('id'),
                Nombre      : context.record.get('nombre'),
                Descripcion : context.record.get('descripcion')
            },
            success: function(response)
            {
                switch(response.responseText)
                {
                    case '':
                        context.grid.store.load();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el Cargo: <b>'+newValues.nombre+'</b>', 'question');
                        context.grid.store.load();
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
    confirmRemuve: function(btn)
    {   
        var me = this; me.grid = btn.up('grid');

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
                url: entorno+'/all/nomenclador/cargo/remove',
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
    // Mantiene el grid en una altura de acuerdo al navegador.
    resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 80)); }
});


