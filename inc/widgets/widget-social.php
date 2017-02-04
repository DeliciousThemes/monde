<?php
/******************************************
/* Social Widget
******************************************/
class Monde_Social_Widget extends WP_Widget {

    private $monde_networks = array('facebook', 'twitter', 'google', 'instagram', 'pinterest', 'bloglovin', 'linkedin', 'dribbble', 'youtube', 'vimeo', 'flickr', 'github', 'tumblr', 'behance', 'soundcloud', 'email', 'rss');  
              
    /** constructor */
    public function __construct() {
        parent::__construct(
          'monde_social_widget', 
          esc_html__('Monde - Social', 'monde'),
          array (
            'description' => esc_html__( 'Social block widget', 'monde' )
          )
          );
    }

    /** @see WP_Widget::widget */
    public function widget($args, $instance) {   
        extract( $args );
        $monde_title = apply_filters('widget_title', $instance['title'] );

        foreach($this->monde_networks as $monde_network) {
          $$monde_network = $instance[$monde_network];
        }

        echo $args['before_widget'];

        if ( $monde_title ) { 
          echo $args['before_title'] . esc_attr($monde_title) . $args['after_title'];     
        }
          ?>                
            <ul id="dt-social-widget">
            <?php

            $monde_ext = '';
            if('on' == $instance['monde_newtab'] ) {
              $monde_ext = 'target="_blank"';
            }
            foreach($this->monde_networks as $monde_network) {
              if($$monde_network != '') { 

                if($monde_network == 'bloglovin') { 
                  echo '<li class="dt-social-'.$monde_network.'"><a href="'.$$monde_network.'" '.$monde_ext.'><i class="fa fa-heart"></i></a></li>';
                }
                else if($monde_network == 'email') { 
                  echo '<li class="dt-social-'.$monde_network.'"><a href="mailto:'.$$monde_network.'" '.$monde_ext.'><i class="fa fa-envelope-o"></i></a></li>';
                }
                else {
                  echo '<li class="dt-social-'.$monde_network.'"><a href="'.$$monde_network.'" '.$monde_ext.'><i class="fa fa-'.$monde_network.'"></i></a></li>';                
                }
              }
            }      
        ?>        
            </ul><!--end social-widget-->
                
          <?php 
          echo $args['after_widget'];
    }

    /** @see WP_Widget::update */
    public function update($new_instance, $old_instance) {          
    
      $instance = $old_instance;

      $instance['title'] = strip_tags($new_instance['title']);

      foreach($this->monde_networks as $monde_network) {
        $instance[$monde_network] = strip_tags($new_instance[$monde_network]);
      }   

      $instance['monde_newtab'] = $new_instance['monde_newtab'];
      
      return $instance;
    }

    /** @see WP_Widget::form */
    public function form($instance) {

        $defaults = array();
        foreach($this->monde_networks as $monde_network) {
          $defaults[$monde_network] = '';
        } 
        $defaults['title'] = esc_html__('Connect with Us', 'monde');
        $defaults['monde_newtab'] = 'on';
        $instance = wp_parse_args( (array) $instance, $defaults );  

        $monde_title = $instance['title'];
        ?>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title: ', 'monde'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($monde_title); ?>" />
        </p>

        <?php
        foreach($this->monde_networks as $monde_network) {
          $$monde_network = $instance[$monde_network]; 
          ?>
         <p>
          <label for="<?php echo esc_attr($this->get_field_id($monde_network)); ?>"><?php echo esc_html(ucfirst($monde_network)); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id($monde_network)); ?>" name="<?php echo esc_attr($this->get_field_name($monde_network)); ?>" type="text" value="<?php echo esc_attr($$monde_network); ?>" />
        </p>
          <?php
        }  
        ?>
        <p>
          <input class="checkbox" type="checkbox" <?php checked($instance['monde_newtab'], 'on'); ?> id="<?php echo $this->get_field_id('monde_newtab'); ?>" name="<?php echo $this->get_field_name('monde_newtab'); ?>" /> 
          <label for="<?php echo $this->get_field_id('monde_newtab'); ?>">Open links in a new tab</label>
        </p>   
    <?php     
    }

} // class monde_Social_Widget
// register Social widget
add_action( 'widgets_init', function(){
     register_widget( 'Monde_Social_Widget' );
});
?>