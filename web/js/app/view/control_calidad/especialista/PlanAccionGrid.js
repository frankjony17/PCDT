
Ext.define('CDT.view.control_calidad.especialista.PlanAccionGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'plan-accion-grid',

    width: '100%',
    selType: 'checkboxmodel',
    autoScroll: true,

    initComponent: function() {
        var me = this; // Ambito del componente.
        // Store
        me.store = Ext.create('CDT.store.control_calidad.PlanAccionStore');
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
            text: 'Descripción',
            dataIndex: 'descripcion',
            flex: 5,
            editor: {
                xtype: 'textfield',
                maxLength: 120,
                allowBlank: false
            }
        },{
            text: 'Fecha Inicial',
            dataIndex: 'fechainicial',
            flex: 1,
            editor: {
                xtype: 'datefield',
                editable: false,
                format: 'Y-m-d',
                allowBlank: false
            }
        },{
            text: 'Fecha Final',
            dataIndex: 'fechafinal',
            flex: 1,
            editor: {
                xtype: 'datefield',
                editable: false,
                format: 'Y-m-d',
                allowBlank: false
            }
        },{
            xtype: 'checkcolumn',
            text: '(E)',
            dataIndex: 'estado',
            width: 75,
            id: 'checkcolumn-plan-accion-grid'
        }];
        me.tbar = [{
            text: 'Adicionar',
            iconCls: 'fa fa-plus',
            tooltip: 'Adicionar acciones',
            id: 'add-grid-accion-id'
        },'-',{
            text: 'Eliminar',
            iconCls: 'fa fa-remove',
            tooltip: 'Eliminar acciones',
            id: 'remove-grid-accion-id'
        },'->',
        {
            tooltip: 'Ayuda acerca de acciones',
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