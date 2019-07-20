<?php
    session_start();
    include '../config/connect.php';

    if (isset($_SESSION['admin_login'])){
		$admin_login = $_SESSION['admin_login'];

		$sql = "SELECT * FROM `member` WHERE `member_id` = ?;";
		$q = $conn->prepare($sql);
		$q->execute(array($admin_login));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$fname = $data['fname'];
		$lname = $data['lname'];

	}else{
		header('Location: ../index.php?alert=Not_Loing');
    }
    
    echo "Hello : " . $fname . ' you are admin.';
?>