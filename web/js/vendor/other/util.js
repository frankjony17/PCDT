Ext.ex = function(){
    var msgCt;
    
    function createBox(t, s){
       return '<div class="msg"><h3>' + t + '</h3><p>' + s + '</p></div>';
    }
    return {
        msg : function(title, format)
        {
            if(!msgCt){
                msgCt = Ext.DomHelper.insertFirst(document.body, {id:'msg-div'}, true);
            }
            var s = Ext.String.format.apply(String, Array.prototype.slice.call(arguments, 1));
            var m = Ext.DomHelper.append(msgCt, createBox(title, s), true);
            m.hide();
            m.slideIn('t').ghost("t", { delay: 1500, remove: true});
        },
        init : function()
        {
            if(!msgCt){
                // It's better to create the msg-div here in order to avoid re-layouts 
                // later that could interfere with the HtmlEditor and reset its iFrame.
                msgCt = Ext.DomHelper.insertFirst(document.body, {id:'msg-div'}, true);
            }
        },
       // MessageBox utilizados en todos los controladores...
        MessageBox: function (title, msg, icon)
        { 
            var iconBox = '';

            if(icon === 'info') {
                iconBox = Ext.MessageBox.INFO;
            } else if (icon === 'question'){
                iconBox = Ext.MessageBox.QUESTION;
            } else if (icon === 'warning'){
                iconBox = Ext.MessageBox.WARNING;
            } else if (icon === 'error'){
                iconBox = Ext.MessageBox.ERROR;
            }
            Ext.MessageBox.show({
                title  : title,
                msg    : msg,
                buttons: Ext.MessageBox.OK,
                icon   : iconBox,
                y      : 60
            }); 
        },
       //Utilizado en los arbooles...
        items: function (ac, id)
        {   var vp = Ext.getCmp('view-viewport-id');
            switch(ac) {
                case '0':
                    return vp.itemstab[0];
                case 'push':
                    return vp.itemstab.push(id);
                case 'length':
                    return vp.itemstab.length;
                case 'remove':
                    return vp.itemstab = id;
                case 'clear':
                    return vp.itemstab = [];    
                default:
                    return vp.itemstab;
            }
        },//Utilizado en los arbooles...
        count: function (ac)
        {   var vp = Ext.getCmp('view-viewport-id');
            switch(ac) {
                case '++':
                    return vp.counttab++;
                default:
                    return vp.counttab;
            }
        },//Utilizado en los arbooles...
        removeId: function (id)
        {   var ids = this.items();
            this.items('clear');
            for (var i = 0; i < ids.length; i++)
            {
                if (ids[i] !== id)
                    this.items('push', ids[i]);
            }
        },//Utilizado en los arbooles...
        findId: function (id)
        {   for (var i = 0; i < this.items('length'); i++)
            {
                if (this.items()[i] === id)
                    return true;
            } return false;
        },
       //Obtener altura del grid según la posición del área south - la altura de la barra de estado...
        height: function (id, val) 
        {
            var southPosition = Ext.getCmp(id).getPosition()[1];

            return southPosition - val;
        },
        // @Crear toolTips...
        tip: function (target, title, html)
        {
            Ext.create('Ext.tip.ToolTip', {
                target: target,
                title: title,
                html: html,
                trackMouse: true
            });
        },
        // Open windows en el navegador
        open: function (link)
         {
            window.open(link, "", "");
         },
        // Mensage Ext JS 5.00
        toast: function(title, html) {
            Ext.toast({
                title: title,
                html: html,
                align: 't',
                closable: false,
                slideInDuration: 400
            });
        }
    };
}();
