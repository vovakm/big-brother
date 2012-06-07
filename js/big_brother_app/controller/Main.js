Ext.define('bb_cpanel.controller.Main', {
	extend : 'Ext.app.Controller',
	views : [
	'interface.globalMenu',
	'interface.globalPanel',
	'interface.rightSidePanel',
	'importWindow'
	],
    init: function(){
        this.control({
            'viewport button[action=logout]':{
                click: this.onLogout
            },
            'viewport menuitem[action=import-from-file]':{
                click: this.importWindow
            }
        });
    },


    onLogout: function(button){
        location.href = '/logout'+'?uid='+Math.floor((Math.random()*10000)+1);;
    },
    importWindow:function () {
        Ext.widget('importWindow').show();
    }
});
