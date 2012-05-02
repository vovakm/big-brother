/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.Users', {
	extend:'Ext.app.Controller',
	stores:['Users'],
	models:['User'],
	views:['users.List'],
	init:function () {
		this.control({
			'viewport userList':{//загрузка таблици пользователей
				afterrender:this.loadUsers,
				beforeitemdblclick:this.dblclickItem
			}
		});
	},
	dblclickItem:function (grid, selected) {
		Ext.getStore('EditUser').load({params:{action:'getUserData', uid:selected.data.id}});
		Ext.widget('EditUser-window').show();
	},
	loadUsers:function () {
		Ext.getStore('Users').load();
	}
});
