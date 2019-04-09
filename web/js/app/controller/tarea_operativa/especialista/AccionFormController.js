
Ext.define('CDT.controller.tarea_operativa.especialista.AccionFormController', {
    extend: 'Ext.app.Controller',

    views: [
        'tarea_operativa.especialista.accion.AccionForm'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'accionForm': {
                afterrender: me.afterRenderWindows
            },
            'accionForm button[text=Salvar]': {
                click: me.validateForm
            },
            'accionForm button[iconCls=edit]': {
                click: me.validateForm
            },

        });
    },
    // Cuando la ventana del formulario es renderiada.
    afterRenderWindows: function (win)
    {
        var me = this;

        me.win = win;

        if (win.btnText === "Editar")
        {
            var data = win.myId.split('-|#|-');
            me.myId = data[0];
            win.down("[emptyText=Descripción]").setValue(data[1]);
        } else {
            me.myId = win.myId;
        }
        me.form = win.down('form');
        me.store = Ext.data.StoreManager.lookup('tareaStore');
    },
    // Validar formulario.
    validateForm : function (btn)
    {  
        var me = this, record = me.form.getForm().getValues();

        if (record.descripcion !== '')
        {
            me.disabledButton(true);
            
            if (btn.text === 'Salvar') {
                me.addAccionTareaOperativa(record);
            } else {
                me.editAccionTareaOperativa(record);
            }
        } else {
            Ext.ex.MessageBox('Atención', '<b>Formulario no válido</b>, verifique la descripción de la accion.', 'info');
        }
    },
    // Adicionar Acción de Tarea Operativa.
    addAccionTareaOperativa: function (record)
    {
        this.ajaxAccionTareaOperativa(entorno+'/tareasoperativas/accion/add', record);
    },
    // Editar Acción de Tarea operativa.
    editAccionTareaOperativa: function (record)
    {
        this.ajaxAccionTareaOperativa(entorno+'/tareasoperativas/accion/edit', record);
    },
    // Ejecutar Ajax.
    ajaxAccionTareaOperativa: function (url, record)
    {
        var me = this;
        
        Ext.Ajax.request({
            url: url,
            params: {
                Id: me.myId,
                Descripcion: record.descripcion
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        me.store.load();
                        me.win.close();
                        break;
                    case 'Unico':
                        Ext.ex.MessageBox('Atención', 'Ya existe la Acción: <br><b>'+record.descripcion+'</b>', 'question');
                        me.form.down('[emptyText=Descripción]').setValue();
                        me.disabledButton(false);
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
    disabledButton: function (bool)
    {
        var me = this;
        
        me.win.down('[iconCls=cancel]').setDisabled(bool);
        Ext.isObject(me.win.down('[iconCls=ok]')) ? me.win.down('[iconCls=ok]').setDisabled(bool) : me.win.down('[iconCls=edit]').setDisabled(bool);
    }
});


