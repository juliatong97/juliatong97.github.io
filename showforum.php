<!DOCTYPE html>
<html>
<head>

   <link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <title>Choose a Forum</title>
	 
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

<h1>Choose a Forum</h1>
<form method="post" action="catlist.php">
<p><label for="category">Choose a category:</label></br>
<?php
include  'ch21_include.php'; 
doDB();

$sql = "SELECT forum_id, forum_name FROM forum ORDER BY forum_name";
$result = mysqli_query ($mysqli, $sql);
echo "<select name=category id=forum>";
while($forum = mysqli_fetch_array($result)){
	 echo "<option value=$forum[forum_id]>$forum[forum_name]</option>";
}
echo "</select>";
mysqli_close($mysqli);
?>

<button type="submit" name="submit" value="submit">Show Topic Posts</button>
</form>
<p>Would you like to see a <a href="topiclist.php">list of all topics</a>?</p>
<p>Would you like to <a href="addtopic.php">add more topics</a>?</p>

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