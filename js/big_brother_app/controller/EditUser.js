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
			},
			'#EditUserForm tabpanel':{

				tabchange:function (tabPanel, newTab, oldTab, eOpts) {
					this.changeFormHeight(newTab.itemId)
				}
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
	changeFormHeight:function (item) {
		console.log(item);
		if (item === 'main')
			Ext.getCmp('EditUser-window').animate({to:{height:300}});
		if (item === 'advanced')
			Ext.getCmp('EditUser-window').animate({to:{height:470}});
		if (item === 'system')
			Ext.getCmp('EditUser-window').animate({to:{height:450}});
	}
});
