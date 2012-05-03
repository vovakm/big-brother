/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.EditUser', {
	extend:'Ext.app.Controller',

	stores:[
		'combo.allUGroups', 'EditUser'
	],
	models:[
		'combo.allUGroup', 'EditUser'
	],
	views:['users.EditUser'],

	init:function () {
		this.control({
			'#EditUserForm':{//загрузка таблици пользователей
				render:this.loadAccountData
			}
		});
	},
	loadAccountData:function () {
		var store = Ext.getStore('EditUser');
		store.on('load', function () {
			Ext.getCmp('EditUserForm').loadRecord(store.data.first())
			Ext.getCmp('userPhoto').html = '<img src="users/pic/' + Ext.getStore('EditUser').data.items[0].data.id + '" alt="" />'
		})
	},
	imagge:function () {
		//Ext.getStore('EditUser').data.items[0].data.id
		//return '<img src="http://placehold.it/150x'+50+'" alt="" />'
	}
});
