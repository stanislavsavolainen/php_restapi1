
<html>

	<head>
	  <style type="text/css">
		<?php include "./front/frontend_styles.css";   ?>
		</style>
		<title> PHP-RestApi client by Stanislav Savolainen</title>
	</head>

	<body id="mainpage">

	<?php

 	$movieTitle = "Hackers";
	$isbn = "0451526538";

  //include "MyConfigurationData.php"; -> replaced to ConfigClass

  require "./config/ConfigClass.php";
  $cfg = new ConfigClass();

  //================================================================================

  if (isset($_POST['movie_submit'])) {

    $movieTitle = $_POST['selectMovie'];
    setcookie("savedMovie", $movieTitle);

    if (isset($_COOKIE["savedBook"])) {
      $isbn = $_COOKIE["savedBook"];
    }
  } else {
    if (!isset($_COOKIE["savedMovie"])) $movieTitle = "Hackers";
  }

  if (isset($_POST['book_submit'])) {

    $isbn = $_POST['selectBook'];
    setcookie("savedBook", $isbn);

    if (isset($_COOKIE["savedMovie"])) {
      $movieTitle = $_COOKIE["savedMovie"];
    }
  } else {
    if (!isset($_COOKIE["savedBook"])) $isbn = "0451526538";
  }

  //==== init connection link and deviceId (avoid hardcoded style) ===============

  $hardcodedDevice = "uuid-string-1";

  if (!isset($_COOKIE["deviceId"])) {
    setcookie("deviceId", "uuid-string-1");
  }
  
  //========  Check if cookies are disabled and deviceId is not initialized ========
           
  if(  ( strlen($_COOKIE["deviceId"]) == 0 ) ) {
   header("Refresh:0");
  } else {
    if( !isset($_COOKIE["deviceId"]) ) {    
       echo '<br />';
       echo '<font color="red"><h1> Your cookies are disabled, you cannot use this service ! </h1></font>';
       echo '<br />';
     }      
    }   
   			
  //echo $_COOKIE["deviceId"];

  //====================== Get JWT token =========================================

  $jwtUrl =  ($cfg->myProjectHost) . "/getJWT?deviceId=" . $_COOKIE["deviceId"]  //$hardcodedDevice;
  $getJWTJSON = file_get_contents($jwtUrl);

  $getJWTObject = json_decode($getJWTJSON);

  $getJWTString = $getJWTObject->{'jwt_json'};

  // ====================== Get Book data ======================================== 

  $bookUrlWithJWT = ($cfg->myProjectHost) . "/getBook?isbn=" . $isbn
    . "&deviceId=" . $_COOKIE["deviceId"] . "&jwtstring=" . $getJWTString;


  $getBookInfoJSON = file_get_contents($bookUrlWithJWT);


  //====================== Get Movie data ========================================

  $movieUrlWithJWT = ($cfg->myProjectHost) . "/getMovie?title=" . $movieTitle
  . "&deviceId=" . $_COOKIE["deviceId"]; 
 
    if (isset($_POST['movie_submit2'])) {  
      
		if (isset($_POST['movie_title'])  ) {    
  			$movieUrlWithJWT .= "&title=".$_POST['movie_title'];
		}
      
		if (isset($_POST['movie_year'])  ) {
			if( is_numeric ( $_POST['movie_year']  ) ) $movieUrlWithJWT .= "&year=".$_POST['movie_year'];
		}

		if (isset($_POST['movie_plot'])  ) {   
  			$movieUrlWithJWT .= "&plot=".$_POST['movie_plot'];
		}	

    } 

  $movieUrlWithJWT .= "&jwtstring=" . $getJWTString;
  
  $getMovieInfoJSON = file_get_contents($movieUrlWithJWT);

  //===============================================================================

  echo '<a href="'.$bookUrlWithJWT.'"> book link </a>';
  echo '<br />';
  echo '<a href="'.$movieUrlWithJWT.'"> movie link </a>';

  $bookObject = (object) json_decode($getBookInfoJSON);
  $movieObject = (object) json_decode($getMovieInfoJSON);

  /*
    echo "<br />";
    echo "-------------------------- php book object ----------------------";
    echo "<br />";
    var_dump($bookObject);
    echo "<br />";
    echo "-----------------------------------------------------------------";

    echo "<br />";
    echo "-------------------------- php movie object ----------------------";
    echo "<br />";
    var_dump($movieObject);
    echo "<br />";
    echo "-----------------------------------------------------------------";
    echo "<br />";
    echo "<br />"; 
  */

  if (property_exists($bookObject, 'error_msg')) {

    //inform client by error_msg , if data can't be displayed
    echo '<font color="red"><h1>' . $bookObject->error_msg . '</h1></font>';
  
  } else {

    // =============================== book and movie search tools ================================ 

    //echo '<div></div>';
    include "./front/SearchToolPage2.php";

    // =============================== book frontend code ======================================== 
    //  include "BookPage.php";
    echo "<table><tr><td class='book_frame'> ";

    include "./front/BookPage.php";
    //=============================== movie frontend code ======================================= 
    //  include "MoviePage.php";
    echo "</td> <td class='movie_frame'>";
    include "./front/MoviePage.php";
    echo "</td> </tr></table>";
  }

	?>

	</body>
</html>
