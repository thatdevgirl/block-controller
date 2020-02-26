# ThreePM Block Controller

This WordPress plugin provides site administrators with the ability to turn on and off specific post editor (Gutenberg) content blocks.

## Usage instructions

1. In the WordPress admin, install and activate the Block Controller plugin.

2. Go to the plugin's settings page under `Block Controller`. _(Only administrators have access to this page.)_

3. All blocks are on (enabled) by default to prevent compatibility issues on plugin activation.

4. Turn off any block that you would like to disable.

5. Some blocks will not be able to be disabled because they are already used by at least one post or page on the site. You can only disable blocks that are not currently in use. If a block is in use by at least one post, the number of uses will be listed next to that block, along with a link to the block audit page.

6. Go to the Block Audit page (under `Block Controller -> Block Audit`) to see a list of all blocks used across the site, as well as their associated posts.

### Special blocks

* The `core/paragraph` and `core/classic` blocks should never, ever, ever be disabled because they are default blocks in the Gutenberg system. Therefore, they are not listed in this plugin.

## To Dos

* Figure out dependencies among blocks.
* Support embeds?
* Dashboard widget? (phase 2!)
* Documentation on a threepm.thatdevgirl.com page.
