/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.statistic.itemslist.by_users', {
	extend: 'Ext.container.Container',
	alias : 'widget.iUsers',
	layout: 'fit',
	items: [{
		xtype: 'grid',
		forceFit: true,	
		store: Ext.getStore('statistic.stat-user-store'),
		title: 'Пользователи',
		columns: [{
			header: 'uid',
			dataIndex: 'id_user',
			hidden: true,
			hideable: false
		},{
			header: 'Номер пропуска',
			dataIndex: 'pass_num',
			width: 60,
			hidden: true
		},{
			header: 'Имя пользователя',
			dataIndex: 'login',
			width: 80
		},{
			header: 'Ф. И. О.',
			dataIndex: 'name',
			width: 150,
			hideable: false
		},{
			header: 'Трафик, Mb',
			dataIndex: 'daily_traffic',
			width: 60
		},{
			header: 'Последний вход с IP',
			dataIndex: 'last_active_ip',
			width: 80
		},{
			header: 'Последняя активность',
			dataIndex: 'last_activity',
			xtype: 'datecolumn',
			format: 'H:i:s'
		}]
	}]

});