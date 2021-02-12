<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<link rel="icon" href="images/small_logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="book_detail_form.css">
</head>
<?php 
	include("dbcon.php");
	$sn = $_SESSION['username'];
	if(isset($_POST['subscribe'])){
		$bn = $_POST['book_name'];
        $bp = $_POST['book_price'];
        $ba = $_POST['book_auth'];
        $bc = $_POST['book_cat'];
        $bd = $_POST['book_desc'];
        $bcon = $_POST['condition'];
        $_bn = mysqli_real_escape_string($conn, $bn);
        $_ba = mysqli_real_escape_string($conn, $ba);
        $_bc = mysqli_real_escape_string($conn, $bc);
        $_bd = mysqli_real_escape_string($conn, $bd);
        $_bcon = mysqli_real_escape_string($conn, $bcon);
		$target = "book_image/".basename($_FILES['image']['name']);
		$i = $_FILES['image']['name'];
		$_i = mysqli_real_escape_string($conn, $i);
		$query = "INSERT INTO book_list (book_name, book_price, book_author, book_cat, book_desc, book_condt, seller_name, book_image) VALUES('$_bn',$bp,'$_ba','$_bc','$_bd','$_bcon','$sn','$_i')";
		$query_run = mysqli_query($conn,$query);
		if (move_uploaded_file($_FILES['image']['tmp_name'],$target)) {
			echo "<script> alert('UPLOADED') </script>";
		}
		else{
			echo "<script> alert('NOT UPLOADED') </script>";
		}
		header("location: index.php");
	}
?>

<body>
<form method="POST" action="book_detail_form.php" enctype="multipart/form-data">
	<div class="form" >	
		<div class="book_cat_list">
			<aside id="aside" >
				<h2>Select a Category</h2>
				<ul>
					<li class="list_cat" id="sf" onclick="document.getElementById('lapi').value = 'SCI-FI'">SCI-FI</li>
					<li class="list_cat" id="m" onclick="document.getElementById('lapi').value = 'MYSTERY'">MYSTERY</li>
					<li class="list_cat" id="cb" onclick="document.getElementById('lapi').value = `CHILDREN'S BOOK`">CHILDREN'S BOOKS</li>
					<li class="list_cat" id="a" onclick="document.getElementById('lapi').value = 'AUTOBIOGRAPHY'">AUTOBIOGRAPHY</li>
					<li class="list_cat" id="nf" onclick="document.getElementById('lapi').value = 'NON-FICTION'">NON-FICTION</li>
					<li class="list_cat" id="fm" onclick="document.getElementById('lapi').value = 'FICTIONAL MYTHOLOGY'">FICTIONAL MYTHOLOGY</li>
					<li class="list_cat" id="f" onclick="document.getElementById('lapi').value = 'FANTASY'">FANTASY</li>
				</ul>
			</aside>
		</div>
		<div class="book_details_form">
			<h1>BOOK DETAILS</h1>
			<label>Image</label><br><br>
			<input type="file" id="image" name="image" accept="image/*"><br><br>
			<label>Name of book</label><br>
			<input type="" class="in" name="book_name" placeholder="Book Name" required="required" autocomplete="off"><br><br>
			<label>Price</label><br>
			<input type="" id="price" name="book_price" min="0" class="in" placeholder="Book Price" required="required" autocomplete="off"><br><br>
			<label>Author name</label><br>
			<input type="" name="book_auth" class="in" placeholder= "Author Name" required="required" autocomplete="off"><br><br>
			<label>Category</label><br>
			<input list="lists" name="book_cat" id="lapi" class="in" placeholder="Select from the list on the left" required="required" autocomplete="off">
			<datalist id="lists">
			    <option value="SCI-FI">
			    <option value="MYSTERY">
			    <option value="CHILDREN'S BOOKS">
			    <option value="AUTOBIOGRAPHY">
			    <option value="NON-FICTION">
			    <option value="FICTIONAL MYTHOLOGY">
			    <option value="FANTASY">
			</datalist><br><br>
			<label>Description</label><br>
			<textarea name="book_desc" placeholder="Book Description" required="required" style="resize: none;" autocomplete="off"></textarea><br><br>
			<label>Condition</label><br>
			<label><input type="radio" class="idk" value="New" name="condition">New</label><br>
			<label><input type="radio" class="idk" value="Almost New" name="condition">Almost New</label><br>
			<label><input type="radio" class="idk" value="Old" name="condition">Old</label><br><br>
			<button type="submit" id="book_form_submit" name="subscribe">SUBMIT</button>
		</div>
	</div>
</form>
<script type="text/javascript">
	function cn(){
		p = document.getElementById('price')
		if (p.value<0) {
			alert("YOU CANNOT ENTER NEGATIVE VALUES")
		}

	}
</script>
</body>
</html>