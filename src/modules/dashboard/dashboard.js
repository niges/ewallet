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











