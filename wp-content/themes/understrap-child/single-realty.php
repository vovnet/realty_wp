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

			<?php if (have_posts()) : the_post(); ?>
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				<?php the_content(); ?>
				<ul class="list-group">
				<?php 
				$city = get_posts(array(
					'post_type' => 'cities',
					'post__in' => array($post->post_parent)
				));
				?>
				<?php if ($city) : ?>
					<li class="list-group-item"> <?php _e('Город'); ?> : <?php echo $city[0]->post_title;?> </li>
				<?php endif; ?>
				
					<li class="list-group-item"><?php _e('Площадь'); ?> : <?php echo get_post_meta(get_the_ID(), 'area', true); ?> </li>
					<li class="list-group-item"><?php _e('Адрес'); ?> : <?php echo get_post_meta(get_the_ID(), 'address', true); ?> </li>
					<li class="list-group-item"><?php _e('Цена'); ?> :  <?php echo get_post_meta(get_the_ID(), 'price', true); ?> </li>
					<li class="list-group-item"><?php _e('Жилая площадь'); ?> :  <?php echo get_post_meta(get_the_ID(), 'living_space', true); ?> </li>
					<li class="list-group-item"><?php _e('Этаж'); ?> : <?php echo get_post_meta(get_the_ID(), 'floor', true); ?> </li>
				</ul>
				<?php $img_id = get_post_meta(get_the_ID(), 'photo', true); ?>
				<li class="list-group-item"><img src="<?php echo wp_get_attachment_image_src($img_id, 'large')[0]?>" /> </li>
				
				
			<?php endif; ?>
				
			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>