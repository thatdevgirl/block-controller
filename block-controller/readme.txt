=== Block Controller ===
Contributors: thatdevgirl
Donate Link: https://www.buymeacoffee.com/thatdevgirl
Tags: content, blocks, gutenberg
Requires at least: 5.0
Requires PHP: 7.0
Tested up to: 6.4
Stable tag: 1.4.1

Allow site administrators to control editor access to content blocks.

== Description ==

This WordPress plugin provides site administrators with the ability to turn on and off specific post editor (Gutenberg) content blocks.

== Installation ==

1. In the WordPress admin, install and activate the Block Controller plugin.

2. Go to the plugin's settings page under `Block Controller`.

3. All blocks are on (enabled) by default to prevent compatibility issues on plugin activation.

4. Turn off any block that you would like to disable.

5. Some blocks will not be able to be disabled because they are already used by at least one post or page on the site. You can only disable blocks that are not currently in use. If a block is in use by at least one post, the number of uses will be listed next to that block, along with a link to the block audit page.

6. Go to the Usage Summary page (under `Block Controller -> Usage Summary`) to see a list of all blocks used across the site, as well as their associated posts.

== Screenshots ==

1. The main settings page, where site administrators can enable and disable blocks. This page highlights blocks that are already in use.

2. The block usage summary page, which displays a quick view of the blocks used on the site. This page enumerates the number of instances of each block throughout the site and the number of pages each block is used on.

3. The block usage details page for all blocks. This page display all blocks used throughout the site and a linked list of the pages each block is used on.

4. The block usage details page for a single block. This page is similar to the details page for all blocks, but includes only the information for a single block.

== Changelog ==

= 1.4.1 = 
* Tested with WordPress 6.4.
* Fixed "lodash is not defined" error.
* Added options for blocks added with WP 6.4.

= 1.4 =
* Updated the block usage summary page to use the core WP Table, which adds sorting functionality to the page and block count columns.

= 1.3 =
* Added a block summary view to display a simple table that lists all of the blocks used on the site, along with the number of instances of each block and the number of pages each block appears on.
* Renamed the "Block Inventory" pages to "Block Usage".
* Made the "Block Usage" page more robust. The page by default will list all pages, but if it is navigated to from an individual block link on either the main settings page or the usage summary page, it will display information for just that one block.
* [FIX] Fixed a fatal JavaScript error on multisites, where the post editor fails to load, resulting in a "white screen of death".
* [TECH DEBT] Minor code refactoring and adding additional, inline comments.

= 1.2 =
* Replacing `wp_localize_script` with `wp_add_inline_script` to pass PHP data to the JavaScript. This better adheres to WordPress standards.
* Adding new blocks to the list of blocks capable of being disabled. Most of them are the ones that support full-site editing.

= 1.1.3 =
* Fixing a fatal PHP bug that was discovered in PHP 8, where the array_merge to combine all blocks across all packages into a single array fails because the keys are also passed to the array_merge function.

= 1.1.2 =
* Fixing a potential fatal PHP bug in getting the block inventory, where the `is_user_logged_in()` function may not be defined when the inventory function makes the call to get all posts.

= 1.1 =
* Tested for support with WordPress core 5.7.
* Changed the way blocks are disabled. Instead of unregistering blocks in the editor (which is risky if this is done on a site where that block is being used), the blocks are simply removed from the Block Inserter.
* FIX: You can actually disable the Classic block now.
* FIX: Since embed blocks are variations of the core embed block (as of core 5.6), fixed the way those blocks are disabled so they actually disable.
* FIX: Squashed PHP bugs related to recent WP core updates.
* Reorganized the list of core blocks on the settings page to be less arbitrary.
* CSS updates to the settings pages.

= 1.0.2 =
* A small update was needed for when the plugin is initially installed, to add a check if the DB has no disabled blocks option (because it doesn't!).

= 1.0 =
* Initial release
