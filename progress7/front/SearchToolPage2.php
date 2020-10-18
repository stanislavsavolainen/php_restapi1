<div>

  <div id="searchbar_book">
    <form name="form1" method="post" action="">
      <label for="selectBook"> select book by isbn </label>
      <select name="selectBook" autocomplete="off">
        <?php
        foreach ( ($cfg->bookIsbnArray) as $bookOptionElement) {

          if ($bookOptionElement != $isbn) echo '<option value="' . $bookOptionElement . '">' . $bookOptionElement . '</option>';
          else echo '<option selected value="' . $bookOptionElement . '">' . $bookOptionElement . '</option>';
          
        }
        ?>
      </select>
      <input type="submit" name="book_submit" value="Show book">
    </form>
  </div>

  <div id="searchbar_movie">
  <div> select movie from menu </div> 
    <form name="form2" method="post" action="">
      <label for="selectMovie"> select movie by title </label>
      <select name="selectMovie" autocomplete="off">
        <?php
        foreach ( ($cfg->movieTitleArray) as $movieOptionElement) {

          if ($movieOptionElement != $movieTitle) echo '<option value="' . $movieOptionElement . '">' . $movieOptionElement . '</option>';
          else  echo '<option selected value="' . $movieOptionElement . '">' . $movieOptionElement . '</option>';
        
		}
        ?>
      </select>
      <input type="submit" name="movie_submit" value="Show movie">
    </form>
  </br />
	
  <div id="searchbar_movie2">
  <div> select movie or tv series </div>
    <form name="form2" method="post" action="">
      <label for="movie_title"> title </label>
       <input type="text" name="movie_title">
       <br />
        <label for="movie_year"> year </label>
       <input type="text" name="movie_year">	
        <!--<input type="text" name="movie_plot"> -->
        <select name="movie_plot"> 
            <option> none </option> 
            <option value = "short"> short </option>
            <option value = "full" > full </option>
        </select> 
       <br />
      <input type="submit" name="movie_submit2" value="Show movie or tv series">
    </form>	
  </div>

</div>

<br /> <br />
