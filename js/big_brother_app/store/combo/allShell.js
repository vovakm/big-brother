/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.store.combo.allShell',{
	extend: 'Ext.data.Store',
	model: 'bb_cpanel.model.combo.allShell',
	autoLoad: true,
	proxy:{
		type: 'ajax',
		url: 'combo/allShell',
		actionMethods:{
             method: 'post'
        },
		reader:{
			type: 'json',
			root: 'shell',
			successProperty: 'success'
		}
	}
});



