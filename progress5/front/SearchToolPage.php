<div>

  <div id="searchbar_book">
	
    <form name="form1" method="post" action="">

      <label for="selectBook"> select book by isbn </label>
      <select name="selectBook" autocomplete="off">
        <?php
        foreach ( ($cfg->bookIsbnArray) as $bookOptionElement) {

          if ($bookOptionElement != $isbn) echo '<option value="' . $bookOptionElement . '">' . $bookOptionElement . '</option>';
          else {
            echo '<option selected value="' . $bookOptionElement . '">' . $bookOptionElement . '</option>';
          }
        }
        ?>
      </select>

      <!-- <input type="text" name="txbook"><br> -->
      <input type="hidden" name="savemovievaluewithbookchange" value="<?php echo $movieTitle; ?>">
      <input type="submit" name="book_submit" value="Show book">

    </form>

  </div>

  <div id="searchbar_movie">
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

      <!--  <input type="text" name="txmovie"><br> -->
      <input type="hidden" name="savebookvaluewithmoviechange" value="<?php echo $isbn; ?>">
      <input type="submit" name="movie_submit" value="Show movie">


    </form>

  </div>

</div>

<br /> <br />
