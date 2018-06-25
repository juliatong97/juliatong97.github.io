function showResult(str) {
  if (str.length==0) { 
    document.getElementById("searchbar").innerHTML="";
    document.getElementById("searchbar").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("searchbar").innerHTML=this.responseText;
      document.getElementById("searchbar").style.border="1px solid #A5ACB2";
	  document.getElementById("searchbar").style.color="#A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}