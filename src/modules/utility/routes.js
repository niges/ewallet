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