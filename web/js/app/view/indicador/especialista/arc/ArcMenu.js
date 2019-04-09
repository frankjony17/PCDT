
Ext.define('CDT.view.indicador.especialista.arc.ArcMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'arc-menu',

    plain: true,
    width: 500,
    maxHeight: 500,
    autoScroll: true,

    initComponent: function ()
    {
        var me = this;

        me.items = [{
            xtype: 'buttongroup',
            columns: 2,
            defaults: {
                xtype: 'button',
                width: 480,
                iconAlign: 'left',
                textAlign: 'left'
            },
            items: me.arc
        }];
        me.callParent(arguments);
    }
});