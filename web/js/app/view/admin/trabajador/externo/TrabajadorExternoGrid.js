
Ext.define('CDT.view.admin.trabajador.externo.TrabajadorExternoGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'trabajadorExternoGrid',

    requires: ['Ext.ux.ProgressBarPager', 'Ext.ux.grid.FiltersFeature'],
    
    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,
    stripeRows: true,
    
    features: [{
        groupHeaderTpl: 'Área: {name}',
        ftype: 'grouping',
        collapsible: false
    },{
        ftype: 'filters',
        local: true
    }],

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.admin.TrabajadorStore');
        // Modelo de columna      
        me.columns = [{
            text: 'Id',
            dataIndex: 'id',
            width: 35,
            hidden: true
        }, {
            text: 'Código (SAP)',
            dataIndex: 'numeroPlaza',
            items: {
                xtype: 'textfield',
                emptyText: 'Filtrar.',
                width: '98%',
                margin: 2,
                enableKeyEvents: true,
                property: 'numeroPlaza',
                id: 'ID-column-numero-plaza-textfield-externo'
            },
            flex: 1
        }, {
            text: 'Nombre y apellidos',
            dataIndex: 'nombreApellidos',
            items: {
                xtype: 'textfield',
                emptyText: 'Filtrar.',
                width: '98%',
                margin: 2,
                enableKeyEvents: true,
                property: 'nombreApellidos',
                id: 'ID-column-nombre-apellidos-textfield-externo'
            },
            flex: 3
        }, {
            text: 'Departamento',
            dataIndex: 'departamento',
            items: {
                xtype: 'textfield',
                width: '98%',
                margin: 2,
                property: 'departamento',
                emptyText: 'Filtrar.',
                enableKeyEvents: true,
                id: 'ID-column-departamento-textfield-externo'
            },
            flex: 3
        },{
            text: 'area',
            dataIndex: 'area',
            hidden: true
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
                id: 'ID-pagingtoolbar-combobox-pagina-externo'
            },'-'],
            plugins: new Ext.ux.ProgressBarPager({ width: 375 })
        },{
            xtype: 'toolbar',
            dock: 'top',
            items: [{
                text: 'Asignar área',
                tooltip: 'Ubicar al trabajador en un área',
                iconCls: 'add-area-trabajador'
            },'->',{
                xtype: 'combobox',
                store: Ext.create('CDT.store.admin.NombreDepartamentoStore'),
                width: 400,
                typeAhead: true,
                emptyText: 'Listar trabajadores según el departamento seleccionado.',
                displayField: 'nombre',
                selectOnFocus: true,
                id: 'ID-toolbar-combobox-departamento-externo'
            },{
                tooltip: 'Quitar filtros.',
                iconCls: 'trash',
                disabled: true
            },'-',{
                tooltip: 'Ayuda acerca de trabajador.',
                iconCls: 'help'
            }]
        }];
       // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});