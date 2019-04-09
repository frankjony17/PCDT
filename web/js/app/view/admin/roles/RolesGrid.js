
Ext.define('CDT.view.admin.roles.RolesGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'rolesGrid',

    width: '100%',
    border: false,
    autoScroll: true,
    
    features: [{
        groupHeaderTpl: 'Modulo: {name}',
        ftype: 'groupingsummary',
        collapsible: false
    }],
    
    initComponent: function()
    {
        var me = this; // Ambito del componente.
       // Store 
        me.store = Ext.create('CDT.store.admin.RolesStore');
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
                text: 'Roles',
                dataIndex: 'role',
                flex: 1
            }
        ];
       // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});