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


Ext.onReady(function(){
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
		proxy: {
			// load using HTTP
			type: 'ajax',
			url: 'index.php/logs/getStatByDay',

			reader: {
				type: 'json'
			}
		}
	});
	
	var ds = Ext.create('Ext.data.ArrayStore', {
		fields: [
		{
			name: 'login', 
			type: 'string'
		},
		{
			name: 'event_date', 
			type: 'string'
		},
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
	//create a grid that will list the dataset items.
	var gridPanel = Ext.create('Ext.grid.Panel', {
		id: 'statistic',
		flex: 0.60,
		store: store,
		title:'Users',
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
		listeners: {
			selectionchange: function(model, records) {
				var json, name, i, l, items, series, fields;
				if (records[0]) {
					rec = records[0];
					if (!form) {
						form = this.up('form').getForm();
						fields = form.getFields();
					} else {
						fields = form.getFields();
					}
					form.loadRecord(rec);
				
				}
			}
		}
	});
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
        
		items: [
			{},
		{
            
			layout: {
				type: 'hbox', 
				align: 'stretch'
			},
			flex: 3,
			border: false,
			bodyStyle: 'background-color: transparent',
            
			items: [
				gridPanel, {
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

	//var gp = Ext.getCmp('statistic');
});
