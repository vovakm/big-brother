/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.model.EditUser',{
	extend: 'Ext.data.Model',
	alias: '',
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
		name: 'password',
		type: 'string'
	},{
		name: 'f_name',
		type: 'string'
	},{
		name: 'm_name',
		type: 'string'
	},{
		name: 'l_name',
		type: 'string'
	},{
		name: 'note',
		type: 'string'
	},{
		name:'block',
		type: 'int'
	},{
		name:'bday',
		type: 'date', 
		dateFormat: 'Y-m-d'
	},{
		name:'uday',
		type: 'date',
		dateFormat: 'Y-m-d H:i:s'
	},{
		name:'cday',
		type: 'date',
		dateFormat: 'Y-m-d H:i:s'
	},{
		name:'deleted',
		type: 'int'
	},{
		name:'internet_lock',
		type: 'int'
	},{
		name:'shell',
		type: 'string'
	},{
		name:'access_to_database',
		type: 'string'
	},{
		name:'in_samba',
		type: 'int'
	},{
		name:'quota',
		type: 'string'
	}
	]
});

