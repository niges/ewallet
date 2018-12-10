<script type="text/x-handlebars-template" id="dashboardView">
	
	<button class="btn btn-lg btn-success" id="addCategory">Add New Category</button>
	<button id="logoutSubmit" class="btn btn-lg btn-danger">Logout</button>

	<table class="table table-bordered" id="showCategory">
		
        <thead>
            <th>Id</th>
            <th>title</th>
            <th>Action</th>
        </thead>
        <tbody>
            {{#each response.data}}
      
                <tr>
                    <td>{{id}}</td>
                    <td>{{title}}</td>
                    <td class="btn btn-default viewData" data-route={{id}}>View Data</td>
                    <td class="btn btn-primary editCategory" data-route={{id}}>Edit</td>
                    <td class="btn btn-danger deleteCategory" data-route={{id}}>Delete</td>
                </tr>
                
            {{/each}}
        </tbody>
 
	</table>

</script>


<script type="text/x-handlebars-template" id="addCategoryView">
	
	<form class="form" id="addCategorySubmit">
		<h2>Add Data</h2>
		<table class="table table-bordered">
			<tr>
				<td>Title:<input type="text" class="form-control" id="title"></td>
				
			</tr>
			<tr>
				<td><input type="submit" value="ADD" class="btn btn-success"></td>
			</tr>

		</table>
	</form>

</script>

<script type="text/template" id="editCategoryView">
	<h2>Edit Category</h2>
	<form class="form" id="editCategorySubmit">
		<table class="table table-bordered">
			<tr>
				<td>Title:<input type="text" class="form-control" id="title" value="{{title}}""></td>
				
			</tr>
			<tr>
				<td><input type="submit" value="Update" class="btn btn-success"></td>
			</tr>

		</table>
	</form>

</script>

<script type="text/x-handlebars-template" id="dataView">
	
	<button class="btn btn-lg btn-success" id="addData">Add New Data</button>

	<table class="table table-bordered" id="showData">
		
        <thead>
            <th>Id</th>
            <th>title</th>
            <th>body</th>
            <th></th>
        </thead>
        <tbody>
           
      		{{#each response.data}}
                <tr>
                    <td>{{id}}</td>
                    <td>{{title}}</td>
                    <td>{{body}}</td>
                    <td class="btn btn-primary editData" data-route={{id}}>Edit</td>
                    <td class="btn btn-danger deleteData" data-route={{id}}>Delete</td>
                </tr>
            {{/each}}    
           
        </tbody>
 
	</table>

</script>

<script type="text/x-handlebars-template" id="addDataView">
	<h2>Add Data</h2>
	<form class="form" id="addDataSubmit">
		<table class="table table-bordered">
			<tr>
				<td>Title:<input type="text" class="form-control" id="title"></td>
			</tr>
			<tr>
				<td>Body:<input type="text" class="form-control" id="body"></td>
			</tr>
			<tr>
				<td><input type="submit" value="ADD" class="btn btn-success"></td>
			</tr>

		</table>
	</form>

</script>

<script type="text/template" id="editDataView">
	<h2>Edit Category</h2>
	<form class="form" id="editDataSubmit">
		<table class="table table-bordered">
			<tr>
				<td>Title:<input type="text" class="form-control" id="title" value="{{title}}""></td>
				
			</tr>
			<tr>
				<td>Title:<input type="text" class="form-control" id="body" value="{{body}}""></td>
				
			</tr>
			<tr>
				<td><input type="submit" value="Update" class="btn btn-success"></td>
			</tr>

		</table>
	</form>

</script>

<div id="small-content-placeholder"></div>
<script type="text/template" id="loginView">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				
				<form class="form" method="post" id="loginSubmit">
					<h1>Login</h1>
					<table class="table table-bordered">
						
						<tr>
							<td>
								Email:<input type="text" class="form-control" name="email" id="email">
							</td>
						</tr>
						<tr>
							<td>
								Password:<input type="password" class="form-control" name="password" id="password">
							</td>
						</tr>
						<tr>
							<td>
								<a class="navigator" data-route="forget" href="" id="forget">Forget password</a>
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" value="submit" class="btn btn-success">
							</td>
						</tr>

					</table>
				</form>
				
			</div>
		</div>
	</div>
</script>

<script type="text/template" id="registerView">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>User Registration</h1>
				<div class="error"></div>
				<form class="form" method="post" id="registerSubmit">
					<table class="table table-bordered">
						<tr>
							<td>
								Username:<input type="text" class="form-control" name="name" id="name">
							</td>
						</tr>
						<tr>
							<td>
								Email:<input type="text" class="form-control" name="email" id="email">
							</td>
						</tr>
						<tr>
							<td>
								Password:<input type="password" class="form-control" name="password" id="password">
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" value="submit" class="btn btn-success">
							</td>
						</tr>

					</table>
				</form>
				
			</div>
		</div>
	</div>
</script>

<script type="text/template" id="forgetView">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Forget Password</h1>
				<form class="form" method="post" id="forgetSubmit">
					<table class="table table-bordered">
						
						<tr>
							<td>
								Enter Email:<input type="text" class="form-control" name="email" id="email">
							</td>
						</tr>
						
						<tr>
							<td>
								<input type="submit" value="Recover" class="btn btn-success">
							</td>
						</tr>

					</table>
				</form>
				
			</div>
		</div>
	</div>
</script>

<script type="text/template" id="recoveryView">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Forget Password</h1>
				<form class="form" method="post" id="recoverySubmit">
					<table class="table table-bordered">
						
						<tr>
							<td>
								Token:<input type="text" class="form-control" name="token" id="token">
							</td>
						</tr>
						<tr>
							<td>
								New Password:<input type="password" class="form-control" name="password" id="password">
							</td>
						</tr>
						<tr>
							<td>
								<a href="" id="token">Resend Token</a>
							</td>
						</tr>
						
						<tr>
							<td>
								<input type="submit" value="Recover" class="btn btn-success">
							</td>
						</tr>

					</table>

				</form>
			</div>
		</div>
	</div>
</script>
