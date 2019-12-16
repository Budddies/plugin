<?php
/*
Plugin Name: Custom Post listings
Plugin URI:  plugin url
Description: Basic WordPress Plugin shortcode [custom-post-list] 
Version:     3
Author:      Author name
Author URI:  Author URL
License:     GPL2
License URI: Licence URl
*/

function custom_setup_post_type() {
    $args = array(
        'public'    => true,
        'label'     => __( 'Custom Post', 'textdomain' )
    );
    register_post_type( 'custom_post', $args );
}
add_action( 'init', 'custom_setup_post_type' );

add_shortcode( 'custom-post-list', 'custom_post_listing' );
function custom_post_listing( $atts ) {
	ob_start();
	$args=array(
      'post_type' => 'custom_post', // Post Type Slug
      'posts_per_page' =>-1, // Show All
	  'order'=> 'Desc'
    );
	    $new = new WP_Query($args);
    while ($new->have_posts()) : $new->the_post();
?>

<div class="single_post">
<div class="span6">
<div class="post_title">
<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
</div>
</div>
<div class="span6">
<?php  the_content(); ?>
</div>
</div>

<?php
    endwhile;
	wp_reset_query(); 
	 $myvariable = ob_get_clean();
	return $myvariable;
}
?>


