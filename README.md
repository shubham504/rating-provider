# rating-provider
This plugin used for rating custom post  name `providers`
 for creating post type copy and past below code in # function.php
 
 ```
 function create_posttype() {
 
    register_post_type( 'providers',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'providers' ),
                'singular_name' => __( 'providers' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'providers'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
 ```
