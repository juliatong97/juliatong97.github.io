<?php
include  'ch21_include.php'; 
doDB();

//gather the topics
$get_topics_sql  = "SELECT  topic_id,  topic_title,
                    DATE_FORMAT(topic_create_time, '%b %e %Y at %r') AS fmt_topic_create_time, topic_owner FROM forum_topics ORDER BY topic_create_time DESC";
$get_topics_res  =  mysqli_query($mysqli,  $get_topics_sql)
                    or  die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topics_res) < 1) {
//there are no topics, so say so
     $display_block  =  "<p><em>No  topics  exist.</em></p>";
} else {
	
//create the display string
     $display_block = <<<END_OF_TEXT
     <table>
     <tr>
     <th>TOPIC TITLE</th>
     <th># of POSTS</th>
     </tr> 
END_OF_TEXT;

while($topic_info = mysqli_fetch_array($get_topics_res))  {
     $topic_id = $topic_info['topic_id'];
     $topic_title = stripslashes($topic_info['topic_title']);
     $topic_create_time = $topic_info['fmt_topic_create_time'];
     $topic_owner = stripslashes($topic_info['topic_owner']);

//get number of posts
     $get_num_posts_sql  =  "SELECT  COUNT(post_id)  AS  post_count  FROM forum_posts  WHERE  topic_id = '".$topic_id."'";

 $get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql)
                      or  die(mysqli_error($mysqli));

while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
       $num_posts   =   $posts_info['post_count'];

}

//add to display
     $display_block .= <<<END_OF_TEXT
     <tr>
     <td><a  href="showtopic.php?topic_id=$topic_id">
     <strong>$topic_title</strong></a><br/>
     Created  on  $topic_create_time  by  $topic_owner</td>
     <td class="num_posts_col">$num_posts</td>
     </tr> 
END_OF_TEXT;
}

//free  results 
mysqli_free_result($get_topics_res); mysqli_free_result($get_num_posts_res);

//close connection to MySQL 
mysqli_close($mysqli);

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

<title>Topics in My  Forum</title>
<style type="text/css"> table {
border: 1px solid black; 
border-collapse: collapse;

}
th {
border: 1px solid black; 
padding: 6px;
font-weight:   bold; 
background: #ccc;
}

td {
border: 1px solid black; 
padding: 6px;

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

<h1>Topics in My Forum</h1>
<?php  echo  $display_block;  ?>
</br>
<p>Would you like to <a href="addtopic.php">add a topic</a>?</p>

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
