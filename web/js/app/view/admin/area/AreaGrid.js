
Ext.define('CDT.view.admin.area.AreaGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'areaGrid',

    width    : '100%',
    border   : false,
    selType: 'checkboxmodel',
    autoScroll: true,

    features: [{
        groupHeaderTpl: 'Unidad Organizativa: {name}',
        ftype: 'groupingsummary',
        collapsible: true
    }],

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.admin.AreaStore');
        // Modelo de columna      
        me.columns = [{
            xtype : 'rownumberer',
            text  : 'No',
            width : 35,
            align : 'center'
        },{
            text: 'Id',
            dataIndex: 'id',
            width: 35,
            hidden: true
        },{
            text: 'Nombre',
            dataIndex: 'nombre',
            flex: 2,
            editor: {
                xtype: 'textfield',
                maskRe: /[aA-zZ\ \áéíóúñÁÉÍÓÚÑ]/,
                regex: /[aA-zZ]/,
                maxLength: 48,
                allowBlank: false
            }
        },{
            text: 'Unidad Organizativa',
            dataIndex: 'unidadOrganizativa',
            flex: 2
        }];
        // Articulos de topbar: barra superior    
        me.tbar = [{
            text: 'Adicionar',
            tooltip: 'Adicionar área',
            iconCls: 'add'
        },{
            text: 'Eliminar',
            tooltip: 'Eliminar área',
            iconCls: 'remove'
        },'->',
        {
            tooltip: 'Ayuda acerca de área',
            iconCls: 'help'
        }];
        // Plugins para actualizar...
        me.plugins = Ext.create('Ext.grid.plugin.RowEditing', {
            saveBtnText: 'Editar',
            cancelBtnText: 'Cancelar'
        }); 
        // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});