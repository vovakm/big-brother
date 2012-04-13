/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.users.EditUser',{
	extend: 'Ext.window.Window',
	alias: 'widget.user-window',
	title: 'Редактирование пользователя',
	autoHeight: true,
	width: 300,
	border:0,
	layout: 'fit',
	modal: true,
	passColapsed: true,
	passTitle: 'Изменение пароля',
	passToggle: true,
	iconCls: 'users',
	initComponent: function(){
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
						html:'text'
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
	}
});
