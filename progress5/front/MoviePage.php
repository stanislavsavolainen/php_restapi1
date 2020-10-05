<div>


  <div id="movieTitleId"><b><?php echo '' . $movieObject->Title ?></b></div>
  
  <div id="posterId"><img src="<?php 
       if( property_exists($movieObject, 'Poster') && ( $movieObject->Poster ) != "N/A" ) echo '' . $movieObject->Poster;
       else echo "./front/placeholder.png";  
    ?>" width="200" height="200"></div>

  <br />

  <div id="infoId">
    <div class="movie_info_block">
      <div class="movie_sub_title"><b> Year </b> </div>
      <div class="movie_sub_value" id="yearId"><?php echo '' . $movieObject->Year ?> </div>
    </div>
    <br />

    <div class="movie_info_block">
      <div class="movie_sub_title"> <b> Genre </b> </div>
      <div class="movie_sub_value" id="genreId"><?php echo '' . $movieObject->Genre ?> </div>
    </div>
    <br />


    <div class="movie_info_block">
      <div class="movie_sub_title"><b> Actors </b></div>
      <div class="movie_sub_value" id="actorsId"> <?php echo '' . $movieObject->Actors ?> </div>
    </div>
    <br /><br />
    <div class="movie_info_block">
      <div class="movie_sub_title"><b> Country </b> </div>
      <div class="movie_sub_value" id="countryId"> <?php echo '' . $movieObject->Country ?> </div>
    </div>
    <br />
    <br />
    <br />
    <div class="movie_info_block">
        <div> <b> movie description </b></div>
        <div> <?php echo '' . $movieObject->Plot ?> </div>
    </div>
  </div>

</div>
