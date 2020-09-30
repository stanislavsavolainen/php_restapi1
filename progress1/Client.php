<?php

// php language not used at the moment, javascript ajax call php rest-api

// in progress3 folder plan to develop nice "PHP client" follow OOP - pattern  

?>

<script type="text/javascript">


	function ajaxCall(url , responseField) {

		console.log("try to ajax with url :" + url + " and response :" + responseField);

    		var xmlhttp = new XMLHttpRequest();
    		xmlhttp.onreadystatechange = function() {
      		if (this.readyState == 4 && this.status == 200) {
        		document.getElementById(responseField).innerHTML = this.responseText;
      		}
    	};
    	xmlhttp.open("GET", url, true);
    	xmlhttp.send();
  
}


	function init(){
		console.log("body on load");

		ajaxCall("http://127.0.0.1/progress1/getBook.php?isbn=0451526538" , "book1");
		ajaxCall("http://127.0.0.1/progress1/getMovie.php?title=Terminator" , "movie1");
	}


</script>

<html>
	<body onload="init()">

	<br /> Movie1 response : <div id="movie1"  ></div>
	<br /> Book 1 response : <div id="book1" ></div>
	
	</body>
</html>
