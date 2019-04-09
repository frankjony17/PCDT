
Ext.define('CDT.view.transporte.especialista.vehiculo.SitOpeVehiculoForm', {
    extend: 'Ext.window.Window',
    xtype: 'sitOpeVehiculoForm',

    title: 'Cambiar situación operativa',
    iconCls: 'tree-situacionoperativa',
    layout: 'fit',
    autoShow: true,
    closable: false,
    plain: true,
    headerPosition: 'bottom',
    width: 410,
    
    initComponent: function ()
    {
        var me = this;
       //Articulos del Formulario...
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
                xtype        : 'combobox', 
                name         : 'so',
                emptyText    : 'Situación operativa',
                store        : Ext.create('CDT.store.transporte.especialista.SituacionOperativaStore'),
                queryMode    : 'local',
                displayField : 'nombre',
                valueField   : 'id',
                anchor       : '100%',
                editable     : false,
                allowBlank   : false
            }]
        }];
                
        me.tools = [{
            xtype: 'button',
            text: 'Salvar',
            iconCls: 'ok',
            id: 'edit-id'
        },{
            xtype: 'button',
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: {
                    fn: function(){ 
                        me.btn.setDisabled(false);
                        me.close();
                    }
                }
            }
        }];
        me.callParent(arguments);
    }
});