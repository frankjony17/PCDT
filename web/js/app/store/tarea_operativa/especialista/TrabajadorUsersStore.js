
Ext.define('CDT.store.tarea_operativa.especialista.TrabajadorUsersStore', {
    extend : 'Ext.data.Store',
    xtype  : 'usersStore',
    
    fields   : [
        'id', 'nombreApellidos', 'cargo', 'area', 'departamento'
    ],
    
    autoLoad: true,
    sorters: 'area',
    groupField: 'area',
    
    proxy : {
        type : 'ajax',
        url: entorno+'/all/nomenclador/trabajador/list_for_tarea_operativa',
        reader : {
            type            : 'json',
            root            : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        }
    }
});