<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="<?php echo asset('/css/app.css') ?>" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<?php include_once('../resources/views/_layouts/navbar.php') ?>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Message</div>
				<div class="panel-body">
					<?php if (count($errors) > 0) { ?>
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								<?php foreach ($errors->all() as $error) { ?>
									<li><?php echo $error ?></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
					<form action="<?php echo URL('admin/messages/' . $message->id) ?>" method="POST">
						<input name="_method" type="hidden" value="PUT">
						<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
						<input type="text" name="title" class="form-control" required="required"
							   value="<?php echo $message->title ?>">
						<br>
                            <textarea name="body" rows="10" class="form-control"
									  required="required"><?php echo $message->body ?></textarea>
						<br>
						<button class="btn btn-lg btn-info">Update</button>
						<a class="btn btn-lg btn-info" href="<?php echo URL('admin') ?>">Go Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once('../resources/views/_layouts/footer.html') ?>
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>