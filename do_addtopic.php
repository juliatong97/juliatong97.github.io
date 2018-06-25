<?php
include  'ch21_include.php'; doDB();

//check for required fields from the form
if ((!$_POST['topic_owner']) || (!$_POST['topic_title']) ||
(!$_POST['post_text'])) { 
     header("Location: addtopic.html"); 
	 exit;
}

//create safe values for input into the database
$clean_category    = mysqli_real_escape_string($mysqli, $_POST['category']);
$clean_topic_owner = mysqli_real_escape_string($mysqli, $_POST['topic_owner']);
$clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['topic_title']);
$clean_post_text   = mysqli_real_escape_string($mysqli, $_POST['post_text']);

//create and issue the first query
$add_topic_sql   =   "INSERT   INTO   forum_topics
(forum_id, topic_title, topic_create_time, topic_owner) VALUES ('".$clean_category."', '".$clean_topic_title ."', now(), '".$clean_topic_owner."')";

$add_topic_res   =   mysqli_query($mysqli,   $add_topic_sql)
or  die(mysqli_error($mysqli));

//get the id of the last query
$topic_id   =   mysqli_insert_id($mysqli);

//create and issue the second query
$add_post_sql  =  "INSERT  INTO  forum_posts
(forum_id, topic_id, post_text, post_create_time, post_owner) VALUES ('".$clean_category."', '".$topic_id."', '".$clean_post_text."', now(), '".$clean_topic_owner."')";

$add_post_res  =  mysqli_query($mysqli,  $add_post_sql)
or  die(mysqli_error($mysqli));
//close connection to MySQL mysqli_close($mysqli);

//create nice message for user
$display_block =   "<p>The  <strong>".$_POST["topic_title"]."</strong> topic  has  been  
created.</p>";
?>
<!DOCTYPE html>
<html>
<head>
<title>New  Topic  Added</title>

   <link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav id="nav-menu">
     <ul>
	     <li><a href="about-us.html">About Us</a></li>
		 <li><a href="custom-made.html">Custom Made</a></li>
		 <li><a href="collections.html">Collections</a></li>
		 <li><a href="contact-us.html">Contact Us</a></li>
		 <div class="searchbar">
		   <form>		        
		     <input type="text" class="search" placeholder="Search...">
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

<h1>New Topic Added</h1>
<?php  echo  $display_block;  ?>

<p>Would you like to see all <a href="showforum.php">Forums</a> again?</p>
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

