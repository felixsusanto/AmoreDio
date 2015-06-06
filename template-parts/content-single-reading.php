<?php
/**
 * @package amoredio
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    }

    $post_meta = get_post_meta(get_the_ID());
    $facil_auto_expiry_date = 7;

    $expiry_time = $post_meta['expiry'][0] ? strtotime($post_meta['expiry'][0]) : strtotime(get_the_date('Ymd')) + $facil_auto_expiry_date * 86400;
    $current_time = time();

    ?>

    <form class="form-inline" onsubmit="facil_display_check(); return false;">
      <b class="text-green">Facilitator? <?=$expiry?></b>
      <div class="form-group">
        <label class="sr-only" for="password">Password</label>
        <input type="text" class="form-control" id="password" placeholder="Enter password">
      </div>
      <button class="btn btn-primary">Submit</button>
    </form>
    <hr class="dotted">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

    <div class="entry-meta">
      <?php amoredio_posted_on(); ?>
    </div><!-- .entry-meta -->

    <script>
      var expiry_time = <?=$expiry_time?>;
      var current_time = <?=$current_time?>;
      // please wait until your Facil and cell group share / discuss this topic :)
      var pwd = '<?=$post_meta['password'][0]?>';

      function facil_display_check() {
        var display_facil = false;

        // check date
        if (current_time > expiry_time) {
          display_facil = true;
        }

        // check password
        if ($('#password').val() == pwd) {
          display_facil = true;
        }

        if (display_facil) {
          $('.facil').show();
        } else {
          $('.facil').hide();
        }
      }

      $(function() {
        facil_display_check();
      });

    </script>


  </header><!-- .entry-header -->
  <hr>
  <div class="entry-content">

    <?php the_content(); ?>
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
