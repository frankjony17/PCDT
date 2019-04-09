
Ext.define('CDT.view.tarea_operativa.especialista.accion.AccionForm', {
    extend: 'Ext.window.Window',
    xtype: 'accionForm',

    iconCls: 'tareas-acciones',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'right',
    headerPosition: 'bottom',
    width: 950,
    resizable: false,
    closable: false,
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
                xtype: 'fieldset',
                layout: 'anchor',
                title: 'Descripción de la acción',
                items: [{
                    xtype: 'container',
                    border: false,
                    layout: 'hbox',
                    items: [{
                        xtype: 'textareafield',
                        emptyText: 'Descripción',
                        grow: true,
                        name: 'descripcion',
                        margin: '0 0 10 0',
                        height: 350,
                        flex: 1
                    }]      
                }]
            }]
        }];
        me.tools = [{
            xtype: 'button',
            text: me.btnText,
            iconCls: me.btnIconCls
        },{
            xtype: 'tbspacer', width: 5
        },{
            xtype: 'button',
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: function () { 
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});