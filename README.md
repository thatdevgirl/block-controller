# GU Block Controller Plugin

This plugin is a proof-of-concept that provides site administrators with the ability to turn on and off specific Gutenberg content blocks.

## How this works

Site administrators _(actual permissions for this are TBD)_ have access to a settings page under `Settings->Block Controller`, where they are presented with a list of blocks that are eligible to be turned on or off for editors. Any block that is checked is enabled. Any block that is _not_ checked will be disabled by this plugin.

## Whys

* The plugin is only controlling the set of blocks that it knows about because it is way easier to control that way. I did consider automatically getting a list of all registered blocks and spitting them onto the page, but since we had also discussed categorizing these blocks based on "packages", a flat-out list won't help with the categorization process. However, this does have the consequence of automatically enabling new blocks that are released with Gutenberg / WP core, which means that we will have to stay on top of those releases.
* The settings page lets admins check the blocks that should be enabled because that seems to make more logical sense. A checked block makes more sense to mean "yes! I want this" rather than "nope".

## Defaults

* The `core/paragraph` and `core/classic` blocks should never, ever, ever be disabled because they are default blocks in the Gutenberg system. Therefore, they are not listed in this plugin.
