<?php
include  'ch21_include.php'; doDB();

//check for required info from the query string 
if (!isset($_GET['topic_id']))  {
header("Location: topiclist.php"); 
exit;
}

//create safe values for use
$safe_topic_id   =   mysqli_real_escape_string($mysqli,   $_GET['topic_id']);

//verify the topic exists
$verify_topic_sql = "SELECT topic_title FROM forum_topics
WHERE  topic_id =  '".$safe_topic_id."'";
$verify_topic_res   =      mysqli_query($mysqli,   $verify_topic_sql)
or  die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) {
//this topic does not exist
$display_block = "<p><em>You have selected an invalid topic.<br/> Please  <a  
href=\"topiclist.php\">try  again</a>.</em></p>";
} else {
//get the topic title
while  ($topic_info  =  mysqli_fetch_array($verify_topic_res))  {
$topic_title    =    stripslashes($topic_info['topic_title']);
}

//gather the posts
$get_posts_sql  =  "SELECT  post_id,  post_text, DATE_FORMAT(post_create_time,
'%b   %e   %Y<br/>%r')   AS   fmt_post_create_time,   post_owner FROM forum_posts
WHERE  topic_id  =   '".$safe_topic_id."' ORDER BY post_create_time ASC";
$get_posts_res   =   mysqli_query($mysqli,   $get_posts_sql)
or  die(mysqli_error($mysqli));

//create the display string
$display_block  =  <<<END_OF_TEXT
<p>Showing posts for the <strong>$topic_title</strong> topic:</p>
<table>
<tr>
<th>AUTHOR</th>
<th>POST</th>
</tr> 
END_OF_TEXT;

while ($posts_info = mysqli_fetch_array($get_posts_res)) {
$post_id    =    $posts_info['post_id'];
$post_text      =      nl2br(stripslashes($posts_info['post_text']));
$post_create_time     =     $posts_info['fmt_post_create_time'];
$post_owner     =     stripslashes($posts_info['post_owner']);

//add to display
$display_block .= <<<END_OF_TEXT
<tr>
<td>$post_owner<br/><br/>
created  on:<br/>$post_create_time</td>
<td>$post_text<br/><br/>
<a      href="replytopost.php?post_id=$post_id">
<strong>REPLY    TO    POST</strong></a></td>
</tr> 
END_OF_TEXT;
}

//free  results mysqli_free_result($get_posts_res); mysqli_free_result($verify_topic_res);

//close connection to MySQL mysqli_close($mysqli);

//close up the table
$display_block .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>

   <link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Posts in Topic</title>
<style type="text/css"> table {
border: 1px solid black; border-collapse: collapse;
}
th {
border: 1px solid black; padding: 6px;
font-weight:   bold; background: #ccc;
}
td {
border: 1px solid black; padding: 6px;
vertical-align: top;
}
.num_posts_col { text-align: center; }
</style>
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

<h1>Posts in Topic</h1>
<?php  echo  $display_block;?>

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


