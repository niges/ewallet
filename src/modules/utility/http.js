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
				Finch.navigate('viewData');
				alert('Data Added');
			},
			error: function( err ) {
				Helper().log( err );
			}
			});
		}
	}
}