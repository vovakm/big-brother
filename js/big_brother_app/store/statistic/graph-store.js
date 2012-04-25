/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.statistic.graph-store',{
	//alias: 'widget.stat-user-store',
	extend: 'Ext.data.ArrayStore',
	//autoDestroy: true,
	//storeId: 'myStore',
	idIndex: 0,
	fields: [
		{name: 'hour', type: 'int'},
		{name: 'traffic', type: 'float'}
	]
});



