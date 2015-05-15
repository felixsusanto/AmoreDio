<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package amoredio
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <!-- <a class="skip-link screen-reader-text" href="#content"><?php #esc_html_e( 'Skip to content', 'amoredio' ); ?></a> -->

  <header id="masthead" class="site-header" role="banner">
    <!-- <div class="site-branding">
      <h1 class="site-title"><a href="<?php #echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php #bloginfo( 'name' ); ?></a></h1>
      <h2 class="site-description"><?php #bloginfo( 'description' ); ?></h2>
    </div> --><!-- .site-branding -->
    
    <!-- <nav id="site-navigation" class="main-navigation" role="navigation">
      <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php #esc_html_e( 'Primary Menu', 'amoredio' ); ?></button>
      <?php #wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav> --><!-- #site-navigation -->
    <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-align-justify"></span>
          </button>
          <a class="navbar-brand visible-xs" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-navigation">
          <?php /* Primary navigation */
          wp_nav_menu( array(
            'theme_location' => 'primary', 
            'menu_id' => 'primary-menu',
            'menu' => 'top_menu',
            'depth' => 2,
            'container' => false,
            'menu_class' => 'nav navbar-nav',
            //Process nav menu using our custom nav walker
            'walker' => new wp_bootstrap_navwalker())
          );
          ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header><!-- #masthead -->

  <div id="content" class="site-content">
