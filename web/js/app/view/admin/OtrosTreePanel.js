
Ext.define('CDT.view.admin.OtrosTreePanel', {
    extend: 'Ext.tree.Panel',
    xtype: 'otrosTreePanel',

    store: Ext.create('CDT.store.admin.OtrosTreeStore'),
    useArrows: true,
    rootVisible: false,
    border: false
});