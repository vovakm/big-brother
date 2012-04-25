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
		'statistic.Stat_Users',
		'statistic.graph-store'
	],
	models:['statistic.Stat_User'],
	views:[
		'statistic.itemslist.by_users',
		'statistic.graphics.users_bars',
		'statistic.graphics.users_lines'
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

//		Ext.getStore('statistic.graph-store').loadData(
//			[selected.data.hourly_traffic[0].hour, selected.data.hourly_traffic[0].traffic]
//		)
//		myStore.loadData([
//			['Загловок №1', 'Автор №1'],
//			['Заголово №2', 'Автор №2']
//		]);
		graph.loadData([
			[selected.data.hourly_traffic[0].hour, selected.data.hourly_traffic[0].traffic],
			[selected.data.hourly_traffic[1].hour, selected.data.hourly_traffic[1].traffic],
			[selected.data.hourly_traffic[2].hour, selected.data.hourly_traffic[2].traffic],
			[selected.data.hourly_traffic[3].hour, selected.data.hourly_traffic[3].traffic]
		]);
	}
})
;
