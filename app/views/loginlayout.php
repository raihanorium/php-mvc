<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>


<div class="container-fluid">
    <?php if(isset($model['error'])): ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> <?php echo $model['error']; ?>
        </div>
    <?php endif; ?>

	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<?php echo $LAYOUT_SECTION['body']; ?>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="static/jquery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>