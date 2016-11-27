<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href=".">AutoPay</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li <?php if (isset($_GET['p'])) { echo ($_GET['p'] == 'home') ? 'class="active"' : ''; } else { echo 'class="active"'; }?>><a href=".">Home</a></li>

                <?php if ($_SESSION['LOGGED_IN_USER']['role'] == 1): ?>
				<li class="dropdown <?php if (isset($_GET['p'])) {echo ($_GET['p'] == 'reseller') ? 'active' : '';} ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Resellers <b class="caret"></b></a>
                    <ul class="dropdown-menu">
						<li><a href="?p=reseller">List All</a></li>
                        <li><a href="?p=reseller&a=add">Add Reseller</a></li>
                    </ul>
                </li>
				<li class="<?php if (isset($_GET['p'])) {echo ($_GET['p'] == 'service') ? 'active' : '';} ?>"><a href="?p=service">Services</a></li>
				<li class="<?php if (isset($_GET['p'])) {echo ($_GET['p'] == 'rateplan') ? 'active' : '';} ?>"><a href="?p=rateplan">Rate Plan</a></li>
                <?php endif; ?>

				<li class="<?php if (isset($_GET['p'])) {echo ($_GET['p'] == 'transaction') ? 'active' : '';} ?>"><a href="?p=transaction">Transactions</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <?php echo $_SESSION['LOGGED_IN_USER']['full_name']; ?>
                        <b class="caret"></b>
                    </a>
					<ul class="dropdown-menu">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
						<li><a href="?p=login&a=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>