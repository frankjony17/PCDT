
Ext.define('CDT.view.admin.email.EmailUsuarioForm', {
    extend: 'Ext.window.Window',
    xtype: 'emailUsuarioForm',

    requires: ['Ext.ux.ProgressBarPager', 'Ext.ux.grid.FiltersFeature'],

    title: 'Agregar usuarios. (Destinatarios)',
    iconCls: 'add-user',
    layout: 'fit',
    modal: true,
    autoShow: true,
    resizable: false,
    headerPosition: 'right',
    
    y: 20,
    width: 900,
    height: 475,
            
    initComponent: function ()
    {
        var me = this;
        me.store = Ext.create('CDT.store.admin.UsersStore');
        me.items = Ext.create('Ext.grid.Panel', {
            features: [{
                ftype: 'filters',
                local: true
            }],
            selType: 'checkboxmodel',
            columns: [
            { text: 'Id', dataIndex: 'id', width: 35, hidden: true },
            {
                text: 'Nombre y apellidos (Filtrar)', dataIndex: 'nombre', flex: 3,
                renderer: function(value, cellValues, record)
                {
                    return record.get('nombre');
                },
                items: {
                    xtype: 'textfield',
                    flex : 1,
                    margin: 2,
                    enableKeyEvents: true,
                    listeners: {
                        keyup: function() {
                            me.store.clearFilter();
                            if (this.value) {
                                me.store.filter({
                                    property: 'nombre',
                                    value: this.value,
                                    anyMatch: true,
                                    caseSensitive: false
                                });
                            }
                        },
                        buffer: 500
                    }
                }
            },{
                text: 'Alias (Filtrar)', dataIndex: 'username', flex: 2,
                renderer: function(value, cellValues, record)
                {
                    return record.get('username');
                },
                items: {
                    xtype: 'textfield',
                    flex : 1,
                    margin: 2,
                    enableKeyEvents: true,
                    listeners: {
                        keyup: function() {
                            me.store.clearFilter();
                            if (this.value) {
                                me.store.filter({
                                    property: 'username',
                                    value: this.value,
                                    anyMatch: true,
                                    caseSensitive: false
                                });
                            }
                        },
                        buffer: 500
                    }
                }
            }],
            autoScroll: true,
            store: me.store,
            bbar: [{
                xtype: 'button',
                text: 'Cargar',
                tooltip: 'Cargar usuarios de LDAP.',
                iconCls: 'load-user',
                scale: 'medium'
            }]
        });
        me.callParent(arguments);
    }
});