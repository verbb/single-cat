<?php
namespace verbb\singlecat\base;

use verbb\singlecat\SingleCat;

use Craft;

use yii\log\Logger;

use verbb\base\BaseHelper;

trait PluginTrait
{
    // Static Properties
    // =========================================================================

    public static SingleCat $plugin;


    // Public Methods
    // =========================================================================

    public static function log($message, $attributes = []): void
    {
        if ($attributes) {
            $message = Craft::t('single-cat', $message, $attributes);
        }

        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'single-cat');
    }

    public static function error($message, $attributes = []): void
    {
        if ($attributes) {
            $message = Craft::t('single-cat', $message, $attributes);
        }

        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'single-cat');
    }


    // Private Methods
    // =========================================================================

    private function _setPluginComponents(): void
    {
        BaseHelper::registerModule();
    }

    private function _setLogging(): void
    {
        BaseHelper::setFileLogging('single-cat');
    }

}