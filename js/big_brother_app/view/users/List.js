/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.users.List',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.userList',
	
	plugins: [
	Ext.create('Ext.grid.plugin.RowEditing', {
		clicksToEdit: 1
	})
	],
	/*selModel: Ext.create('Ext.selection.CheckboxModel', {
        checkOnly: false
    }),*/
	region: 'center',
	title: 'Пользователи',
	layout: 'fit',
	forceFit: true,
	id: 'userList',
	store: 'Users',
	iconCls: 'users',
	closable: false,
	frame: false,
	bbar: {
		xtype: 'pagingtoolbar',
		store: 'Users',
		displayInfo: true,
		displayMsg: 'Записей {0} - {1} из {2}',
		emptyMsg: "Нет пользователей"
	},
	columns: [{
		header: 'ID',
		dataIndex: 'id',
		hidden: true,
		hideable: false
	},{
		header: 'Имя пользователя',
		dataIndex: 'login',
		editor: {
			xtype: 'textfield',
			allowBlank: false
		}
	},{
		header: 'Номер пропуска',
		dataIndex: 'pass_num',
		width: 30,
		editor: {
			xtype: 'numberfield',
			minValue: 0,
			allowBlank: false
		}
	},{
		header: 'Ф. И. О.',
		dataIndex: 'name',
		editor: {
			xtype: 'textfield',
			allowBlank: false
		}
	},{
		header: 'Пароль',
		dataIndex: 'name',
		editor: {
		xtype: 'textfield',
        inputType: 'password'
		}
	},{
		header: 'Группа студента',
		dataIndex: 'user_group',
		editor: {
			xtype: 'textfield',
			allowBlank: false
		}
	},{
		header: 'День рождения',
		dataIndex: 'bday',
		xtype: 'datecolumn',
		format: 'j M. Y',
            editor: {
                xtype: 'datefield',
                allowBlank: false,
                minValue: '01/01/1900',
                minText: '',
                maxValue: new Date()
            }
	},{
		header: 'Блокировка',
		dataIndex: 'block',
		width: 30,
//		renderer: function(val){
//			return (val == '1') ? ('Да') : ('Нет');
//		},
			  xtype: 'checkcolumn'
		/*editor: {
			xtype: 'checkbox'
		}*/
	}]
});
