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
	region: 'center',
	title: 'Пользователи',
	layout: 'fit',
	forceFit: true,
	store: 'Users',
	iconCls: 'users',
	closable: false,
	frame: true,/*
    tbar: ['-',{
        iconCls: 'add',
        xtype: 'button',
        text: 'Добавить',
        action: 'addUser'
    },'-',{
        iconCls: 'del',
        xtype: 'button',
        text: 'Удалить',
        action: 'deleteUser'
    },'-',{
        iconCls: 'edit',
        xtype: 'button',
        text: 'Редактировать',
        action: 'editUser'
    },'-'],*/
	bbar: {
        xtype: 'pagingtoolbar',
        store: 'Users',
        displayInfo: true,
        displayMsg: 'Записей {0} - {1} из {2}',
		emptyMsg: "Нет пользователей"
    },
	columns: [{
		header: 'ID',
		dataIndex: 'id'
	},{
		header: 'login',
		dataIndex: 'login'
	},{
		header: 'pass_num',
		dataIndex: 'pass_num'
	},{
		header: 'l_name',
		dataIndex: 'l_name'
	},{
		header: 'block',
		dataIndex: 'block',
		renderer: function(val){
			return (val == '1') ? ('Да') : ('Нет');
		}
	}]
});



