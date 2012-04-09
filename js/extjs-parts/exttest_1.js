/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.require('Ext.chart.*');
Ext.require(['Ext.Window', 'Ext.fx.target.Sprite', 'Ext.layout.container.Fit']);

var Renderers = {};


Ext.onReady(function () {
    

console.log(store1);

	Ext.define('model_statisticChart',{
		extend: 'Ext.data.Model',
		fields: [
		'hour',  'sum', 'user'
		]
	});
	
	var store_statisticChart = Ext.create('Ext.data.Store', {
		model: 'model_statisticChart',
		autoLoad: true,	
		proxy: {
			// load using HTTP
			type: 'ajax',
			url: 'http://myci.local/logs/allTrffiAllUserDay',
			actionMethods: {
				read: 'POST'
			},
			reader: {
				type: 'json'
			}
		}
	});


     var win = Ext.create('Ext.Window', {
        width: 1260,
        height: 300,
        minHeight: 400,
        minWidth: 550,
        hidden: false,
        
        title: 'Scatter Chart Renderer',
        renderTo: Ext.getBody(),
        layout: 'fit',
        items: {
            id: 'chartCmp',
            xtype: 'chart',
            style: 'background:#fff',
            animate: true,
            store: store_statisticChart,
            axes: false,
            insetPadding: 5,
            series: [{
                type: 'scatter',
                axis: false,
                xField: 'hour',
                yField: 'sum',
                color: '#ccc',
                markerConfig: {
                    type: 'circle',
                    radius: 2,
                    size: 2
                }
            }]
        }
    });
});

