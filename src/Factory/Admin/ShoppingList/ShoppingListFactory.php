<?php

namespace App\Factory\Admin\ShoppingList;

use App\Entity\Admin\ShoppingList\ShoppingList;
use App\Factory\Admin\StoreFactory;
use App\Repository\Admin\ShoppingList\ShoppingListRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ShoppingList>
 *
 * @method        ShoppingList|Proxy                     create(array|callable $attributes = [])
 * @method static ShoppingList|Proxy                     createOne(array $attributes = [])
 * @method static ShoppingList|Proxy                     find(object|array|mixed $criteria)
 * @method static ShoppingList|Proxy                     findOrCreate(array $attributes)
 * @method static ShoppingList|Proxy                     first(string $sortedField = 'id')
 * @method static ShoppingList|Proxy                     last(string $sortedField = 'id')
 * @method static ShoppingList|Proxy                     random(array $attributes = [])
 * @method static ShoppingList|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ShoppingListRepository|RepositoryProxy repository()
 * @method static ShoppingList[]|Proxy[]                 all()
 * @method static ShoppingList[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ShoppingList[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ShoppingList[]|Proxy[]                 findBy(array $attributes)
 * @method static ShoppingList[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ShoppingList[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ShoppingListFactory extends ModelFactory
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
            'wording' => self::faker()->word(),
            'description' => self::faker()->paragraph(),
            'store' => StoreFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ShoppingList $shoppingList): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ShoppingList::class;
    }
}
