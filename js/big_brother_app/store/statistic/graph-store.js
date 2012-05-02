/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.statistic.graph-store',{
	extend: 'Ext.data.Store',
	autoLoad: false,
	fields: [
		{name: 'hour', type: 'int'},
		{name: 'traffic', type: 'float'}
	],
	proxy:{
		type: 'ajax',
		url: 'statistic',
		actionMethods:{
			method: 'post'
		},
		reader:{
			type: 'json',
			totalProperty: 'totalCount',
			successProperty: 'success'
		}
	}
});

