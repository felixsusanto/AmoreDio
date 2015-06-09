<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package amoredio
 */

get_header(); ?>
  <?php include "inc/partial-header-img.php"; ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">
      <div class="row">
        <div class="col-sm-8">
          <?php if ( function_exists('yoast_breadcrumb') ) {
              yoast_breadcrumb('<p id="breadcrumbs">','</p>');
            } ?>
          <?php if ( have_posts() ) : ?>

            <header class="page-header">
              <?php
                the_archive_title( '<h1 class="h3 page-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
              ?>
            </header><!-- .page-header -->

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

              <?php
                /* Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_format() );
              ?>

            <?php endwhile; ?>

            <?php the_posts_navigation(); ?>

          <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

          <?php endif; ?>
        </div><!-- /.span -->
        <div class="col-sm-4">
          <?php get_sidebar('blog'); ?>
        </div><!-- /.span -->
      </div><!-- /.row -->
    

    </main><!-- #main -->
  </div><!-- #primary -->


<?php get_footer(); ?>
