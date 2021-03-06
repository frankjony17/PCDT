
Ext.define('CDT.controller.control_calidad.especialista.ControlController', {
    extend: 'Ext.app.Controller',

    control: {
        'control-grid': {
            resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 62)); },
            afterrender: "afterRenderGrid",
            edit: "edit"
        },
        '#add-grid-control-id': {
            click: "showForm"
        },
        '#save-control-id': {
            click: "validateForm"
        },
        '#remove-grid-control-id': {
            click: "confirmRemove"
        }
    },
    afterRenderGrid: function (grid) {
        var me = this;
        me.grid = grid;
        me.store = grid.store;
    },
    showForm: function(btn) {
        Ext.create('CDT.view.control_calidad.especialista.ControlForm', {
            store: btn.up('grid').store
        });
    },
    validateForm : function (btn) {
        var me = this, win = btn.up('window'), form = win.down('form');
        if (form.getForm().isValid()) {
            me.add(form.getForm().getValues(), win);
        } else {
            Ext.ex.MessageBox('Atención', '<b><span style="color:red;">Formulario no válido</span></b>, verifique las casillas en <b><span style="color:red;">rojo</span></b>.', 'info');
        }
    },
    add: function (record, win) {
        var me = this;
        Ext.Ajax.request({
            url: '/controlcalidad/control/add',
            params: {
                fecha: record['fecha'],
                ejecutores: record['ejecutores'],
                controlTipo: record['tipo']
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        win.store.reload();
                        win.close();
                        break;
                    default:
                        Ext.ex.MessageBox('Error', response.responseText, 'error');
                        break;
                }
            },
            failure: function () {
                Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
            }
        });
    },
    edit: function (editor, context, eOpts) {
        Ext.Ajax.request({
            url: '/controlcalidad/control/edit',
            params: {
                id: context.record.get('id'),
                fecha: context.record.get('fecha'),
                ejecutores: context.record.get('ejecutores')
                //controlTipo: context.record.get('tipo')
            },
            success: function(response){
                switch(response.responseText){
                    case '':
                        context.grid.store.reload();
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
                url: '/controlcalidad/control/remove',
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
    }
});