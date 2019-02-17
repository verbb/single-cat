<?php
/**
 * Single Cat plugin for Craft CMS 3.x
 *
 * Fieldtype that allows the user to select a single category from a drop-down.
 *
 * @link      https://elivz.com
 * @copyright Copyright (c) 2018 Eli Van Zoeren
 */

namespace elivz\singlecat;

use elivz\singlecat\fields\SingleCatField as SingleCatFieldField;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class SingleCat
 *
 * @author  Eli Van Zoeren
 * @package SingleCat
 * @since   1.0.0
 */
class SingleCat extends Plugin
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.1.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Register the field type
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = SingleCatFieldField::class;
            }
        );

        // Register the field's schema for CraftQL support
        if (Craft::$app->getPlugins()->getPlugin('craftql')) {
            Event::on(
                SingleCatFieldField::class,
                'craftQlGetFieldSchema',
                [new \markhuot\CraftQL\Listeners\GetCategoriesFieldSchema, 'handle']
            );
        }
    }
}
