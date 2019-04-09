
Ext.define('CDT.view.admin.trabajador.externo.TrabajadorAreaForm', {
    extend: 'Ext.window.Window',
    xtype: 'trabajadorAreaForm',

    title: 'Asignar área',
    iconCls: 'tree-area',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'center',
    width: 400,
    resizable: false,
    modal: true,

    initComponent: function ()
    {
        var me = this;
        //-!
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
                store: Ext.create('CDT.store.admin.AreaStore'),
                anchor: '100%',
                editable: false,
                emptyText: 'Seleccione un área.',
                fieldLabel: 'Área',
                allowBlank: false,
                valueField: 'id',
                displayField: 'nombre'
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