<?php

namespace App\Factory\Admin\ShoppingList;

use App\Entity\Admin\ShoppingList\ShoppingListItem;
use App\Factory\Admin\ProductFactory;
use App\Repository\Admin\ShoppingList\ShoppingListItemRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ShoppingListItem>
 *
 * @method        ShoppingListItem|Proxy                     create(array|callable $attributes = [])
 * @method static ShoppingListItem|Proxy                     createOne(array $attributes = [])
 * @method static ShoppingListItem|Proxy                     find(object|array|mixed $criteria)
 * @method static ShoppingListItem|Proxy                     findOrCreate(array $attributes)
 * @method static ShoppingListItem|Proxy                     first(string $sortedField = 'id')
 * @method static ShoppingListItem|Proxy                     last(string $sortedField = 'id')
 * @method static ShoppingListItem|Proxy                     random(array $attributes = [])
 * @method static ShoppingListItem|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ShoppingListItemRepository|RepositoryProxy repository()
 * @method static ShoppingListItem[]|Proxy[]                 all()
 * @method static ShoppingListItem[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ShoppingListItem[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ShoppingListItem[]|Proxy[]                 findBy(array $attributes)
 * @method static ShoppingListItem[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ShoppingListItem[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ShoppingListItemFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'product' => ProductFactory::random(),
            'quantity' => self::faker()->numberBetween(1,9),
            'shoppingList' => ShoppingListFactory::random(),
            'checked' => self::faker()->numberBetween(0,1)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ShoppingListItem $shoppingListItem): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ShoppingListItem::class;
    }
}
