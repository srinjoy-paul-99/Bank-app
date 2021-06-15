<?php

session_start();

if(!empty($_SESSION)){
	header('location:profile.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300&display=swap" rel="stylesheet">
</head>

<script type="text/javascript">
	$(document).ready(function(){
		$('.show').click(function(){
			$('.password').attr('type',$(this).is(':checked')?'text':'password');

		});
	});
</script>

<body class="bg">
	<nav class="navbar">
		<a href="profile.php" style="font-style: 25px">Modern Bank</a>
	</nav>

	<div class="container">
		<div class="row mt-5">
			<div class="col-md-8">
				<p class="font-lg">Connect to new-age banking system. Switch to Modern Bank...</p>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form action="login_validation.php" method="POST">
						<h3 class="text-md-center card-header"><b>Sign in</b></h3>
						<?php
							if(!empty($_GET)){
								if($_GET['id']==1){
									echo '<small style:"color:red;">Incorrect account number/PIN</small><br>';
								}
								else if($_GET['id']==2){
									echo '<small style:"color: #FB9568">Registration successful, your account number is </small>';
									echo '<small style:"color: #FB9568">'. $_GET["num"] .'</small><br>';
								}
								else if($_GET['id']==3){
									echo '<small style:"color: #FB9568">Registration failed</small><br>';
								}
								else if($_GET['id']==4){
									echo '<small style:"color: #212020">You are already registered, sign in</small><br>';
								}
								else if($_GET['id']==5){
									echo '<small style:"color: #FB9568">Registrationn falied, enter 4 digit PIN only</small><br>';
								}
							}
						?>
						<br><label><h5>Account number</h5></label><br>
						<input class="form-control" type="text" name="ac_number" placeholder="eg. 12345" required=""><br>
						<label><h5>PIN</h5></label><br>
						<input class="form-control password" type="password" name="pin" placeholder="eg. 1234" required="">
						<input type="checkbox" name="" class="show"> show pin<br><br>
						<input class="btn btn-block btn-bg" type="submit" name="" value="Sign in">
						</form>
						<small>New user? <a href="#" data-toggle="modal" data-target="#exampleModal">Sign up</a></small>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-md-center card-header" id="exampleModalLabel"><b>Registration form</b></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="registration.php" method="POST">
	        	<label><h6>Name</h6></label><br>
	        	<input class="form-control" type="text" name="name" placeholder="Virat Kohli" required=""><br>
	        	<label><h6>Email id</h6></label><br>
	        	<input class="form-control" type="email" name="email" placeholder="example@example.com" required=""><br>
	        	<label><h6>Contact number</h6></label><br>
	        	<input class="form-control" type="text" name="phone" placeholder="9876543210" required=""><br>
	        	<label><h6>PIN</h6></label><br>
	        	<input class="form-control password" type="password" name="pin" placeholder="eg. 1234" required="">
						<input type="checkbox" name="" class="show"> show pin<br><br>
	        	<input class="form-control btn-bg" type="submit" name="" value="Sign up"><br>
	        </form>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>

</body>
</html>