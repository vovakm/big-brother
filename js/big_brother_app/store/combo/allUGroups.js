/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.combo.allUGroups',{
	alias: 'widget.allUGroups-store',
	extend: 'Ext.data.Store',
	model: 'bb_cpanel.model.combo.allUGroup',
	autoLoad: true,
	pageSize: 40,
	proxy:{
		type: 'ajax',
		url: 'combo/allUGroups',
		actionMethods:{
             method: 'post'
        },
		reader:{
			type: 'json',
			root: 'groups',
			successProperty: 'success'
		}
	}
});



