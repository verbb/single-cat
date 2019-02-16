# Single Cat plugin for Craft CMS 3.x

A simple little field type that allows the user to select a single category from a drop-down. Templating works just like the normal Categories field type. The only difference is in the entry creation page in the control panel, where you select a category from a drop-down instead of going through the pop-up element picker.

You can switch back and forth freely between this and the native Category field, as you needs change. Of course if you had multiple categories selected in the native field and you switch to Single Cat, the next time you save each entry you will lose all but the first associated category.

## Requirements

This plugin requires Craft CMS 3.1 or later.

## Supports

Support for [CraftQL](https://github.com/markhuot/craftql) is included. Single Cat fields may be accessed in the same way as native Categories fields.

## Installation

To install the plugin, follow these instructions.

1.  Open your terminal and go to your Craft project:

    cd /path/to/project

2.  Then tell Composer to load the plugin:

    composer require elivz/craft-single-cat

3.  In the Control Panel, go to Settings → Plugins and click the “Install” button for Single Cat.

Brought to you by [Eli Van Zoeren](https://elivz.com)
