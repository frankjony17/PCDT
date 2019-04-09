
Ext.define('CDT.controller.control_calidad.especialista.ControlCalidadGridController', {
    extend: 'Ext.app.Controller',

    control: {
        'control-calidad-grid': {
            resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 62)); },
            afterrender: "afterRenderGrid",
            itemcontextmenu: "onItemContextMenu"
        },
        '#toolbar-combobox-tipo': {
            select: "onSelectTipo"
        },
        '#toolbar-combobox-estado': {
            select: "onSelectEstado"
        },
        '#fecha-inicial-date': {
            select: "onSelectFechaInicial"
        },
        '#fecha-final-date': {
            select: "onSelectFechaFinal"
        },
        '#fecha-remove-filter': {
            click: "onClickRemoveFilter"
        },
        '#add-grid-id': {
            click: "onButtonGridAdd"
        },
        '#edit-grid-id': {
            click: "onConfirmEdit"
        },
        '#remove-grid-id': {
            click: "confirmRemove"
        }
    },
    afterRenderGrid: function (grid) {
        this.grid = grid;
        this.store = grid.getStore();
        this.tipo = grid.down('[id=toolbar-combobox-tipo]');
        this.estado = grid.down('[id=toolbar-combobox-estado]');
        this.fechaInicial = grid.down('[id=fecha-inicial-date]');
        this.fechaFinal = grid.down('[id=fecha-final-date]');
        this.storeTrabajador = Ext.create('CDT.store.tarea_operativa.especialista.TrabajadorUsersStore');
    },
    onButtonGridAdd: function (){
        var me = this;
        Ext.create('CDT.view.control_calidad.especialista.ControlCalidadForm', {
            store: me.store,
            btnText: 'Salvar',
            storeTrabajador: me.storeTrabajador
        });
    },
    onSelectTipo: function (combo) {
        var me = this;
        this.store.load({
            params: {
                tipo: combo.getValue(),
                estado: me.estado.getValue(),
                fechainicial: me.fechaInicial.getValue(),
                fechafinal: me.fechaFinal.getValue()
            }
        });
    },
    onSelectEstado: function (combo) {
        var me = this;
        this.store.load({
            params: {
                tipo: me.tipo.getValue(),
                estado: combo.getValue(),
                fechainicial: me.fechaInicial.getValue(),
                fechafinal: me.fechaFinal.getValue()
            }
        });
    },
    onSelectFechaInicial: function (date) {
        var me = this;
        this.store.load({
            params: {
                tipo: me.tipo.getValue(),
                estado: me.estado.getValue(),
                fechainicial: date.getValue(),
                fechafinal: me.fechaFinal.getValue()
            }
        });
    },
    onSelectFechaFinal: function (date) {
        var me = this;
        this.store.load({
            params: {
                tipo: me.tipo.getValue(),
                estado: me.estado.getValue(),
                fechainicial: me.fechaInicial.getValue(),
                fechafinal: date.getValue()
            }
        });
    },
    onClickRemoveFilter: function () {
        this.store.load();
        this.tipo.setValue();
        this.estado.setValue();
        this.fechaInicial.setValue();
        this.fechaFinal.setValue();
    },
    onConfirmEdit: function () {
        var me = this;
        if (me.grid.selModel.getCount() === 1){
            me.showEditForm();
        }
        else if (me.grid.selModel.getCount() > 1){
            Ext.ex.MessageBox('Atención', 'Solo puede editar un registro a la vez, por favor <b>seleccione solo uno</b>.', 'question');
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el registro que desea editar.', 'question');
        }
    },
    showEditForm: function(){
        var me = this, record = me.grid.selModel.getSelection()[0],
            win = Ext.create('CDT.view.control_calidad.especialista.ControlCalidadForm', {
                title: 'Brechas | No Conformidades | Otros',
                btnText: 'Editar',
                id: 'edit-control-calidad',
                storeTrabajador: me.storeTrabajador,
                controlCalidadId: record.get('id'),
                store: me.store
            });
        Ext.getCmp('panel-name-id').setValue(record.get('nombre'));
        Ext.getCmp('panel-observaciones-id').setValue(record.get('observaciones'));
        Ext.getCmp('panel-participantes-id').setValue(record.get('participan'));
        Ext.getCmp('panel-control-id').setValue(record.get('controlcalidad'));
        Ext.getCmp('panel-tipo-id').setValue(record.get('tipo'));
        Ext.getCmp('panel-fecha-id').setValue(record.get('fecha'));
        me.getDataGridForm(record, win.gridTrabajadorStore, win);
        // Mostrar ventana.
        win.show();
    },
    getDataGridForm: function (record, gridTrabajadorStore, win)
    {
        var me = this, ids = record.get('trabajadores_ids').split('-'), index, row, myData = [];

        Ext.Array.each(ids, function(id, index)
        {
            index = me.storeTrabajador.find('id', id);
            row = me.storeTrabajador.getAt(index);

            if (row !== null) {
                myData.push([row.get('id'), row.get('nombreApellidos')]);
            }
        });
        win.myData = myData;
        gridTrabajadorStore.loadData(myData);
    },
    confirmRemove: function() {
        var me = this;
        if (me.grid.selModel.getCount() === 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar el registro seleccionado?', me.remove, me);
        } else if (me.grid.selModel.getCount() > 1) {
            Ext.MessageBox.confirm('Confirmación', 'Desea eliminar los registros seleccionados?', me.remove, me);
        } else {
            Ext.ex.MessageBox('Atención', 'Seleccione el o los registro que desea eliminar.', 'question');
        }
    },
    remove: function (btn) {
        if (btn === 'yes') {
            var me = this, ids = [];
            Ext.Array.each(me.grid.selModel.getSelection(), function (row) {
                ids.push(row.get('id'));
            });
            Ext.Ajax.request({
                url: '/controlcalidad/cc/remove',
                params: {
                    ids: Ext.encode(ids)
                },
                success: function(){
                    me.store.reload();
                },
                failure: function(){
                    Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
                }
            });
        }
    },
    onItemContextMenu: function (view, record, item, index, e) {
        var item1, me = this;
        if (record.get('estado') == true) {
            item1 = {
                text: 'Activar seguimiento (<b>ESTADO</b>)',
                iconCls: 'menu-activar-item',
                action: false
            };
        } else {
            item1 = {
                text: 'Desactivar seguimiento (<b>ESTADO</b>)',
                iconCls: 'menu-dasactivar-item',
                action: true
            };
        }
        var menu = Ext.create('Ext.menu.Menu',{
            plain: true,
            width: 250,
            items: [ item1 ],
            listeners: {
                click: function (menu, item) {
                    Ext.Ajax.request({
                        url: '/controlcalidad/cc/estado',
                        params: {
                            id: record.get('id'),
                            estado: item.action
                        },
                        success: function(){
                            me.store.reload();
                        },
                        failure: function(){
                            Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
                        }
                    });
                }
            }
        });
        menu.showAt(e.getXY());
        e.stopEvent();
    }
});