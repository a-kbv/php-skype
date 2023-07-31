<?php

namespace Akbv\PhpSkype\Provider;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class CacheProvider {
    /**
     * @var FilesystemAdapter
     */
    private $cache;
    
    public function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    //get item from cache
    public function getItem($key)
    {
        return $this->cache->getItem($key);
    }

    public function save($key, $item, $expiration = null)
{
    $cacheItem = $this->cache->getItem($key);
    $cacheItem->set($item);
    
    // Set expiration if provided
    if ($expiration !== null) {
        $cacheItem->expiresAfter($expiration);
    }
    $this->cache->save($cacheItem);
}

    //delete item from cache
    public function deleteItem($key)
    {
        $this->cache->deleteItem($key);
    }

    //clear cache
    public function clear()
    {
        $this->cache->clear();
    }

    //get cache adapter
    public function getCache()
    {
        return $this->cache;
    }

}
