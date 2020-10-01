<?php

    //====================== Get JWT token =========================================
    $hardcodedDevice = "uuid-string-1";
    $jwtUrl = "http://127.0.0.1/progress2/generateJWTtoken.php?deviceId=".$hardcodedDevice;
    $getJWTJSON = file_get_contents($jwtUrl);
    echo $getJWTJSON;
    $getJWTObject = json_decode($getJWTJSON);
    $getJWTString = $getJWTObject -> {'jwt_json'};

    // ====================== Get Book data ======================================== 
    $isbn = "0451526538";
    $bookUrlWithJWT = "http://127.0.0.1/progress2/getBook.php?isbn=".$isbn
    ."&deviceId=".$hardcodedDevice."&jwtstring=".$getJWTString;

    echo '<br/>';
    echo '<font color="blue">'.$bookUrlWithJWT. '</font>';

    $getBookInfoJSON = file_get_contents($bookUrlWithJWT);

    echo "<br />";
    echo '<font color="green">'.$getBookInfoJSON.'</font>';

    //====================== Get Movie data ========================================

    $movieTitle = "Terminator";
    $movieUrlWithJWT = "http://127.0.0.1/progress2/getMovie.php?title=".$movieTitle
    ."&deviceId=".$hardcodedDevice."&jwtstring=".$getJWTString; 

    echo '<br/>';
    echo '<font color="magenta">'. $movieUrlWithJWT. '</font>';

    $getMovieInfoJSON = file_get_contents($movieUrlWithJWT);

    echo "<br />";
    echo '<font color="red">'.$getMovieInfoJSON.'</font>';



?>