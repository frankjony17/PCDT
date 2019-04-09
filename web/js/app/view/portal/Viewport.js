
Ext.define('CDT.view.portal.Viewport', {
    extend: 'Ext.container.Viewport',
    xtype : 'viewportPortal',
    
    layout: 'border',
    id: 'portal-viewport-cdt',
    
    initComponent: function()
    {
        var me = this;
        
        me.items = [
        {
            region: 'north',
            xtype: 'container',
            border: false,
            height: 45,
            
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            id: 'portal-header',
            
            items:[{
                xtype: 'component',
                id: 'portal-header-title',
                html: 'Centro de Dirección Territorial-Portal de Trabajo.',
                flex: 1
            }]
        },
            // REGIÓN CENTRAL --------------------------------------------------
        {
            region: 'center',
            xtype : 'panel',
            bodyStyle: 'background-image:url(../../images/portal/square.gif);',
            border: false,
            
            layout: {
                type: 'table',
                columns: 3,
                tdAttrs: { style: 'padding: 10px;' }
            },
            defaults: {
                xtype: 'panel',
                width: 250,
                height: 200,
                bodyPadding: 10
            },
            items: [
            {
                xtype: 'button',
                text: me.adminHtml(),
                cls: 'x-btn-color',
                id: 'portal-admin-button',
                name: 'admin'
            },{
                xtype: 'button',
                text: me.transporteHtml(),
                cls: 'x-btn-color',
                id: 'portal-transporte-button',
                name: 'transporte'
            },{
                xtype: 'button',
                text: me.tareasOpHtml(),
                cls: 'x-btn-color',
                id: 'portal-tareas-operativas-button',
                name: 'tareasoperativas'
            },{
                xtype: 'button',
                text: me.indicadorHtml(),
                cls: 'x-btn-color',
                id: 'portal-indicadores-button',
                name: 'indicadores'
            }]
        },
            // REGIÓN ESTE -----------------------------------------------------
        {
            region: 'east',
            xtype : 'panel',
            bodyStyle: 'background-image:url(../../images/portal/square.gif);',
            border: false,
            width: 210,
            
            items: [{
                 xtype: 'panel',
                 border: false,
                 html: '<br><b><center>'+
                       '<span style=" color: #777; font-weight:bold; font-size:16px; text-shadow: 0 2px 0 #eee;">'+
                       'Incidencias de transporte:</span></center></b></br>'
            },
                Ext.create('CDT.view.portal.charts.TransportePanel')
            ]
        }];
       // Carga nuestra configuaración y se la pasa al componente del que heredamos. 
        me.callParent(arguments);
    },
    adminHtml: function ()
    {   
        return '<table>'+
            '<tr>'+
                '<th>'+
                    '<img src="/images/portal/admin.png" width=145>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th width=50>'+
                    '<div class="x-btn-color-html">'+
                        'ADMINISTRACIÓN'+
                    '</div>'+
                    '<div class="x-btn-color-html-desc">'+
                        'Usuarios, Roles y<br>Nomencladores.'+
                    '</div>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th height=120>'+
                '</th>'+
            '</tr>'+
        '</table>';
    },
    transporteHtml: function ()
    {   
        return '<table>'+
            '<tr>'+
                '<th>'+
                    '<img src="/images/portal/auto.png" width=145>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th width=50>'+
                    '<div class="x-btn-color-html">'+
                        'TRANSPORTE'+
                    '</div>'+
                    '<div class="x-btn-color-html-desc">'+
                        'Parqueo, Planificación y<br>Eventuales.'+
                    '</div>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th height=120>'+
                '</th>'+
            '</tr>'+
        '</table>';
    },
    tareasOpHtml: function ()
    {
        return '<table>'+
            '<tr>'+
                '<th>'+
                    '<img src="/images/portal/tareasoperativas.png" width=145>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th width=50>'+
                    '<div class="x-btn-color-html">'+
                        'TAREAS OP.'+
                    '</div>'+
                    '<div class="x-btn-color-html-desc">'+
                        'Planificación, Control y<br>Seguimiento.'+
                    '</div>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th height=120>'+
                '</th>'+
            '</tr>'+
        '</table>';        
    },
    indicadorHtml: function ()
    {
        return '<table>'+
            '<tr>'+
                '<th>'+
                    '<img src="/images/portal/indicadores.png" width=145>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th width=50>'+
                    '<div class="x-btn-color-html">'+
                        'INDICADORES.'+
                    '</div>'+
                    '<div class="x-btn-color-html-desc">'+
                        'Comportamiento, Plan y<br>Real.'+
                    '</div>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th height=120>'+
                '</th>'+
            '</tr>'+
        '</table>';        
    },
    nbsp: function (num)
    {   
        var nbsp = '';
        
        for (var i = 0; i < num; i++)
        {
            nbsp += '&nbsp;';
            i++;
        }
        return nbsp;
    }
});