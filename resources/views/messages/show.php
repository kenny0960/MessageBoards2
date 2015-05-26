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
	<h4>
		<a href="/">⬅BACK</a>
	</h4>

	<h1 style="text-align: center; margin-top: 50px;"><?php echo $message->title ?></h1>
	<hr>
	<div id="info" style="text-align: right;">
		post by <?php echo App\Http\Model\UserModel::findUser($message->user_id)->name ?> at <?php echo $message->updated_at ?>
		<?php if ($nCommentCount = App\Http\Model\CommentModel::countComment($message->id)) { ?>
			with <span class="h5 text-danger"><?php echo App\Http\Model\CommentModel::countComment($message->id) ?></span> comments
		<?php } ?>
	</div>
	<div id="content" style="padding: 50px;">
		<p>
			<?php echo $message->body ?>
		</p>
	</div>
	<div id="comments" style="margin-bottom: 100px;">

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

		<div id="new">
			<form action="<?php echo URL('comment/store') ?>" method="POST">
				<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
				<input type="hidden" name="message_id" value="<?php echo $message->id ?>">

				<div class="form-group">
					<label>Nickname (*)</label>
					<input type="text" name="nickname" class="form-control" style="width: 300px;"
						   required="required">
				</div>
				<div class="form-group">
					<label>Email address</label>
					<input type="email" name="email" class="form-control" style="width: 300px;">
				</div>
				<div class="form-group">
					<label>Content (*)</label>
                    <textarea name="content" id="newFormContent" class="form-control" rows="10"
							  required="required"></textarea>
				</div>
				<button type="submit" class="btn btn-lg btn-success col-lg-12">Submit</button>
			</form>
		</div>

		<script>
			function reply(a) {
				var nickname = a.parentNode.parentNode.firstChild.nextSibling.getAttribute('data');
				var textArea = document.getElementById('newFormContent');
				textArea.innerHTML = '@' + nickname + ' ';
			}
		</script>

		<div class="conmments" style="margin-top: 100px;">
			<?php foreach ($comments as $comment) { ?>

				<div class="one" style="border-top: solid 20px #efefef; padding: 5px 20px;">
					<div class="nickname" data="<?php echo $comment->nickname ?>">
						<h3><?php echo $comment->nickname ?></h3>
						<h6><?php echo $comment->created_at ?></h6>
					</div>
					<div class="content">
						<p style="padding: 20px;">
							<?php echo $comment->content ?>
						</p>
					</div>
					<div class="reply" style="text-align: right; padding: 5px;">
						<a href="#new" onclick="reply(this);">Reply</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php include_once('../resources/views/_layouts/footer.html') ?>
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>