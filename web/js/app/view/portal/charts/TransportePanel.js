
Ext.define('CDT.view.portal.charts.TransportePanel', {
    extend: 'Ext.panel.Panel',
    
    layout: 'fit',
    width: '100%',
    height: 150,
    border: false,
    
    initComponent: function()
    {
        var me = this;
        
        me.items = Ext.create('CDT.view.portal.charts.TransporteChart');

        me.callParent(arguments);
    }
});