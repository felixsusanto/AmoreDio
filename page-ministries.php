<?php
/**
 *Template Name: Ministries Page
 *
 * @package amoredio
 */

get_header(); ?>
  <?php include "inc/partial-header-img.php" ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          
          <!-- Actual page content here -->
          <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/content', 'page' ); ?>

          <?php endwhile; // end of the loop. ?>
          <!-- table of content to the ministries list -->
          <?php

          // The Query
          $the_query = new WP_Query( array('post_type'=>'ministries',
                                           'posts_per_page'=> -1,
                                           'orderby' => 'title',
                                           'order'   => 'ASC',
                                          ) );

          // The Loop
          if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
              $the_query->the_post();
            ?>
              <div class="ministry-module">
                <div class="thumb">
                  <img src="<?php the_field('image'); ?>" alt="thumb">
                </div>
                <h3><?php the_title(); ?></h3>
                <p><?php the_content(); ?></p>
                <hr>
                <div class="contact">
                  <span><?php the_field('person_in_charge'); ?> - <?php the_field('contact_number'); ?></span>
                </div>
              </div>
            <?php
            }
            //echo '</ul>';
            ?>
            <?php
            } else {
              // no posts found
            }
            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
        </div>
      </div> <!-- /.row -->
      
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
