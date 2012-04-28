/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.statistic.by_users', {
	extend:'Ext.app.Controller',
	stores:[
		'statistic.Stat_Users', 'statistic.graph-store'
	],
	models:['statistic.Stat_User'],
	views:[
		'statistic.itemslist.by_users', 'statistic.graphics.users_bars', 'statistic.graphics.users_lines'
	],
	init:function () {
		this.control({
			'viewport #id-iUsers':{ //клик на кнопке Статистика
				beforerender:this.loadItems,
				beforeitemdblclick:this.showGraphics
			}
		});
	},
	loadItems:function () {
		console.log('load iUsers');
		var data = new Object;
		data.content = '2011-09-05';
		data.type = 'users';
		Ext.getStore('statistic.Stat_Users').getProxy().extraParams = data;
		Ext.getStore('statistic.Stat_Users').load();
	},
	showGraphics:function (grid, selected) {
		console.log(selected.data.hourly_traffic[0].hour);
		var graph = Ext.getStore('statistic.graph-store');

		var graphItems = [];
		for (var i = 0; i < selected.data.hourly_traffic.length; i++) {
			graphItems[i] = [selected.data.hourly_traffic[i].hour, selected.data.hourly_traffic[i].traffic];
		}
		graph.loadData(graphItems);
	}
});
