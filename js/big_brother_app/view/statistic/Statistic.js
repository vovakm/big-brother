/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.statistic.Statistic', {
	extend: 'Ext.panel.Panel',
	alias : 'widget.statistic-layout',
	id: 'id-statistic-layout',
	region: 'center',
	frame: true,
	layout: 'vbox',
	items: [{
		xtype: 'graphics-card'
	},{
		xtype: 'itemlist-card'
	}]

});