<?php 
session_start();

//connect to database

$mysqli  =  mysqli_connect("localhost",  "root",  "",  "bobbleshop");
				  
$get_cart_sql = "SELECT  st.id, st.sel_item_id,  si.item_title,  si.item_price, 
                 st.sel_item_qty, st.sel_item_size,  st.sel_item_color, si.item_qty FROM 
				 store_shoppertrack AS st LEFT JOIN store_items AS si ON 
                 si.id = st.sel_item_id WHERE session_id = 
				 '".$_COOKIE['PHPSESSID']."'";
$get_cart_res =  mysqli_query($mysqli,  $get_cart_sql)
                 or  die(mysqli_error($mysqli));			 

				 
while ($get_cart_sql = mysqli_fetch_array($get_cart_res)) {
       $id = $get_cart_sql['sel_item_id'];
	   $updateqty = $get_cart_sql['item_qty'] - $get_cart_sql['sel_item_qty']; 
	   $updatestock_sql = "UPDATE store_items SET item_qty = $updateqty WHERE id = $id";
	   $updatestock_res = mysqli_query($mysqli, $updatestock_sql)
                  or  die(mysqli_error($mysqli));
  }
  
  
// then delete everything, this shoud go after all the above statements

$deletecart_sql = "DELETE FROM store_shoppertrack";
$deletecart_res = mysqli_query($mysqli, $deletecart_sql)
                  or  die(mysqli_error($mysqli));	
?>
<!DOCTYPE html>
<html>
<head>

<title>Thank you for shopping with us!</title>

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

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  width: 800px;
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
<h2>Thank you for purchasing at Bobbleshop Collections!</h2>

  <div class="container">
	
	<p>Your purchase successfully has been processed!</p>
	
	<p>We are looking forward to seeing you purchase more items here at Bobbleshop.</p>
	
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