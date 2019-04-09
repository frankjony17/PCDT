
Ext.define('CDT.view.control_calidad.especialista.ControlTipoGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'control-tipo-grid',

    width: '100%',
    selType: 'checkboxmodel',
    autoScroll: true,
    initComponent: function() {
        var me = this; // Ambito del componente.
        // Store
        me.store = Ext.create('CDT.store.control_calidad.ControlTipoStore');
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
            text: 'Nombre',
            dataIndex: 'nombre',
            flex: 1,
            editor: {
                xtype: 'textfield',
                maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 48,
                allowBlank: false
            }
        },{
            text: 'Descripción',
            dataIndex: 'descripcion',
            flex: 2,
            editor: {
                xtype: 'textfield',
                maxLength: 128,
                allowBlank: false
            }
        }];
        me.tbar = [{
            text: 'Adicionar',
            iconCls: 'fa fa-plus',
            tooltip: 'Adicionar control',
            id: 'add-grid-control-tipo-id'
        },'-',{
            text: 'Eliminar',
            iconCls: 'fa fa-remove',
            tooltip: 'Eliminar control',
            id: 'remove-grid-control-tipo-id'
        },'->',
        {
            tooltip: 'Ayuda acerca del tipo de control',
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