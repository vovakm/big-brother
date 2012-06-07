Ext.onReady(function () {
    var login = new Ext.FormPanel({
        labelWidth:80,
        url:'/users/login',
        frame:true,
        title:'Авторизация',
        defaultType:'textfield',
        monitorValid:true,
        items:[
            {
                fieldLabel:'Логин',
                name:'login',
                allowBlank:false
            },
            {
                fieldLabel:'Пароль',
                name:'password',
                inputType:'password',
                allowBlank:false
            }
        ],
        buttons:[
            {
                text:'Войти',
                formBind:true,
                handler:function () {
                    login.getForm().submit({
                        method:'POST',
                        waitTitle:'Подключение',
                        waitMsg:'Ожидайте проверки...',
                        success:function () {
                            window.location = '/admin';
                        },
                        failure:function (form, action) {
                        console.log(action);
                            if (action.failureType === 'server') {

                                obj = Ext.JSON.decode(action.response.responseText);
                                Ext.Msg.alert('Ошибка авторизации!', obj.errors.reason);
                            }

                            if (action.failureType === 'connect') {
                                Ext.Msg.alert('Ошибка!', 'Ошибка подключения к серверу. Попробуйте повторить запрос еще через пару минут');
                            }
                            login.getForm().reset();
                        }


                    });
                }
            }
        ]
    });
    var win = new Ext.Window({
        layout:'fit',
        width:300,
        height:130,
        closable:false,
        resizable:false,
        plain:false,
        draggable:false,
        border:false,
        items:[login]
    });
    win.show();
});