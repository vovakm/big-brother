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
												labelAlign: 'right'

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
													flex:5,
													id: 'comboUGroup',
													margins:'0 0 0 6',
													allowBlank:false,
													name:'user_group',
													xtype:'combo',
													hideTrigger:true,
													typeAhead:true,
													triggerAction:'all',
													selectOnTab:true,
													mode:'local',
													store:'combo.allUGroups',
													valueField:'id',
													displayField:'name',
													shadow:true,
													minChars:1,
													valueNotFoundText:"Не найдено",
													lazyRender:true,
													forceSelection:true,
													listClass:'x-combo-list-small',
													queryMode: 'model'
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
											margins:'0 0 0 6',
											id: 'comboUStatus',
											labelWidth:130,
											allowBlank:false,
											name:'status_name',
											xtype:'combo',
											typeAhead:true,
											triggerAction:'all',
											mode:'local',
											store:'combo.allUStatuses',
											valueField:'id',
											displayField:'name',
											shadow:false,
											minChars:1,
											valueNotFoundText:"Не найдено",
											listClass:'x-combo-list-small',
											queryMode: 'local'
										}
									]},
								{
									xtype:'fieldset',
									title:'Блокировка доступа',
									layout:'hbox',
									items:[
										{
											fieldLabel:'Блокировка учетной записи',
											flex:1,
											labelWidth:160,
											xtype:'checkboxfield'

										},
										{
											labelWidth:130,
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
													labelWidth:135,
													width:290,
													name:'upload_photo',
													buttonText:'',
													buttonConfig:{
														iconCls:'picture-ico'
													}
												},
												{
													labelWidth:170,
													xtype:'checkboxfield',
													fieldLabel:'Удалить существующее фото'
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
											width: 300,
											fieldLabel:'Группа Samba',
											id: 'comboSGroup',
											margins:'0 0 0 6',
											labelWidth:100,
											allowBlank:false,
											name:'samba_group',
											xtype:'combo',
											typeAhead:true,
											triggerAction:'all',
											mode:'local',
											store:'combo.allSamba',
											valueField:'id',
											displayField:'name',
											shadow:false,
											minChars:1,
											valueNotFoundText:"Не найдено",
											listClass:'x-combo-list-small',
											queryMode: 'local'
										},
										{
											width: 300,

											fieldLabel:'Shell',
											id: 'comboShell',
											margins:'0 0 0 6',
											labelWidth:100,
											allowBlank:false,
											store:'combo.allShell',
											name:'shell_name',
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
											queryMode: 'local'

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
												width: 115,
												margin: '0px 9px 4px 0px'
											},
											defaultType:'textfield',
											items:[
												{
													fieldLabel:'Квота 1',
													name:'quota0'
//														50000:75000:5000:7500
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
											labelWidth: 145,
											fieldLabel:'Запись внесена в Samba',
											disable: true
										}
									]
								},{

									xtype:'fieldset',
									title:'Права доступа',
									collapsed:false,
									collapsible: true,
									layout:'anchor',
									defaults:{
										anchor:'100%'
									},
									defaults:{
										hideLabel:false,
										labelWidth:50,
										width: 115,
										margin: '0px 9px 4px 0px'
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
							text:'Save',
							action: 'saveUser'
						},
						{
							text:'Cancel'
						}
					]
				}
			]
		};
		this.callParent(arguments);
	}
});
