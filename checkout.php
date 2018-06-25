<?php
session_start();

//connect to database
$subtotal = 0;
$total_qty = 0;

$mysqli  =  mysqli_connect("localhost",  "root",  "",  "bobbleshop");

$display_block  =  "<h4>Your Shopping Cart</h4>";

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
     <th>Item</th>
     <th>Size</th>
     <th>Color</th>
     <th>Price</th>
     <th>Quantity</th>
     <th>Total Price</th>
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
	 $total_qty += $item_qty;
	 
	 
				   
     $display_block .= <<<END_OF_TEXT
     <tr>
     <td>$item_title <br></td>
     <td>$item_size <br></td>
     <td>$item_color <br></td>
     <td>\$$item_price <br></td>
     <td>$item_qty <br></td>	
     <td>\$$total_price</td>
     </tr> 
END_OF_TEXT;
}
     $display_block .= "<tr>
	 <th colspan='4'>Subtotal</th>
	 <td>$total_qty</td>
	 <td>$$subtotal.00</td>
	 </tr>
	 </table>";
}


$fname = $email = $address = $phone = $city = $state = $zip = "";
$formvalidate = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$fname = ($_POST['fname']);
		$email = ($_POST['email']);
		$address = ($_POST['address']);
		$phone = ($_POST['phone']);
		$city = ($_POST['city']);
		$state = ($_POST['state']);
		$zip = ($_POST['zip']);
		$getdetails_sql = "INSERT INTO store_orders (order_name, order_email, order_address, order_tel, order_city, order_state, order_zip) VALUES ('$fname', '$email', '$address', '$phone', '$city', '$state', '$zip')";
		
		if ($formvalidate = true) {
			$getdetails_res = mysqli_query($mysqli, $getdetails_sql)
                   or  die(mysqli_error($mysqli));

			header("Location: completion.php");
		}
		
}


//free  result 
mysqli_free_result($get_cart_res);
//close connection to MySQL
mysqli_close($mysqli);


?>
<!DOCTYPE html>
<html>
<head>

<title>Checkout - Bobbleshop</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
  text-decoration: none;
}

table {
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

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  width: 800px;
}

.container td {
	 text-align: center;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<nav id="nav-menu">
     <ul>
	     <li><a href="about-us.html">About Us</a></li>
		 <li><a href="custom-made.html">Custom Made</a></li>
		 <li><a href="collections.php">Collections</a></li>
		 <li><a class="current-page" href="contact-us.php">Contact Us</a></li>
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

<h2>Checkout</h2>

<div class="row">
  <div class="col-25">
    <div class="container">
      <h4><span class="price" style="color:black"><i class="fa fa-shopping-cart"></i><b><?php echo $total_qty; ?></b></span></h4>
      <?php  echo  $display_block;  ?>
	  
    </div>
  </div>
  <div class="col-75">
    <div class="container">
      <form action="checkout.php" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i>Full Name</label>
            <input type="text" id="fname" name="fname" required>
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" required>
            <label for="address"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="address" name="address" required>
			<label for="phone"><i class="fa fa-phone"></i> Phone Number</label>
            <input type="text" id="phone" name="phone" required>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" required>

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" required>
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" required>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" class="btn" value="Continue to checkout">
      </form>
    </div>
  </div>

</div>

</div>

<footer>
<ul>
	<li>All rights reserved. &copy; Bobbleshop 2018</li>	
	<li><a href="legals.html">Legals</a></li>
	<li>Site By webmaster</li>
	<li>Follow the Bobblehead makers --></li>
	<li><a href="facebook.com"><img src="images/facebook.png" width="16" height="16" alt="Facebook"></a> <a href="twitter.com"><img src="images/twitter.png" width="16" height="16" alt="Twitter"></a> <a href="instagram.com"><img src="images/instagram.png" width="16" height="16" alt="Instagram"></a></li>
</ul>

</footer>
</div>
</div>
</body>
</html>