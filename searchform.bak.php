<!-- <form action="/" method="get">
  <label for="search">walaa <?php #echo home_url( '/' ); ?></label>
  <fieldset class="input-group">
    <input type="text" name="s" id="search" class="form-control" value="<?php the_search_query(); ?>" />
  </fieldset>
</form> -->
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
  <label for="s">Search for:</label>
  <div class="input-group">
    <input type="text" class="form-control" value="" placeholder="Search Site" name="s" id="s" />
    <span class="input-group-btn">
      <input class="btn btn-default" type="submit" id="sesarchsubmit" value="Search">Go!</input>
    </span>
    <!-- <input type="submit" id="searchsubmit" value="Search" /> -->
  </div>
</form>