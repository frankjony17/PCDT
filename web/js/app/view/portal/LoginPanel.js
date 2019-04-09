
Ext.define('CDT.view.portal.LoginPanel', {
    extend: 'Ext.panel.Panel',
    xtype: 'loginPanel',

    width: 480,
    height: 255,
    
    layout: 'fit',
    bodyStyle: 'padding: 15px;',
    cls: 'portal-login-border',
    
    initComponent: function()
    {
        var me = this;

        me.br = {
            xtype: 'box',
            autoEl: {tag: 'br', html: '<br></br>'}
        };
        me.sp = {
            xtype: 'box',
            autoEl: {tag: 'span', html: '<span>&nbsp;</span>'}
        };
        me.spacer = {
            xtype: 'box',
            autoEl: {tag: 'span', html: '<span>'+ me.nbsp(82) +'</span>'}
        };
        
        me.items = [
        {
            xtype: 'form',
                
            padding: '10px 10px 10px 10px',
            border: false,
            style: 'background-color: #fff;',
                    
            fieldDefaults: {
                anchor: '100%',
                maxLength : 25,
                allowBlank: false,
                labelSeparator: '',
                labelStyle: 'font-weight:bold; font-size:14px; text-shadow: 0 1px 0 #fff;',
                fieldStyle: 'font-size:14px;',
                height: 30,
                msgTarget: 'side',
                autoFitErrors: false
            },  
            defaultType: 'textfield',
            
            items: [
            {
                xtype: 'label',
                html: me.labelHtml()
            },
                me.br,
            {
                fieldLabel: 'Usuario',
                emptyText: 'Nombre de Usuario',
                enableKeyEvents: true,
                selectOnFocus: true,
                name: 'username',
                id: 'login-textfield-usuario',
                maskRe: /[a-z\.\ñ\á\é\í\ó\ú]/,
                regex: /[a-z]/
            },
                  me.br,
            {
                fieldLabel : 'Contraseña',
                emptyText  : 'Contraseña',
                inputType: 'password',
                name: 'password',
                id: 'login-textfield-password'
            },
                  me.br, me.spacer,
            {
                xtype: 'button',
                text: 'Iniciar Sesión',
                cls: 'portal-login-btn',
                iconCls: 'login',
                tooltip: 'Presione el botón para enviar los datos.',
                id: 'portal-login-btn-ok',
                width: 130,
                height: 30
            },
                me.sp,
            {
                xtype: 'button',
                text: 'Cancelar',
                cls: 'portal-login-btn',
                iconCls: 'cancel',
                id: 'portal-login-btn-cancel',
                width: 95,
                height: 30
            }]
        }];
        
        me.callParent(arguments);
    },
    labelHtml: function ()
    {   
        var me = this;
        
        return '<table>'+
            '<tr>'+
                '<th>'+
                    '<span'+
                        ' style="'+
                            'font-weight:bold;'+
                            'font-size:16px;'+
                            'font-family: verdana;'+
                            'text-shadow:0 1px 0 #eee;'+
                            '">'+
                        me.nbsp(50)+'Portal CDT versión 1.0'+
                    '</span>'+
                '</th>'+
            '</tr>'+
            '<tr>'+
                '<th></th>'+
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