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
		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>

		<div class="entry-meta">
			<?php amoredio_posted_on(); ?>
		</div><!-- .entry-meta -->
		<hr class="dotted">
	</header><!-- .entry-header -->

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
