
Ext.define('CDT.view.indicador.especialista.arc.ArcForm', {
    extend: 'Ext.window.Window',
    xtype: 'arcform',

    title: 'Adicionar Área de Resultado Clave (ARC)',
    iconCls: 'fa fa-sitemap',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'center',
    width: 475,
    resizable: false,
    modal: true,
    bodyPadding: 10,

    initComponent: function ()
    {
        var me = this;
        
        me.items = [{
            xtype: 'form',
            url: entorno+'/indicadores/arc/add',
            padding: '10 10 10 10',
            frame: false,
            fieldDefaults: {
                labelAlign: 'top',
                anchor: '100%',
                allowBlank: false
            },
            items: [{
                xtype: 'textfield',
                fieldLabel: 'Nombre',
                name: 'Nombre',
                emptyText: 'ARC',
                maxLength: 20
            },{
                xtype: 'textareafield',
                fieldLabel: 'Descripción',
                name: 'Descripcion',
                emptyText: 'Descripción',
                grow: true
            }]
        }];

        me.buttons = [{
            text: 'Salvar',
            iconCls: 'fa fa-check'
        },{
            text: 'Cancelar',
            iconCls: 'fa fa-ban',
            listeners: {
                click: function(){ 
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});