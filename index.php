<!DOCTYPE html>
<html>
<head>
	<title>Kitabay</title>
	<link rel="icon" href="images/small_logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php  
	include("dbcon.php");
	if (isset($_GET['logout'])) {
		unset($_SESSION['username']);
		session_destroy();
	}
?>
<body>
	<header>
		<nav>
			<img src="images/logo.png" class="lo" onclick="location.href='index.php'">
			<span id="hi">
			<?php 
				if(isset($_SESSION['username'])){
					echo '<a href="index.php?logout=`1`" name="logout" class="navbut">Logout</a>';
					echo '<a href="seller_details.php" class="navbut">Sell</a>';
					echo '<a href="seller_profile.php" class="navbut">Profile</a>';
				}
				else{
					echo '<a href="login_register.php" class="navbut">Login</a>';
					echo '<a href="login_register.php" class="navbut">Sell</a>';
				}
			?>
		</span>
		<button id="menu" onclick="disp_menu()">Menu</button>
		</nav>
		<p id="hino">
			<span id="in_hino">
			<?php 
				if(isset($_SESSION['username'])){
					echo '<a href="index.php?logout=`1`" name="logout" class="navbut">Logout</a><br><br><br>';
					echo '<a href="seller_details.php" class="navbut">Sell</a><br><br><br>';
					echo '<a href="seller_profile.php" class="navbut">Profile</a><br><br><br>';
				}
				else{
					echo '<a href="login_register.php" class="navbut">Login</a><br><br><br>';
					echo '<a href="login_register.php" class="navbut">Sell</a>';
				}
			?></span>
		</p>
		<button class="btn-cat" onclick="cat_toggle()" id="btc"><img src="images/bar.png"></button>
	</header>
	<div class="page">
		<aside id="aside">
			<div id="inside_aside">
			<h2 onclick="cat_check('')" style="cursor: pointer;">All Categories</h2>
			<ul>
				<li onclick="cat_check('SCI-FI')"><img src="images/right-arrow.png" class="list_cat">SCI-FI</li>
				<li onclick="cat_check('MYSTERY')"><img src="images/right-arrow.png" class="list_cat">MYSTERY</li>
				<li onclick="cat_check(`CHILDREN'S BOOK`)"><img src="images/right-arrow.png" class="list_cat">CHILDREN'S BOOK</li>
				<li onclick="cat_check('AUTOBIOGRAPHY')"><img src="images/right-arrow.png" class="list_cat">AUTOBIOGRAPHY</li>
				<li onclick="cat_check('NON-FICTION')"><img src="images/right-arrow.png" class="list_cat">NON-FICTION</li>
				<li onclick="cat_check('FICTIONAL MYTHOLOGY')"><img src="images/right-arrow.png" class="list_cat">FICTIONAL MYTHOLOGY</li>
				<li onclick="cat_check('FANTASY')"><img src="images/right-arrow.png" class="list_cat">FANTASY</li>
			</ul>
		</div>
		</aside>
		<div class="main">
			<div id="backimg"></div>

			<form>
				<div id="search-bar">
					<div class="wrap">
					<i class="fa fa-search" id="s-logo"></i>
					<input type="text" id="search" autocomplete="Off" onkeyup="searching(this.value)"></div>
				</div>
			</form>

			<?php 
				$qrestore = "SELECT * FROM book_list";
				$qrestore_run = mysqli_query($conn, $qrestore);
				$count = 1;
				$len = mysqli_num_rows($qrestore_run);
				echo '<div id="procont">';
				for($i=1;$i<=($len/3)+10;$i++)
				{
				echo '<div class="products" id="products">';
					for ($x=$count; $x<$count+3; $x++){
						
						$restored = mysqli_fetch_row($qrestore_run);
						if($restored) {
							
						$len1 = count($restored);
						echo '<div class="subpro">';
						echo '<i class="fa fa-star-o" id="star" style="float:right;" onclick="location.href=`product.php?proname='.$restored[1].'&cat='.$restored[4].'`"></i><br>';
						echo '<img src="book_image/'.$restored[8].'" class="bi"><br>';
						echo '<div class="hov1"><p class="bn"><b>'.$restored[1].'</b></p>';
						echo '<p class="bp"><b>Rs. '.$restored[2].'</b></p>';
						echo '<p class="ba">Author: '.$restored[3].'</p>';
						echo '<p class="bcat" value="'.$restored[4].'" id="catego">'.$restored[4].'</p></div>';
						echo '</div>';
						}
					}
				echo "</div>";
			$count=$count+3;
		} echo "</div>";?>
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
		</div>
	</div>
	<script type="text/javascript">
		window.onscroll = function() {scrollFunction()};
		function scrollFunction() {
		  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		    document.getElementById("aside").style.transform = "translateY(-15.2%)";
		    document.getElementById("aside").style.transition = "0.5s";
		  } else {
		    document.getElementById("aside").style.transform = "translateY(0px)";
		  }
		}
		function cat_check(c){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function() {
		    	if (this.readyState == 4 && this.status == 200) {
		     		document.getElementById("procont").innerHTML = this.responseText;
				}
			};
			req.open("GET", "ajaxcat.php?cat="+c, true);
			req.send();
		}

		function searching(x){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function() {
		    	if (this.readyState == 4 && this.status == 200) {

		     		document.getElementById("procont").innerHTML = this.responseText;
				}
			};
			req.open("GET", "ajax.php?search="+x, true);

			req.send();
		}
		function cat_toggle(){
			var width = document.getElementById('aside').style.width;
			if (width == "0px") {
				document.getElementById('aside').style.width = "80%";
				document.getElementById('aside').style.padding = "10px";
				document.getElementById('inside_aside').style.display = "block";
				document.getElementById('btc').style.marginLeft = "84%";
			}
			else{
				document.getElementById('aside').style.width = "0px";
				document.getElementById('inside_aside').style.display = "none";
				document.getElementById('btc').style.marginLeft = "0px";
				document.getElementById('aside').style.padding = "0px";
			}

		}
		function disp_menu(){
			console.log('Yes');
			var wih = document.getElementById('hino').style.height;
			if (wih == "0px") {
				document.getElementById('hino').style.height = "210px";
				document.getElementById('in_hino').style.display = "block";
			}
			else{
				document.getElementById('hino').style.height = "0px";
				document.getElementById('in_hino').style.display = "none";
			}
		}
	</script>
</body>
</html>