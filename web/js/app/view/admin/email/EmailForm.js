
Ext.define('CDT.view.admin.email.EmailForm', {
    extend: 'Ext.window.Window',
    xtype: 'emailForm',

    title: 'Enviar correo',
    iconCls: 'tareas-correo-otros',
    layout: 'fit',
    autoShow: true,
    buttonAlign: 'right',
    headerPosition: 'bottom',
    width: 710,
    resizable: false,
    closable: false,
    modal: true,

    initComponent: function ()
    {
        var me = this; 
        
        me.myData = []; // Utilizado en los controladores.
         
        me.addEvents('actioncolumnClick');
        
        me.gridTrabajadorStore = Ext.create('Ext.data.ArrayStore', {
            fields: [ 'id', 'nombre', 'departamento' ]
        });
        me.items = [
        {
            xtype: 'form',
            padding: '10 10 10 10',
            border: false,
            style: 'background-color: #fff;',
            fieldDefaults: {
                labelAlign: 'top'
            },
            items: [{
                xtype: 'fieldset',
                layout: 'anchor',
                title: 'Para',
                id: "fieldset-para-id",
                items: [{
                    xtype: 'container',
                    border: false,
                    layout: 'hbox',
                    items: [{
                        xtype: 'combobox',
                        emptyText: 'Trabajador',
                        store: me.store,
                        queryMode: 'local',
                        displayField: 'nombreApellidos',
                        valueField: 'id',
                        margin: '0 0 0 0',
                        flex: 1,
                        editable: false
                    }]     
                },{
                    xtype: 'container',
                    border: false,
                    layout: 'fit',
                    items: [{
                        xtype: 'grid',
                        store: me.gridTrabajadorStore,
                        columns: [
                            { text: 'Id', dataIndex: 'id', hidden: true },
                            { text: 'Nombre',  dataIndex: 'nombre', flex: 1 },
                            { text: 'Departamento', dataIndex: 'departamento', flex: 1 },
                            {
                                xtype: 'actioncolumn', width: 25, 
                                items: [{
                                    icon: '/images/tarea_operativa/remove.png',
                                    tooltip: 'Elimanar fila.',
                                    handler: function(grid, rowIndex, colIndex){
                                        me.fireEvent('actioncolumnClick', [grid, rowIndex]);
                                    }
                                }]
                            }
                        ],
                        margin: '0 0 8 0'
                    }]
                }]
            },{
                xtype: 'fieldset',
                layout: 'anchor',
                title: 'Contenido',
                items: [{
                    xtype: 'container',
                    border: false,
                    layout: 'hbox',
                    items: [{
                        xtype: 'htmleditor',
                        emptyText: 'Contenido del correo',
                        name: 'contenido',
                        margin: '0 0 10 0',
                        flex: 1
                    }]      
                }]
            }]
        }];
        me.tools = [{
            xtype: 'button',
            text: "Enviar",
            iconCls: "mail-send"
        },{
            xtype: 'tbspacer', width: 5
        },{
            xtype: 'button',
            text: 'Cancelar',
            iconCls: 'cancel',
            listeners: {
                click: function () { 
                    me.close();
                }
            }
        }];
        me.callParent(arguments);
    }
});