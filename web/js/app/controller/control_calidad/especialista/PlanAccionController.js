
Ext.define('CDT.controller.control_calidad.especialista.PlanAccionController', {
    extend: 'Ext.app.Controller',

    control: {
        'plan-accion-grid': {
            resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 62)); },
            afterrender: "afterRenderGrid",
            edit: "edit"
        },
        '#checkcolumn-plan-accion-grid': {
            checkchange: "checkChange"
        },
        '#add-grid-accion-id': {
            click: "showForm"
        },
        '#save-plan-accion-id': {
            click: "validateForm"
        },
        '#remove-grid-accion-id': {
            click: "confirmRemove"
        }
    },
    afterRenderGrid: function (grid) {
        var me = this;
        me.grid = grid;
        me.store = grid.store;
        me.store.load({params:{ pk: me.grid.pk }});
    },
    showForm: function(btn) {
        Ext.create('CDT.view.control_calidad.especialista.PlanAccionForm', {
            store: btn.up('grid').store,
            pk: btn.up('grid').pk
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
            url: '/controlcalidad/planaccion/add',
            params: {
                id: win.pk,
                fechaInicial: record['fechaInicial'],
                fechaFinal: record['fechaFinal'],
                descripcion: record['descripcion']
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        win.store.reload();
                        me.grid.controlCalidadStore.reload();
                        win.close();
                        break;
                    //case 'Unico':
                    //    Ext.ex.MessageBox('Atención', 'Ya existe la acción: <b>'+record['descripcion']+'</b>', 'question');
                    //    form.reset();
                    //    break;
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
            url: '/controlcalidad/planaccion/edit',
            params: {
                id: context.record.get('id'),
                fechaInicial: context.record.get('fechaInicial'),
                fechaFinal: context.record.get('fechaFinal'),
                descripcion: context.record.get('descripcion')
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
    checkChange: function (checkbox, rowIndex, checked, record) {
        var me = this;
        Ext.Ajax.request({
            url: '/controlcalidad/planaccion/estado',
            params: {
                id: record.get('id'),
                estado: checked
            },
            success: function(){
                me.store.reload();
                me.grid.controlCalidadStore.reload();
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
                url: '/controlcalidad/planaccion/remove',
                params: {
                    ids: Ext.encode(ids)
                },
                success: function(){
                    me.store.reload();
                    me.grid.controlCalidadStore.reload();
                },
                failure: function(){
                    Ext.ex.MessageBox('Error','No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
                }
            });
        }
    }
});