
Ext.define('CDT.view.indicador.especialista.objetivo.ObjetivoGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'objetivo-grid',

    width: '100%',
    selType: 'checkboxmodel',
    autoScroll: true,

    features: [{
        groupHeaderTpl: 'ARC: {name}',
        ftype: 'groupingsummary',
        collapsible: true
    }],

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.indicador.ObjetivoStore');
        // Modelo de columna      
        me.columns = [{
            xtype : 'rownumberer',
            text  : 'No',
            width : 40,
            align : 'center'
        },{
            text: 'Id',
            dataIndex: 'id',
            width: 35,
            hidden: true
        },{
            text: 'Tipo',
            dataIndex: 'tipo_objetivo',
            flex: 1,
            editor: {
                xtype: 'combobox',
                store: Ext.create("CDT.store.indicador.TipoObjetivoStore"),
                queryMode: 'local',
                displayField: 'nombre'
            }
        },{
            text: 'Nombre',
            dataIndex: 'nombre',
            flex: 1,
            editor: {
                xtype: 'textfield',
                maxLength: 20,
                allowBlank: false
            }
        },{
            text: 'Descripción',
            dataIndex: 'descripcion',
            flex: 7,
            editor: {
                xtype: 'textareafield',
                grow: true,
                allowBlank: false
            }
        }];
        // Articulos de topbar: barra superior    
        me.tbar = [{
            text: 'Adicionar',
            tooltip: 'Adicionar Área de Resultado Clave (ARC).',
            iconCls: 'fa fa-plus'
        },{
            text: 'Eliminar',
            tooltip: 'Eliminar Área de Resultado Clave (ARC).',
            iconCls: 'fa fa-trash'
        },'->',
        {
            tooltip: 'Ayuda acerca de Área de Resultado Clave (ARC).',
            iconCls: 'fa fa-question'
        }];
        // Plugins para actualizar...
        me.plugins = Ext.create('Ext.grid.plugin.RowEditing', {
            saveBtnText: 'Editar',
            cancelBtnText: 'Cancelar',
            autoCancel: true
        }); 
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});