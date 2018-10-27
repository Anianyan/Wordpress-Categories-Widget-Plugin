<?php
/**
 * List_Categories_Widget Class
 */
class List_Categories_Widget extends WP_Widget {
	function __construct() {
		parent::__construct( 'list_categories_widget',
                            __( 'Categories and Posts', 'list_categories_widget' ),
                            array( 'description' => esc_html__( 'Display categories list and corresponding Posts', 'list_categories_widget' ))
        );
	}

	/**
	 * Outputs the content of the widget
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		$list_category_HTML = '<div id="list-categories-widget" class="content">';
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		$args_val           = array( 'hide_empty' => true );
		$terms              = get_terms( 'category', $args_val );
		$list_category_HTML .= '<div class="row bordered mb-3 category-list">';


		if ( $terms && !is_wp_error( $terms ) ) {
			$list_category_HTML .= '<ul>';
			foreach ( $terms as $term ) {
				$list_category_HTML .= '<li data-id="'. $term->term_id . '">' . $term->name . '(' . $term->count . ')</li>';

			}
			$list_category_HTML .= "</ul>";

		}

		$list_category_HTML . "</div>";
		$list_category_HTML . "</div>";
		echo $list_category_HTML;
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */

	public function form( $instance ) {
		$title 		=  empty( $instance['title'] ) ? esc_html__( 'Categories', 'list_categories_widget' ) : esc_attr($instance['title']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

}