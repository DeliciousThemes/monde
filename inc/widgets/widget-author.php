<?php
/******************************************
/* Social Widget
******************************************/
class Monde_Author_Widget extends WP_Widget {
              
    /** constructor */
    public function __construct() {
        parent::__construct(
          'monde_author_widget', 
          esc_html__('Monde - Author', 'monde'),
          array (
            'description' => esc_html__( 'Author box widget', 'monde' )
          )
          );
    }


    /** @see WP_Widget::widget */
    public function widget($args, $instance) {   
        extract( $args );
        $monde_title = apply_filters('widget_title', $instance['title'] );
        $monde_author = $instance['author'];
        $monde_signature = $instance['signature'];

        echo $args['before_widget'];

        if ( $monde_title ) { 
          echo $args['before_title'] . esc_attr($monde_title) . $args['after_title'];     
        }

        echo '<div class="delicious-author-box">';

        // return avatar
        echo '<div class="delicious-author-box-avatar">'. get_avatar( get_the_author_meta( 'ID',$monde_author ), 128 ) . '</div>';

        // return author description
        $author_description = get_the_author_meta('description',$monde_author);
        $monde_words = $instance['limit_words'];

        if (str_word_count($author_description, 0) > $monde_words) {
            $words = str_word_count($author_description, 2);
            $pos = array_keys($words);
            $author_description = substr($author_description, 0, $pos[$monde_words]);
        }
        echo '<p class="delicious-author-description">'. $author_description . '</p>';
        
        // signature
        echo '<p class="delicious-author-signature">'.$monde_signature.'</p>';

        echo '</div>'; // end delicious-author-box

          echo $args['after_widget'];
    }

    /** @see WP_Widget::update */
    public function update($new_instance, $old_instance) {          
    
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['author'] = strip_tags($new_instance['author']);      
      $instance['limit_words'] = strip_tags($new_instance['limit_words']);      
      $instance['avatar_size'] = strip_tags($new_instance['avatar_size']);      
      $instance['signature'] = strip_tags($new_instance['signature']);      
      return $instance;
    }

    /** @see WP_Widget::form */
    public function form($instance) {

        $defaults = array();
        $defaults['title'] = esc_html__('About the Author', 'monde');
        $defaults['author'] = 0;
        $defaults['limit_words'] = 20;
        $defaults['avatar_size'] = 128;
        $defaults['signature'] = 'John Doe';

        $instance = wp_parse_args( (array) $instance, $defaults );  

        $monde_title = $instance['title'];
        $monde_words = $instance['limit_words'];
        $monde_signature = $instance['signature'];
        ?>


        <?php $authors = get_users(); ?>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title: ', 'monde'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($monde_title); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e('Choose author', 'monde'); ?>:</label>
          <select name="<?php echo $this->get_field_name( 'author' ); ?>" id="<?php echo $this->get_field_id( 'author' ); ?>" class="widefat">
          <?php foreach($authors as $author) : ?>
            <option value="<?php echo $author->ID; ?>" <?php selected($author->ID, $instance['author']); ?>><?php echo $author->data->display_name; ?></option>
          <?php endforeach; ?>
          </select>
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('limit_words')); ?>"><?php esc_html_e('Limit description to X words', 'monde'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit_words')); ?>" name="<?php echo esc_attr($this->get_field_name('limit_words')); ?>" type="text" value="<?php echo esc_attr($monde_words); ?>" />
        </p>   

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('signature')); ?>"><?php esc_html_e('Signature', 'monde'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('signature')); ?>" name="<?php echo esc_attr($this->get_field_name('signature')); ?>" type="text" value="<?php echo esc_attr($monde_signature); ?>" />
        </p>                

          <?php
    }

} // class monde_Social_Widget
// register Author widget
add_action( 'widgets_init', function(){
     register_widget( 'Monde_Author_Widget' );
});
?>