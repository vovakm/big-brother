/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.Users',{
	alias: 'widget.user-store',
	extend: 'Ext.data.Store',
	model: 'bb_cpanel.model.User',
	autoLoad: false,
	pageSize: 40,
	proxy:{
		type: 'ajax',
		url: 'search_users',
		actionMethods:{
             method: 'post'
        },
		reader:{
			type: 'json',
			root: 'users',
			totalProperty: 'totalCount',
			successProperty: 'success'
		}
	}
});



