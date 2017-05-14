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
						<a href="create_post.php" class="btn btn-warning">New Post</a>
					</div>
				</div>
			</div>
			
			<div class="panel-body">
			<table class="table table-striped">
			   <thead>
			      <tr>
			         <th>#</th>
			         <th>ชื่อกระทู้</th>
			         <th>เวลาที่โพส</th>
			         <th>ตัวเลือก</th>
			      </tr>
			   </thead>
			   <tbody>
			      <?php

			      	$i = 0;
			      	$sql = "SELECT * FROM `web_board` ORDER BY `web_board`.`date_time` DESC";
			      	$q = $conn->prepare($sql);
			      	$q->execute(array());
			      	while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
			      		$i++;

			      		echo '<tr>';
			      		echo '<td>'.$row['web_board_id'].'</td>';
			      		echo '<td>'.$row['web_board_title'].'</td>';
			      		echo '<td>'.$row['date_time'].'</td>';
			      		echo '<td><a href="read_post.php?id='.$row['web_board_id'].'" class="btn btn-info">อ่าน</a></td>';
			      		echo '</tr>';
			      	}

			      ?>
			   </tbody>
			</table>
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-6 col-md-6">
						Hello : <?php echo $fname.' '.$lname;?>
					</div>
					<div class="col-xs-6 col-md-6 text-right">
						<a href="logout.php" class="btn btn-danger">logout</a>
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