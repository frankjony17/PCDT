
Ext.define('CDT.controller.tarea_operativa.responsable.TareaGridController', {
    extend: 'Ext.app.Controller',

    views: [
        'tarea_operativa.especialista.tarea.TareaGrid',
        'tarea_operativa.especialista.accion.AccionForm'
    ],
    init: function()
    {   
        var me = this;
        
        me.control({
            'tareaGrid': {
                resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 50)); },
                render: me.showLegend,
                afterrender: me.afterRenderGrid,
                itemcontextmenu: me.showMenuTarea
            },
            'tareaGrid button[iconCls=legend-user]': {
                click: me.showLegend
            },
            'tareaGrid button[iconCls=add]': {
                click: me.confirmAddAccion
            },
            // ACCIONES FORM
            'accionForm': {
                afterrender: me.afterRenderWindows
            },
            'accionForm button[text=Salvar]': {
                click: me.validateForm
            },
            // MENU CONTEXTUAL
            '#tareas-acciones-add': {
                click: me.showAccionesForm
            }
        });
    },
    afterRenderGrid: function (grid, eOpts)
    { 
        var me = this;
        me.grid = grid;
        me.store = grid.store;
        me.loadStore();
        //me.storeTrabajador = Ext.create('CDT.store.tarea_operativa.especialista.TrabajadorUsersStore');
    },
    loadStore: function ()
    {
        var me = this;
        me.store.load({
            params: { Responsable: "true" }
        });
    },
    // Mostrar Menu Tareas Operativas.
    showMenuTarea: function (view, record, item, index, e)
    {
        var menu = Ext.create('Ext.menu.Menu', {
            title: '<b>['+record.get('numero')+']</b>',
            titleAlign: 'center',
            frame: true,
            defaults: {
                padding: 2
            },
            style: { overflow: 'visible' },
            closeAction : 'destroy',
            width: 185,
            items: [{
                text: 'Adicionar acción',
                iconCls: 'add',
                id: 'tareas-acciones-add'
            }]
        });
        menu.showAt(e.xy);
        e.stopEvent();
    },
    // Verificar que se a seleccionado solo un registro.
    confirmAddAccion: function()
    {
        var me = this;
        if (me.grid.selModel.getCount() === 1)
        {
            me.showAccionesForm();
        }
        else if (me.grid.selModel.getCount() > 1)
        {
            Ext.ex.MessageBox('Atención', 'Solo puede adicionar "ACCIONES" a una Tarea Operativa, por favor <b>seleccione solo una</b>.', 'question');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione una Tarea Operativa para agregar una "ACCIÓN".', 'question');
        }
    },
    // Mostrar Windows Tareas.
    showAccionesForm: function()
    {
        var me = this, record = me.grid.selModel.getSelection()[0];

        Ext.create('CDT.view.tarea_operativa.especialista.accion.AccionForm', {
            btnText: 'Salvar',
            btnIconCls: 'ok',
            title: 'Adicionar acción : <b>[ '+ record.get('numero') +' ]</b>',
            myId: record.get('id')
        });
    },
    //---------------------------------------------------------------------------------------------------
    // Cuando la ventana del formulario es renderiada.
    afterRenderWindows: function (win)
    {
        var me = this;

        me.win = win;
        me.myId = win.myId;
        me.form = win.down('form');
    },
    // Validar formulario.
    validateForm : function (btn)
    {
        var me = this, record = me.form.getForm().getValues();

        if (record.descripcion !== '')
        {
            me.disabledButton(true);
            me.addAccionTareaOperativa(record);
        } else {
            Ext.ex.MessageBox('Atención', '<b>Formulario no válido</b>, verifique la descripción de la accion.', 'info');
        }
    },
    // Adicionar Acción de Tarea Operativa.
    addAccionTareaOperativa: function (record)
    {
        this.ajaxAccionTareaOperativa(entorno+'/tareasoperativas/accion/add', record);
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
                        me.loadStore();
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
        me.win.down('[iconCls=ok]').setDisabled(bool);
        me.win.down('[iconCls=cancel]').setDisabled(bool);
    },
    //---------------------------------------------------------------------------------------------------
    // ToolTip Leyenda (Colores).
    showLegend: function (btn)
    {
        var me = this,
            legend_tip = Ext.create('Ext.tip.ToolTip', {
            autoHide: false,
            shadow: true,
            closable: true,
            closeAction: 'destroy',
            width: 160,
            height: 95,
            id: 'tool-tip-legend-tareas-id',
            title: '<div style="background:#c2edf9;"><center>LEYENDA</center></div>',
            html: '<table>'+
                    '<tr><th width=20 style="background:#ff9999;border: 1px solid #CCC !important;"></th><th style="text-align:left;">Pediente.</th></tr>'+
                    '<tr><th width=20 style="background:rgba(248, 6, 0, 0.88);border: 1px solid #CCC !important;"></th><th style="text-align:left;">Ultimo Día.</th></tr>'+
                    '<tr><th width=20 style="background:rgba(174, 138, 154, 0.62);border: 1px solid #CCC !important;"></th><th style="text-align:left;">Fuera de Término.</th></tr>'+
                  '</table>',
            listeners: {
                 hide: function (tip) {
                    tip.showAt(me.getXYPosition());
                 },
                 close: function () {
                     var obj = Ext.getCmp('legend-tarea-id-0000');

                     if (Ext.isObject(obj))
                     {
                        obj.setDisabled(false);
                     }
                 }
            }
        });
        legend_tip.showAt(me.getXYPosition());
        Ext.getCmp('legend-tarea-id-0000').setDisabled(true);
    },
    // Obtener posicion para el tip leyenda.
    getXYPosition: function ()
    {
        var south_panel = Ext.getCmp('fecha-item-toolbar-status-bar-0000'), xy = [];

        xy.push([south_panel.getX() - 100, south_panel.getY() - 112]);

        return xy;
    }
});


