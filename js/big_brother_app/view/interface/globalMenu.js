Ext.define('bb_cpanel.view.interface.globalMenu', {
    extend:'Ext.toolbar.Toolbar',
    id:'globalMenu',
    alias:'widget.globalMenu',
    region:'north',
    //itemId: 'globalMenu',
    height:46,
    margin:'0 0 2 0',
    defaults:{
        scale:'medium'
    },
    //split:true,
    items:['-', {
        xtype:'displayfield',
        value:'<b>Control&nbsp;Panel</b>',
        id:'app-name'
    }, '-', {
        text:'Меню',
        iconCls:'main-menu',
        xtype:'button',
        tooltip:{
            text:'Выберите тип статистики',
            title:'Статистика использования сетевых ресурсов',
            width:300,
            trackMouse:true
        },
        menu:{
            items:[
                {
                    iconCls:'import-from-file',
                    action:'import-from-file',
                    text:'Импорт данных'
                }
            ]
        }
    }, '-', {
        height:24,
        emptyText:'Ключевое слово для поиска',
        name:'content',
        id:'search-simple',
        allowBlank:true,
        width:150,
        xtype:'textfield',
        maxLength:20
    }, {
        text:'Поиск',
        iconCls:'search-global',
        action:'search-simple',
        id:'SearchUserBtn',
        xtype:'splitbutton',
        tooltip:{
            text:'Выберите наиболее подходящий тип поиска',
            title:'Поиск учетных записей пользователей',
            trackMouse:true
        },
        menu:{
            items:[
                {
                    disabled:true,
                    iconCls:'search-advanced',
                    action:'search-advanced',
                    text:'Рассширенный поиск'//, handler: onItemClick
                },
                '-',
                {
                    iconCls:'search-by-name',
                    action:'search-by-name',
                    text:'по Ф.И.О.'//, handler: onItemClick
                },
                {
                    iconCls:'search-by-ugroup',
                    action:'search-by-ugroup',
                    text:'по Группе'//, handler: onItemClick
                },
                {
                    iconCls:'search-by-login',
                    action:'search-by-login',
                    text:'по Логину'//, handler: onItemClick
                },
                {
                    iconCls:'search-by-pass',
                    action:'search-by-pass',
                    text:'по Номеру пропуска'//, handler: onItemClick
                }
            ]
        }
    }, '-', '-', {
        text:'Статистика',
        iconCls:'stat-global',
        //action: 'search-simple',
        id:'Statistic-mb',
        xtype:'splitbutton',
        tooltip:{
            text:'Выберите тип статистики',
            title:'Статистика использования сетевых ресурсов',
            width:300,
            trackMouse:true
        },
        menu:{
            items:[
                {
                    disabled:true,
                    iconCls:'stat-users',
                    action:'stat-users',
                    text:'по Пользователям'
                },
                {
                    disabled:true,
                    iconCls:'stat-sites',
                    action:'stat-sites',
                    text:'по Сайтам'
                },
                {
                    disabled:true,
                    iconCls:'stat-data',
                    action:'stat-data',
                    text:'по Данным'
                },
                {
                    disabled:true,
                    iconCls:'stat-date',
                    action:'stat-date',
                    text:'по Дням'
                }
            ]
        }
    }, '-', '->', '-', {
        text:'Мой профиль',
        iconCls:'my-account',
        action:'account'
    }, '-', {
        text:'Выйти',
        iconCls:'exit',
        action:'logout'
    }, '-']
});