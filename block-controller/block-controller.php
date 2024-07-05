<?php

/**
 * Plugin Name: Block Controller
 * Description: Allow site administrators to control editor access to content blocks.
 * Version: 1.4.2
 * Author: Joni Halabi
 * Author URI: https://jhalabi.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
  exit;
}

require_once( 'inc/assets.php' );
require_once( 'inc/plugins-page.php' );
require_once( 'inc/settings.php' );
