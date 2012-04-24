/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.statistic.ItemsViews', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.itemlist-card',
	layout: 'card',
	items: [{
		xtype: 'iUsersBars'
	}]

});