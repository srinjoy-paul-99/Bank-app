<?php

session_start();

$conn = mysqli_connect("localhost","root","","Account");

$a = $_POST['amount'];

if($a > 0){
	
	$account = $_SESSION['ac'];

	$a = $a + $_SESSION['balance'];

	$query = "UPDATE users SET balance = '$a' WHERE ac = '$account'";

	$result = mysqli_query($conn, $query);

	$result = mysqli_fetch_assoc($result);

	$_SESSION['balance'] = $result['balance'];

	header('location:profile.php?err=0');

}

else{
	header('location:profile.php?err=1');
}


?>