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