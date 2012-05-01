/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.statistic.Stat_Users',{
	alias: 'widget.stat-user-store',
	extend: 'Ext.data.Store',
	model: 'bb_cpanel.model.statistic.Stat_User',
	autoLoad: false,
	pageSize: 5,
	proxy:{
		type: 'ajax',
		url: 'statistic',
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



