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

	if(!empty($_GET)) {

		$id = $_GET['id'];

		//find web board
		$sql = "SELECT * FROM `web_board` WHERE `web_board_id` = ?;";
		$q = $conn->prepare($sql);
		$q->execute(array($id));
		$data  = $q->fetch(PDO::FETCH_ASSOC);
	}

	if(!empty($_POST)) {

		$post_id = $_POST['post_id'];
		$comment = $_POST['comment'];

		try {
			//insert data
			$sql = "INSERT INTO `comment` (`web_board_id`, `member_id`, `comment`, `date_time`) VALUES (?, ?, ?, NOW());";
			$q = $conn->prepare($sql);
			$q->execute(array($post_id,$user_login,$comment));

			header('Location: read_post.php?id='.$post_id);
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
						<h3 class="panel-title"><?php echo $data['web_board_title'];?></h3>
					</div>
					<div class="col-xs-6 col-md-6 text-right">
						<a href="main.php" class="btn btn-default">กลับไปหน้าแรก</a>
					</div>
				</div>
			</div>
			
			<div class="panel-body">
				<p><?php echo $data['web_board_details'];?></p>
				
				<?php

					$sql = "SELECT
					
					`comment`.`comment`
					,`comment`.`date_time`
					,`member`.`fname`
					,`member`.`lname` 

					FROM 

					`comment`

					LEFT JOIN `member`
						ON (`comment`.`member_id` = `member`.`member_id`)

					WHERE 

					`web_board_id` = ?;";
					$q = $conn->prepare($sql);
					$q->execute(array($id));
					while ($row = $q->fetch(PDO::FETCH_ASSOC)) {

					echo '<hr>';
					echo '<div class="comment">';
					echo '<p>'.$row['comment'].'</p>';
					echo '<span>ชื่อ : '.$row['fname'].' '.$row['lname'].'</span> <span>เวลา : '.$row['date_time'].'</span>';
					echo '</div>';
					echo '<hr>';

					}
				?>

				<form class="form-horizontal" action="" method="post">
					<input type="hidden" name="post_id" value="<?php echo $id;?>">
				  
				  <div class="form-group">
				    <label class="col-sm-2 control-label">comment</label>
				   <div class="col-sm-10">
				       <textarea class="form-control" rows="3" name="comment"></textarea>
				    </div>
				  </div>
				  
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success">send</button>
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