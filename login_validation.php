<?php

session_start();

$conn = mysqli_connect("localhost","root","","Account");

$ac_number = $_POST['ac_number'];
$pin = $_POST['pin'];

$query = "SELECT * FROM users WHERE ac LIKE '$ac_number' AND pin LIKE '$pin'";

$result = mysqli_query($conn,$query);

$num = mysqli_num_rows($result);
$result = mysqli_fetch_assoc($result);

if($num == 1){
	$_SESSION['logged_in'] = 1;
	$_SESSION['ac'] = $ac_number;
	$_SESSION['name'] = $result['name'];
	$result = mysqli_fetch_assoc($result);
	print_r($result);
	header('location:profile.php');
}
else{
	header('location:login.php?id=1');
}

?>