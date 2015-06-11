<?php
/**
 * @package amoredio
 */
$expired = false;
$revealed = "";
if(get_field('expiry')){

  $expiry = DateTime::createFromFormat('Ymd', get_field('expiry'));
  $expiry_dateformat = $expiry->format('d-m-Y');
  $expiry_timestamp = strtotime($expiry_dateformat);

  if(time() > $expiry_timestamp){
    //"the post is expired!";
    $expired = true;
  }
} else {
  //Expiry date not defined!
  $published_date = date_create(get_the_date('Y-m-d'));
  //Add 7 days from the published date
  date_add($published_date, date_interval_create_from_date_string('7 days'));
  $expiry_dateformat = date_format($published_date, 'd-m-Y');
  $expiry_timestamp = strtotime($expiry_dateformat);

  if(time() > $expiry_timestamp){
    //"the post is expired!";
    $expired = true;
  }
}

if($expired){$revealed = "revealed";}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="wrapper-revealer clearfix <?php echo $revealed ?>" data-password="<?php the_field('password'); ?>">
    <header class="entry-header">
      <?php
        if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb('<p id="breadcrumbs">','</p>');
        }
      ?>
      <?php if(get_field("facilitator_function")): ?>
      <form class="form-inline facil-box" onsubmit="facil_display_check(); return false;">
        <b class="text-green">Facilitator?</b>
        <div class="form-group facil-password has-feedback">
          <label class="sr-only" for="password">Password</label>
          <input type="text" class="form-control has-error" id="password" placeholder="Enter password">
          <span class="error-only fa fa-times form-control-feedback" aria-hidden="true"></span>
          <span id="inputError2Status" class="sr-only">(error)</span>
        </div>
        <button class="btn btn-primary">Submit</button>
      </form> 
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-bullhorn"></i> Jawaban untuk fasil akan ditampilkan
      </div>
      <hr class="dotted">
      <?php endif; ?>
      <?php if(get_field("serial_info")):?>
        <h2 class="h3 serial_info"><?php the_field("serial_info")?></h2>
      <?php endif;?>
      <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
    
      <div class="entry-meta">
        <?php amoredio_posted_on(); ?>
      </div><!-- .entry-meta -->
    
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
  </div>

  <footer class="entry-footer">
    <?php amoredio_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
