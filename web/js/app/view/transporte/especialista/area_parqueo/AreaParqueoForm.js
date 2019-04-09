
Ext.define('CDT.view.transporte.especialista.area_parqueo.AreaParqueoForm', {
    extend: 'Ext.window.Window',
    xtype: 'areaparqueoForm',

    title: 'Adicionar área de parqueo',
    iconCls: 'area-parqueo',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'center',
    width: 575,
    resizable: false,
    modal: true,

    initComponent: function ()
    {
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
                xtype: 'textfield',
                fieldLabel: 'Nombre',
                name: 'Nombre',
                emptyText: 'Nombre del área de parqueo',
                anchor: '100%',
                maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 43,
                allowBlank: false
            }, {
                xtype: 'container',
                layout: 'hbox',
                items: [{
                    xtype: 'container',
                    flex: 2,
                    border: false,
                    layout: 'anchor',
                    defaultType: 'textfield',
                    items: [{
                        fieldLabel: 'Teléfonos',
                        name: 'Telefonos',
                        emptyText: 'Teléfonos',
                        anchor: '100%',
                        maskRe: /[0-9\-\ \,]/,
                        regex: /[0-9]/,
                        maxLength: 43
                    }]
                }]
            }, {
                xtype: 'textarea',
                fieldLabel: 'Dirección',
                name: 'Direccion',
                emptyText: 'Dirección',
                grow: true,
                anchor: '100%',
                maskRe: /[0-9\/\ \,\aA-zZ\.\#\áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 118
            }]
        }];
        me.buttons = [{
            text: 'Salvar',
            iconCls: 'ok'
        },{
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