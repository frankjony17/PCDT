
Ext.define('CDT.view.admin.users.UsersGrid', {
    extend : 'Ext.grid.Panel',
    xtype  : 'usersGrid',

    width: '100%',
    border: false,
    selType: 'checkboxmodel',
    autoScroll: true,
    //Row Expander
    plugins : [{
        ptype : 'rowexpander',
        rowBodyTpl : [
            '<table>'+
            '<tr>'+
                '<th>'+//contenido.
                '<div class="tablestayle">'+
                    '<table>'+
                        '<thead>'+
                            '<tr><th>Email</th><th>Móvil</th><th>Cargo</th><th>Área</th></tr>'+  
                        '</thead>'+
                        '<tbody>'+
                            '<tr><td>{email}</td><td>{movil}</td><td>{cargo}</td><td>{area}</td></tr>'+
                         '</tbody>'+   
                    '</table>'+
                '</div>'+
                '</th>'+
            '</tr>'+
            '</table>'
        ]
    }],
    columnLines: true,
    animCollapse: true,
    
    features: [{
        groupHeaderTpl: 'Área: {name}',
        ftype: 'groupingsummary',
        collapsible: false
    }],
    
    initComponent: function()
    {
        var me = this; // Ambito del componente.
        // Store 
        me.store = Ext.create('CDT.store.admin.UsersStore');
        // Aplicar CSS a los usuarios que no estan activos o no tienen roles activos. 
        me.viewConfig = {
            getRowClass: function(record)
            {   // CSS que cambia el color de los registros del grid.
                if(record.get('is_active') === false)
                {  // CSS que cambia el color de los registros del grid.
                    return 'x-grid-row-estado-color';
                }
                else if(record.get('roles') === 'Sin asignar.')
                {
                    return 'x-grid-row-no-roles-color';
                }
            }
        };
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
                text: 'Alias',
                dataIndex: 'username',
                flex: 2
            }, {
                text: 'Nombre y apellidos',
                dataIndex: 'nombre',
                flex: 3
            }, {
                text: 'Ultima entrada',
                dataIndex: 'last_login',
                flex: 2,
                align: 'center'
            }, {
                text: 'Roles',
                dataIndex: 'roles',
                flex: 4
            }, {
                xtype: 'booleancolumn',
                text: 'Activo',
                trueText: '<img src=\"/images/admin/users-activo.png\"/>&nbsp;&nbsp;&nbsp;&nbsp;<b>Si</b>',
                falseText: '<img src=\"/images/admin/user-inactivo.png\"/>&nbsp;&nbsp;&nbsp;&nbsp;<b>No</b>',
                dataIndex: 'is_active',
                flex: 1
            }, {
                text: 'email',
                dataIndex: 'email',
                width: 50,
                hidden: true
            }
        ];
       // Articulos de topbar: barra superior    
        me.tbar = [{
            text: 'Adicionar',
            tooltip: 'Adicionar usuario',
            iconCls: 'add-user'
        },{
            text: 'Eliminar',
            tooltip: 'Eliminar usuario',
            iconCls: 'remove-user'
        },'->',{
            tooltip: 'Leyenda.',
            iconCls: 'legend-user',
            id: 'legend-user-id-0000'
        },{
            tooltip: 'Ayuda acerca de usuarios.',
            iconCls: 'help'
        }]; 
       // Carga nuestra configuaración y se la pasa al componente del que heredamos.  
        me.callParent(arguments);
    }
});