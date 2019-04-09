
Ext.define('CDT.controller.nomenclador.DepartamentoController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.departamento.DepartamentoGrid'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'departamentoGrid button[action=remove]': {
                click: me.confirmRemuve
            },
            'departamentoGrid': {
                edit: me.edit,
                resize: me.resize,
                afterrender: me.afterrender
            },
            '#ID-pagingtoolbar-combobox-pagina-departamento': {
                select: me.loadPage
            }
        });
    },
    // Cuando el Grid es renderiado
    afterrender: function (grid, eOpts)
    {
        var me = this;
        grid.store.load({ params:{ start: me.startNumber(grid), limit: 25 } });
    },
    // Editar departamento solo telefono. 
    edit: function (editor, context, eOpts)
    {   
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/departamento/edit',
            params: {
                Id       : context.record.get('id'),
                Telefonos: context.record.get('telefonos')
            },
            success: function(response)
            {
                switch(response.responseText)
                {
                    case '':
                        context.grid.store.load();
                        break;
                    default:
                        Ext.ex.MessageBox('Error', response.responseText, 'error');
                        break;
                }
            },
            failure: function()
            {
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
    // Eliminar departamento. 
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
                waitMsg: 'Please Wait',
                url: entorno+'/all/nomenclador/departamento/remove',
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
    // Obtener número de página.
    startNumber: function (grid)
    {
        var store = grid.store, pagingtoolbar = grid.down('pagingtoolbar'),
            start = parseInt(store.pageSize * (pagingtoolbar.down('[itemId=inputItem]').getValue() - 1));
        
        return (start > 0) ? start : 0;
    },
    // Load page from grid.
    loadPage: function (cmb)
    {
        var grid = cmb.up('grid'), store = grid.store;
        
        store.pageSize = cmb.getValue();
        store.loadPage(store.currentPage);
    },
    // Mantiene el grid en una altura de acuerdo al navegador...
    resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 80)); }
});


