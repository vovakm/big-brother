/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.statistic.GraphicsViews', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.graphics-card',
	layout: 'card',
	items: [{
		xtype: 'gUsersBars'
	}]
});