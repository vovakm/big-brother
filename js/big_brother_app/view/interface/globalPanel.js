Ext.define('bb_cpanel.view.interface.globalPanel', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.globalPanel',
	itemId: 'globalPanel',
	region: 'center',
	layout: 'border',
	
	flex: 0.8,
	items: [{

		
		xtype: 'SearchUsers'
		},{
		
		xtype: 'userList'
		
	}]
});