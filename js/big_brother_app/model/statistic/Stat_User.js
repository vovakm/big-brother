/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.model.statistic.Stat_User',{
	extend: 'Ext.data.Model',
	fields: [{
			//хм... правда?
		name: 'id_user',
		type: 'int'
	},{
		//номер пропуска
		name: 'pass_num',
		type: 'int'
	},{
		//логин. ORLY?
		name: 'login',
		type: 'string'
	},{
		//ФИО пользователя
		name:'name',
		type: 'string'
	},{
		//группа пользователя. Для тултипа
		name: 'user_group',
		type: 'string'
	},{
		//общий трафик за день
		name:'daily_traffic',
		type: 'float'
	},{
		//в какие часы была активность
		name:'active_hours',
		type: 'auto'
	},{
		//трафик по часам
		name:'hourly_traffic',
		type: 'auto' //<- auto... может быть сотворит чудо
	},{
		//IP с которого последний раз заходил пользователь
		name:'last_active_ip', 
		type: 'string'
	},{
		//время последней активности пользователя
		name:'last_activity',
		type: 'string',
		dateFormat: 'H:i:s'
		
	}
	]
});

