<?php
return [
    'routes' => [
        ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
        ['name' => 'mandate#index', 'url' => '/mandates', 'verb' => 'GET'],
        ['name' => 'mandate#create', 'url' => '/mandates', 'verb' => 'POST'],
        ['name' => 'mandate#show', 'url' => '/mandates/{id}', 'verb' => 'GET'],
        ['name' => 'mandate#delete', 'url' => '/mandates/{id}', 'verb' => 'DELETE'],
        ['name' => 'paymentRun#index', 'url' => '/runs', 'verb' => 'GET'],
        ['name' => 'paymentRun#create', 'url' => '/runs', 'verb' => 'POST'],
        ['name' => 'paymentRun#show', 'url' => '/runs/{id}', 'verb' => 'GET'],
        ['name' => 'payment#index', 'url' => '/payments', 'verb' => 'GET'],
        ['name' => 'payment#create', 'url' => '/payments', 'verb' => 'POST'],
        ['name' => 'payment#show', 'url' => '/payments/{id}', 'verb' => 'GET'],
        ['name' => 'paymentRun#generateSepaXml', 'url' => '/runs/{id}/pain008', 'verb' => 'GET'],
    ],
];
