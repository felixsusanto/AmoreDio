<?php
/**
 * @package amoredio
 */
?>

<style>
  .error-only {
    display: none;
  }
  .has-error .error-only {
    display: block;
  }
</style>

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

    <form class="form-inline facil-box" onsubmit="facil_display_check(); return false;">
      <b class="text-green">Facilitator? <?=$expiry?></b>
      <div class="form-group facil-password has-feedback">
        <label class="sr-only" for="password">Password</label>
        <input type="text" class="form-control has-error" id="password" placeholder="Enter password">
        <span class="error-only glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
        <span id="inputError2Status" class="sr-only">(error)</span>
      </div>
      <button class="btn btn-primary">Submit</button>
    </form>
    <div class="facil"> Jawaban untuk fasil akan ditampilkan</div>

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
        if ($('#password').val().toLowerCase() == pwd.toLowerCase()) {
          display_facil = true;
        } else if($('#password').val()) {
          $('.facil-password').addClass('has-error');
        }

        if (display_facil) {
          $('.facil').show('slow');
          $('.facil-box').hide('slow');
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
