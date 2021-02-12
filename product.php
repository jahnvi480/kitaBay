	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="icon" href="images/small_logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="product.css">
	</head>
	<?php  
		include("dbcon.php");
		
	?>
	<body>
		<header>
			<nav>
				<img src="images/logo.png" class="lo" onclick="location.href='index.php'">
				<span id="hi">
				<?php 
					if(isset($_SESSION['username'])){
						echo '<a href="seller_details.php" class="navbut">Sell</a>';
						echo '<a href="seller_profile.php" class="navbut">Profile</a>';
					}
					else{
						echo '<a href="login_register.php" class="navbut">Login</a>';
						echo '<a href="login_register.php" class="navbut">Sell</a>';
					}
				?></span>
			<button id="menu" onclick="disp_menu()">Menu</button>
		</nav>
		<p id="hino">
			<span id="in_hino">
			<?php 
				if(isset($_SESSION['username'])){
					echo '<a href="seller_details.php" class="navbut">Sell</a><br><br><br>';
					echo '<a href="seller_profile.php" class="navbut">Profile</a><br><br><br>';
				}
				else{
					echo '<a href="login_register.php" class="navbut">Login</a><br><br><br>';
					echo '<a href="login_register.php" class="navbut">Sell</a><br><br><br>';
				}
			?></span>
		</p>
		</header>
				<?php
					$bn1 = mysqli_real_escape_string($conn, $_GET['proname']);
					$query = "SELECT * FROM book_list WHERE book_name = '$bn1'";
					$result = mysqli_query($conn, $query);
					while ($row = mysqli_fetch_array($result)) {
						$bn = $row['book_name'];
						$bp = $row["book_price"];
						$ba = $row["book_author"];
						$bcat = $row["book_cat"];
						$bd = $row["book_desc"];
						$bcon = $row["book_condt"];
						$bi = $row["book_image"];
						$sn = $row["seller_name"];
						echo "<div class='propage'>";
						echo '<div class="firstflex"><img src="book_image/'.$bi.'" class="bi"></div>';
						echo "<div class='secondflex'><form action='seller_profile.php' method='POST'><div class='bnbp'><p id='bp'><b>Rs. ".$bp."</b>";

						echo "<input name='bn' value='".$bn."' type='hidden'><button class='cartbutton' type='submit' name='cartbut'><i class='fa fa-shopping-cart'></i></button></p><br></form>";

						echo "<p><span id='bn'>".$bn."</span><span id='bcon'>".$bcon."</span></p></div><div class='sn'><h2>Seller name </h2><p style='text-transform: uppercase;'>".$sn."</p></div></div></div>";
						echo "<div class='propage'><div class='desc'><p id='ba'><b>Author: </b>".$ba."</p><br>";
						echo "<p id='bcat'><b> Book Category: </b>".$bcat."</p><br>";
						echo "<p id='bd'><b> Book Description: </b>".$bd."</p></div></div>";
						echo "";
					}
					$c = mysqli_real_escape_string($conn, $_GET['cat']);
					$q1 = "SELECT * FROM book_list WHERE book_cat = '$c' AND book_name <> '$bn1'";
					$r = mysqli_query($conn, $q1);
					echo "<div class='related'><h2>Related Books</h2><div class='bl'>";
					while ($row1 = mysqli_fetch_array($r)) 
						{
							echo "<div class='samebooks'>";
							echo '<i class="fa fa-star-o" id="star" style="float:right;" onclick="location.href=`product.php?proname='.$row1['book_name'].'&cat='.$bcat.'`"></i><img src="book_image/'.$row1['book_image'].'" class="sbi"><br>';
							echo "<p>".$row1['book_name']."</p></div>";
						}
					echo "</div></div>";
				?>
				<footer>
				<div style="line-height: 1.8em;">
					<img src="images/logo.png" style="margin: -60px 0px -60px 0px;cursor: pointer;" onclick="location.href='index.php'">
					<p>
						KitaBay is a platform where users can sell and buy books of any kind. 
					</p>
				</div>
				<div style="line-height: 1.8em;">
					<p>CONTACT US:<br>
					<a href="mailto:jahnvithakkar2000@gmail.com" class="mail" title="jahnvithakkar2000@gmail.com"><i class="fa fa-envelope" style="font-size: 15px;"></i> kitabay@gmail.com</a><br>
					<a href="tel:+919702934903"><i class="fa fa-phone" aria-hidden="true"></i> +919702934903</a><br>
		  			<a href="https://www.facebook.com/TSECUBA" class="fb" target="_blank"><i class="fa fa-facebook" style="font-size: 20px;"></i> KitaBay</a><br>  
		  			<a href="https://www.instagram.com/uba_tsec_official/?hl=en" class="yt" target="_blank"><i class="fa fa-instagram" style="font-size: 20px;"></i> kitaBay_official </a> </p>
				</div>
				<div>
		         	<p>ADDRESS:<br><i class="fa fa-map-marker" aria-hidden="true"></i> W, P. G. Kher Marg, (32nd Road, Marg, Off Linking Rd, TPS III, Bandra West, Mumbai, Maharashtra 400050<br></p>
		        </div>
			</footer>
	</body>
	<script type="text/javascript">
			function disp_menu(){
			console.log('Yes');
			var wih = document.getElementById('hino').style.height;
			if (wih == "0px") {
				document.getElementById('hino').style.height = "180px";
				document.getElementById('in_hino').style.display = "block";
			}
			else{
				document.getElementById('hino').style.height = "0px";
				document.getElementById('in_hino').style.display = "none";
			}
		}
	</script>
	</html>