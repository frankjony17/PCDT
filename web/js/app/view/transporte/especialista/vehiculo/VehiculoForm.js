
Ext.define('CDT.view.transporte.especialista.vehiculo.VehiculoForm', {
    extend: 'Ext.window.Window',
    xtype: 'vehiculoForm',

    title: 'Adicionar vehículo',
    iconCls: 'vehiculo',
    layout: 'fit',
    buttonAlign: 'center',
    width: 700,
    resizable: false,
    modal: true,

    initComponent: function ()
    {
        var me = this;
        // Articulos del Formulario.
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
                title: 'Matrícula',
                layout: 'anchor',
                items: [{
                    xtype: 'container',
                    flex: 1,
                    border: false,
                    layout: 'hbox',
                    defaults: { flex: 1 },
                    defaultType: 'textfield',
                    items: [{
                        fieldLabel: 'Chapa Actual',
                        name: 'chapa',
                        emptyText: 'Chapa Actual',
                        margin: '0 5 0 0',
                        maskRe: /[A-Z0-9]/,
                        regex: /[A-Z0-9]/,
                        maxLength: 18,
                        minLength: 6,
                        allowBlank: false   
                    },{
                        fieldLabel: 'ID Aplicación-Habana',
                        name: 'matriculaId',
                        emptyText: 'ID Aplicación-Habana',
                        maskRe: /[0-9]/,
                        regex: /[0-9]/,
                        maxLength: 10,
                        minLength: 4,
                        allowBlank: false
                    }]
                },{
                    xtype: 'fieldset',
                    collapsible: true,
                    collapsed: true,
                    title: 'Otros',
                    layout: 'hbox',
                    items: [{
                        xtype: 'container',
                        flex: 1,
                        border: false,
                        layout: 'anchor',
                        defaultType: 'textfield',
                        items: [{
                            fieldLabel: 'Chapa Vieja',
                            name: 'chapaVieja',
                            emptyText: 'Capa vieja',
                            anchor: '98%',
                            maskRe: /[A-Z0-9]/,
                            regex: /[A-Z0-9]/,
                            maxLength: 18,
                            minLength:6
                        }]
                    },{
                        xtype: 'container',
                        flex: 1,
                        border: false,
                        layout: 'anchor',
                        defaultType: 'textfield',
                        items: [{
                            fieldLabel: 'Circulación',
                            name: 'circulacion',
                            emptyText: 'Circulación',
                            anchor: '98%',
                            maskRe: /[A-Z0-9]/,
                            regex: /[A-Z0-9]/,
                            maxLength: 18,
                            minLength:6
                        }]
                    },{
                        xtype: 'container',
                        flex: 1,
                        border: false,
                        layout: 'anchor',
                        items: [{
                            xtype: 'datefield',
                            fieldLabel: 'Vencimiento',
                            name: 'vencimiento',
                            emptyText: 'Vencimiento',
                            anchor: '100%',
                            format: 'Y-m-d',
                            editable: false
                        }]
                    }]
                }]
            },{
                xtype: 'fieldset',
                collapsible: true,
                title: 'Vehículo',
                layout: 'anchor',
                items: [{
                    xtype: 'container',
                    flex: 1,
                    border: false,
                    layout: 'hbox',
                    defaults: { flex: 1 },
                    items: [{
                        xtype: 'combobox', 
                        fieldLabel: 'Área',
                        name: 'area',
                        emptyText: 'Área a la que pertenece.',
                        store: Ext.create('CDT.store.admin.AreaStore'),
                        queryMode: 'local',
                        displayField: 'nombre',
                        valueField: 'id',
                        margin: '0 5 0 0',
                        editable: false,
                        allowBlank: false
                    },{
                        xtype: 'combobox', 
                        fieldLabel: 'Área de Parqueo',
                        name: 'areaParqueo',
                        emptyText: 'Área de Parqueo',
                        store: Ext.create('CDT.store.transporte.especialista.AreaParqueoStore'),
                        queryMode: 'local',
                        displayField: 'nombre',
                        valueField: 'id',
                        margin: '0 5 0 0',
                        editable: false,
                        allowBlank: false
                    }]
                },{
                    xtype: 'fieldset',
                    collapsible: true,
                    collapsed: true,
                    title: 'Otros',
                    layout: 'hbox',
                    items: [{
                        xtype: 'container',
                        flex: 1,
                        border: false,
                        layout: 'anchor',
                        defaultType: 'textfield',
                        items: [{
                            fieldLabel: 'Marca',
                            name: 'marca',
                            emptyText: 'Marca',
                            anchor: '98%',
                            maxLength: 40
                        }]
                    },{
                        xtype: 'container',
                        flex: 1,
                        border: false,
                        layout: 'anchor',
                        defaultType: 'textfield',
                        items: [{
                            fieldLabel: 'Modelo',
                            name: 'modelo',
                            emptyText: 'Modelo',
                            anchor: '98%',
                            maxLength: 40
                        }]
                    },{
                        xtype: 'container',
                        flex: 1,
                        border: false,
                        layout: 'anchor',
                        defaultType: 'textfield',
                        items: [{
                            fieldLabel: 'Tipo',
                            name: 'tipo',
                            emptyText: 'Tipo',
                            anchor: '98%',
                            maxLength: 40
                        }]
                    }]
                }]
            }]
        }];
        // buttons.
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