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