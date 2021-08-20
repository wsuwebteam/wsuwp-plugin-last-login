<?php
/**
 * Plugin Name: WSUWP Last Login
 * Plugin URI: https://github.com/wsuwebteam/wsuwp-plugin-last-login
 * Description: Records and display the last login for users
 * Version: 0.0.5
 * Requires PHP: 7.0
 * Author: Washington State University, Dan White
 * Author URI: https://web.wsu.edu/
 * Text Domain: wsuwp-plugin-plugin-last-login
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Initiate plugin
require_once __DIR__ . '/includes/plugin.php';
