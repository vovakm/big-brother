/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.Loader.setConfig({
	enabled: true,
	paths: {
		basePath: '/js/big_brother_app', 
		Ext: '/js/ext-4.0.7-gpl/src'
	}
});

//Ext.require(["bb_cpanel.view.globalMenu"]);
//Ext.require(["bb_cpanel.controller.Main"]);
Ext.application({
	enabled: true,
	name: 'bb_cpanel',
	version: '1.0',
	enableQuickTips: true,
	appFolder: '/js/big_brother_app', 
	autoCreateViewport: false,
	historyTokenDelimiter: ':',
	historyPreview: '',
	logged: false,
	settings: {
		serverDateTimeFormat: 'Y-m-d H:i:s',
		serverDateFormat: 'Y-m-d',
		serverTimeFormat: 'H:i:s',
		dateTimeFormat: 'Y-m-d H:i:s',
		dateFormat: 'Y-m-d',
		timeFormat: 'H:i:s'
	},
	controllers: [
	'Main',
	//'Login',
	'Users',
	'SearchUsers'
	//'Pages',
	//'Proxies',
	//'Reports'
	],
	launch: function() {
		Ext.create('Ext.container.Viewport', {
			layout: 'border',
			padding: 6,
			items: [{
				xtype : 'globalMenu'
			},{
				xtype : 'globalPanel'
			},{
				xtype : 'rightSidePanel'
			}]
		})
            }
	
	
});
