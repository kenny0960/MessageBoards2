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
				<div class="panel-heading">Manage Comments</div>

				<div class="panel-body">

					<table class="table table-striped">
						<tr class="row">
							<th class="col-lg-4">Content</th>
							<th class="col-lg-2">User</th>
							<th class="col-lg-4">Message</th>
							<th class="col-lg-1"></th>
							<th class="col-lg-1"></th>
						</tr>
						<?php foreach ($comments as $comment) { ?>
							<tr class="row">
								<td class="col-lg-6">
									<?php echo $comment->content ?>
								</td>
								<td class="col-lg-2">
									<h3><?php echo $comment->nickname ?></h3>
									<?php echo $comment->email ?>
								</td>
								<td class="col-lg-4">
									<a href="<?php echo URL('messages/' . $comment->message_id) ?>" target="_blank">
										<?php echo App\Http\Model\MessageModel::findMessage($comment->message_id)->title ?>
									</a>
								</td>
								<td class="col-lg-1">
									<a href="<?php echo URL('admin/comments/' . $comment->id . '/edit') ?>"
									   class="btn btn-success">EDIT</a>
								</td>
								<td class="col-lg-1">
									<form action="<?php echo URL('admin/comments/' . $comment->id) ?>" method="POST"
										  style="display: inline;">
										<input name="_method" type="hidden" value="DELETE">
										<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
										<button type="submit" class="btn btn-danger">DELETE</button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</table>


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