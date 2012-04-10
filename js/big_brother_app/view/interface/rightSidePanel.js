Ext.define('bb_cpanel.view.interface.rightSidePanel', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.rightSidePanel',
	itemId: 'rightSidePanel',
	region: 'east',
	layout: 'border',
	title: 'Дополнительна  панель',
	collapseDirection: 'left',
	width: '15%',
	collapsed: true,
	collapsible: true,
	split: true,
		items: [{
			region: 'north',
			xtype: 'panel',
			title: 'Информация',
			html: '<div style="padding: 5px">текст информации</div>',
			iconCls: 'information-ico',
			split: false,
			collapsed: false,
			collapsible: false,
			height: '35%'
		},{
			region: 'center',
			xtype: 'panel',
			title: 'Детали',
			html: '<div style="padding: 5px"><strong>тут тоже будет что-то</div>',
			iconCls: 'settings-ico',
			split: true,
			collapsed: false,
			collapsible: false
		}]
});