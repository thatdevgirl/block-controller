# Block Controller

Allow site administrators to turn off and on individual Gutenberg (post editor) blocks.

## Usage instructions

1. In the WordPress admin, install and activate the Block Controller plugin.

2. Go to the plugin's settings page under `Block Controller`.

3. All blocks are on (enabled) by default to prevent compatibility issues on plugin activation.

4. Turn off any block that you would like to disable.

5. Some blocks will not be able to be disabled because they are already used by at least one post or page on the site. You can only disable blocks that are not currently in use. If a block is in use by at least one post, the number of uses will be listed next to that block, along with a link to the block audit page.

6. Go to the Block Audit page (under `Block Controller -> Block Audit`) to see a list of all blocks used across the site, as well as their associated posts.

## To Dos

* Dashboard widget? (phase 2!)

## Original premise

### Thoughts about initial set up
* The plugin does not care about what theme is active.
* Content blocks are grouped into “packages” in a settings screen.
	* Users can activate / deactivate a package to gain access to those blocks.
	* There needs to be some sort of override (advanced mode?) where users can select individual blocks within a package
* Never, ever, ever let users be able to deactivate the *paragraph* block, since it is the Gutenberg default block.

### Thoughts on removing block access
* Users are SOL if they deactivate a block that is in use somewhere on the site.
* So… we can go into “mom” mode and scan the content of the posts/pages for instances of a particular block. (Is this even feasible?!?!)
	* If a block is in use, we can either:
		* give the user a stern lecture (or, flash a warning) that deactivating the block is bad, but ultimately let them deactivate it
		* not let them deactivate the block at all
* Maybe we can also provide them a list with all of the posts/pages that are in that block? (Phase 2? Or…. Doesn’t core have something like this already or coming soon? I totally thought I read something about this somewhere.)

As I am thinking more about this plug-in, I think this plug-in should list the group of blocks that are eligible to be turned off and then anything that is not checked in this plug-in is blacklisted. This will mean that any new core blocks that are introduced will automatically be a part of the block library until/if we add a listing for the new block to this plug-in. However, it also meansThat any new custom box we write it will automatically show in the library. It also reduces any complications for any decisions that we make to limit blocks to a post tape or a template. That is because this plug-in is blankets blacklisting blocks. It is not taking into consideration the block can be on one post but not another. At least for now. There are a lot of business decisions that we need to make, but for right now I am only writing a proof of concept.
