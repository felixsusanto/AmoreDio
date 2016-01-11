<?php
/**
 *Template Name: Welcome Page
 *
 *
 * @package amoredio
 */

get_header(); ?>


  <div class="carousel">
    <div class="logo">
      <img src="<?php echo get_template_directory_uri();?>/assets/img/logo-01.png" alt="logo of Amore Dio">
    </div>
    <div id="owl-carousel" class="">
    <?php
      $args = array('post_type'=>'carousel', 
                    'posts_per_page'=> -1, 
                    'orderby' => 'title',
                    'order'   => 'ASC');
      $carousel = new WP_Query($args);
      if($carousel->have_posts()): while($carousel->have_posts()): $carousel->the_post();
    ?>
      <div class="carousel--height" style="background-image:url('<?php the_field("background_image")?>')">
        <blockquote>
          <p><?php the_field('quotes'); ?> </p>
          <footer><cite><?php the_field('source_title'); ?></cite></footer>
        </blockquote>
      </div>
    <?php endwhile; ?>
    <?php endif; wp_reset_query(); ?>
    </div><!-- /.loop -->
    <div class="tooth"></div>
  </div><!-- /.carousel -->

  <div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">
      <div class="row">
        <div class="col-sm-8">

          <?php if ( have_posts() ) : ?>
            <div class="jumbotron">
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <p><?php the_content(); ?></p>
                <p class="text-right">
                   <a href="<?php echo get_permalink( 14 ) ?>" class="btn btn-lg btn-primary">Find out more...</a>
                </p>
            <?php endwhile; ?>
            </div>
          <?php endif; wp_reset_query(); ?>

          <div class="prayer-intention">
            <h2 class="text-center text-red">Prayer Intention of&nbsp;the&nbsp;Month</h2>
            <?php
              $args_pray = array('post_type'=>'prayer', 'showposts'=> 1);
              $prayer = new WP_Query($args_pray);
              if ($prayer->have_posts()): while($prayer->have_posts()): $prayer->the_post();
            ?>
              <h4 class="text-center"><?php the_title();?></h4>
              <div class="content"><?php the_content(); ?></div>
            <?php endwhile;?>
            <?php endif; wp_reset_query(); ?>
          </div><!-- /.prayer-intention -->

          <hr class="dotted">

          <div class="upcoming-event">
            <h2 class="text-center text-red"><i class="fa fa-bullhorn"></i> 
              <?php
                $last_event_id = wp_get_recent_posts(array('post_type'=>'event', 'showposts'=> 1))[0]['ID'];
                $event_date = DateTime::createFromFormat('Ymd', get_field('date', $last_event_id));
                $event_dateformat = $event_date->format('d-m-Y');
                $event_date_timestamp = strtotime($event_dateformat);

                if(time() > $event_date_timestamp){
                  echo "Latest Event";
                } else {
                  echo "Upcoming Event";
                }
              ?>
            </h2>
            <?php
              $args_event = array('post_type'=>'event', 'showposts'=> 1);
              $event = new WP_Query($args_event);
              if ($event->have_posts()): while($event->have_posts()): $event->the_post();
            ?>
              <div class="featured-img">
                <img src="<?php the_field('poster_image'); ?>" class="img-responsive img-thumbnail center-block" alt="">
              </div>
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
                        <?php if( get_field('to_date') ): ?>
                          <br><b>to</b><br>
                          <?php
                            $toDate = DateTime::createFromFormat('Ymd', get_field('to_date'));
                            echo $toDate->format('l, d F Y');
                          ?>
                        <?php endif; ?>
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
          
          <hr class="dotted">

          <div class="latest-updates">
            <h2 class="text-center text-red"><i class="fa fa-newspaper-o"></i> Latest Updates / News</h2>
              <?php
                $args_reading = array('post_type'=>'cg-reading', 'showposts'=> 1);
                $reading = new WP_Query($args_reading);
                if($reading->have_posts()):while($reading->have_posts()):$reading->the_post();
              ?>
                <div class="well recent-readings">
                  <h3 class="heading-title">Latest Cell Group Readings</h3>
                  <h4><?php the_title(); ?></h4>
                  <p class="text-green"><?php the_field('serial_info'); ?></p>
                  <p>
                    <?php the_field('excerpt'); ?>
                  </p>
                  <p class="text-right"><a href="<?php the_permalink(); ?>">See More <i class="fa fa-chevron-circle-right"></i></a></p>
                </div>
              <?php endwhile; endif; wp_reset_query();?>

            
              <?php
                $args_post = array('post-type'=>'post', 'showposts'=> 1);
                $blogpost = new WP_Query($args_post);
                if($blogpost->have_posts()):while($blogpost->have_posts()):$blogpost->the_post();
              ?>
                <div class="well recent-article">
                  <h3 class="heading-title">Recent Article</h3>
                  <div class="recent-article-li">
                    <h4><?php the_title(); ?></h4>
                    <p><?php the_excerpt(); ?></p>
                    <p class="text-right">
                      <a href="<?php the_permalink();?>">See More <i class="fa fa-chevron-circle-right"></i></a>
                    </p>
                  </div><!-- /.recent-article -->
                </div> 
              <?php endwhile; endif; wp_reset_query();?>
                           
            
          </div>

        </div> <!-- /.span -->

        <div class="col-sm-4">
          <?php get_sidebar(); ?>
        </div> <!-- /.span -->

      </div> <!-- /.row -->
    
    </main><!-- #main -->

  </div><!-- #primary -->


<?php get_footer(); ?>
