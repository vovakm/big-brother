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
	views: ['users.List'],
	init : function () {		
		this.control({
			'globalMenu #SearchUserBtn menuitem':{ //клик на пункте меню
				click: this.menuitem_handler
			},
			'viewport userList':{//загрузка таблици пользователей
				afterrender: this.loadUsers,
				beforeitemdblclick: this.dblclickItem
			},
			'SearchUsers textfield': { //поле поиска 
				specialkey: function(field, e) { 
					if(e.getKey() == e.ENTER)
						this.searchRequest(field) 
				} 
			},
			'SearchUsers button[action=send-search]':{ // клик на кнопке поиска
				click: function(button){
					click: this.searchRequest(button)
				}
			},
			'globalMenu #search-simple': { //быстрый поиск. полее ввода
				specialkey: function(field, e) { 
					if(e.getKey() == e.ENTER)  
						this.fastSearchRequest(); 
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
		console.log('edit_user_window');
		Ext.getStore('EditUser').load();
		var store = Ext.getStore('EditUser');
		var win = Ext.widget('EditUser-window');
		win.show();
		win.down('form').getForm().loadRecord(store.data.items[0]);
	},
	imageload: function(){
		console.log(this);
	},
	search_simple: function(button){
		Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(button.action+'-form');
		if(Ext.getCmp('id_SearchUsersPanel').collapsed) //свернутое?
			Ext.getCmp('id_SearchUsersPanel').expand(); //развернем!
	},
	menuitem_handler: function(menuitem){
		Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(menuitem.action+'-form'); //перевернули курту
		Ext.getCmp('id_SearchUsers').getLayout().getActiveItem().items.items[0].items.items[0].focus(false, 700) //ставим фокус в поле ввода, после 0,7 секунд
		if(Ext.getCmp('id_SearchUsersPanel').collapsed) //свернутое?
			Ext.getCmp('id_SearchUsersPanel').expand(); //сим-сим.... откройся
	},
	loadUsers: function(){
		Ext.getStore('Users').load();
	},
	searchRequest: function(item){
		if (item.ownerCt.getForm().isValid()){
			Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
			var data = item.ownerCt.getForm().getValues(); // получили данные формф
			data.action = item.ownerCt.ownerCt.id; //добавили параметр action и внесли значение типа поиска
			data.type = 's'; //тип переменой - срока
			Ext.getCmp('userList').getStore().getProxy().extraParams = data; // запульнули в стор новые параметры
			Ext.getStore('Users').load(); //пуф! грузим!
		}
	},
	fastSearchRequest: function(){
		if (Ext.getCmp('search-simple').isValid()){
			Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
			var data = new Object;
			data.content = Ext.getCmp('search-simple').getValue();
			data.action = 'search-simple-form';
			data.type = 's';
			Ext.getCmp('userList').getStore().getProxy().extraParams = data;
			Ext.getStore('Users').load();
		}
	}
});
