<?php
  if( get_field('image')){
    $the_image_url = get_field('image');
  }
?>
<div class="logo-page-bg cover" style="background-image:url(<?php echo $the_image_url; ?>);">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-01.png" alt="AmoreDio logo">
</div>
<div class="tooth"></div>