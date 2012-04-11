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
	flex: 0.7,
	plugins: [
	Ext.create('Ext.grid.plugin.RowEditing', {
		clicksToEdit: 1
	})
	],
	/*selModel: Ext.create('Ext.selection.CheckboxModel', {
        checkOnly: true
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
		hidden: true
	},{
		header: 'login',
		dataIndex: 'login',
		editor: {
			xtype: 'textfield',
			allowBlank: false
		}
	},{
		header: 'pass_num',
		dataIndex: 'pass_num',
		width: 30,
		editor: {
			xtype: 'numberfield',
			minValue: 0,
			allowBlank: false
		}
	},{
		header: 'l_name',
		dataIndex: 'l_name',
		editor: {
			xtype: 'textfield',
			allowBlank: false
		}
	},{
		header: 'block',
		dataIndex: 'block',
		width: 30,
		renderer: function(val){
			return (val == '1') ? ('Да') : ('Нет');
		},
		editor: {
                xtype: 'checkbox'
            }
	}]
});



