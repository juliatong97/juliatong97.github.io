<?php
//connect to database
$mysqli = mysqli_connect("localhost", "root", "", "bobbleshop");

$display_block = "<h2>Choose a category:</h2>";

//show categories first
$get_cats_sql = "SELECT id, cat_title, cat_desc FROM
                 store_categories ORDER BY cat_title";
$get_cats_res = mysqli_query($mysqli, $get_cats_sql)
                 or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_cats_res) < 1) {
    $display_block = "<p><em>Sorry, no categories to browse.</em></p>";
 } else {
while ($cats = mysqli_fetch_array($get_cats_res)) {
     $cat_id = $cats['id'];
     $cat_title = strtoupper(stripslashes($cats['cat_title']));
     $cat_desc = stripslashes($cats['cat_desc']);

     $display_block .= "<p><strong><a href=\"".$_SERVER['PHP_SELF'].
     "?cat_id=".$cat_id."\">".$cat_title."</a></strong><br/>"
     .$cat_desc."</p>";

     if (isset($_GET['cat_id']) && ($_GET['cat_id'] == $cat_id)) {
         //create safe value for use
         $safe_cat_id = mysqli_real_escape_string($mysqli,
             $_GET['cat_id']);

     //get items
     $get_items_sql = "SELECT id, item_title, item_price
     FROM store_items WHERE cat_id = '".$cat_id."' ORDER BY item_title";
     $get_items_res = mysqli_query($mysqli, $get_items_sql)
     or die(mysqli_error($mysqli));

     if (mysqli_num_rows($get_items_res) < 1) {
     $display_block = "<p><em>Sorry, no items in this category.</em></p>";
     } else {
         $display_block .= "<ul>";
         while ($items = mysqli_fetch_array($get_items_res)) {
             $item_id = $items['id'];
             $item_title = stripslashes($items['item_title']);
             $item_price = $items['item_price'];

             $display_block .= "<li><a 
			 href=\"showitem.php?item_id=".
             $item_id."\">".$item_title."</a>
             (\$".$item_price.")</li>";
         }

         $display_block .= "</ul>";
     }
     //free results
     mysqli_free_result($get_items_res);
   }
  }
 }

 //to display all products according to each category
if(isset($_POST["page"])){
	$sql = "SELECT * FROM store_item";
	$get_item_sql = mysqli_query($mysqli,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$get_item_sql = "SELECT * FROM store_items LIMIT $start,$limit";
	$get_item_res = mysqli_query($mysqli,$get_item_sql);
	if(mysqli_num_rows($get_item_res) > 0){
		while($row = mysqli_fetch_array($get_item_res)){
			$id         = $item_info['id'];
            $cat_id     = $item_info['cat_id'];
            $cat_title  = strtoupper(stripslashes($item_info['cat_title']));
            $item_title = stripslashes($item_info['item_title']);
            $item_price = $item_info['item_price'];
            $item_desc  = stripslashes($item_info['item_desc']);
            $item_image = $item_info['item_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$item_title</div>
								<div class='panel-body'>
									<img src='images/$item_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$$item_price
									<button pid='$id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Add To Cart</button>
								</div>
							</div>
						</div>	
			";
		}
	}
}

if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM store_items WHERE cat_id = '$id'";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM store_items WHERE product_keywords LIKE '%$keyword%'";
	}
	
	$get_item_res = mysqli_query($mysqli,$sql);
	while($row=mysqli_fetch_array($get_item_res)){
			$id         = $item_info['id'];
            $cat_id     = $item_info['cat_id'];
            $cat_title  = strtoupper(stripslashes($item_info['cat_title']));
            $item_title = stripslashes($item_info['item_title']);
            $item_price = $item_info['item_price'];
            $item_desc  = stripslashes($item_info['item_desc']);
            $item_image = $item_info['item_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$item_title</div>
								<div class='panel-body'>
									<img src='images/$item_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$$item_price
									<button pid='$id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Add To Cart</button>
								</div>
							</div>
						</div>	
			";
		}
	}
	 
//free results
mysqli_free_result($get_cats_res);
//close connection to MySQL
mysqli_close($mysqli);
?>
<!doctype html>

<html>
<head>

 <title>Bobblehead</title>

   <link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
     <script src="livesearch.js"></script>
	  
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


<h1>COLLECTIONS</h1>

<div id="content">

<?php echo $display_block; ?>

     <div class="row">
	     <form method="POST" action="collection.php?item_id=<?php echo $items['$cat_id'];?>">
		     <div class="products">
			     <img src="<?php echo $items['images/$item_image'];?>" class="img-responsive" />
				 <h4 class="text-info"><?php echo $items['item_title'];?></h4>
				 <input type="hidden" name="item_title" value="<?php echo $items['$item_title'];?>" />
				 <input type="hidden" name="item_price" value="<?php echo $items['$item_price'];?>" />
				 <input type="submit" name="add_to_cart" class="btn btn-info" value="Add to Cart" />
             </div>
		 </form>
	 </div>
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
<html> 