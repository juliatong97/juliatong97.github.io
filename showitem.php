<?php
session_start();
//connect to database
$mysqli  =  mysqli_connect("localhost",  "root",  "",  "bobbleshop");

$display_block = "<h1>My Store - Item Detail</h1>";

//create safe values for use
$safe_item_id  =  mysqli_real_escape_string($mysqli,  $_GET['item_id']);

//validate item
$get_item_sql = "SELECT  c.id as cat_id, c.cat_title, si.item_title, 
                 si.item_price, si.item_desc, si.item_image FROM store_items 
                 AS si LEFT JOIN store_categories AS c on c.id = si.cat_id 
                 WHERE  si.id =  '".$safe_item_id."'";
$get_item_res =  mysqli_query($mysqli,   $get_item_sql)
                 or  die(mysqli_error($mysqli));

if (mysqli_num_rows($get_item_res) < 1) {
     //invalid item
     $display_block .= "<p><em>Invalid item selection.</em></p>";
} else {
     //valid item, get info
     while ($item_info = mysqli_fetch_array($get_item_res)) {
         $cat_id   =   $item_info['cat_id'];
         $cat_title     =     strtoupper(stripslashes($item_info['cat_title']));
         $item_title    =    stripslashes($item_info['item_title']);
         $item_price    =    $item_info['item_price'];
         $item_desc     =      stripslashes($item_info['item_desc']);
         $item_image    =     $item_info['item_image'];
     }

     //make breadcrumb trail & display of item
     $display_block .= <<<END_OF_TEXT
     <p><em>You are viewing:</em><br/>
     <strong><a href="collections.php?cat_id=$cat_id">$cat_title</a> &gt;
      $item_title</strong></p>
     <div  style="float:  left;"><img src="images/$item_image"  alt="$item_title" width="50%"
      /></div>
     <div style="float: left; padding-left: 12px">
     <p><strong>Description:</strong><br/>$item_desc</p>
     <p><strong>Price:</strong>\$$item_price</p> 
	 <form method="post" action="addtocart.php">
END_OF_TEXT;

     //free  result 
	 mysqli_free_result($get_item_res);

     //get colors
     $get_colors_sql = "SELECT item_color FROM store_item_color WHERE 
	                    item_id  =  '".$safe_item_id."' ORDER  BY  item_color";
     $get_colors_res =  mysqli_query($mysqli,  $get_colors_sql)
                        or  die(mysqli_error($mysqli));

if (mysqli_num_rows($get_colors_res) > 0) {
     $display_block .= "<p><label for=\"sel_item_color\">
	 Available Colors:</label><br/>
	 <select id=\"sel_item_color\" name=\"sel_item_color\">"; 
	 
     while ($colors = mysqli_fetch_array($get_colors_res)) {
             $item_color = $colors['item_color'];
             $display_block .= "<option value=\"".$item_color."\">".
			 $item_color."</option>";
     }
	 $display_block .= "</select>";
}

//free  result 
  mysqli_free_result($get_colors_res);

//get sizes
   $get_sizes_sql = "SELECT item_size FROM store_item_size WHERE 
                     item_id  =  '".$safe_item_id."'  ORDER BY  item_size";
   $get_sizes_res =  mysqli_query($mysqli, $get_sizes_sql)
                     or  die(mysqli_error($mysqli));

if (mysqli_num_rows($get_sizes_res) > 0) {
     $display_block .= "<p><label for=\"sel_item_size\">
	 Available Sizes:</label><br/>"; 
	 "<select id=\"sel_item_size\" name=\"sel_item_size\">";
	 
	 while ($sizes = mysqli_fetch_array($get_sizes_res)) {
             $item_size   =   $sizes['item_size'];
             $display_block .= "<option value=\"".$item_size."\">".
			 $item_size."</option>";
         }
   }

  $display_block .= "</select></p>";

//free  result 
  mysqli_free_result($get_sizes_res);

  $display_block .= "<p><label for=\"sel_item_qty\">Select Quantity:</label>
  <select id=\"sel_item_qty\" name=\"sel_item_qty\">";
  
  for($i=1; $i<11; $i++) {
	  $display_block .= "<option value=\"".$i."\">".$i."</option>";
   }
   
   $display_block .= <<<END_OF_TEXT
   </select></p>
   <input type="hidden" name="sel_item_id"
   value="$_GET[item_id]"/>
   <button type="submit" name="submit" value="submit">
   Add to Cart</button>
   </form>
   </div>
END_OF_TEXT;
}

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
   
<style type="text/css">
   label {font-weight: bold;}
</style>
</head>
<body>

<nav id="nav-menu">
     <ul>
	     <li><a href="about-us.html">About Us</a></li>
		 <li><a href="custom-made.html">Custom Made</a></li>
		 <li><a class="current-page" href="collections.html">Collections</a></li>
		 <li><a href="contact-us.html">Contact Us</a></li>
		 <div class="searchbar">
		 <form>
		   <input type="text" class="search" onkeyup="showResult(this.value)" placeholder="Search...">
		   <button type="submit"><i class="fa fa-search"></i></button>
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