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
		'combo.allUGroups', 'combo.allUStatuses','combo.allSamba','combo.allShell', 'EditUser'
	],
	models:[
		'combo.allList','combo.allShell', 'EditUser'
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
			},
			'EditUser-window button[action=saveUser]':{
				click:this.saveUser
			}
		});
	},
	loadAccountData:function () {
		var store = Ext.getStore('EditUser');
		store.on('load', function () {
			Ext.getCmp('EditUserForm').loadRecord(store.data.first())
			Ext.getCmp('userPhoto').html = '<img src="users/pic/' + Ext.getStore('EditUser').data.items[0].data.id + '" alt="" />'
			Ext.getCmp('comboUGroup').setValue(Ext.getStore('EditUser').getAt(0).get('id_user_group'));
			Ext.getCmp('comboUStatus').setValue(Ext.getStore('EditUser').getAt(0).get('id_status'));
//			Ext.getCmp('comboShell').setValue(Ext.getStore('EditUser').getAt(0).get('shell'));

			Ext.getCmp('comboSGroup').setValue(Ext.getStore('EditUser').getAt(0).get('id_samba_group'));
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
	},
	saveUser:function (button) {
		var win = button.up('window');
		var form = win.down('form');

		form.submit({
			url:'users/update_user',
			waitMsg:'Saving Data...',
			success:function () {
				if (form.getRecord() == undefined) { /* IF ADD USER */
					Ext.getStore('Users').load({});
				} else { /* IF UPDATE USER */
					form.getRecord().set(form.getValues());
				}
				win.close();
			}
		});
	}
});
