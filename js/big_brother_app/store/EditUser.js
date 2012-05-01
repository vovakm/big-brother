/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.EditUser',{
	//alias: 'widget.EditUser-store',
	extend: 'Ext.data.Store',
	model: 'bb_cpanel.model.EditUser',
	id: 'EditUser',
	autoLoad: false,
	pageSize: 1,
	proxy:{
		type: 'ajax',
		url: 'users/getUserData',
		actionMethods:{
             method: 'post'
        },
		reader:{
			type: 'json',
			root: 'user',
			totalProperty: 'totalCount',
			successProperty: 'success'
		}
	}
});



