/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.users.SearchUsers', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.SearchUsers',
	id: 'id_SearchUsersPanel',
	region: 'north',
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
				frame:false,
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
					width: 400,
					minLength: 2,
					maxLength: 23
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
				//layout: 'hbox',
				frame:false,
				title: 'Расширенный поиск',
				bodyStyle:'padding:5px 5px 0',
				fieldDefaults: {
					msgTarget: 'side',
					width: 300
				},
				defaultType: 'textfield',
				defaults: {
					anchor: '50%'
				},

				items: [{
					emptyText: 'Логин',
					name: 'login',
				},{
					emptyText: 'группа',
					name: 'group'
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
				layout: 'hbox',
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
					emptyText: 'Имя пользователя',
					name: 'content',
					allowBlank:false,
					width: 400,
					minLength: 2,
					maxLength: 23
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
			id: 'search-by-ugroup-form',
			layout: 'column',
			items: [{
				columnWidth: .75,
				xtype: 'form',
				layout: 'hbox',
				frame: false,
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
					emptyText: 'Название группы',
					name: 'ugroup',
					allowBlank:false,
					width: 400,
					minLength: 2,
					maxLength: 7
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
			id: 'search-by-login-form',
			layout: 'column',
			items: [{
				columnWidth: .75,
				title: 'Поиск по имени учетной записи',
				bodyStyle:'padding:5px 5px 0',
				frame:false,
				xtype:'form',
				layout: 'hbox',
				align:'middle',
				items:[{
					xtype:'textfield',
					emptyText: 'Логин пользователя',
					name: 'content',
					msgTarget: 'side',
					width: 400,
					allowBlank:false,
					minLength: 2,
					maxLength: 23
					
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
		},
		{

			xtype: 'panel',		
			id: 'search-by-pass-form',
			layout: 'column',
			items: [{
				columnWidth: 0.75,
				xtype: 'form',
				frame: false,
				layout: 'hbox',
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
				items:[{
					xtype:'textfield',
					emptyText: 'Номер пропуска',
					name: 'content',
					msgTarget: 'side',
					labelAlign: 'left',
					width: 400,
					allowBlank:false,
					minLength: 4,
					maxLength: 7
				},{
					xtype: 'button',
					text: 'Найти',
					action: 'send-search',
					margins: '0 0 0 10',
					width: 120
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


	