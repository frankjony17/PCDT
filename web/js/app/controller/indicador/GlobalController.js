
Ext.define('CDT.controller.indicador.GlobalController', {
    extend: 'Ext.app.Controller',

    config: {
        control: {
            '#arc-splitbutton-viewport': {
                click: 'onSplitButtonClick'
            },
            '#objetivo-button-viewport': {
                click: 'onObjetivoButtonClick'
            },
            // CriterioMedidaTreePanel
            'tree-cm': {
                headerclick: 'onHeaderClick',
                itemcontextmenu: 'onItemContextMenu',
                itemclick: "onItemClick"
            }
        }
    },

    onSplitButtonClick: function(item)
    {
        this.addTabpanel(item, Ext.create("CDT.view.indicador.especialista.arc.ArcGrid"));
    },
    onObjetivoButtonClick: function(item)
    {
        var tree = Ext.getCmp("tree-panel-criterio-medida");
        this.addTabpanel(item, Ext.create("CDT.view.indicador.especialista.objetivo.ObjetivoGrid",{
            treeStore: tree.store
        }));
    },
    onAnalizarOjetivo: function ()
    {
        console.log("onAnalizarOjetivo");
        //this.addTabpanel(item, Ext.create("CDT.view.indicador.especialista.objetivo.ObjetivoGrid"));
    },
    onHeaderClick: function (ct, column)
    {
        if (column.dataIndex === "nombre")
        {
            var item = {"id":"vewport-criterio-medida-grid", "iconCls":"fa fa-area-chart", "text":"Criterios de Medida"}, tree = Ext.getCmp("tree-panel-criterio-medida");
            this.addTabpanel(item, Ext.create("CDT.view.indicador.especialista.cm.CriterioMedidaGrid",{
                treeStore: tree.store
            }));
        }
    },
    onItemContextMenu: function (tree, record, item, index, e, eOpts)
    {
        var me = this;
        if (record.get("iconCls") === "tree-close-folder" || record.get("iconCls") === "tree-open-folder")
        {
            var menu = Ext.create('Ext.menu.Menu', {
                width: 320,
                items: [
                    '<b class="menu-title">Objetivo ['+ record.get("nombre") +']</b>',
                    {
                        text: 'Analizar (Comportamiento, Gráficos)',
                        iconCls: '',
                        listeners: {
                            click: function (menu, item){
                                me.onAnalizarOjetivo
                            }
                        }
                    },{
                        text: 'Gestionar (Adicionar, Editar, Eliminar)',
                        iconCls: '',
                        listeners: {
                            click: function (menu, item){
                                me.addTabpanel(me.getCmp("objetivo-button-viewport"), Ext.create("CDT.view.indicador.especialista.objetivo.ObjetivoGrid"))
                            }
                        }
                    }
                ]
            });
            menu.showAt(e.getXY());
            e.stopEvent();
        }
    },
    onItemClick: function (view, record, item, index, e, eOpts)
    {
        if (record.raw.leaf === true)
        {
            var item = {
                "id": "vewport-criterio-medida-panel" + record.raw.ID,
                "iconCls": "fa fa-area-chart",
                "text": "CM",
                "name": record.raw.nombre
            };
            this.addTabpanel(item, Ext.create("CDT.view.indicador.especialista.cm.analisis.CriterioMedidaPanel", {
                idCriterioMedida: record.raw.ID
            }));
        }
    },
    /**
     * Viewport Indicadores
     * -----------------------------------------------------------------------------------------------------------------
     * Viewport Indicadores
     */
    addTabpanel: function (record, items)
    {
        var me = this, centerpanel = me.getCmp('center-panel-id');
        centerpanel.removeAll();
        me.addTab(items, record);
    },
    // Añadir tabpanel.
    addTab: function (items, record)
    {
        var me = this, centerpanel = me.getCmp('center-panel-id'), title = 'Gestionar [' + record["text"] + ']';

        if (record["text"] === "CM")
        {
            title = "Análisis [Criterios de Medida: "+record["name"]+"]";
        }
        var tab = centerpanel.add({
            title: title,
            iconCls: record["iconCls"],
            items: items,
            id: record["id"] + '-tab'
        });
        me.updateStatusBar(title);
    },
    // Obtener componente dado un identificador.
    getCmp: function (id)
    {
        return Ext.getCmp(id);
    },
    // Update detalle de barra de estado.
    updateStatusBar: function (text)
    {
        var status_bar = Ext.getCmp('status-bar-detalles'), operacion = "Gestionar";

        status_bar.update('<b><span style="color:#000;"><b>'+ text +'</b></span></b>');
    }
});


