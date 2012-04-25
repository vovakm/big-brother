/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.controller.statistic.by_users', {
	extend: 'Ext.app.Controller',
	stores: ['statistic.Stat_Users'],
	models: ['statistic.Stat_User'],
	views: [
		'statistic.itemslist.by_users',
		'statistic.graphics.users_bars'
	],
	init : function () {		
		this.control({
			
		});
	}
});
