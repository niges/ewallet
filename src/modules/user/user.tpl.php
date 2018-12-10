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
