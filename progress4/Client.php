<?php

$movieTitle = "Hackers";
$isbn = "0451526538";


include "MyConfigurationData.php";


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

//echo $_COOKIE["deviceId"];

//====================== Get JWT token =========================================

$jwtUrl = $myProjectHost . "/getJWT?deviceId=" . $hardcodedDevice;
$getJWTJSON = file_get_contents($jwtUrl);

$getJWTObject = json_decode($getJWTJSON);

$getJWTString = $getJWTObject->{'jwt_json'};

// ====================== Get Book data ======================================== 

$bookUrlWithJWT = $myProjectHost . "/getBook?isbn=" . $isbn
  . "&deviceId=" . $_COOKIE["deviceId"] . "&jwtstring=" . $getJWTString;

$getBookInfoJSON = file_get_contents($bookUrlWithJWT);

//====================== Get Movie data ========================================

$movieUrlWithJWT = $myProjectHost . "/getMovie.php?title=" . $movieTitle
  . "&deviceId=" . $_COOKIE["deviceId"] . "&jwtstring=" . $getJWTString; 

$getMovieInfoJSON = file_get_contents($movieUrlWithJWT);

//===============================================================================

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


  include "SearchToolPage.php";

  // =============================== book frontend code ======================================== 

  include "BookPage.php";

  //=============================== movie frontend code ======================================= 

  include "MoviePage.php";
}

?>
