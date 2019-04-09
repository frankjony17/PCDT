
Ext.define('CDT.controller.control_calidad.especialista.ControlCalidadFormController', {
    extend: 'Ext.app.Controller',

    control: {
        'control-calidad-form': {
            close: "cleanData",
            afterrender: "afterRenderForm",
            actioncolumnClick: "removeRowGridForm"
        },
        'control-calidad-form combobox[id=panel-ejecuta-id]': {
            select: "addTrabajadorGrid"
        },
        '#save-control-calidad': {
            click: "validateForm"
        },
        '#edit-control-calidad': {
            click: "validateForm"
        }
    },
    afterRenderForm: function (win) {
        var me = this;
        me.win = win;
        me.store = win.store;
        me.storeTrabajador = win.storeTrabajador;
        me.gridTrabajadorStore = win.gridTrabajadorStore;
    },
    validateForm: function (btn) {
        var me = this;
        if (this.isValid()) {
            if (btn.text == 'Salvar') {
                me.addControlCalidad(
                    Ext.getCmp("panel-name-id"),
                    Ext.getCmp("panel-observaciones-id"),
                    Ext.getCmp("panel-participantes-id"),
                    Ext.getCmp("panel-control-id"),
                    Ext.getCmp("panel-tipo-id"),
                    Ext.getCmp("panel-fecha-id"),
                    me.win.myData
                );
            } else {
                me.editControlCalidad(
                    me.win.controlCalidadId,
                    Ext.getCmp("panel-name-id"),
                    Ext.getCmp("panel-observaciones-id"),
                    Ext.getCmp("panel-participantes-id"),
                    Ext.getCmp("panel-control-id"),
                    Ext.getCmp("panel-tipo-id"),
                    Ext.getCmp("panel-fecha-id"),
                    me.win.myData
                );
            }
        } else {
            Ext.Msg.show({ title: 'Atención', message: '<b>Formulario no válido</b>, verifique las casillas en <span style="color:red;">rojo</span>.<br>Seleccione los Ejecutantes...', buttons:Ext.MessageBox.OK, icon: Ext.Msg.QUESTION });
        }
    },
    isValid: function () {
        var count = 0;
        if (Ext.getCmp("panel-name-id").isValid()) {
            count++;
        }
        if (Ext.getCmp("panel-control-id").isValid()) {
            count++;
        }
        if (Ext.getCmp("panel-tipo-id").isValid()) {
            count++;
        }
        if (count == 3 && this.win.myData.length > 0) {
            return true;
        }
        return false;
    },
    addControlCalidad: function (nombre, observaciones, participantes, control, tipo, fecha, data) {
        var me = this; Ext.Ajax.request({
            url: "/controlcalidad/cc/add",
            params: {
                nombre: nombre.getValue(),
                observaciones: observaciones.getValue(),
                participantes: participantes.getValue(),
                control: control.getValue(),
                tipo: tipo.getValue(),
                fecha: fecha.getValue(),
                trabajadores: Ext.encode(data)
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        me.cleanData();
                        me.store.load();
                        me.win.close();
                        break;
                    case 'UNICO':
                        Ext.Msg.show({ title: 'Atención', message: 'Ya existe un elemento con este nombre. (Brechas | No Conformidades | Otros)', buttons:Ext.MessageBox.OK, icon: Ext.Msg.QUESTION });
                        nombre.setValue();
                        control.setValue();
                        break;
                    default:
                        Ext.Msg.show({ title: 'Error', message: response.responseText, buttons:Ext.MessageBox.OK, icon: Ext.Msg.ERROR });
                        break;
                }
            },
            failure: function () {
                Ext.Msg.show({ title: 'Error', message: 'No se pudo conectar con el servidor, intentelo mas tarde.', buttons:Ext.MessageBox.OK, icon: Ext.Msg.ERROR });
            }
        });
    },
    editControlCalidad: function (id, nombre, observaciones, participantes, control, tipo, fecha, data) {
        var me = this; Ext.Ajax.request({
            url: "/controlcalidad/cc/edit",
            params: {
                id: id,
                nombre: nombre.getValue(),
                observaciones: observaciones.getValue(),
                participantes: participantes.getValue(),
                tipo: tipo.getValue(),
                fecha: fecha.getValue(),
                trabajadores: Ext.encode(data)
            },
            success: function (response) {
                switch (response.responseText) {
                    case '':
                        me.cleanData();
                        me.store.load();
                        me.win.close();
                        break;
                    case 'UNICO':
                        Ext.Msg.show({ title: 'Atención', message: 'Ya existe un elemento con este nombre. (Brechas | No Conformidades | Otros)', buttons:Ext.MessageBox.OK, icon: Ext.Msg.QUESTION });
                        nombre.setValue();
                        control.setValue();
                        break;
                    default:
                        Ext.Msg.show({ title: 'Error', message: response.responseText, buttons:Ext.MessageBox.OK, icon: Ext.Msg.ERROR });
                        break;
                }
            },
            failure: function () {
                Ext.Msg.show({ title: 'Error', message: 'No se pudo conectar con el servidor, intentelo mas tarde.', buttons:Ext.MessageBox.OK, icon: Ext.Msg.ERROR });
            }
        });
    },
    addTrabajadorGrid: function (combo, record) {
        var me = this, data = record['data'], row;
        row = [data['id'], data['nombreApellidos']];
        if (me.inArray(data['id'])) {
            me.win.myData.push(row);
            me.loadData();
        }
    },
    inArray: function(id) {
        var me = this;
        for (var i = 0; i < me.win.myData.length; i++) {
            if (me.win.myData[i][0] === id) {
                return false;
            }
        }
        return true;
    },
    removeRowGridForm: function (value) {
        var me = this, grid = value[0], rowIndex = value[1], rec = grid.getStore().getAt(rowIndex);
        for (var i = 0; i < me.win.myData.length; i++) {
            if (me.win.myData[i][0] === rec.data.id) {
                me.win.myData.splice(i,1);
                return me.loadData();
            }
        }
    },
    loadData: function () {
        var me = this;
        me.gridTrabajadorStore.loadData(me.win.myData);
    },
    cleanData: function () {
        var me = this;
        me.win.myData = [];
        me.loadData();
    }
});


