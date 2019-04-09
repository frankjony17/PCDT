
Ext.define('CDT.view.transporte.especialista.chofer.ChangeHorarioParqueoForm', {
    extend: 'Ext.window.Window',
    xtype: 'changeHorarioParqueoForm',

    title: 'Cambiar Horario',
    autoShow: true,
    resizable: false,
    closable: false,
    iconCls: 'change',
    
    plain: true,
    headerPosition: 'bottom',
    layout: 'fit',
    
    width: 350,
    id: 'changeHorarioParqueoForm-id',
    
    initComponent: function () {
        var me = this;
        
        me.items = [
        {
            xtype: 'form',

            padding: '10 10 10 10',
            border: false,
            style: 'background-color: #fff;',

            fieldDefaults: {
                labelAlign: 'top'
            },
            
            items: [{
                xtype:'fieldset',
                title: 'Seleccione un criterio',
                padding: '10 10 10 10',
                layout: 'anchor',

                items: [{
                    xtype: 'combobox', 
                    emptyText: 'Por opciones',
                    name: 'Opciones',
                    store: ['Seleccionados', 'No seleccionados', 'Todos'],
                    queryMode: 'local',
                    anchor: '100%',
                    editable: false,
                    listeners: {
                         'select': function ()
                         {
                             me.down('[name=Cargo]').setValue();
                             me.down('[name=Cargo]').setDisabled(true);
                             me.down('[name=trash]').setDisabled(false);
                         }
                    }
                },{
                    xtype: 'combobox', 
                    emptyText: 'Por cargo',
                    name: 'Cargo',
                    store: Ext.create('CDT.store.admin.CargoStore'),
                    queryMode: 'local',
                    displayField: 'nombre',
                    valueField: 'id',
                    anchor: '100%',
                    editable: false,
                    listeners: {
                         'select': function ()
                         {
                             me.down('[name=Opciones]').setValue();
                             me.down('[name=Opciones]').setDisabled(true);
                             me.down('[name=trash]').setDisabled(false);
                         }
                    }
                },{
                    xtype: 'button',
                    tooltip: 'Limpiar selección',
                    iconCls: 'trash',
                    name: 'trash',
                    disabled: true,
                    handler: function(btn)
                    {
                        btn.setDisabled(true);
                        me.down('[name=Cargo]').setValue();
                        me.down('[name=Opciones]').setValue();
                        me.down('[name=Cargo]').setDisabled(false);
                        me.down('[name=Opciones]').setDisabled(false);
                    }
                }]
            },{
                xtype:'fieldset',
                title: 'Hora de parqueo',
                padding: '10 10 10 10',
                layout: 'anchor',

                items: [{
                    xtype: 'timefield',
                    name: 'horaParqueo',
                    emptyText: 'Hora de parqueo',
                    format: 'H:i:i',
                    minValue: '17:30:00',
                    maxValue: '23:30:00',
                    increment: 30,
                    anchor: '100%',
                    editable: false,
                    allowBlank: false
                }]
            }]
        }];
                
        me.tools = [{
            xtype: 'button',
            text: 'Salvar',
            iconCls: 'ok'
        },{
            xtype: 'button',
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: function(){ 
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});