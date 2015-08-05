function showSession() {
  var search = document.getElementById("search").value;
  console.log(search);

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("session-content").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","search.php?keyword="+search,true);
  xmlhttp.send();
}