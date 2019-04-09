Ext.define('CDT.controller.tarea_operativa.responsable.HistorialController', {
        extend: 'Ext.app.Controller',

        views: [
            'tarea_operativa.especialista.historial.HistorialGrid'
        ],
        init: function ()
        {
            var me = this;

            me.control({
                'historialGrid': {
                    resize: function (grid) { grid.setHeight(Ext.ex.height('south-panel-id', 50)); },
                    afterrender: me.afterRenderGrid
                },
                'historialGrid datefield[emptyText=Inicial]': {
                    expand: me.dateInicial,
                    select: me.loadStoreBy
                },
                'historialGrid datefield[emptyText=Final]': {
                    expand: me.dateFinal,
                    select: me.loadStoreBy
                },
                '#historial-combobox-area-id': {
                    select: me.loadStoreBy
                },
                '#historial-combobox-estado-id': {
                    select: me.loadStoreBy
                },
                '#historial-combobox-trash-id': {
                    click: me.cleanComboBox
                },
                '#historial-datefield-trash-id': {
                    click: me.cleanDateField
                }
        });
    },
    afterRenderGrid: function (grid, eOpts)
    {
        var me = this;
        me.grid = grid;
        me.store = grid.store;
    },
    loadStore: function () { var me = this; me.store.load(); },
    //-
    dateInicial: function (field)
    {
        var me = this, final = me.grid.down("[emptyText=Final]");

        if (final.getValue() !== "")
        {
            field.setMaxValue(final.getValue());
        }
    },
    dateFinal: function (field)
    {
        var me = this, inicial = me.grid.down("[emptyText=Inicial]");

        if (inicial.getValue() !== "")
        {
            field.setMinValue(inicial.getValue());
        }
    },
    loadStoreBy: function ()
    {
        var me = this;

        me.store.load({
            params: {
                Area: me.grid.down("[id=historial-combobox-area-id]").getValue(),
                Estado: me.grid.down("[id=historial-combobox-estado-id]").getValue(),
                Inicial: me.grid.down("[emptyText=Inicial]").getValue(),
                Final: me.grid.down("[emptyText=Final]").getValue()
            }
        });
    },
    cleanComboBox: function (btn)
    {
        var me = this;
        me.grid.down("[id=historial-combobox-area-id]").setValue();
        me.grid.down("[id=historial-combobox-estado-id]").setValue();
        me.loadStoreBy();
    },
    cleanDateField: function (btn)
    {
        var me = this;
        me.grid.down("[emptyText=Inicial]").setValue();
        me.grid.down("[emptyText=Final]").setValue();
        me.loadStoreBy();
    }
});


