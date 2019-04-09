
Ext.define('CDT.view.control_calidad.especialista.ControlGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'control-grid',

    width: '100%',
    selType: 'checkboxmodel',
    autoScroll: true,
    features: [{
        groupHeaderTpl: 'Tipo: {name}',
        ftype: 'groupingsummary',
        collapsible: true
    }],
    initComponent: function() {
        var me = this; // Ambito del componente.
        // Store
        me.store = Ext.create('CDT.store.control_calidad.ControlStore');
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
            text: 'Fecha',
            dataIndex: 'fecha',
            flex: 1,
            editor: {
                xtype: 'datefield',
                editable: false,
                format: 'Y-m-d',
                allowBlank: false
            }
        },{
            text: 'Ejecutores',
            dataIndex: 'ejecutores',
            flex: 5,
            editor: {
                xtype: 'textfield',
                maxLength: 256,
                allowBlank: false
            }
        },{
            text: 'tipo',
            dataIndex: 'tipo',
            flex: 1,
            hidden: true
        }];
        me.tbar = [{
            text: 'Adicionar',
            iconCls: 'fa fa-plus',
            tooltip: 'Adicionar control',
            id: 'add-grid-control-id'
        },'-',{
            text: 'Eliminar',
            iconCls: 'fa fa-remove',
            tooltip: 'Eliminar control',
            id: 'remove-grid-control-id'
        },'->',
        {
            tooltip: 'Ayuda acerca de control',
            iconCls: 'help'
        }];
        // Plugins para actualizar...
        me.plugins = Ext.create('Ext.grid.plugin.RowEditing', {
            saveBtnText: 'Editar',
            cancelBtnText: 'Cancelar'
        });
        me.callParent(arguments);
    }
});