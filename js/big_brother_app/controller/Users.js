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
			'viewport userList':{ //load user list
				afterrender:this.loadUsers, //load user store, after grid render
				beforeitemdblclick:this.dblclickItem //action on "user edit". When admin dbClick on item of grid.
			},
			'userList button[action=userAdd]':{ // create new user. Show empty form
				click:this.userAdd
			}
		});
	},
	dblclickItem:function (grid, selected) {
		Ext.getStore('EditUser').load({params:{action:'getUserData', uid:selected.data.id}});
		Ext.widget('EditUser-window').show();
	},
	userAdd:function () {
		Ext.widget('EditUser-window').show();
	},
	loadUsers:function () {
		Ext.getStore('Users').load();
	}
});
