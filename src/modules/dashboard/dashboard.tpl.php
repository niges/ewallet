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