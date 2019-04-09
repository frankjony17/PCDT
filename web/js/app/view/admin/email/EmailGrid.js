
Ext.define('CDT.view.admin.email.EmailGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'emailGrid',

    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,

    features: [{
        groupHeaderTpl: 'Modulo: {name}',
        ftype: 'groupingsummary',
        collapsible: true,
        id: "email-grid-groupingsummary-id"
    }],
    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.email.EmailStore');
        // Modelo de columna      
        me.columns = [{
            xtype : 'rownumberer',
            text  : 'No',
            width : 35,
            align : 'center'
        },{
            text: 'UserId',
            dataIndex: 'user_id',
            width: 35,
            hidden: true
        },{
            text: 'Email',
            dataIndex: 'email',
            flex: 2
        },{
            text: 'Trabajador',
            dataIndex: 'trabajador',
            flex: 3
        }];
        // Articulos de topbar: barra superior
        me.tbar = [{
            xtype: 'buttongroup',
            items: [{
                text: 'Adicionar módulo',
                iconCls: 'add-modulo'
            }]
        }, {
            xtype: 'buttongroup',
            items: [/*{
                text: 'Eliminar módulo',
                iconCls: 'remove-modulo'
            }, */{
                text: 'Eliminar usuario',
                iconCls: 'remove-user'
            }]
        }, '->',{
            xtype: 'buttongroup',
            items: [{
                tooltip: 'Ayuda acerca de historial',
                iconCls: 'help'
            }]
        }];
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.
        me.callParent(arguments);
    }
});