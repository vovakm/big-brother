
/*
Ext.define('API.store.Apilist', {
	extend : 'Ext.data.Store',
	model : 'API.model.Apimodel',
	autoLoad : true,
	autoSync : true,
	proxy : {
		type : 'ajax',
		url : 'app.php',
		api : {
			read : 'app.php',
			update : 'app2.php'
		},
		reader : {
			type : 'json',
			root : 'data',
			successProperty : 'success'
		},
		updater : {
			type : 'json',
			writeAllFields : true,
			root : 'data',
			successProperty : 'success'
		}
	}
});

*/