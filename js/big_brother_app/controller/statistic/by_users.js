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
				afterrender:this.initElements,
				beforeitemclick:this.showGraphics
			},
			'globalMenu #Statistic-mb':{
				click:this.toggleToStatisticLayuot
			}
		});
	},
	loadItems:function () {
		var date = new Date();
		date = Ext.Date.format(date, "Y-m-d");
		var data = new Object;
		data.startDate = date;
		data.endDate = date;
		data.type = 'users';
		Ext.getStore('statistic.Stat_Users').getProxy().extraParams = data;
		Ext.getStore('statistic.Stat_Users').load();
	},
	initElements:function () {
		var date = new Date();
		Ext.getCmp('startdt-statistic-range').setMaxValue(date);
		Ext.getCmp('enddt-statistic-range').setMaxValue(date);
		Ext.getCmp('enddt-statistic-range').setMinValue(date);
		date = Ext.Date.format(date, "Y-m-d");
		var data = new Object;
		data.startDate = date;
		data.endDate = date;
		data.type = 'users';
		Ext.getStore('statistic.Stat_Users').getProxy().extraParams = data;
	},
	showGraphics:function (grid, selected) {
		Ext.getCmp('graphics-card-layout').getEl().mask('Загрузка данных...');
//		console.log(selected.data.id_user);
		var data = new Object;
		data.startDate = Ext.getStore('statistic.Stat_Users').getProxy().extraParams['startDate'];
		data.endDate = Ext.getStore('statistic.Stat_Users').getProxy().extraParams['endDate'];
		data.uid = selected.data.id_user;
		data.type = 'dataByUser';
		Ext.getStore('statistic.graph-store').getProxy().extraParams = data;
		Ext.getStore('statistic.graph-store').load();
		Ext.getStore('statistic.graph-store').on('load', function(){
			Ext.getCmp('graphics-card-layout').getEl().unmask();
		})


		//		в случае, когда передаем все за один раз.
		//		var graph = Ext.getStore('statistic.graph-store');
		//		var graphItems = [];
		//		for (var i = 0; i < selected.data.hourly_traffic.length; i++) {
		//			graphItems[i] = [selected.data.hourly_traffic[i].hour, selected.data.hourly_traffic[i].traffic];
		//		}
		//		graph.loadData(graphItems);
	},
	toggleToStatisticLayuot:function () {
		if (Ext.getCmp('id-globalPanel').getLayout().getActiveItem().id !== 'id-statistic-layout') {
			if (Ext.getCmp('id_rightSidePanel').collapsed)
				Ext.getCmp('id_rightSidePanel').expand();
			Ext.getCmp('id-globalPanel').getLayout().setActiveItem('id-statistic-layout'); // перключились на отображение пользователей
			Ext.getCmp('id_rightSidePanel').items.items[0].getLayout().setActiveItem('datepicker-statistic-layout');
		}
	}
});
