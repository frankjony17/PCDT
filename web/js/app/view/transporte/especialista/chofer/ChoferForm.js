
Ext.define('CDT.view.transporte.especialista.chofer.ChoferForm', {
    extend: 'Ext.window.Window',
    xtype: 'choferForm',

    title: 'Adicionar chofer',
    iconCls: 'chofer',
    layout: 'fit',
    buttonAlign: 'center',
    width: 700,
    resizable: false,
    modal: true,
    y: 54,
    
    initComponent: function ()
    {
        var me = this;
        
        me.trabajadorStore = Ext.create('CDT.store.admin.TrabajadorStore');
        
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
                xtype: 'fieldset',
                collapsible: true,
                collapsed: true,
                title: 'Filtrar por Área:',
                layout: 'hbox',
                id: 'chofer-fieldset-area',
                items: [{
                    xtype: 'container',
                    flex: 1,
                    border: false,
                    layout: 'anchor',
                    items: [{
                        xtype: 'combobox',
                        emptyText: 'Área',
                        store: Ext.create('CDT.store.admin.AreaStore'),
                        queryMode: 'local',
                        displayField: 'nombre', 
                        anchor: '99%',
                        editable: false
                    }]
                },{
                    xtype: 'button',
                    iconCls: 'trash',
                    anchor: '100%',
                    disabled: true
                }]
            },{
                xtype: 'fieldset',
                layout: 'hbox',
                items: [{
                    xtype: 'container',
                    flex: 3,
                    border: false,
                    layout: 'anchor',
                    items: [{
                        xtype: 'combobox', 
                        fieldLabel: 'Trabajador',
                        emptyText: 'Nombre y Apellidos',
                        name: 'trabajador',
                        store: me.trabajadorStore,
                        queryMode: 'local',
                        displayField: 'nombreApellidos',
                        valueField: 'id',
                        typeAhead: true,
                        selectOnFocus: true,
                        anchor: '98%',
                        editable: false,
                        allowBlank: false
                    }]
                },{
                    xtype: 'container',
                    flex: 1,
                    border: false,
                    layout: 'anchor',
                    defaultType : 'textfield',
                    items: [{
                        fieldLabel: 'Licencia',
                        name: 'licencia',
                        emptyText: 'Número de licencia',
                        anchor: '100%',
                        maskRe: /[A-Z0-9]/,
                        regex: /[A-Z0-9]/,
                        maxLength: 18,
                        minLength:6
                    }]
                }]            
            },{
                xtype: 'fieldset',
                collapsible: true,
                title: 'Otros:',
                layout: 'hbox',
                items: [{
                    xtype: 'container',
                    flex: 2,
                    border: false,
                    layout: 'anchor',
                    items: [{
                        xtype: 'timefield',
                        fieldLabel: 'Hora de parqueo',
                        name: 'horaParqueo',
                        emptyText: 'Hora de parqueo',
                        format: 'H:i:i',
                        minValue: '17:30:00',
                        maxValue: '23:30:00',
                        increment: 30,
                        anchor: '98%',
                        editable: false
                    }]
                },{
                    xtype: 'container',
                    flex: 1,
                    border: false,
                    layout: 'anchor',
                    items: [{
                        xtype: 'combobox',   
                        fieldLabel: 'Profecional',
                        name: 'profecional',
                        store: ['SI', 'NO'],
                        queryMode: 'local',
                        editable: false,
                        emptyText: 'Profecional',
                        anchor: '100%'
                    }]
                }]
            }]
        }];
        me.buttons = [{
            text: me.btnText,
            iconCls: me.btnIconCls,
            action: me.btnAction
        },{
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: function() {
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});