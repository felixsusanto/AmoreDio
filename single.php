<?php
/**
 * The template for displaying all single posts.
 *
 * @package amoredio
 */

get_header(); ?>
  <?php
    $test = new WP_Query(array('pagename'=> 'Blogs'));
    while($test->have_posts()){
      $test->the_post();
      $the_image_url = get_field('image');
    }
    include "inc/partial-header-img.php"; 
  ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">
    <div class="row">
      <div class="col-sm-8">
        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'template-parts/content', 'single' ); ?>

          <?php the_post_navigation(); ?>

          <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
          ?>

        <?php endwhile; // end of the loop. ?>
      </div>
      <!-- /.col-sm-8 -->
      <div class="col-sm-4">
        <?php get_sidebar(); ?>
      </div>
      <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
