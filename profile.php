<?php

session_start();
if(empty($_SESSION)){
	header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300&display=swap" rel="stylesheet">
</head>
<body class="bg" style="background-image: url('https://wallpapercave.com/wp/wp6602853.jpg');">
	<nav class="navbar">
		<a class="navbar-brand" style="font-size: 25px" href="profile.php">Modern Bank</a>
		<div class="row">
				<div class="col-md-12 text-md-center">
					<span style="display: block; font-size: 20px; margin-left: auto; margin-right: auto; color:#eee">Hi, <?php echo $_SESSION["name"]; ?></span>
				</div>
		</div>
		<div id="menu">
			<a href="#" data-toggle="modal" data-target="#debit"><i class="fa fa-credit-card" aria-hidden="true"></i> Debit</a>
			<a href="#" data-toggle="modal" data-target="#credit"><i class="fa fa-credit-card" aria-hidden="true"></i> Credit</a>
			<a href="#" data-toggle="modal" data-target="#details"><i class="fa fa-user" aria-hidden="true"></i> Personal details</a>
			<a href="logout.php"><i class="fas fa-power-off"></i> Log out</a>
		</div>
	</nav>

	<div class="container">
		<div class="row" style="margin-top: 150px">
			<div class="offset-2"></div>
			<div class="col-md-8">
				<div class="card" style="background-color: #eee; border-width: 10px; border-color: #888">
					<div class="card-body text-md-center" style="font-size: 30px;">
						<div><?php 
							if(!empty($_GET)){
								if($_GET['err']==1){
									echo '<small><b><p style="color:red;">Invalid credit amount</p></b></small>';
								}
								else if($_GET['err']==0){
									echo '<small><b><p style="color:green;">Credit successful</p></b></small>';
								}
								else if($_GET['err']==11){
									echo '<small><b><p style="color:red;">Invalid destination account</p></b></small>';
								}
								else if($_GET['err']==12){
									echo '<small><b><p style="color:red;">Invalid amount</p></b></small>';
								}
								else if($_GET['err']==13){
									echo '<small><b><p style="color:red;">Insufficient balance</p></b></small>';
								}
								else if($_GET['err']==14){
									echo '<small><b><p style="color:red;">Transaction not possible within same account</p></b></small>';
								}
								else if($_GET['err']==20){
									echo '<small><b><p style="color:green;">Transaction successful</p></b></small>';
								}
							}

							$conn = mysqli_connect("localhost","root","","Account");

							$query = "SELECT * FROM users WHERE ac LIKE ".$_SESSION['ac'];
							$result = mysqli_query($conn, $query);
							$result = mysqli_fetch_assoc($result);
							$_SESSION['name'] = $result['name'];
							$_SESSION['balance'] = $result['balance'];
							$_SESSION['email'] = $result['email'];
							$_SESSION['phone'] = $result['phone'];


							echo '<p class="font-cus text-md-center">Account number : '.$_SESSION["ac"].'<br>Balance : '.$_SESSION["balance"];

						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title" style="display: block; margin-left: 300px; margin-right: auto;" id="exampleModalLabel"><b>Personal details</b></h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row mt-2 text-md-center font-cus">
	        	<div>
	        		<?php echo '<p>Name : '.$_SESSION["name"].'<br>Email id : '.$_SESSION["email"].'<br>Contact : '.$_SESSION["phone"]; ?>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="debit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title" style="display: block; margin-left: 170px; margin-right: auto;" id="exampleModalLabel"><b>Debit window</b></h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="debit.php" method="POST">
	        	<label style="font-size: 20px;">Destination account number</label><br>
	        	<input class="form-control" type="text" name="des"><br>
	        	<label style="font-size: 20px;">Debit amount</label><br>
	        	<input class="form-control" type="text" name="amount"><br>
	        	<input class="btn btn-block btn-bg" type="submit" name="" value="Proceed"><br>
	        </form>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="credit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title" style="display: block; margin-left: 165px; margin-right: auto;" id="exampleModalLabel"><b>Credit window</b></h3>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="credit.php" method="POST">
	        	<label style="font-size: 20px;">Credit amount</label><br>
	        	<input class="form-control" type="text" name="amount"><br>
	        	<input class="btn btn-block btn-bg" type="submit" name="" value="Proceed">
	        </form>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>

</body>
</html>