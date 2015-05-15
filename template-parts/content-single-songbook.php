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

    <?php if( get_field('youtube_video') ): ?>
      <div class="embed-responsive embed-responsive-16by9">
        <iframe width="420" height="315" src="https://www.youtube.com/embed/<?php the_field('youtube_video'); ?>" frameborder="0" allowfullscreen></iframe>
      </div>
    <?php endif; ?>

    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

    <div class="entry-meta">
      <?php amoredio_posted_on(); ?>
    </div><!-- .entry-meta -->
    <div class="row">
      <div class="col-sm-6">
        <b>Artist:</b> 
        <?php
          $string = '';
          $terms = get_the_terms($post->ID, 'artists');
          foreach ($terms as $taxindex => $taxitem) {
            $string .= $taxitem->name . ', ';
          }
          echo substr($string, 0, -2);
        ?>
      </div>
      <!-- /.col-sm-6 -->
      <div class="col-sm-6">
        <b>Category:</b> 
        <?php
          $string = '';
          $terms = get_the_terms($post->ID, 'song-type');
          foreach ($terms as $taxindex => $taxitem) {
            $string .= $taxitem->name . ', ';
          }
          echo substr($string, 0, -2);
        ?>
      </div>
      <!-- /.col-sm-6 -->
    </div>
    <!-- /.row -->
    <hr>
  </header><!-- .entry-header -->

  <div class="entry-content">

    <pre data-key="<?php the_field('basic_chord'); ?>">
      <?php the_field('chords'); ?>
    </pre>
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
