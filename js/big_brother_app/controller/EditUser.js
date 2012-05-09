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
		'combo.allUGroups', 'combo.allUStatuses', 'combo.allSamba', 'combo.allShell', 'EditUser'
	],
	models:[
		'combo.allList', 'combo.allShell', 'EditUser'
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
			'EditUser-window #comboUGroup':{

				blur:function (field) {
					this.loadSambaGroup(field)
				}
			},
			'EditUser-window button[action=saveUser]':{
				click:this.saveUser
			},
			'EditUser-window button[action=cancelWindow]':{
				click:this.cancelWindow
			}
		});
	},
	loadAccountData:function () {
		Ext.getCmp('EditUser-window').setHeight(300);
		Ext.getStore('combo.allUGroups').load();
		var store = Ext.getStore('EditUser');
//		if (store.getAt(0))
			store.on('load', function () {
				Ext.getCmp('EditUserForm').loadRecord(store.data.first())
				Ext.getCmp('userPhoto').html = '<img src="users/pic/' + store.getAt(0).get('id') + '" alt="" />'
				Ext.getCmp('comboUGroup').setValue(store.getAt(0).get('id_user_group'));
				Ext.getCmp('comboUStatus').setValue(store.getAt(0).get('id_status'));
				Ext.getCmp('comboShell').setValue(store.getAt(0).get('shell'));
				Ext.getCmp('comboSGroup').setValue(store.getAt(0).get('id_samba_group'));
			});
//		else
		console.log(store);

	},
	changeFormHeight:function (item) {
		//		console.log(item);
		if (item === 'main')
			Ext.getCmp('EditUser-window').animate({to:{height:300}});
		if (item === 'advanced')
			Ext.getCmp('EditUser-window').animate({to:{height:470}});
		if (item === 'system')
			Ext.getCmp('EditUser-window').animate({to:{height:350}});
	},
	saveUser:function (button) {
		var win = button.up('window');
		var form = win.down('form');

		form.submit({
			url:'users/userUpdate',
			waitMsg:'Saving Data...',
			success:function () {
				Ext.getStore('Users').load();
				win.close();
			}
		});
	},
	cancelWindow:function (button) {
		var win = button.up('window');
		var form = win.down('form');
		form.removeAll();
		win.close();

	},
	loadSambaGroup:function (field) {
		//		console.log(field.value);
		Ext.Ajax.request({
			method:'post',
			url:'users/findSambaGroup',
			params:{
				usergroupid:field.value
			},
			success:function (response) {
				var jData = Ext.JSON.decode(response.responseText);
				Ext.getCmp('comboSGroup').setValue(jData.sambaId);
			}
		});
	}
});
