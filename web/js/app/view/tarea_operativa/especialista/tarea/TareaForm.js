
Ext.define('CDT.view.tarea_operativa.especialista.tarea.TareaForm', {
    extend: 'Ext.window.Window',
    xtype: 'tareaForm',

    title: 'Adicionar Tarea Operativa',
    iconCls: 'tareas-operativas',
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
                title: 'Responsable',
                items: [{
                    xtype: 'container',
                    border: false,
                    layout: 'hbox',
                    items: [{
                        xtype: 'combobox',
                        emptyText: 'Cargo',
                        store: Ext.create('CDT.store.admin.CargoStore'),
                        queryMode: 'local',
                        displayField: 'nombre',
                        margin: '0 5 5 0',
                        flex: 2,
                        editable: false
                    },{
                        xtype: 'combobox',
                        emptyText: 'Trabajador',
                        store: me.storeTrabajador,
                        queryMode: 'local',
                        displayField: 'nombreApellidos',
                        valueField: 'id',
                        margin: '0 0 0 0',
                        flex: 4,
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
                title: 'Descripción',
                items: [{
                    xtype: 'container',
                    border: false,
                    layout: 'hbox',
                    items: [{
                        xtype: 'textareafield',
                        emptyText: 'Descripción',
                        grow: true,
                        name: 'descripcion',
                        margin: '0 0 10 0',
                        height: 100,
                        flex: 1
                    }]      
                }]
            },{
                xtype: 'container',
                border: false,
                layout: 'hbox',
                items: [{
                    xtype: 'fieldset',
                    layout: 'anchor',
                    title: 'Fechas',
                    margin: '0 5 5 0',
                    flex: 1,
                    items: [{
                        xtype: 'datefield',
                        emptyText: 'Inicial',
                        anchor: '100%',
                        format: 'Y-m-d',
                        editable: false,
                        allowBlank: false,
                        name: 'fecha_inicial',
                        itemId: 'fecha_inicial',
                        vtype: 'daterange',
                        endDateField: 'fecha_final'
                    },{
                        xtype: 'datefield',
                        emptyText: 'Final',
                        anchor: '100%',
                        format: 'Y-m-d',
                        editable: false,
                        allowBlank: false,
                        name: 'fecha_final',
                        itemId: 'fecha_final',
                        vtype: 'daterange',
                        startDateField: 'fecha_inicial'
                    }]
                },{
                    xtype: 'fieldset',
                    layout: 'anchor',
                    title: 'Periodo de Chequeo',
                    margin: '0 0 0 0',
                    flex: 2,
                    items: [{
                        xtype: 'checkboxgroup',
                        columns: 4,
                        vertical: true,
                        items: [
                            {boxLabel: 'Lunes', inputValue: 2, name: 'lun'},
                            {boxLabel: 'Martes', inputValue: 3, name: 'mar'},
                            {boxLabel: 'Miércoles', inputValue: 4, name: 'mie'},
                            {boxLabel: 'Jueves', inputValue: 5, name: 'jue'},
                            {boxLabel: 'Viernes', inputValue: 6, name: 'vie'},
                            {hideEmptyLabel: true, disabled: true, margin: '0 5 5 0'},
                            {
                                xtype: 'combobox',
                                store: ["Diario", "Quincenal", "Mensual"],
                                queryMode: 'local',
                                editable: false,
                                emptyText: 'Otros.',
                                width: 125, id: "periodo-chequeo-combobox-id"
                            }]
                    }]
                }]
            }]
        }];
        me.tools = [{
            xtype: 'button',
            text: me.btnText,
            iconCls: me.btnIconCls
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