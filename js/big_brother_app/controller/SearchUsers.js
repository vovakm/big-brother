/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.SearchUsers', {
	extend:'Ext.app.Controller',

	/*stores: ['Users'],
	 models: ['User'],*/
	views:[
		'users.SearchUsers'
	],

	init:function () {
		this.control({

			'globalMenu #SearchUserBtn menuitem':{ //клик на пункте меню
				click:this.menuitem_handler
			},
			'SearchUsers textfield':{ //поле поиска
				specialkey:function (field, e) {
					if (e.getKey() == e.ENTER)
						this.searchRequest(field)
				}
			},
			'SearchUsers button[action=send-search]':{ // клик на кнопке поиска
				click:function (button) {
					click: this.searchRequest(button)
				}
			},
			'globalMenu #search-simple':{ //быстрый поиск. полее ввода
				specialkey:function (field, e) {
					if (e.getKey() == e.ENTER)
						this.fastSearchRequest();
				}
			},
			'globalMenu button[action=search-simple]':{ //быстрый поиск. клик кнопки
				click:function (button) {
					click: this.fastSearchRequest();
				}
			}

		});
	},
	search_simple:function (button) {
		this.toggleToUserManagment();
		//		if (Ext.getCmp('id_SearchUsersPanel').collapsed) //свернутое?
		//			Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(button.action + '-form');
		Ext.getCmp('id_SearchUsersPanel').expand(); //развернем!
	},
	menuitem_handler:function (menuitem) {
		this.toggleToUserManagment();
		//		if (Ext.getCmp('id_SearchUsersPanel').collapsed) //свернутое?
		//			Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
		Ext.getCmp('id_SearchUsers').getLayout().setActiveItem(menuitem.action + '-form'); //перевернули курту
		Ext.getCmp('id_SearchUsers').getLayout().getActiveItem().items.items[0].items.items[0].focus(false, 700) //ставим фокус в поле ввода, после 0,7 секунд
		Ext.getCmp('id_SearchUsersPanel').expand(); //сим-сим.... откройся
	},

	searchRequest:function (item) {
		if (item.ownerCt.getForm().isValid()) {
			this.toggleToUserManagment();
			//			Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
			var data = item.ownerCt.getForm().getValues(); // получили данные формф
			data.action = item.ownerCt.ownerCt.id; //добавили параметр action и внесли значение типа поиска
			data.type = 's'; //тип переменой - срок
			Ext.getCmp('userList').getStore().getProxy().extraParams = data; // запульнули в стор новые параметры
			Ext.getStore('Users').load(); //пуф! грузим!
		}
	},
	fastSearchRequest:function () {
		this.toggleToUserManagment();
		if (Ext.getCmp('search-simple').isValid()) {
			var data = new Object;
			data.content = Ext.getCmp('search-simple').getValue();
			data.action = 'search-simple-form';
			data.type = 's';
			Ext.getCmp('userList').getStore().getProxy().extraParams = data;
			Ext.getStore('Users').load();
		}
	},
	toggleToUserManagment:function () {
		if (Ext.getCmp('id-globalPanel').getLayout().getActiveItem().id !== 'id-user-managment') {
			if (!Ext.getCmp('id_rightSidePanel').collapsed)
				Ext.getCmp('id_rightSidePanel').collapse();
			Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-user-managment'); // перключились на отображение пользователей
			Ext.getCmp('id_rightSidePanel').items.items[0].getLayout().setActiveItem('default-item-right-panel');
		}
	}
});



