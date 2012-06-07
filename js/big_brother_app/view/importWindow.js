/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.importWindow', {
    extend:'Ext.window.Window',
    alias:'widget.importWindow',
    id:'importWindow',
    title:'Ипорт данных',
    autoHeight:true,
    width:800,
    height:400,
    border:0,
    layout:'fit',
    resizable:false,
    modal:true,
    passColapsed:true,

    iconCls:'import-from-file',
    initComponent:function () {
        this.items = {
            xtype:'form',

            frame:true,
            items:[
                {
                    xtype:'tabpanel',
                    activeTab:0,
                    defaults:{
                        bodyStyle:'padding:10px'
                    },
                    fieldDefaults:{
                        msgTarget:'side',
                        labelWidth:150
                    },
                    items:[{

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
                        }]
                }
            ]
        };
        this.callParent(arguments);
    }
});
