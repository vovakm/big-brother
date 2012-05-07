/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.combo.allSamba',{
//	alias: 'widget.allSamba-store',
	extend: 'Ext.data.Store',
	model: 'bb_cpanel.model.combo.allList',
	autoLoad: true,
	proxy:{
		type: 'ajax',
		url: 'combo/allSamba',
		actionMethods:{
             method: 'post'
        },
		reader:{
			type: 'json',
			root: 'samba',
			successProperty: 'success'
		}
	}
});



