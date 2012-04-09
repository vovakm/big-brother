/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.require([
	'Ext.form.*',
	'Ext.data.*',
	'Ext.chart.*',
	'Ext.grid.Panel',
	'Ext.layout.container.Column'
	]);

<<<<<<< HEAD
Ext.Ajax.timeout = 120000; //2 minutes
Ext.onReady(function(){
    
	//use a renderer for values in the data view.


	   
=======

Ext.onReady(function(){
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
	//use a renderer for values in the data view.
	function perc(v) {
		return v + '%';
	}

	var bd = Ext.getBody(),
	form = false,
	rec = false,
	selectedStoreItem = false,
	//performs the highlight of an item in the bar series
	selectItem = function(storeItem) {
		var name = storeItem.get('login'),
		series = barChart.series.get(0),
		i, items, l;
            
		series.highlight = true;
		series.unHighlightItem();
		series.cleanHighlights();
		for (i = 0, items = series.items, l = items.length; i < l; i++) {
			if (name == items[i].storeItem.get('login')) {
				selectedStoreItem = items[i].storeItem;
				series.highlightItem(items[i]);
				break;
			}
		}
		series.highlight = false;
	}

<<<<<<< HEAD
//	models
	Ext.define('ustat',{
		extend: 'Ext.data.Model',
		fields: [
		'event_date',  'login', 'trafic', 'h_name', 'h_trafic'
		]
	});
	Ext.define('model_statisticChart',{
		extend: 'Ext.data.Model',
		fields: [
		'hour',  'trafic'
		]
	});
//	stores
	var store = Ext.create('Ext.data.Store', {
		model: 'ustat',
		autoLoad: true,	
=======
	
	Ext.define('ustat',{
		extend: 'Ext.data.Model',
		fields: [
		// set up the fields mapping into the xml doc
		// The first needs mapping, the others are very basic
		'event_date',  'login', 'trafic', 'h_name', 'h_trafic'
		]
	});

	// create the Data Store
	var store = Ext.create('Ext.data.Store', {
		model: 'ustat',
		autoLoad: true,
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
		proxy: {
			// load using HTTP
			type: 'ajax',
			url: 'index.php/logs/getStatByDay',
<<<<<<< HEAD
			actionMethods: {
				read: 'POST'
			},
			reader: {
				type: 'json'
				
=======

			reader: {
				type: 'json'
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
			}
		}
	});
	
<<<<<<< HEAD
	var store_statisticChart = Ext.create('Ext.data.Store', {
		model: 'model_statisticChart',
		autoLoad: true,	
		proxy: {
			// load using HTTP
			type: 'ajax',
			url: 'index.php/logs/getDataByUser',
			actionMethods: {
				read: 'POST'
			},
			reader: {
				type: 'json'
			}
		}
	});
=======
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
	var ds = Ext.create('Ext.data.ArrayStore', {
		fields: [
		{
			name: 'login', 
			type: 'string'
		},
<<<<<<< HEAD

=======
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
		{
			name: 'event_date', 
			type: 'string'
		},
<<<<<<< HEAD

		{
			name: 'trafic', 
			type: 'float'
		}
            
		],
		data: store
	});
	
		var dateMenu = Ext.create('Ext.menu.DatePicker', {
		handler: function(msg, date){
			var date = Ext.Date.format(date, 'Y-m-d');
			store.load({
				params: 'date='+date
			});
		}
	});
	var statisticChart = Ext.create('Ext.chart.Chart', {
		margin: '0 0 0 0',
		insetPadding: 20,
		flex: 2.0,
		xtype: 'chart',
		animate: true,
		shadow: true,
		store: store_statisticChart,
		axes: [{
			type: 'Numeric',
			position: 'left',
			fields: ['trafic'],
			title: 'Transfer data',
			grid: true,
			minimum: 0
		}, {
			type: 'Category',
			position: 'bottom',
			fields: ['hour'],
			title: 'Working hours',
			label: {
				rotate: {
					degrees: 0
				}
			}
		}],
		series: [{
			type: 'column',
			axis: 'left',
			gutter: 80,
			xField: ['hour'],
			yField: ['trafic'],
			tips: {
				trackMouse: true,
				width: 74,
				height: 38,
				renderer: function(storeItem, item) {
					this.setTitle(storeItem.get('hour') + '<br />' + storeItem.get('trafic'));
				}
			},
			style: {
				fill: '#38B8BF'
			}
		}]
        
	});
    
=======
		{
			name: 'trafic', 
			type: 'float'
		},
		{
			name: 'h_hour',
			type: 'int'
		},
		{
			name: 'h_trafic'
		}  
		],
		data: store
	});
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
	//create a grid that will list the dataset items.
	var gridPanel = Ext.create('Ext.grid.Panel', {
		id: 'statistic',
		flex: 0.60,
		store: store,
		title:'Users',
<<<<<<< HEAD

=======
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
		columns: [
		{
			id     :'login',
			text   : 'Login',
			flex: 1,
			sortable : true,
			dataIndex: 'login'
		},
		{
			text     : 'Trafic',
			width    : 75,
			sortable : true,
			align: 'right',
			dataIndex: 'trafic'
		}
		],
<<<<<<< HEAD

		listeners: {
			selectionchange: function(model, records) {
				store_statisticChart.load({
				params: 'login='+records[0].data.login+'&day='+records[0].data.event_date
			});
=======
		listeners: {
			selectionchange: function(model, records) {
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
				var json, name, i, l, items, series, fields;
				if (records[0]) {
					rec = records[0];
					if (!form) {
						form = this.up('form').getForm();
						fields = form.getFields();
<<<<<<< HEAD
					
					} else {
						fields = form.getFields();
					}
                    
=======
					} else {
						fields = form.getFields();
					}
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
					form.loadRecord(rec);
				
				}
			}
		}
	});
<<<<<<< HEAD
	var toolbar = Ext.create('Ext.toolbar.Toolbar');
	toolbar.suspendLayout = true;
	var menu = Ext.create('Ext.menu.Menu', {
		id: 'mainMenu',
		style: {
			overflow: 'visible'     // For the Combo popup
		},
		items: [
		{
			text: 'Choose a Date',
			iconCls: 'calendar',
			menu: dateMenu // <-- submenu by reference
		}
		]
	});
	toolbar.add({
		text:'Button / Menu',
		iconCls: 'bmenu',  // <-- icon
		menu: menu  // assign menu by instance
	}, {
		text: 'Users',
		iconCls: 'user',
		menu: {
			xtype: 'menu',
			plain: true,
			items: {
				xtype: 'buttongroup',
				title: 'User options',
				columns: 2,
				defaults: {
					xtype: 'button',
					scale: 'large',
					iconAlign: 'left'
				},
				items: [{
					text: 'User<br/>manager',
					iconCls: 'edit',
					width: 90
				},{
					iconCls: 'add',
					width: 'auto',
					tooltip: 'Add user',
					width: 40
				},{
					colspan: 2,
					text: 'Import',
					scale: 'small',
					width: 130
				},{
					colspan: 2,
					text: 'Who is online?',
					scale: 'small',
					width: 130
				}]
			}
		}
	});

=======
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
	var gridForm = Ext.create('Ext.form.Panel', {
		title: 'Statistic',
		frame: true,
		bodyPadding: 5,
		width: 960,
		height: 800,
		fieldDefaults: {
			labelAlign: 'left',
			msgTarget: 'side'
		},
		layout: {
			type: 'vbox',
			align: 'stretch'
		},
<<<<<<< HEAD
		items: [
		toolbar,statisticChart,
=======
        
		items: [
			{},
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
		{
            
			layout: {
				type: 'hbox', 
				align: 'stretch'
			},
			flex: 3,
			border: false,
			bodyStyle: 'background-color: transparent',
            
			items: [
<<<<<<< HEAD
			gridPanel, {
=======
				gridPanel, {
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
				flex: 0.4,
				layout: {
					type: 'vbox',
					align:'stretch'
				},
				margin: '0 0 0 5',
				title: 'User Details',
				items: [{
					margin: '5',
					xtype: 'fieldset',
					flex: 1,
					title:'User details',
					defaults: {
						width: 240,
						labelWidth: 90
					},
					defaultType: 'numberfield',
					items: [{
						fieldLabel: 'Login',
						name: 'login',
						xtype: 'textfield'
					},{
						fieldLabel: 'Trafic by day',
						name: 'trafic',
						xtype: 'textfield'
					}]
				}]
			}]
		},],
		renderTo: 'tt'
	});
<<<<<<< HEAD
=======

	//var gp = Ext.getCmp('statistic');
>>>>>>> d7c19a200a2d68b9025e17ce4a23b1e0fa4c76ff
});
