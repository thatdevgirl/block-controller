<?php

/**
 * Plugin Name: Block Controller
 * Description: This WordPress plugin allows administrators to control editor access to content blocks.
 * Version: 1.1
 * Author: Joni Halabi
 * Author URI: https://jhalabi.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
  exit;
}

require_once( 'inc/assets.php' );
require_once( 'inc/settings.php' );
