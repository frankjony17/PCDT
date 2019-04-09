
Ext.define('CDT.view.admin.departamento.DepartamentoGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'departamentoGrid',

    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,
    
    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.admin.DepartamentoStore');
        // Modelo de columna      
        me.columns = [{
            xtype: 'rownumberer',
            text: 'No',
            width: 35,
            align: 'center'
        }, {
            text: 'Id',
            dataIndex: 'id',
            width: 35,
            hidden: true
        }, {
            text: 'Código',
            dataIndex: 'codigo',
            flex: 1
        }, {
            text: 'Nombre',
            dataIndex: 'nombre',
            flex: 4
        }, {
            text: 'Teléfono',
            dataIndex: 'telefonos',
            flex: 2,
            editor: {
                xtype: 'textfield',
                maskRe: /[0-9\-\ \,]/,
                regex: /[0-9]/,
                maxLength: 43
            }
        }];
        // Articulos del dockedItems: barra superior e inferior
        me.dockedItems = [{
            xtype: 'pagingtoolbar',
            dock: 'bottom',
            height: 26,
            padding: '1 10 1 10',
            store: me.store,
            displayInfo: true,
            inputItemWidth: 40,
            items: ['-', 'Por página ',
            {
                xtype: 'combobox',
                store: [25, 50, 100, 250, 500, 1000],
                value: 25,
                width: 65,
                editable: false,
                selectOnFocus: true,
                id: 'ID-pagingtoolbar-combobox-pagina-departamento'
            },'-'],
            plugins: new Ext.ux.ProgressBarPager({ width: 375 })
        },{
            xtype: 'toolbar',
            dock: 'top',
            items: [{
                text: 'Eliminar',
                tooltip: 'Eliminar departamento',
                iconCls: 'remove',
                action: 'remove'
            },'->',{
                tooltip: 'Ayuda acerca de departamento',
                iconCls: 'help'
            }]
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