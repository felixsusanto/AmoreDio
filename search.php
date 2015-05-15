<?php
/**
 * The template for displaying search results pages.
 *
 * @package amoredio
 */

get_header(); ?>

  <section id="primary" class="content-area">
    <main id="main" class="site-main container search-result" role="main">
    <div class="row">
      <div class="col-sm-8">
        <?php if ( have_posts() ) : ?>

          <header class="page-header">
            <h3 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'amoredio' ), '<span class="text-primary">"' . get_search_query() . '"</span>' ); ?></h3>
          </header><!-- .page-header -->

          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>

            <?php
            /**
             * Run the loop for the search to output the results.
             * If you want to overload this in a child theme then include a file
             * called content-search.php and that will be used instead.
             */
            get_template_part( 'template-parts/content', 'search' );
            ?>

          <?php endwhile; ?>

          <?php the_posts_navigation(); ?>

        <?php else : ?>

          <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>
      </div>
      <!-- /.col-sm-8 -->
      <div class="col-sm-4">
        <?php get_sidebar(); ?>
      </div>
      <!-- /.com-sm-4 -->
    </div>
    <!-- /.row -->
    </main><!-- #main -->
  </section><!-- #primary -->


<?php get_footer(); ?>
