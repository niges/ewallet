(function(){
function dashboard() {
	return {
		renderAddCategory : function() {
			var template = $( '#addCategoryView' ).html();
			Helper().render( template );
		},
		renderEditCategory : function() {
			var data_token = JSON.parse(Helper().getCookie());
			var cid = data_token.cid;

			$.ajax({
				type: 'get',
				url : Config().apiUrl+Routes().categories+Routes().title+cid,
				success : function( response ) {
				
					var title = response.data[0].title;
					var template = $( '#editCategoryView' ).html();
					var small_template = Handlebars.compile(template);
					var small_data = {
							            title
						        	};
					$("#small-content-placeholder").html(small_template(small_data));
					
				},
				error : function( err ) {
					Helper().log( err )
				}
			});
		},
		renderViewData : function() {
			
			var data_token = JSON.parse(Helper().getCookie());
			var did = data_token.did;
			$.ajax({
				type : 'get',
				url  : Config().apiUrl+Routes().datas+Routes().show+did,
				success : function( response ) {
					$('#menu').hide();
					
					var template = $( '#dataView' ).html();
					var small_template = Handlebars.compile(template);
					var small_data = {
							           response
						        	};
					$("#small-content-placeholder").html(small_template(small_data));

				},
				error   : function( err ){
					Helper().log( err );
				}
			});
		},
		renderAddData : function() {
			$('#menu').hide();
			var template = $( '#addDataView' ).html();
			Helper().render(template);
		},
		renderEditData : function() {
			var data_token = JSON.parse(Helper().getCookie());
			var data_id = data_token.data_id;

			$.ajax({
				type: 'get',
				url : Config().apiUrl+Routes().datas+Routes().title+data_id,
				success : function( response ) {
					$('#menu').hide();
					var title = response.data[0].title;
					var body = response.data[0].body;

					var template = $( '#editDataView' ).html();

					var small_template = Handlebars.compile(template);
					var small_data = {
							            title,body
						        	};
					$("#small-content-placeholder").html(small_template(small_data));
					
				},
				error : function( err ) {
					Helper().log( err )
				}
			});

		}
	}
}

$( document ).on( 'click', '#addCategory', function(e) {
	e.preventDefault();
	Finch.navigate( 'add' );
	
});

$( document ).on( 'submit', '#addCategorySubmit', function(e) {
	e.preventDefault();
	
	var data = {};

	data['title']   = $('#title').val();
	var uid = Helper().getCookie();
	uid = JSON.parse(uid);
	data['user_id'] = uid.id;
	data = JSON.stringify( data );

	var onSuccess = function( response ) {
		$('#addCategorySubmit').hide();
		Finch.navigate('dashboard');

	}

	var onError = function( err ) {
		Helper.log( err );
	}

	$dashboard().addCategory( data ).then( onSuccess, onError);


});


$( document ).on( 'click', '.deleteCategory', function(e) {
	e.preventDefault();

	if(confirm('Do you want to delete')==true) {

		var id = $(this).data( 'route' );

		$dashboard().deleteCategory( id );
	} else {
		alert('No');
	}

	
});

$( document ).on( 'click', '.editCategory', function(e) {

	e.preventDefault();
	var cid = $( this ).data( 'route' );
	var data = {};
	var data_token = JSON.parse(Helper().getCookie());
	data['access_token'] = data_token.access_token;
	data['id'] = data_token.id;
	data['cid'] = cid;
	data = JSON.stringify(data);
	Helper().setCookie(data);

	Finch.navigate('edit');
	
});

$( document ).on( 'submit', '#editCategorySubmit',function(e) {
	e.preventDefault();
	var title = $('#title').val();
	var data_token = JSON.parse(Helper().getCookie());
	var cid = data_token.cid;

	var data = {};
	data['title'] = title;
	// data['cid']   = cid;
	// data = JSON.stringify(data);
	$dashboard().editCategory(data,cid);
});

$( document ).on( 'click','.viewData',function(e) {
	e.preventDefault();
	var did = $(this).data('route');
	var cid = $(this).data('route'); 
	var data = {};
	var data_token = JSON.parse(Helper().getCookie());
	data['access_token'] = data_token.access_token;
	data['id'] = data_token.id;
	data['cid'] = cid;
	data['did'] = did;
	data = JSON.stringify(data);
	Helper().setCookie(data);
	Finch.navigate('viewData');
});

$( document ).on( 'click', '#addData', function(e) {
	Finch.navigate('addData');
});

$( document ).on( 'submit', '#addDataSubmit', function(e) {
	e.preventDefault();
	var title = $('#title').val();
	var body = $('#body').val();
	data_token = JSON.parse(Helper().getCookie());
	var category_id = data_token.cid;

	var data = {};
	data['title'] = title;
	data['body']  = body;
	

	$dashboard().addData(data,category_id);	

});

$( document ).on( 'click', '.deleteData', function(e) {
	e.preventDefault();
	var id = $(this).data('route');
	$dashboard().deleteData( id );
});

$( document ).on( 'click', '.editData', function(e) {
	var id = $( this ).data('route');
	var did = $(this).data('route');
	var cid = $(this).data('route'); 
	var data = {};
	var data_token = JSON.parse(Helper().getCookie());
	data['access_token'] = data_token.access_token;
	data['id'] = data_token.id;
	data['cid'] = cid;
	data['did'] = did;
	data['data_id'] = id;
	data = JSON.stringify(data);
	Helper().setCookie(data);

	Finch.navigate('editData');
});

$( document ).on( 'submit', '#editDataSubmit', function(e) {
	e.preventDefault();
	var title = $('#title').val();
	var body  = $('#body').val();
	var data_token = JSON.parse(Helper().getCookie());
	var data_id = data_token.data_id;
	var data = {};
	data['title'] = title;
	data['body']  = body;
	
	$dashboard().editData(data,data_id);
});

$( document ).on( 'click', '#logoutSubmit', function( e ) {

	e.preventDefault();
	Helper().delCookie();
	var template = $( '#registerView' ).html();
	Finch.navigate( 'login' );
	Helper().render( template );
	location.reload();
	Helper().log( e );

});












function $dashboard(){
	return {
		addCategory: function( payload ) {
			return $http().post({
				url     : Routes().categories+Routes().addCategory,
				payload : payload,
			});

		},
		deleteCategory: function( payload ) {
			return $http().delete({
				url     : Routes().categories+Routes().delete,
				payload : payload,
			});
		},
		editCategory: function( data,cid ) {
			return $http().edit({
				url     : Routes().categories+Routes().edit,
				data : data, 
				cid  : cid, 
			});
		},
		addData : function( payload,category_id ) {
			return $http().addData({
				url : Routes().datas+Routes().add,
				payload:payload,
				category_id:category_id,
			});
		},
		deleteData : function( payload ) {
			return $http().delete({
				url: Routes().datas+Routes().delete,
				payload:payload,
			});
		},
		editData    : function( data, cid) {

			return $http().edit({
				url : Routes().datas+Routes().edit,
				data : data,
				cid : cid,
			});
		}
	}
}
function user(){
	return{
		renderLogin: function(){

			if ( (Helper().getCookie()) ) {
				Finch.navigate( Routes().dashboard );
				this.renderDashboard();
			} else {
				var template = $( '#loginView' ).html();
				Finch.navigate( Routes().login );
				Helper().render( template );
			}
		},
		renderRegister: function(){
			var template = $( '#registerView' ).html();
			Finch.navigate( 'register' );
			Helper().render( template );
		},
		renderForget: function(){
			var template = $( '#forgetView' ).html();
			Finch.navigate( 'forget' );
			Helper().render( template );
		},

		renderDashboard: function(){
			var data_token = JSON.parse(Helper().getCookie());
			var token = data_token.access_token;
			var id    = data_token.id;

			if( !(Helper().getCookie()) ){
				Finch.navigate('login');
			} else {
				$.ajax({
					type: 'get',
					url :  Config().apiUrl+Routes().categories+Routes().users+id,
					success: function( response ) {
						$('#menu').hide();
						var small_source   = $("#dashboardView").html();
						var small_template = Handlebars.compile(small_source);
						var small_data = {
					            response
				        	};
				     
						$("#small-content-placeholder").html(small_template(small_data));
		
					},
					error: function( err ) {
						Helper.log( err );
					}
				});
			
				// var template = $('#dashboardView').html();
				// $('#menu').hide();
				// Helper().render( template );
			}
		}
	}
}

$( document ).on( 'submit','#loginSubmit',function(e){
	e.preventDefault();
	var data         =  {};
	data['email']    =  $( '#email' ).val();
	data['password'] =  $( '#password' ).val();
	data = JSON.stringify(data);

	var onSuccess = function( response ) {
		console.log( response );
		var token = response.data.jwt;
		var uid    = response.data.id;

		var data = {"access_token":token,"id":uid};
		data = JSON.stringify(data);

		Helper().setCookie( data );

		if( Helper().getCookie() == '{}' ) {
			alert('Invalid One');
		} else {
			$('#loginSubmit').hide();
			Finch.navigate('dashboard');
			
		}

		Helper().log( response );
	}

	var onError = function( err ) {

		console.log(err,'err');
		Helper().log( err );
	}

	$user().login( data ).then( onSuccess, onError );

});

$( document ).on( 'submit', '#registerSubmit', function( e ) {
	e.preventDefault();

	var data = {};
	data['name']     = $('#name').val();
	data['email']    = $('#email').val();
	data['password'] = $('#password').val();
	data = JSON.stringify(data);

	var onSuccess = function( response ) {
		var token = response.data.jwt;
		Helper().setCookie( 'access_token='+token );
		if( Helper().getCookie() == 'access_token=undefined' ) {
			alert('Already Registered');
		} else {
			var template = $( '#dashboardView' ).html();
			Finch.navigate( 'dashboard' );
		}
		Helper().log( response );

	}

	var onError = function( err ) {
		Helper().log( err );
	}

	$user().register( data ).then( onSuccess, onError );
	
});

$( document ).on( 'submit', '#forgetSubmit', function(e) {
	e.preventDefault();
	var getEmail = $('#email').val();
	var data = {};
	data['email'] =  $( '#email' ).val();

	var data      =  JSON.stringify( data );

	var onSuccess = function( response ) {
		e.preventDefault();

		if ( response.data == '') {
			alert( 'Username Not Found' );
		} else {
			Helper().setCookie( getEmail );
			var template = $( '#recoveryView' ).html();
			Finch.navigate('recovery');
			Helper().render(template);
		}
		
	}

	var onError = function( err ) {
		Helper().log( data );
	}

	$user().forget( data ).then( onSuccess, onError);
});

$( document ). on( 'submit', '#recoverySubmit', function(e) {
	e.preventDefault();

	var data = {};
	data['token']    = $( '#token' ).val();
	data['password'] = $( '#password' ).val();
	data             = JSON.stringify( data );

	var onSuccess = function( response ) {
		var token = response.data.jwt;
		Helper().setCookie( 'access_token='+token );
		var template = $( '#dashboardView' ).html();
		Finch.navigate( 'dashboard' );
		Helper().render(template);

		Helper().log( response );
	}

	var onError = function( err ) {
		Helper().log( err );
	}

	$user().recovery( data ).then( onSuccess, onError);
});

$( document ).on( 'click', '#token', function(e) {
	e.preventDefault();
	var getEmail = Helper().getCookie();
	var data = {};
	data['email'] = getEmail;
	var data      =  JSON.stringify( data );

	var onSuccess = function( response ) {

		alert( 'hello' );

	}

	var onError = function( err ) {
		Helper().log( err );
	}

	$user().resendEmail( data ).then( onSuccess, onError );

});






function $user(){
	return {
		login: function( payload ){
			return $http().post({
				url: Routes().users+Routes().login,
				payload: payload,
			});
		},

		register: function( payload ){
			return $http().post({
				url: Routes().users+Routes().register,
				payload: payload,
			});
		},

		forget: function( payload ) {
			return $http().post({
				url: Routes().users+Routes().forget,
				payload: payload,
			});
		},

		recovery: function( payload ) {
			return $http().post({
				url: Routes().users+Routes().recovery,
				payload : payload,

			});
		},

		resendEmail: function( payload ) {
			return $http().post({
				url: Routes().users+Routes().resendEmail,
				payload: payload,
			});
		},
	}
}
function Config(){
	return{
		mode      : 'production',
		apiUrl    : 'localhost/ewallet/server/',
		cookieVar : 'ewallet'
	}
}
function Helper(){
	return{
		render: function( data ){
			$( '#render' ).html( data );
		},
		log: function( data ){
			if( 'production' == config().mode ){
				console.log( data );
			}
		},
		setCookie: function( data ){
			localStorage.setItem( Config().cookieVar, data );
		},
		getCookie: function(){
			return localStorage.getItem( Config().cookieVar );
		},
		delCookie: function() {
			return localStorage.clear();
		}
	}
}
function $http(){
	return{
		post: function( param ){
			
			return $.post( Config().apiUrl + param.url, param.payload);

		},
		delete: function( param ) {
			$.ajax({
				type: 'delete',
				url: Config().apiUrl+param.url+param.payload,
				success : function( response ) {
					Finch.navigate('dashboard');
				},
				error: function( err ) {
					Helper.log( err );
				}

			});
		},

		edit:  function( param ) {
			console.log(param.cid);
			$.ajax({
				type: 'put',
				url : Config().apiUrl+param.url+param.cid,
				data : JSON.stringify(param.data),
				contentType : 'application/json',
				dataType    :  'json',
				success: function( response ) {
					Finch.navigate('dashboard');
					alert('Data Updated');
				},
				error: function( err ) {
					Helper().log( err );
				}
			});
		},
		addData : function( param ) {

			$.ajax({
			type: 'post',
			url : Config().apiUrl+param.url+param.category_id,
			data : JSON.stringify(param.payload),
			contentType : 'application/json',
			dataType    :  'json',
			success: function( response ) {
				$('#addDataSubmit').hide();
				Finch.navigate('dashboard');
				alert('Data Added');
			},
			error: function( err ) {
				Helper().log( err );
			}
			});
		}
	}
}
function Routes(){
	return{
		login     : 'login',
		register  : 'register',
		users	  : 'users/',
		dashboard : 'dashboard',
		forget	  : 'forget',
		recovery  : 'recovery',
		resendEmail : 'resendEmail',
		dashboard : 'dashboard',
		add       : 'add/ ',
		categories: 'categories/',
		addCategory: 'addCategory/',
		delete     : 'delete/',
		edit       : 'edit/',
		title      : 'title/',
		data       : 'viewData',
		addData    : 'addData' ,
		datas      : 'datas/',
		editData   : 'editData',
		show       : 'show/',   
	}
}

Finch.route( Routes().login, function(){
	user().renderLogin();
});

Finch.route( Routes().register, function(){
	user().renderRegister();
});

Finch.route( Routes().forget, function(){
	user().renderForget();
});

Finch.route( Routes().dashboard, function() {
	user().renderDashboard();
});

Finch.route( Routes().add, function() {
	dashboard().renderAddCategory();
});

Finch.route( Routes().edit, function() {
	dashboard().renderEditCategory();
});

Finch.route( Routes().data, function() {
	dashboard().renderViewData();
});

Finch.route( Routes().addData, function() {
	dashboard().renderAddData();
});

Finch.route( Routes().editData,function() {
	dashboard().renderEditData();
})

$(document).ready(function(){ 
	Finch.listen();

	// if (Helper().getCookie() == null) {
	// 	Finch.navigate('login');
	// 	user().renderLogin();
	// } else {
	// 	Finch.navigate('dashboard');
	// 	user().renderDashboard();
	// }
});

$(document).on( 'click', '.navigator', function(e){
	e.preventDefault();
	var route = $(this).data( 'route' );
	Finch.call( route );
})
})();