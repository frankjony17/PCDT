
Ext.define('CDT.view.admin.trabajador.interno.TrabajadorCargoForm', {
    extend: 'Ext.window.Window',
    xtype: 'trabajadorCargoForm',

    title: 'Asignar cargo',
    iconCls: 'tree-cargo',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'center',
    width: 400,
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
                xtype: 'combobox',
                store: Ext.create('CDT.store.admin.CargoStore'),
                anchor: '100%',
                editable: false,
                emptyText: 'Cargo',
                allowBlank: false,
                displayField: 'nombre',
                valueField: 'id',
                selectOnFocus: true
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