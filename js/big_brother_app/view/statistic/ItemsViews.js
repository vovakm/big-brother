/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.statistic.ItemsViews', {
	extend: 'Ext.container.Container',
	alias : 'widget.itemlist-card',
	flex: 2,
	layout: 'card',
	items: [{
		xtype: 'iUsers'
	}]

});