
Ext.define('CDT.controller.portal.ViewportController', {
    extend: 'Ext.app.Controller',

    views: 'portal.Viewport',
    
    init: function()
    {   
        var me = this;
        
        me.control({
            'viewportPortal': {
                render: me.renderViewport,
                afterrender: me.showLoginAndLoadConfig
            },
            '#portal-admin-button': {
                click: me.showLogin,
                mouseover: me.mouseOver,
                mouseout: me.mouseOut
            },
            '#portal-transporte-button': {
                click: me.showLogin,
                mouseover: me.mouseOver,
                mouseout: me.mouseOut
            },
            '#portal-tareas-operativas-button': {
                click: me.showLogin,
                mouseover: me.mouseOver,
                mouseout: me.mouseOut
            },
            '#portal-indicadores-button': {
                click: me.showLogin,
                mouseover: me.mouseOver,
                mouseout: me.mouseOut
            },
            '#portal-control-calidad-button': {
                click: me.showLogin,
                mouseover: me.mouseOver,
                mouseout: me.mouseOut
            },
            '#portal-control-calidad-button': {
                click: me.showLogin,
                mouseover: me.mouseOver,
                mouseout: me.mouseOut
            },
            '#portal-login-btn-ok': {
                click: me.validate,
                mouseover: me.loginBtnOver,
                mouseout: me.loginBtnOut
            },
            '#portal-login-btn-cancel': {
                click: me.closeLogin,
                mouseover: me.loginBtnOver,
                mouseout: me.loginBtnOut
            },
            '#login-textfield-usuario': {
                specialkey: me.specialkeyUsuarioText,
                render: me.renderUsuarioText
            },
            '#login-textfield-password': {
                specialkey: me.specialkeyPasswordText
            }
        });
    },
    // Render Viewport...
    renderViewport: function ()
    {
        var me = this; me.val_progress = false; // me.pr_val Usado en función login...
        
        me.tip_img = Ext.create('Ext.tip.ToolTip', {
            autoHide: false,
            shadow: false,
            width: 60,
            height: 60,
            cls: 'portal-login-tip',
            listeners: {
                 hide: function (tip) {
                    if (me.val === true)
                    {
                       tip.showAt(me.tipPositionImg()); 
                    } 
                    else {
                        tip.close();
                    }
                 }
            }
        });
        me.tip_form_invalid = Ext.create('Ext.tip.ToolTip', {
            title: '<b><span style="color:red;">Error:</span>',
            html: 'Formulario no válido, verifique las casillas en <b><span style="color:red;"><u>rojo</u>.</span></b>',
            id: 'login-tooltip'
        });
    },
    // Mostrar Login...
    showLogin: function(btn)
    {   
        var me = this, panel, 
        spot = Ext.create('Ext.ux.Spotlight', {
            easing: 'easeOut',
            duration: 300
        });
        panel = Ext.create('CDT.view.portal.LoginPanel',{
            renderTo: 'login',
            id: 'portal-login-panel',
            spot: spot
        });
        spot.show(panel.id);
        // ToolTip declaraciones...
        me.val = true;
        me.tip_img.update('<img src="../../images/portal/lock.png" />');
        me.tip_img.showAt(me.tipPositionImg());
        // Modulo o aplicacion a la que se quiere acceder...
        me.modulo = btn.name;
    },
    // Mostrar Login cuando se muestre el portal y prepararlo para acceder a un modulo determinado...
    showLoginAndLoadConfig: function ()
    {
        if (modulo !== '')
        {
            var me = this, btn = {};
            
            btn.name = modulo;
            
            me.showLogin(btn);
            me.showTipAccessDenied();
        }
    },
    // Cambiar CSS...
    mouseOver: function (btn)
    {
        btn.removeCls('x-btn-color');
        btn.addCls('x-btn-color-over');
    },
    // Cambiar CSS...
    mouseOut: function (btn)
    {
        btn.removeCls('x-btn-color-over');
        btn.addCls('x-btn-color');
    },
    // Cambiar CSS...
    loginBtnOver: function (btn)
    {
        btn.removeCls('portal-login-btn');
        btn.addCls('portal-login-btn-selected');
    },
    // Cambiar CSS...
    loginBtnOut: function (btn)
    {
        btn.removeCls('portal-login-btn-selected');
        btn.addCls('portal-login-btn');
    },
    // Close panel login.
    closeLogin: function ()
    {
        var panel = Ext.getCmp('portal-login-panel'), me = this;
        // Cierro el ToolTip si esta abierto...
        me.val = false;
        me.tip_img.close();
        me.tip_form_invalid.close();
        // Oculto el Spotlight y cierro el panel...
        panel.spot.hide();
        panel.close();
    },
    // Renderer UsuarioText
    renderUsuarioText: function (cmp)
    {
        cmp.focus(50, true);
    },
    // Enter al texfield Usuario... 
    specialkeyUsuarioText: function (field, e)
    {
        var me = this;
        
        if (e.getKey() === e.ESC)
        {
            me.closeLogin();
        }
        if (e.getKey() === e.ENTER)
        {
            var pass = Ext.getCmp('login-textfield-password');
            
            pass.focus(50, true);
        }
    },
    // Enter al texfield Contraseña... 
    specialkeyPasswordText: function (field, e)
    {
        var me = this;
        
        if (e.getKey() === e.ESC)
        {
            me.closeLogin();
        }
        if (e.getKey() === e.ENTER)
        {
            me.validate(field);
        }
    },
    // Validar formulario login...
    validate: function (btn)
    {   var me = this, form = btn.up('form');
        
        me.disabledButton(form, true);
        
        if (form.getForm().isValid()) {
            me.login(form.getForm().getValues(), form);
        } else {
            me.showTip();
            me.disabledButton(form, false);
        }
    },
    disabledButton: function (form, bool)
    {
        form.down('[id=portal-login-btn-ok]').setDisabled(bool);
        form.down('[id=portal-login-btn-cancel]').setDisabled(bool);
    },
    // Autenticar usuario...
    login: function (record, form)
    {
        var me = this; //console.log(me.encryptedText(record['password']));
        
        Ext.Ajax.request({
            url: entorno+'/secured/login/check',
            params: {
                username : record['username'],
                password : me.encryptedText(record['password']),
                rolename : me.modulo
            },
            success: function(response)
            {   
                switch(response.responseText)
                {
                    case '0':
                    case '1':
                    case '2':
                         Ext.ex.MessageBox('Resultado de Autenticación','Credenciales Invalidas.', 'warning');
                         me.disabledButton(form, false);
                        break;
                    default:
                        if (response.responseText.search(/app/i))
                        {
                            location.href = response.responseText;
                        }
                        else
                        {
                            Ext.ex.MessageBox('Error', response.responseText, 'error');
                        }
                        break;
                }
            },
            failure: function()
            {
                Ext.ex.MessageBox('Error', 'No se pudo conectar con el servidor, intentelo mas tarde.', 'error');
            }
        });         
    },
    // Mostrar ToolTip...
    showTip: function ()
    {
        var me = this;
        
        me.tip_img.update('<img src="../../images/portal/lock-error.png" />');
        
        me.tip_form_invalid.showAt(me.tipPositionMsg());
    },
    // Obtener posición del ToolTip...
    tipPosition: function ()
    {
        var panel = Ext.getCmp('portal-login-panel'), x, y, xy = [];

        x = panel.getX();
        y = panel.getY();

        xy.push(x, y);

        return xy;
    },
    // Obtener posición del ToolTip errores...
    tipPositionMsg: function ()
    {
        var me = this, xy = [];

        xy.push(me.tipPosition()[0] + 110, me.tipPosition()[1] + 174);

        return xy;
    },    
    // Obtener posición del ToolTip de la imagen...
    tipPositionImg: function ()
    {
        var me = this, xy = [];

        xy.push(me.tipPosition()[0] + 12, me.tipPosition()[1] + 12);

        return xy;
    },
    // Encriptado de clave (Algorismo revercible)...
    encryptedText: function (pass)
    {
        var bin2hex=function(str){
            var out='';
            for(var i=0;i<str.length;i++)
                    out+=hexdigits[str.charCodeAt(i)>>4]+hexdigits[str.charCodeAt(i)&15]+' ';
            return out;
        };
        var pad=function(x,y){
            if(x.length>=y)
                    return x.substr(0,y);
            for(var i=y-x.length;i;i--)
                    x+=String.fromCharCode(Math.floor(Math.random()*256));
            return x;
        };
        var hexdigits='0123456789ABCDEF';
        var hexLookup=Array(256);
        for(var i=0;i<256;i++)
                hexLookup[i]=hexdigits.indexOf(String.fromCharCode(i));
        //---------------------------------------------------------------------------------------------
        var key = '12345678911234567892123456789312',
            cr = 'rijndael-128',
            mod = 'cbc',
            iv = '1234567891123456';
        
        iv = pad(iv,mcrypt.get_iv_size(cr,mod));

        mcrypt.Crypt(null,null,null, key, cr, mod);

        return bin2hex(mcrypt.Encrypt(pass,iv));
    }
});


