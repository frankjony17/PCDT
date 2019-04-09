
Ext.define('CDT.view.transporte.especialista.chofer.ChoferGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'choferGrid',

    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,
    
    features: [{
        groupHeaderTpl: 'Área: {name}',
        ftype: 'groupingsummary',
        collapsible: true
    }],

    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.transporte.especialista.ChoferStore');
        // Modelo de columna      
        me.columns = [
            {
                xtype : 'rownumberer',
                text  : 'No',
                width : 35,
                align : 'center'
            }, {
                text: 'Id',
                dataIndex: 'id',
                width: 35,
                hidden: true
            }, {
                text: 'Nombre del trabajador',
                dataIndex: 'trabajador',
                flex: 4
            }, {
                text: 'Licencia',
                dataIndex: 'licencia',
                flex: 2
            }, {
                text: 'Profecional',
                dataIndex: 'profecional',
                align: 'center',
                flex: 1,
                renderer: function(val) {
                    if ( val === 'SI' ) {
                        return '<img src=\"/images/transporte/flag-si.png\"/>';
                    } else {
                        return '<img src=\"/images/transporte/flag-no.png\"/>';
                    }
                }
            }, {
                text: 'Hora de parqueo',
                dataIndex: 'horaParqueo',
                flex: 2
            }, {
                text: 'TrabajadorID',
                dataIndex: 'trabajador_id',
                hidden: true
            }
        ];               
        // Articulos de topbar: barra superior    
        me.tbar = [{
            text: 'Adicionar',
            tooltip: 'Adicionar chofer',
            iconCls: 'add'
        },{
            text: 'Editar',
            tooltip: 'Editar chofer',
            iconCls: 'edit'
        },'',{
            text: 'Eliminar',
            tooltip: 'Eliminar chofer',
            iconCls: 'remove'
        },'->',{
            tooltip: 'Cambiar horario de parqueo a múltiples choferes. (Por Criterio)',
            iconCls: 'change'
        },{
            tooltip: 'Ayuda acerca de Choferes.',
            iconCls: 'help'
        }];
        me.callParent(arguments);
    }
});