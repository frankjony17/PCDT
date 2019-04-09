
Ext.define('CDT.view.admin.trabajador.interno.TrabajadorInternoGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'trabajadorInternoGrid',

    requires: ['Ext.ux.ProgressBarPager', 'Ext.ux.grid.FiltersFeature'],
    
    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,
    stripeRows: true,
    // Row Expander
    plugins: [{
        ptype: 'rowexpander',
        expandOnDblClick: false,
        rowBodyTpl: [
            '<table>'+
            '<tr>'+
                '<th>'+//contenido.
                '<div class="tablestayle">'+
                    '<table>'+
                        '<thead>'+
                            '<tr><th>Cargo</th><th>Departamento</th></tr>'+  
                        '</thead>'+
                        '<tbody>'+
                            '<tr><td>{cargo}</td><td>{departamento}</td></tr>'+
                         '</tbody>'+   
                    '</table>'+
                '</div>'+
                '</th>'+
            '</tr>'+
            '</table>'
        ]
    },{
        ptype: 'rowediting',
        saveBtnText: 'Editar',
        cancelBtnText: 'Cancelar',
        RowEditing: false
    }],
    columnLines: true,
    animCollapse: true,
    
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
                id: 'ID-column-numero-plaza-textfield'
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
                id: 'ID-column-nombre-apellidos-textfield'
            },
            flex: 4
        }, {
            text: 'Móvil',
            dataIndex: 'movil',
            flex: 1,
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
                store: [25, 50, 100, 250, 500],
                value: 25,
                width: 65,
                editable: false,
                selectOnFocus: true,
                id: 'ID-pagingtoolbar-combobox-pagina'
            },'-'],
            plugins: new Ext.ux.ProgressBarPager({ width: 375 })
        },{
            xtype: 'toolbar',
            dock: 'top',
            items: [{
                text: 'Asignar cargo',
                tooltip: 'Asignar cargo al trabajador',
                iconCls: 'add-cargo-trabajador',
                value: 'cargo'
            },{
                text: 'Eliminar',
                tooltip: 'Eliminar trabajador',
                iconCls: 'remove'
            },'->',{
                tooltip: 'Ayuda acerca de trabajador.',
                iconCls: 'help'
            }]
        }];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});