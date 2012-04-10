Ext.define('bb_cpanel.view.interface.globalMenu', {
	extend: 'Ext.toolbar.Toolbar',
	id: 'globalMenu',
	alias : 'widget.globalMenu',
	region: 'north',
	//itemId: 'globalMenu',
	height: 46,
	margin: '0 0 2 0',
	//split:true, 
	items: ['-',{
		xtype: 'displayfield',
		value: '<b>Control&nbsp;Panel</b>',
		id: 'app-name'
	},'-',{
		height: 34,
		text: 'Поиск',
		iconCls: 'search-global',
		action: 'search-simple',
		xtype: 'splitbutton',
		tooltip: {
			text:'Выберите наиболее подходящий тип поиска', 
			title:'Поиск учетных записей пользователей',
			trackMouse: true
		},
		menu : {
			items: [{
				text: 'Быстрый поиск',
				iconCls: 'search-simple',
				action: 'search-simple',
				tooltip: {
					html:'Поиск по номеру пропуска,<br> имени учетной записи', 
					title:'Быстрый поиск',
					trackMouse: true
				}
			}, {
				iconCls: 'search-advanced',
				action: 'search-advanced',		
				text: 'Рассширенный поиск'//, handler: onItemClick
			}, '-',{
				iconCls: 'search-by-name',
				action: 'search-by-name',
				text: 'по Ф.И.О.'//, handler: onItemClick
			},{
				iconCls: 'search-by-ugroup',
				action: 'search-by-ugroup',
				text: 'по Группе'//, handler: onItemClick
			},{
				iconCls: 'search-by-login',
				action: 'search-by-login',
				text: 'по Логину'//, handler: onItemClick
			},{
				iconCls: 'search-by-pass',
				action: 'search-by-pass',
				text: 'по Номеру пропуска'//, handler: onItemClick
			}]
		}
	},'-',{
		height: 34,
		text: 'кнопка для которой<br/>еще не придуман функционал',
		handler: function(){
			Ext.MessageBox.show({
				title:'hello world',
				msg: 'Не написана еще та функция, которая будет достойна данной кнопочки. <br/>\n\Ну. Правда. Я не знаю зачем мне эта кнопка',
				buttons: Ext.MessageBox.OK,
				icon: Ext.MessageBox.INFO,  
				width: 400
			});
		}
	}
	,/*'-',*/'->',/*'-',*/{
		height: 34,
		text:'Мой профиль',
		iconCls: 'my-account',
		action: 'account',
		handler: function(){
			Ext.MessageBox.show({
				title:'batman :)',
				msg: '<strong>xxx:</strong> он ваще красавец. Создал опрос:<br/>\n\
\"А вы заметили, что вариант ответа \"Пыщь! Я Бэтмэн!\" начисто гробит статистику любого опроса?\" <br/>\n\
<strong>xxx:</strong> и варинты ответов: \"Да\", \"Нет\", \"Пыщь! Я Бэтмэн!\" <br/>\n\
<strong>xxx:</strong> Про результаты рассказывать?//',
				buttons: Ext.MessageBox.OK,
				icon: Ext.MessageBox.WARNING,  
				width: 600
			});
		}
	},'-',{
		height: 34,
		text: 'Выйти',
		iconCls: 'exit',
		action: 'logout'
	},'-']
});