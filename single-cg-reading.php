<?php
/**
 * The template for displaying single post of songbook.
 *
 * @package amoredio
 */

get_header(); ?>
  <?php
    $test = new WP_Query(array('pagename'=> 'CG Readings'));
    while($test->have_posts()){
      $test->the_post();
      $the_image_url = get_field('image');
    }
    include "inc/partial-header-img.php"; 
  ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'template-parts/content', 'single-reading' ); ?>

          <?php the_post_navigation( array('screen_reader_text' => __( 'Navigate Songbook' ))); ?>

          <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
          ?>

        <?php endwhile; // end of the loop. ?>
      </div>
      <!-- /.span -->
    </div>
    <!-- /.row -->
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
