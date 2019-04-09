
Ext.define('CDT.view.indicador.especialista.cm.CriterioMedidaTreePanel', {
    extend: 'Ext.tree.Panel',
    xtype: 'tree-cm',

    useArrows: true,
    rootVisible: false,
    multiSelect: false,
    singleExpand: true,
    width: 240,
    height: 300,
    id: 'tree-panel-criterio-medida',

    initComponent: function()
    {
        this.store = Ext.create("CDT.store.indicador.CriterioMedidaTreeStore");

        this.columns = [{
            text: 'ID',
            dataIndex: 'ID',
            width: 35,
            hidden: true
        },{
            xtype: 'treecolumn',
            text: '<img style="padding: 0 5px 0 10px" src="../../../../../../images/indicador/tree-children.png">Criterio-Med.',
            flex: 2,
            sortable: false,
            dataIndex: 'nombre'
        },{
            text: 'Estado',
            xtype: 'widgetcolumn',
            flex: 1,
            dataIndex: 'progress',
            widget: {
                xtype: 'progressbarwidget',
                textTpl: [
                    '{percent:number("0")}%'
                ]
            }
        }];
        this.callParent();
    }
});
