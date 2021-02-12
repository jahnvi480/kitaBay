<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="icon" href="images/small_logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="seller_profile.css">
</head>
<?php  
	include("dbcon.php");
	if(isset($_POST['cartbut'])){
        $bookn = $_POST['bn'];
        $buyn = $_SESSION['username'];
        $query = "UPDATE book_list SET buyer_name = '$buyn' WHERE book_name = '$bookn'";
        $query_run = mysqli_query($conn,$query);
        if ($query_run) {
            echo "<script> alert('Your information is stored successfully') </script>";
        }
    }
    if(isset($_POST['del'])){
    	$bookname = $_POST['bn'];
    	$q = "DELETE FROM book_list WHERE book_name = '$bookname'";
    	$q_run = mysqli_query($conn,$q);
        if ($q_run) {
            echo "<script> alert('Deleted successfully') </script>";
        }
    }
    if(isset($_POST['remove'])){
        $bookn = $_POST['bn'];
        $buyn = $_SESSION['username'];
        $qa = "UPDATE book_list SET buyer_name = '' WHERE book_name = '$bookn'";
        $qa_run = mysqli_query($conn,$qa);
        if ($qa_run) {
            echo "<script> alert('Removed') </script>";
        }
    }
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
		<div class="nav2">
			<button onclick="drop()"><img width="35px" src="images/up.png" class="butimg"></button>
			<span style="float: right;">
			<button onclick="cart()" autofocus><img width="35px" src="images/cart.png" class="butimg"></button>
			<button onclick="sell()"><img width="40px" src="images/sell.png" class="butimg"></button></span>
		</div>
	</header>
	<div class="page">
		<aside id="aside">
			<div id="inside_aside">
			<h2 style="text-transform: uppercase;"><?php echo $_SESSION['username'];?></h2>
			<?php
				$query = "SELECT * FROM seller_details WHERE seller_email = '$_SESSION[email]'";
				$result = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($result)) {
					$em = $row['seller_email'];
					$pn = $row["seller_phone"];
					$ad = $row["seller_add"];
					echo "<div id='aside_p'><div style='text-align:left; line-height: 2em;margin-left:20px'><p><b>Email: </b>".$em."</p>";
					echo "<p><b>Phone No.: </b>".$pn."</p>";
					echo "<p><b>Address: </b>".$ad."</p></div></div>";
				}
			?>
			<button onclick='location.href="seller_details.php"' id="edit"><img src="images/user.png" id="useredit"></button></div>
		</aside>
		<div id="buttons">
			<button onclick="cart()" class="but" autofocus><span style="margin:0px 15px 0px -5px">CART</span><img width="35px" src="images/cart.png" class="butimg"></button><br>
			<button onclick="sell()" class="but"><span style="margin:0px 15px 0px -5px">SELL</span><img width="40px" src="images/sell.png" class="butimg"></button>
		</div>
		<div class="main">
			<div id="cart">
				<h1>YOUR CART</h1>
				<h1 id="gif"><img src='images/empty.gif' id="gif_img"><br><a href='index.php' id="gifa">Your Cart is empty...Click here to shop</a></h1>
				<?php 
					$q = "SELECT * FROM book_list WHERE buyer_name = '$_SESSION[username]'";
					$r = mysqli_query($conn, $q);
					while ($row = mysqli_fetch_array($r)) { 
						$p = "SELECT seller_email FROM seller_details WHERE seller_name = '$row[seller_name]'";
						$pr = mysqli_query($conn, $p);
						?>
						<div class="subpro">
							<?php echo '<img src="book_image/'.$row["book_image"].'" class="bi"><br>' ?>
							<div class="img_nam_mob">
							<div class="hov1">
								<p class="bn"><b><?php echo $row["book_name"]?></b></p>
								<p class="bp"><b>Rs. <?php echo $row["book_price"]?></b></p>
								<p class="selln"><b> Seller Name: </b> <span class="names"><?php echo $row["seller_name"]?></span><br><?php while($rows = mysqli_fetch_array($pr)){echo "<b>Contact Seller: </b><a href='mailto:".$rows['seller_email']."'>Email</a>";}?></p>
								<p class="ba"><b>Author: </b><?php echo $row["book_author"]?></p>
								<p class="bcat" id="catego"><b>Book Category:</b><?php echo $row["book_cat"]?></p>
							</div>
							<div class="hov">
								<p class="bd"><b>Book Description:</b><br><?php echo $row["book_desc"]?></p>
								<p class="bcon"><b>Book Condition:</b>  <?php echo $row["book_condt"]?></p>
							</div></div>
							<form action="seller_profile.php" method="POST">
								<?php echo "<input name='bn' value='".$row["book_name"]."' type='hidden' >" ?>
							<button type="submit" name="remove" class="del" ><i class="fa fa-trash" aria-hidden="true" style="color: white"></i></button></form>
						</div>
				<?php } ?>
			</div>
			<div id="sell">
				<h1>SELL</h1>
				<?php 
					$q = "SELECT * FROM book_list WHERE seller_name = '$_SESSION[username]'";
					$r = mysqli_query($conn, $q);
					while ($row = mysqli_fetch_array($r)) { ?>
						<div class="subpro">
							<?php echo '<img src="book_image/'.$row["book_image"].'" class="bi"><br>' ?>
							<div class="img_nam_mob">
							<div class="hov1">
								<p class="bn"><b><?php echo $row["book_name"]?></b></p>
								<p class="bp"><b>Rs. <?php echo $row["book_price"]?></b></p>
								<p class="byn"><b> Buyer Name: </b> <span class="names"  id="bn"><?php echo $row["buyer_name"]?></span></p>
								<p class="ba"><b>Author:</b> <?php echo $row["book_author"]?></p>
								<p class="bcat" id="catego"><b>Book Category:</b> <?php echo $row["book_cat"]?></p>
							</div>							
							<div class="hov">
								<p class="bd"><b>Book Description:</b><br> <?php echo $row["book_desc"]?></p>
								<p class="bcon"><b>Book Condition:</b> <?php echo $row["book_condt"]?></p>
							</div></div>

							<form action="seller_profile.php" method="POST">
								<?php echo "<input name='bn' value='".$row["book_name"]."' type='hidden' >" ?>
							<button type="submit" name="del" class="del"><i class="fa fa-trash" aria-hidden="true" style="color: white"></i></button></form>
						</div>
				<?php } ?>
			</div>
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
</body>
<?php 
	$R = "SELECT * FROM book_list WHERE buyer_name = '$_SESSION[username]'";
	$y = mysqli_query($conn, $R);
	if (mysqli_num_rows($y)==0) {
		echo "<script>document.getElementById('gif').style.display='block'</script>";
	}
	else {
		echo "<script>document.getElementById('gif').style.display='none'</script>";
	}
?>
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

		function cart(){
			document.getElementById('cart').style.display='block';
			document.getElementById('sell').style.display='none';
		}
		function sell(){
			document.getElementById('sell').style.display='block';
			document.getElementById('cart').style.display='none';
		}
		function drop(){
			var disp = document.getElementById('inside_aside').style.display;
			if (disp == 'none') {
				document.getElementById('aside').style.width ="95%";
				document.getElementById('aside').style.height = "auto";
				document.getElementById('aside').style.borderRadius = "0px";
				document.getElementById('aside').style.padding ="10px";
				document.getElementById('inside_aside').style.display ="block";
				document.getElementById('aside_p').style.paddingLeft ="25%";
			}
			else{
				document.getElementById('aside').style.width ="0%";
				document.getElementById('aside').style.height = "0px";
				document.getElementById('aside').style.borderRadius = "0px";
				document.getElementById('aside').style.padding ="0px";
				document.getElementById('inside_aside').style.display ="none";
			}
		}
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