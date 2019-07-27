<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php 
					global $post;
					$realties = get_posts(array(
						'post_type' => 'realty',
						'posts_per_page' => 3,
						'orderby' => 'date',
						'order' => 'DESC'
					));
				?>

				<?php if ( $realties ) : ?>

					<div class="card-group">

					<?php foreach($realties as $post) : setup_postdata($post); ?>

						  <div class="card">
						  	<?php $img_id = get_post_meta(get_the_ID(), 'photo', true); ?>
						    <img src="<?php echo wp_get_attachment_image_src($img_id)[0]; ?>" class="card-img-top">
						    <div class="card-body">
						      <?php the_title(sprintf( '<h5 class="card-title"><a href="%s"  el="bookmark">', esc_url( get_permalink() ) ),'</a></h5>'); ?>
						      <p><small class="text-muted"><?php _e('Площадь'); ?> : <?php echo get_post_meta(get_the_ID(), 'area', true); ?></small></p>
						      <p><small class="text-muted"><?php _e('Адрес'); ?> : <?php echo get_post_meta(get_the_ID(), 'address', true); ?></small></p>
						      <p><small class="text-muted"><?php _e('Цена'); ?> :  <?php echo get_post_meta(get_the_ID(), 'price', true); ?></small></p>
						      <p><small class="text-muted"><?php _e('Жилая площадь'); ?> :  <?php echo get_post_meta(get_the_ID(), 'living_space', true); ?></small></p>
						      <p><small class="text-muted"><?php _e('Этаж'); ?> : <?php echo get_post_meta(get_the_ID(), 'floor', true); ?></small></p>
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

					<?php endforeach; ?>
					<?php wp_reset_postdata() ?>

					</div>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

				<!-- Ajax форма для добавления недвижимости -->
				<?php if (is_user_logged_in()) : ?>

					<?php
						$cities = get_posts(array(
							'post_type' => 'cities',
							'posts_per_page' => -1,
							'order_by' => 'post_title'
						));
					?>

					<div id="new_realty">
						<h2><?php _e('Подать новое объявление'); ?></h2>
						<form enctype="multipart/form-data" id="new_realty_form" method="post">
							<div class="form-group">
							    <label for="title"><?php _e('Заголовок'); ?></label>
							    <input type="text" class="form-control" id="title" name="title">

							    <label for="description"><?php _e('Описание'); ?></label>
							    <textarea  type="text" class="form-control" rows="3" id="description" name="description"></textarea>

							    <label for="area"><?php _e('Площадь'); ?></label>
							    <input type="text" class="form-control" id="area" name="area">

							    <label for="address"><?php _e('Адрес'); ?></label>
							    <input type="text" class="form-control" id="address" name="address">

							    <label for="price"><?php _e('Цена'); ?></label>
							    <input type="text" class="form-control" id="price" name="price">

							    <label for="living_space"><?php _e('Жилая площадь'); ?></label>
							    <input type="text" class="form-control" id="living_space" name="living_space">

							    <label for="floor"><?php _e('Этаж'); ?></label>
							    <input type="text" class="form-control" id="floor" name="floor">

							    <label for="city"><?php _e('Город'); ?></label>
							    <select class="custom-select" id="city" name="city">
	  							<option selected value="-1"><?php _e('Выберите город'); ?></option>
							    <?php foreach ($cities as $city) : ?> 
							    	<option value="<?php echo $city->ID; ?>"><?php echo $city->post_title; ?></option>
							    <?php endforeach; ?>
							    </select>
						  	</div>

							<input id="realty_btn" type="submit" class="btn btn-primary" name="new_realty_btn">
						</form>
					</div>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>
