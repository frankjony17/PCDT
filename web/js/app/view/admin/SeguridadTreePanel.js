
Ext.define('CDT.view.admin.SeguridadTreePanel', {
    extend: 'Ext.tree.Panel',
    xtype: 'seguridadTreePanel',

    store: Ext.create('CDT.store.admin.SeguridadTreeStore'),
    useArrows: true,
    rootVisible: false 
});