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
Ext.application({
	enabled: true,
	name: 'bb_cpanel',
	version: '1.0',
	enableQuickTips: true,
	timeout: 120000, //2 minutes
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
	'statistic.by_users',
	'Users',
	'EditUser',
	'SearchUsers',
	'Statistic'
	//'Pages',
	],

	launch: function() {
		Ext.Ajax.request({
        url: '/js/ext-4.0.7-gpl/locale/ext-lang-ru.js',
        success: function(response, opts) {
            eval(response.responseText);
        },
        failure: function() {
            Ext.Msg.alert('Error', 'Couldn\'t load locale file');
        }
    });
		
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
