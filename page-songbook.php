<?php
/**
 *Template Name: Songbook Page
 *
 * @package amoredio
 */

get_header(); ?>
  <div class="logo-page-bg cover" style="background-image:url(<?php the_field('image'); ?>);">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-01.png" alt="AmoreDio logo">
  </div>
  <div class="tooth"></div>

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

          // The Query
          $the_query = new WP_Query( array('post_type'=>'songbook',
                                           'posts_per_page'=> -1
                                          ) );

          // The Loop
          if ( $the_query->have_posts() ) {
            //echo '<ul>';
            ?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Category</th>
                  </tr>
                </thead>
                <tbody>
            <?php
            while ( $the_query->have_posts() ) {
              $the_query->the_post();
              //echo '<li>' . get_the_title() . '</li>';
            ?>
              <tr>
                <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                <td>
                  <?php
                    $string = '';
                    $terms = get_the_terms($post->ID, 'artists');
                    foreach ($terms as $taxindex => $taxitem) {
                      $string .= $taxitem->name . ', ';
                    }
                    echo substr($string, 0, -2);
                  ?>
                </td>
                <td>
                  <?php
                    $string = '';
                    $terms = get_the_terms($post->ID, 'song-type');
                    foreach ($terms as $taxindex => $taxitem) {
                      $string .= $taxitem->name . ', ';
                    }
                    echo substr($string, 0, -2);
                  ?>
                </td>
              </tr>
            <?php
            }
            //echo '</ul>';
            ?>
                </tbody>
              </table>
            <?php
          } else {
            // no posts found
          }
          /* Restore original Post Data */
          wp_reset_postdata();
          ?>
        </div> <!-- /.span -->
      </div>
      <!-- /.row -->
      
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
