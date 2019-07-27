<?php

defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
global $post;
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

			<?php if (have_posts()) : the_post() ?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<header class="entry-header">

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">

						<?php understrap_posted_on(); ?>

					</div><!-- .entry-meta -->

				</header><!-- .entry-header -->

				<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

				<div class="entry-content">

					<?php the_content(); ?>

					<?php
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
							'after'  => '</div>',
						)
					);
					?>

				</div><!-- .entry-content -->

				<footer class="entry-footer">

					<?php understrap_entry_footer(); ?>

				</footer><!-- .entry-footer -->

			</article><!-- #post-## -->
			<?php endif; ?>
				
			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->


		<?php 
			$realties = get_children(array(
				'post_parent' => get_the_ID(),
				'post_type' => 'realty',
				'posts_per_page' => 10
			));
		?>

		<?php foreach ($realties as $post) : setup_postdata($post)?>
			<div class="card mb-3" style="max-width: 540px;">
			  <div class="row no-gutters">
			    <div class="col-md-4">
			      	<?php $img_id = get_post_meta(get_the_ID(), 'photo', true); ?>
					<img src="<?php echo wp_get_attachment_image_src($img_id)[0]; ?>" class="card-img-top">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <?php the_title(sprintf( '<h5 class="card-title"><a href="%s"  el="bookmark">', esc_url( get_permalink() ) ),'</a></h5>'); ?>
			        <p class="card-text"><?php the_content(); ?></p>
			        <?php 
						$city = get_posts(array(
							'post_type' => 'cities',
							'post__in' => array($post->post_parent)
						));
					?>
					<?php if ($city) : ?>
						<p><small class="text-muted"> <?php _e('Город'); ?> : <?php echo $city[0]->post_title;?> </small></p>
					<?php endif; ?>
			      </div>
			    </div>
			  </div>
			</div>

		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>