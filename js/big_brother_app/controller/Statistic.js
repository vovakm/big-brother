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
			},
			'#startdt-statistic-range':{
				change: this.dateRange
			},
			'#enddt-statistic-range':{
				change: this.dateRange
			}

		});
	},
	statisticDefault: function(){
		Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-statistic-layout');

	},
	dateRange: function(){
		var data = new Object;
		Ext.getCmp('enddt-statistic-range').setMinValue(Ext.getCmp('startdt-statistic-range').value);
		data.startDate = Ext.Date.format(Ext.getCmp('startdt-statistic-range').value, "Y-m-d");
		data.endDate = Ext.Date.format(Ext.getCmp('enddt-statistic-range').value, "Y-m-d");
		data.type = 'users';
		Ext.getStore('statistic.Stat_Users').getProxy().extraParams = data;
		//Ext.getCmp('enddt').setMaxValue(Ext.getCmp('startdt').value)
	}
});
