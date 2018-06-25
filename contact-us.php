<!doctype html>

<html>
<head>

 <title>Contact Us - Bobbleshop</title>

   <link rel="stylesheet" href="bobblehead.css">
   
   <link href='https://fonts.googleapis.com/css?family=Bowlby One SC' rel='stylesheet'>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
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


<h1>CONTACT US</h1>


<div id="content">


<section id="col1">

<h2>Contact the Bobbleshop makers!</h2>

<p>If you have any enquiries, please do not hesitate to contact us and send your enquiries using this form. Here are our contact details.</p>

</br>

<?php
class Enquiry {

    public function addEnquiry() {
        $this->firstname = $_POST['firstname'];
		$this->lastname = $_POST['lastname'];
    }
}

$enquiry = new Enquiry();
echo $_POST['firstname'];
echo $_POST['lastname'];

?>

<div class="contact-container">
  <form action="/action_page.php" method="POST">
    <label for="firstName">First Name</label>
    <input type="text" id="firstName" name="firstname" placeholder="Your first name..">

    <label for="lastName">Last Name</label>
    <input type="text" id="lastName" name="lastname" placeholder="Your last name..">

    <label for="state">State</label>
    <select id="state" name="state">
      <option value="nsw">NSW</option>
      <option value="vic">Victoria</option>
      <option value="qld">Queensland</option>
    </select>

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">
  </form>
</div>

</section>

<section id="col2">

<h2>Contact Details</h2>

     <p><strong>Address: 2 Short St, Chatswood NSW 2067</strong></p>
     <p><strong>Phone: 1200 360 601</strong></p>
     <p><strong>Email: <a href="mailto:info@bobbleshop.com.au">info@bobbleshop.com.au</a></strong></p>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3316.0082749108537!2d151.19448841570116!3d-33.786284480679186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12a9231df2d611%3A0x710e961cfea9e6bb!2sBobbleheads+Australia!5e0!3m2!1sen!2sau!4v1527083754421" width="500" height="425" frameborder="0" style="border:0" allowfullscreen></iframe>

</section>

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
<html> 