/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.combo.allUStatuses',{
	alias: 'widget.allUStatuses-store',
	extend: 'Ext.data.Store',
	model: 'bb_cpanel.model.combo.allList',
	autoLoad: true,
	proxy:{
		type: 'ajax',
		url: 'combo/allUStatuses',
		actionMethods:{
             method: 'post'
        },
		reader:{
			type: 'json',
			root: 'statuses',
			successProperty: 'success'
		}
	}
});



