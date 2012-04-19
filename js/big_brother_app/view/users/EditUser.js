/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.users.EditUser',{
	extend: 'Ext.window.Window',
alias: 'widget.EditUser',
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
			id: 'sf',
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
								name: 'f_name',
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
								name: 'ugroup',
								fieldLabel: 'Группа',
								flex: 5,
								margins: '0 0 0 6',
								
								allowBlank: false,
			
				xtype: 'combobox',
				hideTrigger:false,
				typeAhead: true,
				triggerAction: 'all',
				selectOnTab: true,
				store: Ext.getStore('allUGroups'),
				
				valueField:'name',
				displayField:'name',
				shadow:true,		
				lazyRender: true,
				listClass: 'x-combo-list-small'
							}]
						}]
					}]
				},{
					title:'Дополнительно',
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
/*initComponent: function(){
		this.items = {
			xtype: 'form',
			frame: true,
			items: [{
				xtype: 'fieldset',
				title: 'Настойки профиля',
				items: [{
					xtype: 'textfield',
					fieldLabel: 'Email',
					name: 'email'
				},{
					xtype: 'textfield',
					fieldLabel: 'Имя',
					name: 'name'
				}]
			},{
				xtype: 'fieldset',
				title: 'Состояние',
				items: [{
					xtype: 'textfield',
					name: 'id',
					hidden: true
				},{
					xtype: 'radiogroup',
					fieldLabel: 'Статус',
					columns: 1,
					items: [{
						boxLabel: 'admin',
						inputValue: 'admin',
						name: 'status'
					},{
						boxLabel: 'user',
						inputValue: 'user',
						name: 'status'
					}]
				},{
					xtype: 'checkboxgroup',
					columns: 1,
					fieldLabel: 'Активный?',
					items: [{
						name: 'enabled',
						inputValue: '1',
						uncheckedValue: '0'
					}]
				}]
			},{
				xtype: 'fieldset',
				title: this.passTitle,
				checkboxToggle: this.passToggle,
				collapsed: this.passToggle,
				items: [{
					xtype: 'textfield',
					fieldLabel: 'Пароль',
					name: 'password1'
				},{
					xtype: 'textfield',
					fieldLabel: 'Повторите пароль',
					name: 'password2'
				},{
					xtype: 'panel',
					layout: 'fit',
					items: [{
						height: 100,
						title: 'photo',
						html: '<img id="simg" src="http://placehold.it/255x150" />'
					}]
				}]
			}],
			buttons:[{
				text: 'Отправить',
				action: 'saveUser',
				formBind: true
			}]
		};
		this.callParent(arguments);
	}*/
});
