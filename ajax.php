<?php 

	include("dbcon.php");
	$search_value = mysqli_real_escape_string($conn,$_GET["search"]);

	$qrestore = "SELECT * FROM book_list WHERE book_name LIKE '%{$search_value}%' ";
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
	 } echo "</div>";
?>