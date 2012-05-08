/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.users.EditUser', {
    extend:'Ext.window.Window',
    alias:'widget.EditUser-window',
    id:'EditUser-window',
    title:'Редактирование пользователя',
    autoHeight:true,
    width:600,
    height:300,
    border:0,
    layout:'fit',
    resizable:false,
    modal:true,
    passColapsed:true,
    passTitle:'Изменение пароля',
    passToggle:true,
    iconCls:'search-by-name',
    initComponent:function () {
        this.items = {
            xtype:'form',
            id:'EditUserForm',
            frame:true,
            items:[
                {
                    xtype:'tabpanel',
                    activeTab:0,
                    id:'sometabpanel',
                    defaults:{
                        bodyStyle:'padding:10px'
                    },
                    fieldDefaults:{
                        msgTarget:'side',
                        labelWidth:150
                    },
                    items:[
                        {
                            title:'Основные данные',
                            itemId:'main',
                            defaultType:'textfield',
                            items:[
                                {
                                    xtype:'fieldset',
                                    title:'Имя студента',
                                    defaultType:'textfield',
                                    layout:'anchor',
                                    defaults:{
                                        anchor:'100%'

                                    },
                                    items:[
                                        {
                                            xtype:'fieldcontainer',
                                            fieldLabel:'Ф. И. О.',
                                            layout:'hbox',
                                            combineErrors:true,
                                            defaultType:'textfield',
                                            defaults:{
                                                hideLabel:'true',
                                                labelAlign:'right'

                                            },
                                            items:[
                                                {
                                                    name:'l_name',
                                                    fieldLabel:'Фамилия',
                                                    flex:2,
                                                    emptyText:'Фамилия',
                                                    allowBlank:false
                                                },
                                                {
                                                    name:'f_name',
                                                    fieldLabel:'Имя',
                                                    flex:2,
                                                    margins:'0 0 0 6',
                                                    emptyText:'Имя',
                                                    allowBlank:false
                                                },
                                                {
                                                    name:'m_name',
                                                    fieldLabel:'Отчество',
                                                    flex:2,
                                                    margins:'0 0 0 6',
                                                    emptyText:'Отчество',
                                                    allowBlank:false
                                                },{
                                                    xtype:'hidden',
                                                    name:'id'
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    xtype:'fieldset',
                                    title:'Пользователь системы',
                                    defaultType:'textfield',
                                    layout:'anchor',
                                    defaults:{
                                        anchor:'100%'
                                    },
                                    items:[
                                        {
                                            xtype:'fieldcontainer',
                                            layout:'hbox',
                                            combineErrors:true,
                                            defaultType:'textfield',
                                            defaults:{
                                                hideLabel:false
                                            },
                                            items:[
                                                {
                                                    name:'login',
                                                    fieldLabel:'Логин',
                                                    flex:6,
                                                    emptyText:'Логин',
                                                    allowBlank:false
                                                },
                                                {
                                                    name:'password',
                                                    inputType:'password',
                                                    fieldLabel:'Пароль',
                                                    flex:6,
                                                    margins:'0 0 0 6',
                                                    emptyText:'Пароль',
                                                    allowBlank:false
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    xtype:'fieldset',
                                    title:'Данные студента',
                                    defaultType:'textfield',
                                    layout:'anchor',
                                    defaults:{
                                        anchor:'100%'
                                    },
                                    items:[
                                        {
                                            xtype:'fieldcontainer',
                                            layout:'hbox',
                                            combineErrors:true,
                                            defaultType:'textfield',
                                            defaults:{
                                                hideLabel:false
                                            },
                                            items:[
                                                {
                                                    name:'pass_num',
                                                    fieldLabel:'Номер пропуска',
                                                    flex:5,
                                                    emptyText:'Номер пропуска',
                                                    allowBlank:false
                                                },
                                                {
                                                    fieldLabel:'Группа',
                                                    id:'comboUGroup',
                                                    name:'user_group',
                                                    store:'combo.allUGroups',
                                                    flex:5,
                                                    margins:'0 0 0 6',
                                                    allowBlank:false,
                                                    xtype:'combo',
                                                    hideTrigger:true,
                                                    typeAhead:true,
                                                    triggerAction:'all',
                                                    selectOnTab:true,
                                                    mode:'local',
                                                    valueField:'id',
                                                    displayField:'name',
                                                    shadow:true,
                                                    minChars:1,
                                                    valueNotFoundText:"Не найдено",
                                                    lazyRender:true,
                                                    forceSelection:true,
                                                    listClass:'x-combo-list-small',
                                                    queryMode:'model'
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            title:'Дополнительно',
                            itemId:'advanced',
                            defaultType:'textfield',
                            items:[
                                {
                                    xtype:'fieldset',
                                    title:'Пользовательские данные',
                                    layout:'hbox',
                                    items:[
                                        {
                                            fieldLabel:'Статус пользователя',
                                            id:'comboUStatus',
                                            name:'status_name',
                                            margins:'0 0 0 6',
                                            store:'combo.allUStatuses',
                                            labelWidth:130,
                                            allowBlank:false,
                                            xtype:'combo',
                                            typeAhead:true,
                                            triggerAction:'all',
                                            mode:'local',
                                            valueField:'id',
                                            displayField:'name',
                                            shadow:false,
                                            minChars:1,
                                            valueNotFoundText:"Не найдено",
                                            listClass:'x-combo-list-small',
                                            queryMode:'local'
                                        }
                                    ]},
                                {
                                    xtype:'fieldset',
                                    title:'Блокировка доступа',
                                    layout:'hbox',
                                    items:[
                                        {
                                            fieldLabel:'Блокировка учетной записи',
                                            name:'block',
                                            flex:1,
                                            labelWidth:160,
                                            xtype:'checkboxfield'

                                        },
                                        {
                                            labelWidth:130,
                                            name:'internet_lock',
                                            xtype:'checkboxfield',
                                            fieldLabel:'Блокировка Интернет',
                                            flex:1
                                        }
                                    ]

                                },
                                {
                                    xtype:'fieldset',
                                    title:'Фотография',
                                    layout:'hbox',
                                    items:[
                                        {
                                            xtype:'container',
                                            layout:'vbox',
                                            height:100,
                                            width:290,
                                            items:[
                                                {
                                                    xtype:'filefield',
                                                    emptyText:'Выберите изображение',
                                                    fieldLabel:'Загрузить фотографию',
                                                    name:'new_photo',
                                                    labelWidth:135,
                                                    width:290,
                                                    buttonText:'',
                                                    buttonConfig:{
                                                        iconCls:'picture-ico'
                                                    }
                                                },
                                                {
                                                    xtype:'checkboxfield',
                                                    name:'delete_image',
                                                    fieldLabel:'Удалить существующее фото',
                                                    labelWidth:170
                                                }
                                            ]
                                        },
                                        {
                                            id:'userPhoto',
                                            html:'',
                                            height:210,
                                            margin:'0 0 3px 0',
                                            flex:1
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            title:'Системные',
                            itemId:'system',
                            defaultType:'textfield',
                            items:[
                                {

                                    xtype:'fieldset',
                                    title:'Сервер',
                                    layout:'anchor',
                                    defaultType:'textfield',
                                    items:[
                                        {
                                            width:300,
                                            fieldLabel:'Группа Samba',
                                            id:'comboSGroup',
                                            name:'samba_group',
                                            store:'combo.allSamba',
                                            margins:'0 0 0 6',
                                            labelWidth:100,
                                            allowBlank:false,
                                            xtype:'combo',
                                            typeAhead:true,
                                            triggerAction:'all',
                                            mode:'local',
                                            valueField:'id',
                                            displayField:'name',
                                            shadow:false,
                                            minChars:1,
                                            valueNotFoundText:"Не найдено",
                                            listClass:'x-combo-list-small',
                                            queryMode:'local'
                                        },
                                        {
                                            width:300,
                                            fieldLabel:'Shell',
                                            id:'comboShell',
                                            name:'shell_name',
                                            store:'combo.allShell',
                                            margins:'0 0 0 6',
                                            labelWidth:100,
                                            allowBlank:false,
                                            xtype:'combo',
                                            typeAhead:true,
                                            triggerAction:'all',
                                            mode:'local',
                                            valueField:'name',
                                            displayField:'name',
                                            shadow:false,
                                            minChars:1,
                                            valueNotFoundText:"Не найдено",
                                            listClass:'x-combo-list-small',
                                            queryMode:'local'

                                        },
                                        {
                                            xtype:'fieldset',
                                            title:'Квота',
                                            collapsed:false,
                                            layout:{
                                                type:'hbox',
                                                align:'stretchmax'
                                            },
                                            defaults:{
                                                hideLabel:false,
                                                labelWidth:50,
                                                width:115,
                                                margin:'0px 9px 4px 0px'
                                            },
                                            defaultType:'textfield',
                                            items:[
                                                {
                                                    fieldLabel:'Квота 1',
                                                    name:'quota0'
                                                },
                                                {
                                                    fieldLabel:'Квота 2',
                                                    name:'quota1'
                                                },
                                                {
                                                    fieldLabel:'Квота 3',
                                                    name:'quota2'
                                                },
                                                {
                                                    fieldLabel:'Квота 4',
                                                    name:'quota3'
                                                }
                                            ]
                                        },
                                        {
                                            xtype:'checkboxfield',
                                            name:'in_samba',
                                            labelWidth:145,
                                            fieldLabel:'Запись внесена в Samba',
                                            disable:true
                                        }
                                    ]
                                },
                                {

                                    xtype:'fieldset',
                                    title:'Права доступа',
                                    collapsed:false,
                                    collapsible:true,
                                    layout:'anchor',
                                    defaults:{
                                        anchor:'100%'
                                    },
                                    defaults:{
                                        hideLabel:false,
                                        labelWidth:50,
                                        width:115,
                                        margin:'0px 9px 4px 0px'
                                    },
                                    defaultType:'textfield',
                                    items:[
                                        {

                                        }
                                    ]

                                }
                            ]
                        }
                    ],
                    buttons:[
                        {
                            text:'Сохранить',
                            action:'saveUser'
                        },
                        {
                            text:'Отмена',
                            action: 'cancelWindow'
                        }
                    ]
                }
            ]
        };
        this.callParent(arguments);
    }
});
