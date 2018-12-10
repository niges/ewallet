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





