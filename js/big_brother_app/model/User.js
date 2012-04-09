/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.model.User',{
    extend: 'Ext.data.Model',

    fields: [
        'id',
        'pass_num',
        'login',
        'f_name',
        'm_name',
        'l_name',
        'user_group',
        'note',
        'block'
    ]
});



