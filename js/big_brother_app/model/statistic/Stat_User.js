/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.model.statistic.Stat_Users',{
	extend: 'Ext.data.Model',
	fields: [{
		name: 'id_user',
		type: 'int'
	},{
		name: 'pass_num',
		type: 'int'
	},{
		name: 'login',
		type: 'string'
	},{
		name:'name',
		type: 'string'
	},{
		//группа пользователя. Для тултипа
		name: 'user_group',
		type: 'string'
	},{
		name:'current_day',
		type: 'date', 
		dateFormat: 'Y-m-d'
	},{
		name:'daily_traffic',
		type: 'float'
	},{
		name:'active_hours',
		type: 'auto'
	},{
		name:'hourly_traffic',
		type: 'auto'
	},{
		name:'last_active_ip',
		type: 'string'
	},{
		name:'last_activity',
		type: 'string',
		dateFormat: 'H:i:s'
		
	}
	]
});

