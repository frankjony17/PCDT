
Ext.define('CDT.controller.nomenclador.AreaController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.area.AreaGrid',
        'admin.area.AreaForm'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'areaGrid': {
                edit: me.edit,
                resize: me.resize
            },
            'areaGrid button[iconCls=add]': {
                click: me.showArea
            },
            'areaGrid button[iconCls=remove]': {
                click: me.confirmRemuve
            },
            // Formulario 
            'areaForm button[iconCls=ok]': {
                click: me.validateForm
            }
        });
    },
    // Mostrar Windows area.
    showArea: function(btn)
    {   
        Ext.create('CDT.view.admin.area.AreaForm', {
            store: btn.up('grid').store
        });
    },
    // Validar formulario... 
    validateForm : function (btn)
    {   
        var me = this, win = btn.up('window'), form = win.down('form');

        if (form.getForm().isValid()) {
            me.addArea(form.getForm().getValues(), win.store, form.getForm());
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    // Insertar datos.
    addArea: function (record, store, form)
    {
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/area/add',
            params: {
                Area : record['Nombre']
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        store.load();
                        Ext.ex.msg('Creación OK', 'Operación realizada exitosamente.');
                        form.reset();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el Área: <b>'+record['Nombre']+'</b>', 'question');
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
            url: entorno+'/all/nomenclador/area/edit',
            params: {
                Id   : context.record.get('id'),
                Area : context.record.get('nombre')
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        context.grid.store.load();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe el Área: <b>'+context.record.get('nombre')+'</b>', 'question');
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
                url: entorno+'/all/nomenclador/area/remove',
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
    // Mantiene el grid en una altura de acuerdo al navegador...
    resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 80)); }
});


