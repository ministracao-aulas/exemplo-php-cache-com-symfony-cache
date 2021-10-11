<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

$cache = new FilesystemAdapter();

function aleatorio()
{
    sleep(3);
    return rand(100, 100000);
}

// The callable will only be executed on a cache miss.
$value = $cache->get('my_cache_key', function (ItemInterface $item) {
    $item->expiresAfter(3600);

    // ... do some HTTP request or heavy computations
    $computedValue = aleatorio();

    return $computedValue;
});

// echo $value; // 'foobar'
dump($value); // 'foobar'

// ... and to remove the cache key
// $cache->delete('my_cache_key');