
Ext.define('CDT.controller.transporte.especialista.MatriculaController', {
    extend: 'Ext.app.Controller',

    views: [
        'transporte.especialista.matricula.MatriculaGrid',
        'transporte.especialista.matricula.MatriculaForm'
    ],

    init: function()
    {   
        var me = this;
        
        me.control({
            'matriculaGrid': {
                edit: me.edit,
                resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 50)); },
                afterrender: function (grid, eOpts) { var me = this; me.grid = grid; me.store = grid.store; me.loadStore(); },
                itemcontextmenu: me.contextMenu
            },
            'matriculaGrid button[iconCls=change-id]': {
                click: me.confirmEditId
            },
            'matriculaForm button[iconCls=ok]': {
                click: me.validateChangeIdForm
            }
        });
    },
    loadStore: function () { var me = this; me.store.load(); },
/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    // Editar datos de matrícula.
    edit: function (editor, context, eOpts)
    {   
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/transporte/matricula/edit',
            params: {
                Id          : context.record.get('id'),
                Chapa       : context.record.get('chapa'),
                ChapaVieja  : context.record.get('chapaVieja'),
                Circulacion : context.record.get('circulacion'),
                Vencimiento : context.record.get('vencimiento')
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        me.loadStore();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe una Matrícula con estos datos, <b><span style="color:red;">verifique?</span></b>.', 'question');
                        me.loadStore();
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
    // Menu contextual Grid Trabajador Interno
    contextMenu: function (view, record, item, index, e, eOpts)
    {
        var me = this, menu = Ext.create('Ext.menu.Menu');
        
        menu.add({
            text: 'Editar Id',
            iconCls: 'change-id',
            listeners: { 
                click: function() { 
                    me.showChangeId(record.get('id'));
                }
            }
        });
        menu.showAt(e.xy);
        e.stopEvent();        
    },    
    // Verificar que se a seleccionado solo un registro.
    confirmEditId: function()
    {   
        var me = this;
        if (me.grid.selModel.getCount() === 1)
        {
            me.showChangeId(me.grid.selModel.getSelection()[0].get('id'));
        } 
        else if (me.grid.selModel.getCount() > 1)
        {
            Ext.ex.MessageBox('Atención', 'Solo puede editar un registro a la vez, por favor <b>seleccione solo uno</b>.', 'question');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el registro que desea editar.', 'question');
        }
    },
    // Mostrar ventana para actualizar el id de la matricula seleccionada.
    showChangeId: function(id)
    {
        var win = Ext.create('CDT.view.transporte.especialista.matricula.MatriculaForm',{
            matricula_id: id
        }),
        // Obtener formulario contenido en la ventana.
        form = win.down('form');
        // Cargar formulario con los datos del registro seleccionado del grid.
        form.down('[name=id]').setValue(id);
        // Mostrar ventana.
        win.show();
    },
    // Limpiar los componentes unicos del formulario.
    cleanComponentesUnicosForm: function (win)
    {
        var id = win.down('[name=id]');

        id.setValue();
    },    
    // Validar formulario.
    validateChangeIdForm : function (btn)
    {   
        var me = this, win = btn.up('window'), form = win.down('form');

        if (form.getForm().isValid())
        {
            me.editId(form.getForm().getValues(), win);
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    // Editar ID de la matrícula seleccionada.
    editId: function (record, win)
    {   
        var me = this;
        Ext.Ajax.request({
            url: entorno+'/transporte/matricula/edit_id',
            params: {
                Id    : win.matricula_id,
                NewId : record['id']
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        me.loadStore();
                        win.close();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe una Matrícula con estos datos, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'question');
                        me.cleanComponentesUnicosForm(win);
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
});


