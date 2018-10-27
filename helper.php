<?php
/**
 * Helper functions
 */

function list_categories_widget_get_posts() {

		$cat_id = $_POST['id'];

		//get posts uses term_id
		$args=array(
			'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' => $cat_id,
					)
				),
			);

			$posts=get_posts($args);

			//all post name initialize in array
			if ( ! empty( $posts ) ) {
				$resp = array();
				foreach ( $posts as $post ) {
					$resp[$post->ID] = $post->post_name;
				}
				wp_send_json_success($resp);
			} else {
				wp_send_json_error();
			}
}