/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.model.User',{
	extend: 'Ext.data.Model',

	fields: [{
		name: 'id',
		type: 'int'
	},{
		name: 'pass_num',
		type: 'int'
	},{
		name: 'login',
		type: 'string'
	},{
		name:'f_name',
		type: 'string'
	},{
		name: 'm_name',
		type: 'string'
	},{
		name: 'l_name',
		type: 'string'
	},{
		name: 'user_group',
		type: 'string'
	},{
		name: 'note',
		type: 'string'
	},

	{
		name:'block',
		type: 'int'
	}
	]
});



