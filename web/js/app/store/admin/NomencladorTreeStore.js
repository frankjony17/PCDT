
Ext.define('CDT.store.admin.NomencladorTreeStore', {
    extend : 'Ext.data.TreeStore',

    root: {
        expanded: true,
        children: [
        {
            text: '<b>Estructura Interna</b>',
            iconCls: 'tree-estructura-interna',
            id: 'tree-estructura-interna-id',
            expanded: true,
            children: [
            {
                text: '<b>Unidad Organizativa</b>',
                iconCls: 'tree-unidad-organizativa',
                id: 'tree-unidad-organizativa-id',
                leaf: true
            },{
                text: '<b>Área</b>',
                iconCls: 'tree-area',
                id: 'tree-area-id',
                leaf: true
            },{
                text: '<b>Cargo</b>',
                iconCls: 'tree-cargo',
                id: 'tree-cargo-id',
                leaf: true
            },{
                text: '<b>Trabajador (interno)</b>',
                iconCls: 'tree-trabajador-interno',
                id: 'tree-trabajador-interno-id',
                leaf: true
            }]
        },{
            text: '<b>Estructura Externa</b>',
            iconCls: 'tree-estructura-externa',
            id: 'tree-estructura-externa-id',
            expanded: false,
            children: [
            {
                text: '<b>Departamento</b>',
                iconCls: 'tree-departamento',
                id: 'tree-departamento-id',
                leaf: true
            },{
                text: '<b>Trabajador (externo)</b>',
                iconCls: 'tree-trabajador-externo',
                id: 'tree-trabajador-id',
                leaf: true
            }]
        }]
    }
});