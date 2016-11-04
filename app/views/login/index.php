<html>
	<layout>loginlayout</layout>
	
	<layoutsection name="body">
		<div class="panel panel-primary" style="margin-top: 100px;">
			<div class="panel-heading">
				<h3 class="panel-title">Login</h3>
			</div>
			<div class="panel-body">
				<form action="?p=login&a=login" method="POST" role="form">
					<div class="form-group">
						<label for="userName">Username</label>
						<input type="text" name="userName" class="form-control" id="userName" placeholder="Username" />
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="Password" />
					</div>

					<button type="submit" class="btn btn-primary pull-right">Login</button>
				</form>
			</div>
		</div>
	</layoutsection>
</html>