<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Apcu-Bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Apcu;

use Vainyl\Cache\CacheInterface;
use Vainyl\Core\AbstractIdentifiable;

/**
 * Class ApcuCache
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApcuCache extends AbstractIdentifiable implements CacheInterface
{
    private $name;

    /**
     * ApcuCache constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        return apcu_clear_cache();
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        return apcu_delete($key);
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys)
    {
        if (false === apcu_delete($keys)) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        if (false === ($result = apcu_fetch($key))) {
            return $default;
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
        if (false === ($result = apcu_fetch($keys))) {
            return array_fill(0, count($keys), $default);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return apcu_exists($key);
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null)
    {
        if (false === ($result = apcu_store($key, $value, (int)$ttl))) {
            return false;
        }

        if (is_array($result)) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null)
    {
        if (false === ($result = apcu_store($values, null, (int)$ttl))) {
            return false;
        }

        if (is_array($result)) {
            return false;
        }

        return true;
    }
}