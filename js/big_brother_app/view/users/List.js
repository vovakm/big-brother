/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.users.List', {
	extend:'Ext.grid.Panel',
	alias:'widget.userList',
	//	plugins: [
	//	Ext.create('Ext.grid.plugin.RowEditing', {
	//		clicksToEdit: 1
	//	})
	//	],
	/*selModel: Ext.create('Ext.selection.CheckboxModel', {
	 checkOnly: true
	 }),*/
	region:'center',
	title:'Пользователи',
	layout:'fit',
	forceFit:true,
	id:'userList',
	store:'Users',
	iconCls:'users',
	closable:false,
	frame:false,
	dockedItems:[
		{
			xtype:'toolbar',
			dock:'top',
			defaultType:'button',
			items:[
				{
					iconCls:'user_add',
					action:'userAdd',
					scale: 'medium',
					text:'Добавить',
					tooltip:{
						title:'Добавить',
						text:'Создать нового пользователя системы',
						trackMouse:true
					}
				},
				{
					disabled: true,
					iconCls:'lock',
					scale: 'medium',
					action:'userAccessLock',
					text:'Блокировать доступ',
					tooltip:{
						title:'Блокировать доступ',
						text:'Заблокировать учетную запись пользователя',
						trackMouse:true
					}
				},
				{
					disabled: true,
					iconCls:'world_delete',
					scale: 'medium',
					action:'userInetLock',
					text:'Блокировать Интернет',
					tooltip:{
						title:'Блокировать Интернет',
						text:'Заблокировать доступ в Интернет',
						trackMouse:true
					}
				},
				'->',
				{
					disabled: true,
					iconCls:'delete',
					scale: 'medium',
					action:'userDelete',
					text:'Удалить пользователя',
					tooltip:{
						title:'Удалить пользователя',
						text:'Внести пользователя в очередь удаления и заблокировать учетную запись',
						trackMouse:true
					}
				}
			]
		}
	],
	bbar:{
		xtype:'pagingtoolbar',
		store:'Users',
		displayInfo:true,
		displayMsg:'Записей {0} - {1} из {2}',
		emptyMsg:"Нет пользователей"
	},
	columns:[
		{
			header:'ID',
			dataIndex:'id',
			hidden:true,
			hideable:false
		},
		{
			header:'Имя пользователя',
			dataIndex:'login',
			width:100,
			editor:{
				xtype:'textfield',
				allowBlank:false
			}
		},
		{
			header:'Номер пропуска',
			dataIndex:'pass_num',
			width:60,
			editor:{
				xtype:'numberfield',
				minValue:0,
				allowBlank:false
			}
		},
		{
			header:'Ф. И. О.',
			dataIndex:'name',
			width:150,
			editor:{
				xtype:'textfield',
				allowBlank:false
			}
		},
		{
			header:'Пароль',
			dataIndex:'password',
			editor:{
				xtype:'textfield',
				inputType:'password'
			}
		},
		{
			header:'Группа студента',
			dataIndex:'user_group',
			editor:{
				xtype:'textfield',
				allowBlank:false
			}
		},
		{
			header:'День рождения',
			dataIndex:'bday',
			width:60,
			xtype:'datecolumn',
			format:'d.m.Y'
			//		,
			//		editor: {
			//			xtype: 'datefield',
			//			allowBlank: false,
			//			minValue: '01/01/1900',
			//			minText: '',
			//			maxValue: new Date()
			//		}
		},
		{
			header:'Блокировка',
			dataIndex:'block',
			width:60,
			renderer:function (val) {
				return (val == '1') ? ('Да') : ('Нет');
			},
			editor:{
				xtype:'checkbox'
			}
		},
		{
			header:'Изменен',
			dataIndex:'uday',
			xtype:'datecolumn',
			format:'d.m.Y H:i:s'
		}
	]
});
