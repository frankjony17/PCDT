
Ext.define('CDT.view.admin.estructura.EstructuraExternaMenu', {
    extend: 'Ext.menu.Menu',
    
    width: 400,
    style: {
        overflow: 'visible'     // For the Combo popup
    },
    
    initComponent: function ()
    {
        var me = this;
        
        me.items = [
        {
            xtype: 'combobox',
            store: Ext.create('CDT.store.admin.UnidadOrganizativaStore'),
            width: '95%',
            editable: false,
            hideLabel: true,
            emptyText: 'Actualizar trabajadores de una Unidad Organizativa.',
            typeAhead: true,
            displayField: 'nombre',
            selectOnFocus: true,
            id: 'menu-combobox-update-trabajadores'
        },'-',{
            text: 'Actualizar trabajadores <b>(De Todos los Territorios)</b>',
            iconCls: 'update-all-trabajadores',
            id: 'update-all-trabajadores-id'
        }];
        me.callParent(arguments);
    }
});