<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Apcu-bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Apcu\Factory;

use Vainyl\Apcu\ApcuCache;
use Vainyl\Cache\CacheInterface;
use Vainyl\Cache\Factory\CacheFactoryInterface;
use Vainyl\Core\AbstractIdentifiable;

/**
 * Class ApcuCacheFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApcuCacheFactory extends AbstractIdentifiable implements CacheFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createCache(string $cacheName, string $connectionName, array $options = []): CacheInterface
    {
        return new ApcuCache($cacheName);
    }
}