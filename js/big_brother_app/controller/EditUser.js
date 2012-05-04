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
        //Ext.getCmp('EditUser-window').animate({to:{height:400}});
		store.on('load', function () {
			Ext.getCmp('EditUserForm').loadRecord(store.data.first())
			Ext.getCmp('userPhoto').html = '<img src="users/pic/' + Ext.getStore('EditUser').data.items[0].data.id +1000+ '" alt="" />'
		})
	}
});
