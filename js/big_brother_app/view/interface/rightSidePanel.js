Ext.define('bb_cpanel.view.interface.rightSidePanel', {
	extend:'Ext.panel.Panel',
	alias:'widget.rightSidePanel',
	id:'id_rightSidePanel',
	region:'east',
	layout:'border',
	title:'Дополнительна  панель',
	titleCollapse:true,
	//	collapseDirection:'right',
	width:'15%',
	collapsed:true,
	collapsible:true,
	split:true,
	items:[
		{
			region:'north',
			layout:'card',
			split:false,
			collapsed:false,
			collapsible:false,
			height:'35%',
			items:[
				{
					xtype:'panel',
					title:'Информация',

					id:'default-item-right-panel',
					iconCls:'information-ico',
					html:'<div style="padding: 5px"></div>'

				},
				{
					xtype:'form',
					title:'Выбор даты',
					id:'datepicker-statistic-layout',
					iconCls:'datepicker-ico',
					defaultType:'datefield',
					bodyStyle:'padding:5px',
					items:[
						{
							fieldLabel:'Начальная дата',
							name:'startdt',
							id:'startdt-statistic-range',
							value:  new Date(),
							format: 'd.m.Y',
							maxDate: new Date()
						},
						{
							fieldLabel:'Конечная дата',
							name:'enddt',
							id:'enddt-statistic-range',
							value:  new Date(),
							format: 'd.m.Y',
							maxDate: new Date()
						}
					]

				}
			]

		},
		{
			region:'center',
			xtype:'panel',
			title:'Детали',
			html:'<div style="padding: 5px"><strong>тут тоже будет что-то</div>',
			iconCls:'settings-ico',
			split:true,
			collapsed:false,
			collapsible:false
		}
	]
});