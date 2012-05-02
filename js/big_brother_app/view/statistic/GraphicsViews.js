/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.statistic.GraphicsViews', {
	extend:'Ext.container.Container',
	id: 'graphics-card-layout',
	alias:'widget.graphics-card',
	flex:3,
	margins:'0 0 5 0',
	layout:'card',
	items:[
		{
			xtype:'gUsersLines'
		},
		{
			xtype:'gUsersBars'
		}
	]
});