
Ext.define('CDT.view.admin.uo.UnidadOrganizativaGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'uoGrid',

    width: '100%',
    border: false,
    autoScroll: true,
    
    initComponent: function()
    {
        var me = this; // Ambito del componente.
       // Store 
        me.store = Ext.create('CDT.store.admin.UnidadOrganizativaStore');
        me.store.load({ params: { ALL: 'OK' }});
       // Modelo de columna      
        me.columns = [
            {
                xtype: 'rownumberer',
                text: 'No',
                width: 35,
                align: 'center'
            }, {
                text: 'Id',
                dataIndex: 'id',
                width: 35,
                hidden: true
            }, {
                text: 'Acrónimo',
                dataIndex: 'acronimo',
                flex: 1,
                renderer: function(val) {
                    return '<b>'+ val +'</b>';
                }
            }, {
                text: 'Nombre',
                dataIndex: 'nombre',
                flex: 4
            }, {
                text: 'Teléfonos',
                dataIndex: 'telefonos',
                flex: 2,
                editor: {
                    xtype: 'textfield',
                    maskRe: /[0-9\-\ \,]/,
                    regex: /[0-9]/,
                    maxLength: 43
                }
            }
        ];
        // Plugins para actualizar...
        me.plugins = Ext.create('Ext.grid.plugin.RowEditing', {
            saveBtnText: 'Editar',
            cancelBtnText: 'Cancelar'
        });
       // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});