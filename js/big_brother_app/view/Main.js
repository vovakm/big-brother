
Ext.define('bb_cpanel.view.Main', {
    extend: 'Ext.Window',
    //requires: ['UsersApp.view.grid'],
    itemId: 'usersWindow',
    layout: 'fit',
    items: [
        { xtype: 'NamesGridPanel', itemId: 'NamesGrid' }
    ]
});