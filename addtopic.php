<!DOCTYPE html>

<html>

<head>

   <link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   

     <title>Add  a  Topic</title>
	
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

<h1>Add  a  Topic</h1>
<form method="post" action="do_addtopic.php">

<p><label for="category">Choose a category:</label></br>
<?php
include  'ch21_include.php'; 
doDB();

$sql = "SELECT forum_id, forum_name FROM forum ORDER BY forum_id";
$result = mysqli_query ($mysqli, $sql);
echo "<select name=category id=forum>";

while($forum=mysqli_fetch_array($result)){
	 echo "<option value=$forum[forum_id]>$forum[forum_name]</option>";
}
echo "</select>";
mysqli_close($mysqli);
?>

<p><label for="topic_owner">Your Email Address:</label><br/>
<input type="email" id="topic_owner" name="topic_owner" size="40" maxlength="150"  
required="required"  /></p>

<p><label  for="topic_title">Topic  Title:</label><br/>
<input  type="text"  id="topic_title"  name="topic_title"  size="40" maxlength="150" 
required="required" /></p>
<p><label for="post_text">Post Text:</label><br/>
<textarea id="post_text" name="post_text" rows="8" cols="40" ></textarea></p>

<button  type="submit"  name="submit"  value="submit">Add  Topic</button>

</form>

</div>

<footer>
<ul>
	<li>All rights reserved. &copy; Bobbleshop 2018</li>	
	<li><a href="legals.html">Legals</a></li>
	<li>Site By webmaster</li>
	<li>Follow the Bobblehead makers --></li>
	<li><a href="facebook.com"><img src="images/facebook.png" width="16" height="16" alt="Facebook"></a> <a href="twitter.com"><img src="images/twitter.png" width="16" height="16" alt="Twitter"></a> <a href="instagram.com"><img src="images/instagram.png" width="16" height="16" alt="Instagram"></a></li>
</ul>

</div>
</div>
</body>
</html>
