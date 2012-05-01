/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.users.EditUser',{
	extend: 'Ext.window.Window',
	alias: 'widget.EditUser-window',
	id: 'EditUser-window',
	title: 'Редактирование пользователя',
	autoHeight: true,
	width: 600,
	border:0,
	layout: 'fit',
	modal: true,
	passColapsed: true,
	passTitle: 'Изменение пароля',
	passToggle: true,
	iconCls: 'search-by-name',
	initComponent: function(){
		this.items = {
			xtype: 'form',
			id: 'EditUserForm',
			frame: true,
			items: [{
				xtype:'tabpanel',
				activeTab: 0,
				defaults:{
					bodyStyle:'padding:10px'
				},
				fieldDefaults: {
					msgTarget: 'side',
					labelWidth: 150
				},
				items:[{
					title:'Основные данные',
					defaultType: 'textfield',
					items:[{
						xtype: 'fieldset',
						title: 'Имя студента',
						defaultType: 'textfield',
						layout: 'anchor',
						defaults: {
							anchor: '100%'
						},
						items: [{
							xtype: 'fieldcontainer',
							fieldLabel: 'Имя',
							layout: 'hbox',
							combineErrors: true,
							defaultType: 'textfield',
							defaults: {
								hideLabel: 'true'
							},
							items: [{
								name: 'l_name',
								fieldLabel: 'Фамилия',
								flex: 2,
								emptyText: 'Фамилия',
								allowBlank: false
							}, {
								name: 'f_name',
								fieldLabel: 'Имя',
								flex: 2,
								margins: '0 0 0 6',
								emptyText: 'Имя',
								allowBlank: false
							}, {
								name: 'm_name',
								fieldLabel: 'Отчество',
								flex: 2,
								margins: '0 0 0 6',
								emptyText: 'Отчество',
								allowBlank: false
							}]
						}]
					},{
						xtype: 'fieldset',
						title: 'Пользователь системы',
						defaultType: 'textfield',
						layout: 'anchor',
						defaults: {
							anchor: '100%'
						},
						items: [{
							xtype: 'fieldcontainer',
							layout: 'hbox',
							combineErrors: true,
							defaultType: 'textfield',
							defaults: {
								hideLabel: false
							},
							items: [{
								name: 'login',
								fieldLabel: 'Логин',
								flex: 6,
								emptyText: 'Логин',
								allowBlank: false
							}, {
								name: 'password',
								inputType: 'password',
								fieldLabel: 'Пароль',
								flex: 6,
								margins: '0 0 0 6',
								emptyText: 'Пароль',
								allowBlank: false
							}]
						}]
					},{
						xtype: 'fieldset',
						title: 'Данные студента',
						defaultType: 'textfield',
						layout: 'anchor',
						defaults: {
							anchor: '100%'
						},
						items: [{
							xtype: 'fieldcontainer',
							layout: 'hbox',
							combineErrors: true,
							defaultType: 'textfield',
							defaults: {
								hideLabel: false
							},
							items: [{
								name: 'pass_num',
								fieldLabel: 'Номер пропуска',
								flex: 5,
								emptyText: 'Номер пропуска',
								allowBlank: false
							}, {
								fieldLabel: 'Группа',
								//id: 'mmcombo',
								flex: 5,
								margins: '0 0 0 6',
								allowBlank: false,
								name: 'user_group',
								xtype: 'combo',
								hideTrigger:true,
								typeAhead: true,
								triggerAction: 'all',
								selectOnTab: true,
								mode: 'local',
								store: 'combo.allUGroups',
								valueField:'id',
								displayField:'name',
								shadow:true,		
								minChars: 1,
								valueNotFoundText:"Не найдено",
								lazyRender: true,
								forceSelection:true,
								listClass: 'x-combo-list-small'
							}]
						}]
					}]
				},{
					title:'Дополнительно',
					defaultType: 'textfield',

					items: [{
						fieldLabel: 'Home',
						xtype: 'textfield',
						name: 'shell'
					},{
						fieldLabel: 'Business',
						name: 'bday'
					},{
						fieldLabel: 'Mobile',
						name: 'mobile'
					},{
						fieldLabel: 'Fax',
						name: 'fax'
					}]
				},{
					title:'Системные',
					defaultType: 'textfield',

					items: [{
						fieldLabel: 'Home',
						name: 'home',
						value: '(888) 555-1212'
					},{
						fieldLabel: 'Business',
						name: 'business'
					},{
						fieldLabel: 'Mobile',
						name: 'mobile'
					},{
						fieldLabel: 'Fax',
						name: 'fax'
					}]
				}],
				buttons: [{
					text: 'Save'
				},{
					text: 'Cancel'
				}]
			}]
		};
		this.callParent(arguments);
	}
});
