<div style="background-color: orange;">


  <div id="movieTitleId"><?php echo '' . $movieObject->Title ?></div>

  <div id="posterId"><img src="<?php echo '' . $movieObject->Poster  ?>" width="200" height="200"></div>

  <div id="infoId">

    <div style=" width :50%;">
      <div style=" float: left; width : 50%; width : 25%;"><b> Year </b> </div>
      <div id="yearId" style="float: left; width : 75%;"><?php echo '' . $movieObject->Year ?> </div>
    </div>
    <br />

    <div style=" width :50%;">
      <div style=" float: left; width : 50%; width : 25%;"> <b> Genre </b> </div>
      <div id="genreId" style="float: left; width : 75%;"><?php echo '' . $movieObject->Genre ?> </div>
    </div>
    <br />


    <div style=" width :50%;">
      <div style=" float: left; width : 25%;"><b> Actors </b></div>
      <div id="actorsId" style=" float: left; width : 75%;"> <?php echo '' . $movieObject->Actors ?> </div>
    </div>
    <br />
    <div style=" width :50%;">
      <div style=" float: left; width : 25%;"><b> Country </b> </div>
      <div id="countryId" style=" float: left; width : 75%;"> <?php echo '' . $movieObject->Country ?> </div>
    </div>

    <br />
    <div> <b> movie description </b></div>
    <div> <?php echo '' . $movieObject->Plot ?> </div>

  </div>


</div>