
Ext.define('CDT.view.admin.NomencladorTreePanel', {
    extend: 'Ext.tree.Panel',
    xtype: 'nomencladorTreePanel',

    store: Ext.create('CDT.store.admin.NomencladorTreeStore'),
    useArrows: true,
    rootVisible: false 
});