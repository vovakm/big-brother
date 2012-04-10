/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.Users', {
	extend: 'Ext.app.Controller',

	stores: ['Users'],
	models: ['User'],
	views: [
	'users.List'
	],

	init : function () {		
		this.control({
			'globalMenu button[action=search-simple]':{
				click: this.search_simple
			},
			'globalMenu menuitem':{
				click: this.menuitem_handler
			},
			'viewport userList':{
				afterrender: this.loadUsers
			},
			'SearchUsers textfield': { 
				specialkey: function(field, e) { 
					if(e.getKey() == e.ENTER) { 
						this.searchRequest(field)
//						console.log(field.ownerCt);
//						console.log(field.value);
//						console.log(field.ownerCt.getForm().getValues())
						//Ext.Msg.alert("Alert","Enter Key Event !");
						//Ext.getCmp('search-by-name-form').items.items[0].getForm().submit()
					} 
				} 
			},
			'SearchUsers button[action=send-search]':{
				click: function(button){
					click: this.searchRequest(button)
				}
			}


			
		/*,
			'globalMenu menuitem[action=search-advanced]':{
				click: this.search_advanced
			},
			'globalMenu menuitem[action=search-by-name]':{
				click: this.search_by_name
			},
			'globalMenu menuitem[action=search-by-ugroup]':{
				click: this.search_by_ugroup
			},
			'globalMenu menuitem[action=search-by-login]':{
				click: this.search_by_login
			},
			'globalMenu menuitem[action=search-by-pass]':{
				click: this.search_by_pass
			},
			'globalMenu menuitem[action=search-templates]':{
				click: this.search_templates
			}*/
			
		});
	},
	search_simple: function(button){
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(button.action+'-form');
		if(Ext.getCmp('id_SearchUsersPanel').collapsed)
			Ext.getCmp('id_SearchUsersPanel').expand();
	},
	menuitem_handler: function(menuitem){
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(menuitem.action+'-form');
		if(Ext.getCmp('id_SearchUsersPanel').collapsed)
			Ext.getCmp('id_SearchUsersPanel').expand();
	},
	loadUsers: function(){
		Ext.getStore('Users').load({
			//params: 'action='+'sblog'+'&content='+'ko'+'&type='+'s'
		});
	},
	searchRequest: function(item){
//console.log(item.ownerCt.getForm().getValues())
var data = item.ownerCt.getForm().getValues();
data.action = item.ownerCt.ownerCt.id;
		Ext.getStore('Users').load({
			params: data
			
		});
	}
	
/*
	params: {
			action: 'sblog',
			content: 'kot',
			type: 's'
		},
	*/
	
});
