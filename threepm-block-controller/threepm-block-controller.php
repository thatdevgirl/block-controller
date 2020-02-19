<?php

/**
 * Plugin Name: ThreePM Block Controller
 * Description: This WordPress plugin allows administrators to control editor access to content blocks.
 * Version: 1.0
 * Author: Joni Halabi
 * Author URI: https://thatdevgirl.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
  exit;
}

require_once( 'inc/set-plugin-meta.inc.php' );
require_once( 'inc/set-plugin-action-links.inc.php' );
require_once( 'inc/set-controller.inc.php' );
