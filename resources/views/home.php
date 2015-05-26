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
	<div id="title" style="text-align: center;">
		<h1>Laravel 5 Practice : Message Boards</h1>
	</div>
	<hr>
	<ul>
		<?php foreach ($messages as $message) { ?>
			<li style="margin: 50px 0;">
				<div class="title">
					<a href="<?php echo URL('messages/' . $message->id) ?>">
						<h3><?php echo $message->title ?></h3>
					</a>
				</div>
				<div class="body">
					<p class="h4"><?php echo $message->body ?></p>

					<p class="h5" style="text-align: right">
						－post by <?php echo App\Http\Model\UserModel::findUser($message->user_id)->name ?>
						at <?php echo $message->updated_at ?>
						<?php if ($nCommentCount = App\Http\Model\CommentModel::countComment($message->id)) { ?>
							with <span
								class="h5 text-danger"><?php echo App\Http\Model\CommentModel::countComment($message->id) ?></span> comments
						<?php } ?>
					</p>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>

<?php include_once('../resources/views/_layouts/footer.html') ?>
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>
