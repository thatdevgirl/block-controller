=== Block Controller ===
Contributors: thatdevgirl
Donate Link: https://www.buymeacoffee.com/thatdevgirl
Tags: content, blocks, gutenberg
Requires at least: 5.0
Requires PHP: 7.0
Tested up to: 5.7
Stable tag: 1.1

Turn on and off specific post editor content blocks.

== Description ==

This WordPress plugin provides site administrators with the ability to turn on and off specific post editor (Gutenberg) content blocks.

== Installation ==

1. In the WordPress admin, install and activate the Block Controller plugin.

2. Go to the plugin's settings page under `Block Controller`.

3. All blocks are on (enabled) by default to prevent compatibility issues on plugin activation.

4. Turn off any block that you would like to disable.

5. Some blocks will not be able to be disabled because they are already used by at least one post or page on the site. You can only disable blocks that are not currently in use. If a block is in use by at least one post, the number of uses will be listed next to that block, along with a link to the block audit page.

6. Go to the Block Audit page (under `Block Controller -> Block Audit`) to see a list of all blocks used across the site, as well as their associated posts.

== Screenshots ==

1. Screenshot of the main settings page, where administrators can enable and disable blocks.

2. Screenshot of the block audit page, where administrators can see a list of all blocks used across the site.

== Changelog ==

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
