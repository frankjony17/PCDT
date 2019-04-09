
Ext.define('CDT.controller.email.EmailController', {
    extend: 'Ext.app.Controller',

    views: [
        'admin.email.EmailForm'
    ],
    init: function()
    {   
        var me = this;

        me.control({
            'emailForm': {
                afterrender: me.afterRenderWindows,
                actioncolumnClick: me.removeRowGridForm
            },
            'emailForm button[iconCls=mail-send]': {
                click: me.validateForm
            },
            'emailForm combobox[emptyText=Trabajador]': {
                select: me.addTrabajadorGrid
            }
        });
    },
    // Cuando la ventana del formulario es renderiada.
    afterRenderWindows: function (win, eOpts)
    {
        var me = this;
        me.win = win;
        me.form = win.down('form');
        me.storeTrabajador = win.store;
        me.gridTrabajadorStore = win.gridTrabajadorStore;
    },
    // Validar formulario...
    validateForm : function (btn)
    {
        var me = this, record = me.form.getForm().getValues();

        if (me.win.tipo !== "Responsables")
        {
            if (record.contenido !== '' && me.win.myData.length > 0){
                me.sendOtros(me.form.getForm().getValues());
            } else {
                Ext.ex.MessageBox('Atención', '<b>Formulario no válido</b>, verifique las siguientes acciones:<br><b>&nbsp;&nbsp;&nbsp;&nbsp;1. <span style="color:red;">Listado de destinatarios</span>.<br>&nbsp;&nbsp;&nbsp;&nbsp;2. <span style="color:red;">Contenido del correo electrónico</span>.<br>', 'info');
            }
        } else {
            if (record.contenido !== ''){
                me.sendResponsables(me.form.getForm().getValues());
            } else {
                Ext.ex.MessageBox('Atención', '<b>Formulario no válido</b>, <span style="color:red;">verifique el contenido del correo electrónico</span>.<br>','info');
            }
        }
    },
    sendResponsables: function (record)
    {
        var me = this, pr = me.progress();

        Ext.Ajax.request({
            url: entorno+'/tareasoperativas/email/responsables/send',
            params: {
                Contenido : record.contenido,
                TareaId   : me.win.tarea
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        pr.close();
                        me.win.close();
                        Ext.ex.msg('Envió OK', 'Correo enviado exitosamente.');
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
    sendOtros: function (record)
    {
        var me = this, pr = me.progress();

        Ext.Ajax.request({
            url: entorno+'/tareasoperativas/email/otros/send',
            params: {
                Destinatarios : me.getDestinatarios(),
                Contenido : record.contenido,
                TareaName : me.win.tarea
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        pr.close();
                        me.win.close();
                        Ext.ex.msg('Envió OK', 'Correo enviado exitosamente.');
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
        combo.setValue();
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
    getDestinatarios: function ()
    {
        var me = this, ids = [];

        Ext.Array.each(me.win.myData, function(row)
        {
            ids.push(row[0]);
        });
        return Ext.encode(ids);
    },
    progress: function ()
    {
        return Ext.MessageBox.show({
            msg: 'Enviando mensaje, por favor espere...',
            progressText: '`Progreso...',
            wait: true,
            waitConfig: {
                interval: 200
            },
            icon: 'ext-mb-download',
            iconHeight: 50
        });
    }
});


