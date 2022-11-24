<?php
namespace verbb\singlecat\fields;

use Craft;
use craft\base\ElementInterface;
use craft\db\Table;
use craft\elements\Category;
use craft\elements\db\CategoryQuery;
use craft\fields\BaseRelationField;
use craft\gql\arguments\elements\Category as CategoryArguments;
use craft\gql\interfaces\elements\Category as CategoryInterface;
use craft\gql\resolvers\elements\Category as CategoryResolver;
use craft\helpers\ArrayHelper;
use craft\helpers\Db;
use craft\helpers\ElementHelper;
use craft\helpers\Gql;

use GraphQL\Type\Definition\Type;

class SingleCatField extends BaseRelationField
{
    // Static Methods
    // =========================================================================

    public static function displayName(): string
    {
        return Craft::t('single-cat', 'Single Category');
    }

    protected static function elementType(): string
    {
        return Category::class;
    }


    // Properties
    // =========================================================================

    /**
     * @var int|null Branch limit
     */
    public $branchLimit = 1;

    /**
     * @var bool Whether to show blank select option
     */
    public $showBlankOption = true;


    // Public Methods
    // =========================================================================

    public function init(): void
    {
        parent::init();

        $this->allowLimit = false;
        $this->allowMultipleSources = false;
        $this->settingsTemplate = 'single-cat/field/settings';
        $this->inputTemplate = 'single-cat/field/input';
        $this->inputJsClass = false;
        $this->sortable = false;
    }

    public function normalizeValue($value, ElementInterface $element = null)
    {
        if (is_array($value)) {
            $categories = Category::find()
                ->siteId($this->targetSiteId($element))
                ->id(array_values(array_filter($value)))
                ->anyStatus()
                ->all();

            // Enforce the branch limit
            Craft::$app->getStructures()->applyBranchLimitToElements($categories, $this->branchLimit);

            $value = ArrayHelper::getColumn($categories, 'id');
        }

        return parent::normalizeValue($value, $element);
    }

    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Make sure the field is set to a valid category group
        if ($this->source) {
            $source = ElementHelper::findSource(static::elementType(), $this->source, 'field');
        }

        if (empty($source)) {
            return '<p class="error">' . Craft::t('app', 'This field is not set to a valid category group.') . '</p>';
        }

        // Get all the categories in this group
        $categories = Category::find()
            ->groupId($source['criteria']['groupId'])
            ->siteId($this->targetSiteId($element))
            ->anyStatus()
            ->all();

        // Get the element ID of the stored category
        /** @var CategoryQuery $value */
        $value = $value
            ->select(['elements.id'])
            ->anyStatus()
            ->scalar();

        // Check whether blank option needs to be shown
        $storedCategoryExists = $value !== false;
        $isFresh = $element && $element->getIsFresh();

        $showBlankOption = $this->showBlankOption || (!$storedCategoryExists && !$isFresh);

        // Render the input template
        return Craft::$app->getView()->renderTemplate($this->inputTemplate, [
            'name' => $this->handle,
            'value' => $value,
            'field' => $this,
            'source' => $source,
            'categories' => $categories,
            'showBlankOption' => $showBlankOption,
        ]);
    }

    public function getContentGqlType(): array
    {
        return [
            'name' => $this->handle,
            'type' => Type::listOf(CategoryInterface::getType()),
            'args' => CategoryArguments::getArguments(),
            'resolve' => CategoryResolver::class . '::resolve',
        ];
    }

    public function getEagerLoadingGqlConditions()
    {
        $allowedEntities = Gql::extractAllowedEntitiesFromSchema();
        $allowedCategoryUids = $allowedEntities['categorygroups'] ?? [];

        if (empty($allowedCategoryUids)) {
            return false;
        }

        $categoryIds = Db::idsByUids(Table::CATEGORYGROUPS, $allowedCategoryUids);

        return ['groupId' => array_values($categoryIds)];
    }
}
