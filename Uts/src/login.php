<?php
session_start();
include 'koneksi.php';
if (isset ($_POST['signin'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = mysqli_query($conn, "SELECT * FROM users where Email ='$email' AND Password ='$password'");
	$count = mysqli_num_rows($sql);
	if ($count > 0) {
		$row = mysqli_fetch_assoc($sql);
		$_SESSION['role'] = $row['Role'];
		if ($row['Role'] == 'admin') {
			$_SESSION['alogin'] = $row['ID_User'];
			$_SESSION['arole'] = $row['Role'];
			header("location:home.php");
		} else {
			$_SESSION['ulogin'] = $row['ID_User'];
			$_SESSION['arole'] = $row['Role'];
			header("location:home.php");
		}
	} else {
		echo "<script>alert('Invalid Details');</script>";
	}
}
?>