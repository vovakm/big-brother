Ext.define('bb_cpanel.view.users.SearchUsers', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.SearchUsers',
	//itemId: 'id_SearchUsers',
	id: 'id_SearchUsersPanel',
	region: 'north',
	//Ext.getCmp('id_SearchUsers').expand()

	split: true,
	collapsed: true,
	collapsible: true,
	title: 'Параметры поиска',
	items: [{
		region: 'center',
		xtype: 'panel',		
		layout: 'card',
		id: 'id_SearchUsers',
		items:[{
			xtype: 'panel',		
			id: 'search-simple-form',
			layout: 'column',
			items: [{
				columnWidth: .75,
				xtype: 'form',
				layout: 'hbox',
				frame:true,
				title: 'Быстрый поиск',
				bodyStyle:'padding:5px 5px 0',
				fieldDefaults: {
					msgTarget: 'side',
					labelWidth: 150
				},
				defaultType: 'textfield',
				defaults: {
					anchor: '50%'
				},
				items: [{
					emptyText: 'Ключевое слово для поиска',
					name: 'content',
					allowBlank:false,
					width: 400
				},{
					xtype: 'button',
					text: 'Найти',
					action: 'send-search',
					margins: '0 0 0 10',
					width: 120
				}]
			 
				
			},{
				title: 'Width = 250px',
				columnWidth: .25,
				html: 'Content'
			}]
		},{
			xtype: 'panel',		
			id: 'search-advanced-form',
			layout: 'column',
			items: [{
				columnWidth: .75,
				xtype: 'form',
				frame:false,
				title: 'Расширенный поиск',
				bodyStyle:'padding:5px 5px 0',
				fieldDefaults: {
					msgTarget: 'side',
					labelWidth: 75
				},
				defaultType: 'textfield',
				defaults: {
					anchor: '50%'
				},

				items: [{
					fieldLabel: 'First Name',
					name: 'first',
					allowBlank:false
				},{
					fieldLabel: 'Last Name',
					name: 'last'
				}],

				buttons: [{
					text: 'Save'
				},{
					text: 'Cancel'
				}]
				
			},{
				title: 'Width = 250px',
				columnWidth: .25,
				html: 'Content'
			}]
		},{
			xtype: 'panel',		
			id: 'search-by-name-form',
			layout: 'column',
			items: [{
				columnWidth: .75,
				xtype: 'form',
				frame:false,
				url:'asd.php',
				title: 'Поиск по имени пользователя',
				bodyStyle:'padding:5px 5px 0',
				fieldDefaults: {
					msgTarget: 'side',
					labelWidth: 75
				},
				defaultType: 'textfield',
				defaults: {
					anchor: '50%'
				},

				items: [{
					fieldLabel: 'First Name',
					name: 'first',
					allowBlank:false
				},{
					fieldLabel: 'Last Name',
					name: 'last'
				}],

				buttons: [{
					text: 'Save'
				},{
					text: 'Cancel'
				}]
				
			},{
				title: 'Width = 250px',
				columnWidth: .25,
				html: 'Content'
			}]
		},{
			xtype: 'panel',		
			id: 'search-by-ugroup-form',
			layout: 'column',
			items: [{
				columnWidth: .75,
				xtype: 'form',
				frame:false,
				layout: 'hbox',
				title: 'Поиск по группам',
				bodyStyle:'padding:5px 5px 0',
				fieldDefaults: {
					msgTarget: 'side',
					labelWidth: 75
				},
				defaultType: 'textfield',
				defaults: {
					anchor: '50%'
				},

				items: [{
					fieldLabel: 'First Name',
					name: 'first',
					allowBlank:false,
					width: 150
				},{
					fieldLabel: 'Last Name',
					name: 'last',
					width: 150
				}],

				buttons: [{
					text: 'Save'
				},{
					text: 'Cancel'
				}]
				
			},{
				title: 'Width = 250px',
				columnWidth: .25,
				html: 'Content'
			}]
		},{
			xtype: 'panel',		
			id: 'search-by-login-form',
			layout: 'column',
			items: [{
				columnWidth: .75,
				title: 'Поиск по имени учетной записи',
				bodyStyle:'padding:5px 5px 0',
				
				xtype:'form',
				layout: 'hbox',
				align:'middle',
				items:[{
					xtype:'textfield',
					fieldLabel: 'Логин пользователя',
					name: 'user_login',
					msgTarget: 'under',
					labelAlign: 'left',
					labelWidth: 150,
					width: 400,
					allowBlank:false
				},{
					xtype: 'button',
					text: 'Найти',
					cls: 'searchUserBtn',
					margins: '0 0 0 10',
					width: 120
				}]
				
				
			},{
				title: 'Width = 250px',
				columnWidth: .25,
				html: 'Content'
			}]
		},
		{

			xtype: 'panel',		
			id: 'search-by-pass-form',
			layout: 'column',
			items: [{
				columnWidth: 0.75,
				xtype: 'form',
				frame:false,
				title: 'Поиск по номеру пропуска',
				bodyStyle:'padding:5px 5px 0',
				fieldDefaults: {
					msgTarget: 'side',
					labelWidth: 75
				},
				defaultType: 'textfield',
				defaults: {
					anchor: '50%'
				},

				items: [{
					fieldLabel: 'First Name',
					name: 'first',
					allowBlank:false
				},{
					fieldLabel: 'Last Name',
					name: 'last'
				}],

				buttons: [{
					text: 'Save'
				},{
					text: 'Cancel'
				}]
				
			},{
				title: 'Width = 250px',
				columnWidth: 0.25,
				html: 'Content'
			}]
		}]
	}
	]
});


	