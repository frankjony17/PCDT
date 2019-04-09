
Ext.define('CDT.view.indicador.especialista.objetivo.ObjetivoForm', {
    extend: 'Ext.window.Window',
    xtype: 'objetivo-form',

    title: 'Adicionar Objetivos (Estratégicos/Anuales)',
    iconCls: 'fa fa-tasks',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'center',
    width: 547,
    resizable: false,
    modal: true,
    bodyPadding: 10,

    initComponent: function ()
    {
        var me = this;
        
        me.items = [{
            xtype: 'form',
            url: entorno+'/indicadores/objetivo/add',
            bodyPadding: 10,
            fieldDefaults: {
                labelAlign: 'top',
                anchor: '100%',
                allowBlank: false
            },
            items: [{
                xtype: 'fieldcontainer',
                layout: 'hbox',
                items: [{
                    xtype: 'combobox',
                    fieldLabel: 'ARC',
                    name: 'Arc',
                    emptyText: 'Adicionar Área de Resultado Clave',
                    store: Ext.create("CDT.store.indicador.ArcStore", { autoLoad: true }),
                    queryMode: 'local',
                    displayField: 'nombre',
                    valueField: 'id',
                    editable: false,
                    margin: '0 5 0 0',
                    flex: 10
                },{
                    xtype: 'combobox',
                    fieldLabel: 'Tipo de objetivo',
                    name: 'TipoObjetivo',
                    emptyText: 'Tipo de Objetivo',
                    store: Ext.create("CDT.store.indicador.TipoObjetivoStore"),
                    queryMode: 'local',
                    displayField: 'nombre',
                    valueField: 'id',
                    triggerAction: 'all',
                    forceSelection: true,
                    editable: false,
                    flex: 10
                }]
            },{
                xtype: 'textfield',
                fieldLabel: 'Nombre',
                name: 'Nombre',
                emptyText: 'Objetivos',
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