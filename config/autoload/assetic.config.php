<?php

return [
    'assetic_configuration' => [
        'debug' => true,
        'buildOnRequest' => true,
        'webPath' => __DIR__ . '/../../public/assets_auto',
        'basePath' => 'assets_auto',
        'default' => [
            'options' => [
                'mixin' => true
            ],
        ],
    ],
];
