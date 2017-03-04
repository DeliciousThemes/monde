<?php
add_filter( 'rwmb_meta_boxes', 'monde_register_meta_boxes' );

function monde_register_meta_boxes( $monde_meta_boxes ) {

	// Check before register meta boxes
	if ( ! monde_maybe_include() ) {
		return $monde_meta_boxes;
	}

	$monde_prefix = 'monde_';
	$monde_meta_boxes[] = array(
		'id'         => 'monde_blog_page_options',
		'title'      => esc_html__( 'Carousel Options', 'monde' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			array(
				'name'  => esc_html__( 'No of Posts to Display', 'monde' ),
				'id'    => "{$monde_prefix}carousel_posts",
				'type'  => 'number',
				'std'	=> 5
			),		
			array(
				'name'  => esc_html__( 'Order Posts By', 'monde' ),
				'id'    => "{$monde_prefix}carousel_orderby",
				'type'  => 'select',
				'options'     => array(
					'comment_count' => esc_html__( 'Most Popular(by comments)', 'monde' ),					
					'ID' => esc_html__( 'ID', 'monde' ),
					'date' => esc_html__( 'Most Recent', 'monde' ),
					'name' => esc_html__( 'Post Name', 'monde' ),
					'rand' => esc_html__( 'Random Order', 'monde' ),
				),		
				'multiple'    => false,					
				'std'	=> 'comment_count'
			),	

			array(
				'name'  => esc_html__( 'Order', 'monde' ),
				'id'    => "{$monde_prefix}carousel_order",
				'type'  => 'select',
				'options'     => array(
					'DESC' => esc_html__( 'Descending', 'monde' ),					
					'ASC' => esc_html__( 'Ascending', 'monde' ),
				),		
				'multiple'    => false,					
				'std'	=> 'DESC'
			),	
			array(
				'name' => esc_html__( 'Exclude Carousel Posts', 'monde' ),
				'id'   => "{$monde_prefix}exclude_posts",
				'desc' => esc_html__( 'Exclude carousel posts from the posts lists under the carousel', 'monde' ),
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),											
		),
	);	

	return $monde_meta_boxes;

}

function monde_maybe_include() {
	// Always include in the frontend to make helper function work
	if ( ! is_admin() ) {
		return true;
	}
	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = intval( $_GET['post'] );
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = intval( $_POST['post_ID'] );
	} else { $post_id = false;
	}
	$post_id = (int) $post_id;

	// Check for page template
	$checked_templates = array( 'template-blog.php' );
	$template = get_post_meta( $post_id, '_wp_page_template', true );
	if ( in_array( $template, $checked_templates ) ) {
		return true;
	}
	// If no condition matched
	return false;
}
