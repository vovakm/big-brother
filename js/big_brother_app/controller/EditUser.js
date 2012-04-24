/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.EditUser', {
	extend: 'Ext.app.Controller',

	stores: [
		'combo.allUGroups',
		'EditUser'
	],
	models: [
		'combo.allUGroup',
		'EditUser'
	],
	views: ['users.EditUser'],

	init : function () {
		this.control({
			'#sf':{//загрузка таблици пользователей
				//load: this.loadallUGroups
			}
		});
	},
	loadallUGroups: function(){
		
		Ext.getStore('EditUser').load();
		var store = Ext.getStore('EditUser');
		//var win = Ext.widget('EditUser-window');
		Ext.getCmp('sf').getForm().loadRecord(store.data.items[0]);
		console.log('asdasdasd');
	}
});
