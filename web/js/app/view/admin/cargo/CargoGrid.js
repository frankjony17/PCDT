
Ext.define('CDT.view.admin.cargo.CargoGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'cargoGrid',

    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.admin.CargoStore');
        // Modelo de columna      
        me.columns = [
            {
                xtype : 'rownumberer',
                text  : 'No',
                width : 35,
                align : 'center'
            }, {
                text: 'Id',
                dataIndex: 'id',
                width: 35,
                hidden: true
            }, {
                text: 'Nombre',
                dataIndex: 'nombre',
                flex: 1,
                editor: {
                    xtype: 'textfield',
                    maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                    regex: /[aA-zZ]/,
                    maxLength: 43,
                    allowBlank: false
                }
            }, {
                text: 'Descripción',
                dataIndex: 'descripcion',
                flex: 3,
                editor: {
                    xtype: 'textfield',
                    maskRe: /[aA-zZ\áéíóúñÁÉÍÓÚÑ\ \.\,]/,
                    regex: /[aA-zZ]/,
                    maxLength: 118,
                    allowBlank: false
                }
            }
        ];
        // Articulos de topbar: barra superior    
        me.tbar = [{
            text: 'Adicionar',
            tooltip: 'Adicionar cargo',
            iconCls: 'add',
            action: 'save'
        },{
            text: 'Eliminar',
            tooltip: 'Eliminar cargo',
            iconCls: 'remove',
            action: 'remove'
        },'->',
            {
                tooltip: 'Ayuda acerca de cargo',
                iconCls: 'help'
            }];
        // Plugins para actualizar...
        me.plugins = Ext.create('Ext.grid.plugin.RowEditing', {
            saveBtnText: 'Editar',
            cancelBtnText: 'Cancelar'
        });
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});