<?php
/**
 *Template Name: Event Page
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
            $highlight_post_id = array();
            $args_event = array('post_type'=>'event', 'showposts'=> 1);
            $event = new WP_Query($args_event);
            if ($event) {
              foreach ($event as $post) {
                $highlight_post_id[] = $post->ID;
              }
            }
          ?>
          
          <?php if (get_query_var('paged') <= 1) : ?>
          <div class="upcoming-event">
            <h2 class="text-center text-red"><i class="fa fa-bullhorn"></i> Upcoming Event</h2>
            <?php
              if ($event->have_posts()): while($event->have_posts()): $event->the_post();
            ?>
              <?php if(get_field('poster_image')): ?>
                <div class="featured-img">
                  <img src="<?php the_field('poster_image'); ?>" class="img-responsive img-thumbnail center-block" alt="">
                </div>
              <?php endif;?>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <div class="well">
                    <h4>Event Details</h4>
                    <dl>
                      <dt>Venue</dt>
                      <dd><?php the_field('venue'); ?></dd>
                      <dt>Date</dt>
                      <dd>
                        <?php 
                        $date = DateTime::createFromFormat('Ymd', get_field('date'));
                        echo $date->format('l, d F Y');
                        ?>
                      </dd>
                      <dt>Time</dt>
                      <dd><?php the_field('time'); ?></dd>
                      <?php if(get_field('contact')):?>
                        <dt>Contact</dt>
                        <dd><?php the_field('contact'); ?></dd>
                      <?php endif;?>
                    </dl>
                  </div>
                </div><!-- /.span -->
                <div class="col-md-8">
                  <h3><?php the_title(); ?></h3>
                  <p><?php the_field('event_description'); ?></p>
                </div><!-- /.span -->
              </div><!-- /.row -->
            <?php endwhile; endif; wp_reset_query(); ?>  
          
          </div><!-- /.upcoming-event -->
          <?php endif; ?>


          <div class="previous-event">
            <h2 class="text-center text-red"><i class="fa fa-bullhorn"></i> Previous Event</h2>
            <?php
              // First, initialize how many posts to render per page
              $display_count = 2;
              // Next, get the current page
              $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
              // use post not in to exclude the highlighted post
              $args_pastevent = array('post_type'=>'event', 'post__not_in'=>$highlight_post_id, 'posts_per_page'=> $display_count, 'paged'=> $paged );
              $pastevent = new WP_Query($args_pastevent);
              if($pastevent->have_posts()): while($pastevent->have_posts()): $pastevent->the_post();
            ?>
            <div class="past-event-module">
              <h3><?php the_title(); ?></h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="thumb" style="background-image:url('<?php the_field("poster_image")?>')"></div>
                  
                  <h4>Event Details</h4>
                  <dl class="well">
                    <dt>Venue</dt>
                    <dd><?php the_field('venue'); ?></dd>
                    <dt>Date</dt>
                    <dd>
                      <?php 
                      $date = DateTime::createFromFormat('Ymd', get_field('date'));
                      echo $date->format('l, d F Y');
                      ?>
                    </dd>
                    <dt>Time</dt>
                    <dd><?php the_field('time'); ?></dd>
                    <?php if(get_field('contact')):?>
                      <dt>Contact</dt>
                      <dd><?php the_field('contact'); ?></dd>
                    <?php endif;?>
                  </dl>
                </div>
                <div class="col-md-6">
                  <h4>About the event</h4>
                  <?php the_field('event_description'); ?>
                </div>
              </div>
            </div><!-- /.past-event-module -->
              
            <?php endwhile; wp_pagenavi(array('query'=>$pastevent)); ?>

            <?php elseif ($paged > 1): // redirect to main event page if overshoot the pagination / empty event?>
              <script>
                var str = window.location.href;
                str = str.substr(0, str.lastIndexOf("page/"));
                window.location = str;
              </script>

            <?php endif; wp_reset_query(); ?>
          </div> <!-- /.previous-event -->
        </div>
        <!-- /.span -->
      </div>
      <!-- /.row -->
      
    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
