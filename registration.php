<?php

session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pin = $_POST['pin'];

if($pin<1000 || $pin>9999){
	header('location:login.php?id=5');
}
else{
	$conn = mysqli_connect("localhost","root","","Account");

	$query = "SELECT * FROM users WHERE phone LIKE '$phone' AND email LIKE '$email'";

	$result = mysqli_query($conn,$query);

	$num = mysqli_num_rows($result);

	if($num==1){
		header('location:login.php?id=4');
	}

	else{
		$query = "INSERT INTO users (ac,pin,name,email,phone,balance) VALUES (NULL, '$pin', '$name', '$email', '$phone', 500)";

		// minimum balance 500 is added

		$result = mysqli_query($conn,$query);

		if($result){
			$query = "SELECT * FROM users WHERE email LIKE '$email' AND phone LIKE '$phone'";
			$result = mysqli_query($conn,$query);
			$result = mysqli_fetch_assoc($result);
			$_GET['num'] = $result['ac'];
			header('location:login.php?id=2&num='.$_GET['num']);
		}
		else{
			header('location:login.php?id=3');
		}
	}
}

?>