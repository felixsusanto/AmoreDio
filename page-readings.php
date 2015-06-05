<?php
/**
 *Template Name: Readings Page
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
          <!-- table of content to the songbook list -->
          <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          // The Query
          $the_query = new WP_Query( array('post_type'=>'cg-reading',
                                           'posts_per_page'=> 6,
                                           'paged'=> $paged
                                          ) );

          // The Loop
          if ( $the_query->have_posts() ): while ( $the_query->have_posts() ): $the_query->the_post(); ?>
              <div class="well well-small">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <h4><?php the_field('serial_info');?></h4>
                <p><?php the_field('excerpt'); ?></p>
              </div>
            <?php 
            endwhile; 
              wp_pagenavi(array('query'=>$the_query));
            endif;?>
          <?php wp_reset_query(); ?>
        </div>
        <!-- /.span -->
      </div>
      <!-- /.row -->
      
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
