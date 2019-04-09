
Ext.define('CDT.view.transporte.especialista.matricula.MatriculaGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'matriculaGrid',

    width: '100%',
    selType: 'checkboxmodel',
    autoScroll: true,
    
    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.transporte.especialista.MatriculaStore');
        // Modelo de columna      
        me.columns = [
            {
                xtype : 'rownumberer',
                text  : 'No',
                width : 35,
                align : 'center'
            }, {
                text : 'Matrículas',
                columns: [{
                    text: 'Actual',
                    dataIndex: 'chapa',
                    width: 200,
                    sortable: true,
                    editor: {
                        xtype: 'textfield',
                        maskRe: /[A-Z0-9]/,
                        regex: /[A-Z0-9]/,
                        maxLength: 18,
                        minLength:6,
                        allowBlank: false
                    },
                    renderer: function(val) {
                        return '<b>'+ val +'</b>';
                    }
                }, {
                    text: 'Vieja',
                    dataIndex: 'chapaVieja',
                    width: 200,
                    sortable: true,
                    editor: {
                        xtype: 'textfield',
                        maskRe: /[A-Z0-9]/,
                        regex: /[A-Z0-9]/,
                        maxLength: 18,
                        minLength:6
                    },
                    renderer: function(val) {
                        return '<s>'+ val +'</s>';
                    }
                }]                
            }, {
                text: 'Circulación',
                dataIndex: 'circulacion',
                flex: 1,
                editor: {
                    xtype: 'textfield',
                    maskRe: /[A-Z0-9]/,
                    regex: /[A-Z0-9]/,
                    maxLength: 18,
                    minLength:6
                }
            }, {
                text: 'Vencimiento',
                dataIndex: 'vencimiento',
                flex: 1,
                editor: {
                    xtype: 'datefield',
                    format: 'Y-m-d',
                    editable: false
                },
                renderer: function(val) {
                    return (val === 'No definida.') ? '<s>'+ val +'</s>' : val;
                }
            }, {
                text: 'ID (App-Habana)',
                dataIndex: 'id',
                flex: 1,
                hidden: true
            }
        ];               
        // Articulos de topbar: barra superior    
        me.tbar = [
        {
            text: 'Editar ID',
            tooltip: 'Editar ID',
            iconCls: 'change-id'
        },'->',{
            tooltip: 'Ayuda acerca de matrícula',
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