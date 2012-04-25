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
	frame: true,
	layout: {
		type: 'vbox',
		align: 'stretch',
		pack: 'start'
	},
	items: [{
		xtype: 'graphics-card'
	},{
		xtype: 'itemlist-card'
	}]
});