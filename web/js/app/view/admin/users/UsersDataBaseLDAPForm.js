
Ext.define('CDT.view.admin.users.UsersDataBaseLDAPForm', {
    extend: 'Ext.window.Window',
    xtype: 'usersDataBaseLDAPForm',
    
    requires: ['Ext.ux.ProgressBarPager', 'Ext.ux.grid.FiltersFeature'],
    
    title: 'Crear nuevos usuarios.',
    iconCls: 'add-user',
    layout: 'fit',
    modal: true,
    
    autoShow: true,
    resizable: false,
    headerPosition: 'right',
    
    y: 20,
    width: 900,
    height: 600,
            
    initComponent: function ()
    {
        var me = this;
        
        me.store = Ext.create('CDT.store.admin.UsersDataBaseOrLDAPStore');
        
        me.items = Ext.create('Ext.grid.Panel', {
            features: [{
                ftype: 'filters',
                local: true
            }],
            selType: 'checkboxmodel',
            columns: [
                { text: 'Id', dataIndex: 'id', width: 35, hidden: true },
                { 
                    text: 'Nombre y apellidos (Filtrar)', dataIndex: 'cn', flex: 3,
                    renderer: function(value, cellValues, record)
                    {
                        return record.get('cn');
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
                                        property: 'cn',
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
                    text: 'Alias (Filtrar)', dataIndex: 'uid', flex: 2,
                    renderer: function(value, cellValues, record)
                    {
                        return record.get('uid');
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
                                        property: 'uid',
                                        value: this.value,
                                        anyMatch: true,
                                        caseSensitive: false
                                    });
                                }
                            },
                            buffer: 500
                        }
                    }
                },{ text: 'Mail', dataIndex: 'mail', hidden: true }
            ],
            autoScroll: true,
            store: me.store,
            plugins : [{
                ptype : 'rowexpander',
                rowBodyTpl : ['<table><tr><th>'+
                    '<div id="table">'+
                        '<table>'+
                            '<thead>'+
                                '<tr><th>Correo electronico</th></tr>'+  
                            '</thead>'+
                            '<tbody>'+
                                '<tr><td>{mail}</td></tr>'+
                             '</tbody>'+   
                        '</table>'+
                    '</div>'+
                    '</th></tr></table>'
                ]
            }],
            columnLines: true,
            animCollapse: true,
            tbar: [{ 
                xtype: 'button',
                text: 'Usuarios Locales',
                tooltip: 'Cargar usuarios de la Base de Datos.',
                iconCls: 'load-user-db'
            },{ 
                xtype: 'button',
                text: 'Usuarios de LDAP',
                tooltip: 'Cargar usuarios del servidor LDAP.',
                iconCls: 'load-user-ldap'
            },'->',{
                xtype: 'combobox',
                emptyText: 'Filtrar por: Área (Usuarios Locales)',
                store: Ext.create('CDT.store.admin.AreaStore'),
                queryMode: 'local',
                displayField: 'nombre',
                valueField: 'id',
                editable: false,
                width: 320
            }],
            bbar: [{
                xtype: 'button',
                text: 'Cargar',
                tooltip: 'Cargar usuarios de LDAP.',
                iconCls: 'load-user',
                scale: 'medium',
                disabled: true
            },'-','->',{
                xtype: 'pagingtoolbar',
                padding: '1 10 1 10',
                store: me.store,
                border: false,
                displayInfo: false
            }]
        });
        me.callParent(arguments);
    }
});