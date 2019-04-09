
Ext.define('CDT.controller.nomenclador.UnidadOrganizativaController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.uo.UnidadOrganizativaGrid'
    ],
    init: function()
    {
        var me = this;
        
        me.control({
            'uoGrid': {
                resize: me.resize,
                edit: me.edit
            }
        });
    },
    // Editar datos... 
    edit: function (editor, context, eOpts)
    {   
        Ext.Ajax.request({
            url: entorno+'/all/nomenclador/uo/edit',
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
            failure: function(){
                Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
            }
        }); 
    },
    // Mantiene el grid en una altura de acuerdo al navegador...
    resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 80)); }
});


