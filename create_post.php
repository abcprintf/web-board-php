<?php
	session_start();
	include 'config/connect.php';

	if (isset($_SESSION['user_login'])){
		$user_login = $_SESSION['user_login'];

		$sql = "SELECT * FROM `member` WHERE `member_id` = ?;";
		$q = $conn->prepare($sql);
		$q->execute(array($user_login));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$fname = $data['fname'];
		$lname = $data['lname'];

	}else{
		header('Location: index.php?alert=Not_Loing');
	}

	if(!empty($_POST)) {

		$title = $_POST['title'];
		$details = $_POST['details'];

		
		try {
			//Insert data
			$sql  = "INSERT INTO `web_board` (`web_board_title`, `web_board_details`, `member_id`, `date_time`) VALUES (?, ?, ?, NOW());";
			$q = $conn->prepare($sql);
			$q->execute(array($title,$details,$user_login));

			header('Location: main.php?alert=insert_success');
		} catch (Exception $e) {
			echo $e->getMessage();
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
						<h3 class="panel-title">Web board</h3>
					</div>
					<div class="col-xs-6 col-md-6 text-right">
						<a href="main.php" class="btn btn-default">กลับไปหน้าแรก</a>
					</div>
				</div>
			</div>
			
			<div class="panel-body">
				<form class="form-horizontal" action="" method="post">
				  
				  <div class="form-group">
				    <label class="col-sm-2 control-label">หัวเรื่อง</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="title">
				    </div>
				  </div>

				  <div class="form-group">
				    <label class="col-sm-2 control-label">เนื้อหา</label>
				   <div class="col-sm-10">
				       <textarea class="form-control" rows="3" name="details"></textarea>
				    </div>
				  </div>
				  
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success">Post</button>
				    </div>
				  </div>
				</form>
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-6 col-md-6">
						Hello : <?php echo $fname.' '.$lname;?>
					</div>
					<div class="col-xs-6 col-md-6 text-right">
						<!--<a href="logout.php" class="btn btn-danger">logout</a>-->
					</div>
				</div>
			</div>

		</div>

		<!--/panel -->
	</div>

	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>