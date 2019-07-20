<?php
	session_start();
	include 'config/connect.php';

	if(!empty($_POST)) {

		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$try_password = trim($_POST['try_password']);

        if($password !== $try_password){
            header('Location: index.php?alert=passwordNotMatch!');
            exit();
        }

       try{
            $sql = "INSERT INTO `member` (`fname`, `lname`, `date_time`, `username`, `password`) VALUES (?, ?, NOW(), ?, MD5(?));";
            $q = $conn->prepare($sql);
            $q->execute(array($fname, $lname, $username, $password));

            header('Location: index.php?alert=regiserSuccess');
       }catch(Exception $e){
            header('Location: index.php?alert=regiserFail!');
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
						<h3 class="panel-title">สมัครสมาชิก</h3>
					</div>
					<div class="col-xs-6 col-md-6 text-right">
					</div>
				</div>
			</div>

			<div class="panel-body">

				<form class="form-horizontal" action="" method="post">

                    <div class="form-group">
						<label class="col-sm-2 control-label">First Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="fname" autocomplete="off">
						</div>
					</div>

                    <div class="form-group">
						<label class="col-sm-2 control-label">Last Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="lname" autocomplete="off">
						</div>
					</div>

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
						<label class="col-sm-2 control-label">Try-Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="try_password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success">register</button>
							<a href="index.php" class="btn btn-default">กลับ</a>
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