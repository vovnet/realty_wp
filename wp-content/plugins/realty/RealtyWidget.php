<?php
/**
 * Виджет для вывода списка городов.
 */
class RealtyWidget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'realty_widget',
			'description' => 'Выводит список городов.',
		);
		parent::__construct( 'realty_widget', 'City Widget', $widget_ops );
	}

	public function widget($args, $instance) {
		$cities = get_posts(array(
			'post_type' => 'cities',
			'posts_per_page' => -1
		));

		global $post;
		?>

		<h2><?php _e('Города'); ?></h2>
		<ul>
			<?php foreach ($cities as $post) : setup_postdata($post) ?>
				<li><a href="<?php the_permalink($post); ?>"><?php the_title(); ?></a> </li>
			<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
		</ul>

		<?php
	}
}