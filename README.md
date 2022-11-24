# Single Cat plugin for Craft CMS
A simple little field type that allows the user to select a single category from a drop-down. Templating works just like the normal Categories field type. The only difference is in the entry creation page in the control panel, where you select a category from a drop-down instead of going through the pop-up element picker.

You can switch back and forth freely between this and the native Category field, as you needs change. Of course if you had multiple categories selected in the native field and you switch to Single Cat, the next time you save each entry you will lose all but the first associated category.

## Installation
You can install Single Cat via the plugin store, or through Composer.

### Craft Plugin Store
To install **Single Cat**, navigate to the _Plugin Store_ section of your Craft control panel, search for `Single Cat`, and click the _Try_ button.

### Composer
You can also add the package to your project using Composer and the command line.

1. Open your terminal and go to your Craft project:
```shell
cd /path/to/project
```

2. Then tell Composer to require the plugin, and Craft to install it:
```shell
composer require verbb/single-cat && php craft plugin/install single-cat
```

## Credits
Originally created by [Eli Van Zoeren](https://elivz.com).

## Show your Support
Single Cat is licensed under the MIT license, meaning it will always be free and open source – we love free stuff! If you'd like to show your support to the plugin regardless, [Sponsor](https://github.com/sponsors/verbb) development.

<h2></h2>

<a href="https://verbb.io" target="_blank">
    <img width="100" src="https://verbb.io/assets/img/verbb-pill.svg">
</a>
