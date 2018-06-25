<?php
session_start();

//connect to database
$subtotal = 0;

$mysqli  =  mysqli_connect("localhost",  "root",  "",  "bobbleshop");

$display_block  =  "<h1>Your Shopping Cart</h1>";

//check for cart items based on user session id
$get_cart_sql = "SELECT  st.id,  si.item_title,  si.item_price, 
                 st.sel_item_qty, st.sel_item_size,  st.sel_item_color  FROM 
				 store_shoppertrack AS st LEFT JOIN store_items AS si ON 
                 si.id = st.sel_item_id WHERE session_id = 
				 '".$_COOKIE['PHPSESSID']."'";
$get_cart_res =  mysqli_query($mysqli,  $get_cart_sql)
                 or  die(mysqli_error($mysqli));

if (mysqli_num_rows($get_cart_res) < 1) {
     //print message
     $display_block .= "<p>You have no items in your cart. 
	 Please <a href=\"collections.php\">continue to shop</a>!</p>";
} else {
   //get info and build cart display
     $display_block .= <<<END_OF_TEXT
     <table>
     <tr>
     <th>Title</th>
     <th>Size</th>
     <th>Color</th>
     <th>Price</th>
     <th>Qty</th>
     <th>Total Price</th>
     <th>Subtotal</th>
	 <th>Action</th>
     </tr>

END_OF_TEXT;

     while ($cart_info  =  mysqli_fetch_array($get_cart_res))  {
     $id = $cart_info['id'];
     $item_title = stripslashes($cart_info['item_title']);
     $item_price = $cart_info['item_price'];
     $item_qty = $cart_info['sel_item_qty'];
     $item_color = $cart_info['sel_item_color'];
     $item_size = $cart_info['sel_item_size'];
     $total_price = sprintf("%.02f", $item_price * $item_qty);
	 $subtotal += $total_price;

     $display_block .= <<<END_OF_TEXT
     <tr>
     <td>$item_title <br></td>
     <td>$item_size <br></td>
     <td>$item_color <br></td>
     <td>\$$item_price <br></td>
     <td>$item_qty <br></td>
     <td>\$$total_price</td>
	 <td>$$subtotal</td>
     <td><a href="removefromcart.php?id=$id">remove</a></td>
     </tr> 
END_OF_TEXT;
}
     $display_block .= "</table>";

}
//free  result 
mysqli_free_result($get_cart_res);
//close connection to MySQL
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Store</title>

<link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
      <script src="livesearch.js"></script>

<style type="text/css"> table {
border: 1px solid black; border-collapse: collapse;
}
th {
border: 1px solid black; padding: 6px;
font-weight:  bold; background: #ccc; text-align:   center;

}
td {
border: 1px solid black; padding: 6px;
vertical-align: top; text-align: center;
}
</style>
</head>
<body>

<nav id="nav-menu">
     <ul>
	     <li><a href="about-us.html">About Us</a></li>
		 <li><a href="custom-made.html">Custom Made</a></li>
		 <li><a class="current-page" href="collections.html">Collections</a></li>
		 <li><a href="contact-us.php">Contact Us</a></li>
		 <div class="searchbar">
		 <form>
		   <input type="text" class="search" onkeyup="showResult(this.value)" placeholder="Search...">
		   <button type="submit"><i class="fa fa-search"></i></button>
		   <div id="searchbar"></div>
		 </form>
		 <div>
	 </ul>
</nav>

<header>
<a href="index.html"><img src="images/bobbleshop-logo2.png" width="700" height="150" alt="Bobblehead Site"></a>
</header>



<div id="wrapper">
<div id="innerwrapper">

<div id="content">
<?php  echo  $display_block;  ?>

<p>Continue shopping for items <a href="collections.php">here.</a>

<p>Finished? Proceed to <a href="checkout.php">checkout.</a>

</div>

<footer>
<ul>
	<li>All rights reserved. &copy; Bobbleshop 2018</li>	
	<li><a href="legals.html">Legals</a></li>
	<li>Site By webmaster</li>
	<li>Follow the Bobblehead makers --></li>
	<li><img src="images/facebook.png" width="16" height="16" alt="Facebook"> <img src="images/twitter.png" width="16" height="16" alt="Twitter"> <img src="images/instagram.png" width="16" height="16" alt="Instagram"></li>
</ul>

</footer>
</div>
</div>
</body>
</html>

