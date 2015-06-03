<?php
/**
 *Template Name: Gallery Page
 *
 *
 * @package amoredio
 */

get_header(); ?>


  <?php include "inc/partial-header-img.php" ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">
      <div class="row">
        <div class="col-sm-12">
          
          <!-- Actual page content here -->
          <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/content', 'page' ); ?>

          <?php endwhile; // end of the loop. ?>
          <!-- table of content to the ministries list -->

        </div>
      </div> <!-- /.row -->
      
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
