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
	'users.List',
	'users.EditUser'
	],

	init : function () {		
		this.control({
			'globalMenu #SearchUserBtn menuitem':{ //клик на пункте меню
				click: this.menuitem_handler
			},
			'viewport userList':{//загрузка таблици пользователей
				afterrender: this.loadUsers,
				beforeitemdblclick: this.dblclickItem
			},
			'user-window':{//загрузка таблици пользователей
				afterrender: this.imageload
			},
			'SearchUsers textfield': { //поле поиска 
				specialkey: function(field, e) { 
					if(e.getKey() == e.ENTER) { 
						this.searchRequest(field)
					} 
				} 
			},
			'SearchUsers button[action=send-search]':{ // клик на кнопке поиска
				click: function(button){
					click: this.searchRequest(button)
				}
			},
			'globalMenu #search-simple': { //быстрый поиск. полее ввода
				specialkey: function(field, e) { 
					if(e.getKey() == e.ENTER) { 
						this.fastSearchRequest();
					} 
				} 
			},
			'globalMenu button[action=search-simple]':{ //быстрый поиск. клик кнопки
				click: function(button){
					click: this.fastSearchRequest();
				}
			},
			'userList':{
				
				
				
			}

		});
	},
	dblclickItem: function(grid, selected){
        var win = Ext.widget('user-window').show();
        win.down('form').getForm().loadRecord(selected);
    },
	imageload: function(){
		console.log(this);
    
    },
	search_simple: function(button){
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(button.action+'-form');
		if(Ext.getCmp('id_SearchUsersPanel').collapsed)
			Ext.getCmp('id_SearchUsersPanel').expand();
	},
	menuitem_handler: function(menuitem){
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(menuitem.action+'-form');
		Ext.getCmp('id_SearchUsers').getLayout().getActiveItem().items.items[0].items.items[0].focus(false, 700)
		if(Ext.getCmp('id_SearchUsersPanel').collapsed){
			Ext.getCmp('id_SearchUsersPanel').expand();
		//Ext.getCmp('aaa').focus(false, 700)
		//textField.setFocus('', 10);
		}
	},
	loadUsers: function(){
		Ext.getStore('Users').load();
	},
	searchRequest: function(item){
		if (item.ownerCt.getForm().isValid()){
			var data = item.ownerCt.getForm().getValues();
			data.action = item.ownerCt.ownerCt.id;
			data.type = 's';
			Ext.getCmp('userList').getStore().getProxy().extraParams = data
			Ext.getStore('Users').load();
		}
	},
	fastSearchRequest: function(){
		if (Ext.getCmp('search-simple').isValid()){
			var data = new Object;
			data.content = Ext.getCmp('search-simple').getValue();
			data.action = 'search-simple-form';
			data.type = 's';
			Ext.getCmp('userList').getStore().getProxy().extraParams = data
			Ext.getStore('Users').load();
		}
	}
	
/*
	params: {
			action: 'sblog',
			content: 'kot',
			type: 's'
		},
	*/
	
});
