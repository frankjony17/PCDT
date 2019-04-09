
Ext.define('CDT.view.admin.roles.RolesForm', {
    extend: 'Ext.window.Window',
    xtype: 'rolesForm',
    
    title: 'Añadir o quitar roles.',
    iconCls: 'tree-roles',
    layout: 'fit',
    modal: true,
    
    autoShow: true,
    closable: false,
    resizable: false,
    headerPosition: 'bottom',
    
    width: 650,
    height: 585,
    
    initComponent: function ()
    {
        var me = this;
        
        me.rolesStore = Ext.create('CDT.store.admin.RolesUsersStore');
        me.rolesStore.load({ params: { Id: me.usersId }});
        
        me.checkcolumn = Ext.create('Ext.grid.column.CheckColumn',{
            text: 'Activar/Desactivar', dataIndex : 'estado', flex: 1
        });
        me.grid = Ext.create('Ext.grid.Panel', {
            border: false,
            autoScroll: true,
            store: me.rolesStore,
            
            features: [{ groupHeaderTpl: 'Modulo: {name}', ftype: 'groupingsummary' }],
            
            columns: [
                { text: 'Id', dataIndex: 'id', width: 35, hidden: true },
                { text: 'Roles', dataIndex: 'role', flex: 2 },
                me.checkcolumn
            ]
        });
        me.items = me.grid;
        
        me.tools = [{
            xtype: 'button',
            text: 'Salvar',
            iconCls: 'ok'
        },{
            xtype: 'tbspacer', width: 5
        },{
            xtype: 'button',
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: function () { 
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});