<?php
/**
 *Template Name: Contact Page
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

            <!-- added auto load certain tabs based on the anchor url -->
            <script>
              var contact_y = 300;
              var url = document.location.toString();
              if (url.match('#')) {
                  $(window).scroll(contact_y); // go up to show Contact nicely
                  document.body.scrollTop=contact_y;
                  $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
              }

              // Change hash for page-reload
              $('.nav-tabs a').on('shown.bs.tab', function (e) {
                  e.preventDefault();
                  if(history.pushState) {
                    history.pushState(null, null, e.target.hash);
                  }
                  else {
                    window.location.hash = '#myhash';
                  }
              })
            </script>

          <?php endwhile; // end of the loop. ?>
        </div>
        <!-- /.span -->
      </div>
      <!-- /.row -->
      
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
