<?php 

session_start();

$conn = mysqli_connect("localhost","root","","Account");

$des = $_POST['des'];
$amount = $_POST['amount'];

$query = "SELECT * FROM users WHERE ac LIKE '$des'";

$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);

if($num != 1){
	header('location:profile.php?err=11');
}
else{
	if($amount < 0){
		header('location:profile.php?err=12');
	}
	else{
		$a = $_SESSION['balance'] - $amount;
		// minimum balance should be 100

		if($a < 100){
			header('location:profile.php?err=13');
		}
		else{
			if($des == $_SESSION['ac']){
				header('location:profile.php?err=14');
			}
			else{
				$r = mysqli_fetch_assoc($result);
				$am = $r['balance'] + $amount;
				$q = "UPDATE users SET balance = '$am' WHERE ac = '$des'";
				mysqli_query($conn, $q);

				$am = $_SESSION['balance'] - $amount;
				$q = "UPDATE users SET balance = '$am' WHERE ac = ".$_SESSION['ac'];
				$r = mysqli_query($conn, $q);
				$r = mysqli_fetch_assoc($r);

				$_SESSION['balance'] = $r['balance'];
				header('location:profile.php?err=20');
			}
		}
	}
}

?>