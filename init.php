<?php
 /*
    Plugin Name: Rating Provider
    Plugin URI: http://www.xyz.com/
    Description: Plugin for displaying Rating of Provider.
    Author: xyz
    Version: 4.0
    Author URI: http://www.xyz.com/
    */	
// function to create the DB / Options / Defaults					
function rating_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "rating";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` int  NOT NULL AUTO_INCREMENT,
            `post_id` varchar(255) CHARACTER SET utf8 NOT NULL,
			`created_date` varchar(255) CHARACTER SET utf8 NOT NULL,
			`provider` varchar(255) CHARACTER SET utf8 NOT NULL,
			`overall_rating` varchar(255) CHARACTER SET utf8 NOT NULL,
			`service` varchar(255) CHARACTER SET utf8 NOT NULL,
			`price` varchar(255) CHARACTER SET utf8 NOT NULL,
			`speed` varchar(255) CHARACTER SET utf8 NOT NULL,
			`email` varchar(255) CHARACTER SET utf8 NOT NULL,
			`fname` varchar(255) CHARACTER SET utf8 NOT NULL,
			`lname` varchar(255) CHARACTER SET utf8 NOT NULL,
			`zip` varchar(255) CHARACTER SET utf8 NOT NULL,
			`comments` varchar(255) CHARACTER SET utf8 NOT NULL,
			`like` varchar(255) CHARACTER SET utf8 NOT NULL,
			`dislike` varchar(255) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";
		  
	


require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
	
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'rating_options_install');

//menu items
add_action('admin_menu','rating_modifymenu');
function rating_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Rating Provider', //page title
	'Rating Provider', //menu title
	'manage_options', //capabilities
	'rating_list', //menu slug
	'rating_provider_list', //function
	'dashicons-star-half'
	);	
	
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'rating-list.php');
require_once(ROOTDIR . 'rating-form.php');
require_once(ROOTDIR . 'table-list-class.php');


