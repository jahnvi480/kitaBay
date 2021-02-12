<?php 
    include("dbcon.php");
    if(isset($_POST['sd'])){
        $sn = $_POST['sel_n'];
        $se = $_POST['sel_em'];
        $spn = $_POST['sel_pn'];
        $sa = $_POST['sel_add'];
        $query1 = "SELECT * FROM seller_details WHERE seller_email = '$_SESSION[email]'";
        if(mysqli_num_rows(mysqli_query($conn, $query1))>0){
            $q = "UPDATE seller_details SET seller_phone = '$spn', seller_add = '$sa' WHERE seller_email = '$_SESSION[email]'";
            $q_run = mysqli_query($conn, $q);
            header("location: book_detail_form.php");
        }
        else {
            $query = "INSERT INTO seller_details(seller_name , seller_email , seller_phone , seller_add) VALUES ('$sn' , '$se' , '$spn' ,'$sa')";
            $query_run = mysqli_query($conn,$query);    
            echo "<script> alert('Your information is stored successfully') </script>";
            header("location: book_detail_form.php");
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Seller Details | KitaBay</title>
    <link rel="icon" href="images/small_logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="seller_details.css">
</head>
<body>
    <div class="form"> 
    <div style="width: 48%;" class="image"><img src="images/sellerimg.jpg" width="72%" style="margin-left: 15%"></div>
        <div class="seller_form"> 
                <form method="POST"  action="seller_details.php">
                    <h1>Seller Details</h1><br>
                    <label class="labeling" for="b_name">Name:</label>
                    <input required="required" id="firstname" type="text" value="<?php echo $_SESSION['username'] ?>" placeholder="First Name" class="in" name="sel_n">
                    <br/><br/>

                    <label class="labeling" for="price">Email:</label>
                    <input required="required" id="email" type="text"  value="<?php echo $_SESSION['email'] ?>" placeholder="Email" class="in" name="sel_em">
                    <br/><br/>
                    
                    <label class="labeling" for="Author">Phone Number:</label>
                    <input required="required" id="number" type="text"  placeholder="Phone Number" class="in" name="sel_pn" autocomplete="off" >
                    <br/><br/>

                    <label class="labeling" for="Author">Address:</label>
                    <textarea required="required" id="address" type="text"  placeholder="Address" style="resize: none;" name="sel_add" autocomplete="off"></textarea>
                    <br/><br/>

                    <button type="submit" id="book_form_submit" name="sd">SUBMIT</button>
                </form>
            </div>
    </div>
</body>
</html>