<?php
/**
 * @package amoredio
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    } ?>

    <form class="form-inline">
      <b class="text-green">Facilitator?</b>
      <div class="form-group">
        <label class="sr-only" for="password">Password</label>
        <input type="text" class="form-control" id="password" placeholder="Enter password">
      </div>
      <button class="btn btn-primary">Submit</button>
    </form>
    <hr class="dotted">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

    <div class="entry-meta">
      <?php amoredio_posted_on(); ?>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
  <hr>
  <div class="entry-content">

    <?php the_content(); ?>
    <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'amoredio' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php amoredio_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
