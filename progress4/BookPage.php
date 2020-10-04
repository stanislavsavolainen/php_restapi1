<div style="background-color: silver;">
  <br />
  <b>Book isbn number </b>
  <div id="bookISBNid"><?php echo '' . $bookObject->bib_key ?></div>
  <b>preview </b>
  <div id="previewid"><?php echo '' . $bookObject->preview ?></div>
  <b> preview url </b>
  <div id="bookPreviewUrl"> <?php echo '' . $bookObject->preview_url ?> </div>
  <b> info url </b>
  <div id="bookInfoUrl"> <?php echo '' . $bookObject->info_url ?> </div>
  <img src="<?php echo '' . $bookObject->thumbnail_url  ?>" width="200" height="200">
</div>

</div>
