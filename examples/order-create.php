<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Divante\Connector\Bus\ApiClient;

$api = new ApiClient([
    'apiUrl' => 'http://example.com',
    'apiKey' => 'generate your own api token'
]);

/**
 * @var GuzzleHttp\Command\Result $results
 */
$results = $api->magento()->order()->create([
    'id' => 123,
    'name' => 'Test description',
    'price' => 255
]);

print_r($results->toArray());

/*
 Results:
    Array (
        [status] => added
    )
*/
