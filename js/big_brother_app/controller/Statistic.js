/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.Statistic', {
	extend: 'Ext.app.Controller',
//	stores: ['Statistic'],
//	models: ['Statistic'],
	views: [
		'statistic.Statistic',
		'statistic.GraphicsViews',
		'statistic.ItemsViews'
	],
	init : function () {		
		this.control({
			'globalMenu #Statistic-mb':{ //клик на пункте меню
				click: this.statisticDefault
			}
		});
	},
	statisticDefault: function(){
		console.log('statisticDefault');
		Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-statistic-layout')
	}
});
