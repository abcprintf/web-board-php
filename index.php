<?php
	session_start();
	include 'config/connect.php';

	if(!empty($_POST)) {

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$sql = "SELECT * FROM `member` WHERE `username` = ? AND `password` = MD5(?);";
		$q = $conn->prepare($sql);
		$q->execute(array($username,$password));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		if($data) {
			if($data['status'] == "admin"){
				$_SESSION['admin_login'] = $data['member_id'];
				header('Location: admin/main.php?alert=Login_success');
			}else{
				$_SESSION['user_login'] = $data['member_id'];
				header('Location: main.php?alert=Login_success');
			}
		}else {
			header('Location: index.php?alert=Login_fail');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>:: web board ::</title>
	<link rel="stylesheet" href="dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="dist/css/web_board.css">
</head>

<body>

	<div class="container">
		<!-- panel -->

		<div class="panel panel-primary">

			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6 col-md-6">
						<h3 class="panel-title">Login</h3>
					</div>
					<div class="col-xs-6 col-md-6 text-right">
					</div>
				</div>
			</div>

			<div class="panel-body">

				<form class="form-horizontal" action="" method="post">

					<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" autocomplete="off">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-info">Login</button>
							<a href="register.php">สมัครสมาชิก ?</a>
						</div>
					</div>
				</form>

			</div>

			<div class="panel-footer">
				Footer
			</div>

		</div>

		<!--/panel -->
	</div>

	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>

</html>