Ext.define('bb_cpanel.view.interface.globalPanel', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.globalPanel',
	id: 'id-globalPanel',
	//	itemId: 'globalPanel',
	region: 'center',
	frame: true,
	layout: 'card',
	flex: 0.8,
	items: [
	{
		xtype: 'container',
		id: 'id-user-managment',
		layout: 'border',
		items: [{
			xtype: 'SearchUsers'
		},{
			xtype: 'userList'
		}]
	},{			
		xtype: 'statistic-layout'
	}
	]

});