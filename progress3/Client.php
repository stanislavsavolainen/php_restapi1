<?php

  require 'MovieClass.php';
  $movieModel = new MovieClass();

   require 'BookClass.php';
   $bookModel = new BookClass();


   $movieTitle = "Hackers";
   $isbn = "0451526538";


    include "MyConfigurationData.php";


    //================================================

      if(isset($_POST['movie_submit'])) { 

        $movieTitle = $_POST['selectMovie'];

      } else {
        $movieTitle = "Hackers";
      } 

      if(isset($_POST['book_submit'])) { 
        $isbn = $_POST['selectBook'];

      } else {
        $isbn = "0451526538";
      } 


    // echo "<br/><font color='red'>". $movieTitle."</font>";
    // echo "<br/><font color='red'>". $isbn."</font>";

    //====================== Get JWT token =========================================
    $hardcodedDevice = "uuid-string-1";
    $jwtUrl = $myProjectHost."/generateJWTtoken.php?deviceId=".$hardcodedDevice;
    $getJWTJSON = file_get_contents($jwtUrl);
   // echo $getJWTJSON;
    $getJWTObject = json_decode($getJWTJSON);
    $getJWTString = $getJWTObject -> {'jwt_json'};

    // ====================== Get Book data ======================================== 
    
    $bookUrlWithJWT = $myProjectHost."/getBook.php?isbn=".$isbn
    ."&deviceId=".$hardcodedDevice."&jwtstring=".$getJWTString;

    //echo '<br/>';
    //echo '<font color="blue">'.$bookUrlWithJWT. '</font>';

    $getBookInfoJSON = file_get_contents($bookUrlWithJWT);

   // echo "<br />";
   // echo '<font color="green">'.$getBookInfoJSON.'</font>';

    //====================== Get Movie data ========================================

    
    $movieUrlWithJWT = $myProjectHost."/getMovie.php?title=".$movieTitle
    ."&deviceId=".$hardcodedDevice."&jwtstring=".$getJWTString; 

   // echo '<br/>';
   // echo '<font color="magenta">'. $movieUrlWithJWT. '</font>';

    $getMovieInfoJSON = file_get_contents($movieUrlWithJWT);

  //  echo "<br />";
  //  echo '<font color="red">'.$getMovieInfoJSON.'</font>';

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
//echo $movieObject['Title'];
 //echo $bookObject->bib_key;
// echo $movieObject->Title;
/*
 $bookModel->setBibKey($bookObject->bib_key );
 $bookModel->setPreview($bookObject->preview );
 $bookModel->setThumbnailUrl($bookObject->thumbnail_url);
 $bookModel->setPreviewUrl($bookObject->preview_url);
 $bookModel->setInfoUrl($bookObject->info_url);
*/

/*
$bookModel->__set("bib_key" ,  $bookObject->bib_key);
$bookModel->__set("preview" ,  $bookObject->preview);
$bookModel->__set("thumbnail_url" ,  $bookObject->thumbnail_url);
$bookModel->__set("preview_url" ,  $bookObject->preview_url);
$bookModel->__set("info_url" ,  $bookObject->info_url);
*/
//$bookModel->bib_key=$bookObject->bib_key;
//$bookModel->preview=$bookObject->preview;

//echo "<br /><br />";
//echo "Book bib-key : <font color='red'>".$bookObject->preview ."</font>";
//echo "<br /><br />";
//echo "Book super-getter : <font color='green'>".$bookModel->bib_key."</font>";

//$movieModel->setTitle($movieObject->Title);
//$movieModel->setYear($movieObject->Year);

//echo "Book bib-key : <font color='blue'>".$movieModel->getTitle()."</font>";


//echo "<br/><br/></br>";

//php for action self


?>


<!-- https://html.form.guide/php-form/php-form-action-self/   -->


<!-- =============================== book and movie search tools ================================ -->

<div style = "background-color: red;">
  
  <div style=" float: left; background-color: red;">

    <form name="form1" method="post" action="" >

      <label for="selectBook"> select book by isbn </label>
      <select name="selectBook"> 
        <?php
          foreach ( $bookIsbnArray as $bookOptionElement ) {
            echo '<option value="'.$bookOptionElement.'">'.$bookOptionElement.'</option>';
          }  
        ?>
      </select>

    <!-- <input type="text" name="txbook"><br> -->
      <input type="submit" name="book_submit" value="Show book"><br>

  </form>

</div>

<div style=" float: left; background-color: green;">
<form name="form2" method="post" action="">
<label for="selectMovie"> select movie by title </label>
<select name="selectMovie"> 
<?php
      foreach ( $movieTitleArray as $movieOptionElement ) {

        if( $movieOptionElement != "Hackers" ) echo '<option value="'.$movieOptionElement .'">'.$movieOptionElement.'</option>';
        else echo '<option selected value="'.$movieOptionElement .'">'.$movieOptionElement.'</option>';

        }  
    ?>
</select>

<!--  <input type="text" name="txmovie"><br> -->
  <input type="submit" name="movie_submit" value="Show movie"><br>


</form>

</div>

</div>
<br /> <br />

<!-- =============================== book frontend code ======================================== -->

<div style = "background-color: silver;">
<br />
  <b>Book isbn number </b> <div id="bookISBNid"><?php echo ''.$bookObject->bib_key ?></div>
  <b>preview </b> <div id="previewid"><?php echo ''.$bookObject->preview ?></div>
  <b> preview url </b> <div id="bookPreviewUrl"> <?php echo ''.$bookObject->preview_url ?> </div>
  <b> info url </b> <div id="bookInfoUrl"> <?php echo ''.$bookObject->info_url ?> </div>
  <img src="<?php echo ''.$bookObject->thumbnail_url  ?>" width="200" height="200"></div>

</div>

<!-- =============================== movie frontend code ======================================= -->

<div style = "background-color: orange;">


  <div id="movieTitleId"><?php echo ''.$movieObject->Title ?></div>

<div id="posterId"><img src="<?php echo ''. $movieObject->Poster  ?>" width="200" height="200"></div>

<div id="infoId">
 
  <div style=" width :50%;">
    <div style=" float: left; width : 50%; width : 25%;"><b> Year </b> </div> 
    <div id="yearId" style="float: left; width : 75%;"><?php echo ''.$movieObject->Year ?> </div> 
  </div>
  <br />

  <div style=" width :50%;">
    <div style=" float: left; width : 50%; width : 25%;"> <b> Genre </b> </div> 
    <div id="genreId" style="float: left; width : 75%;"><?php echo ''.$movieObject->Genre ?> </div> 
  </div>
  <br />


  <div style=" width :50%;">
    <div style=" float: left; width : 25%;"><b> Actors </b></div> 
    <div id="actorsId" style=" float: left; width : 75%;"> <?php echo ''.$movieObject->Actors ?> </div>
  </div>
  <br />
  <div style=" width :50%;">
    <div style=" float: left; width : 25%;" ><b> Country </b> </div> 
    <div id="countryId" style=" float: left; width : 75%;"> <?php echo ''.$movieObject->Country ?> </div> 
  </div>

  <br />
<div> <b> movie description  </b></div>
<div> <?php echo ''.$movieObject->Plot ?> </div>

</div>


</div>

