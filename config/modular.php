<?php

use components\ModularComponent;

return [
    'path' => base_path('app/Modules'),
    'base_namespace' => 'app\Modules\\' . ModularComponent::MODULE_VERSION,

    /** Modules */
    'modules' => [
        'v1' => [
            'Settings',
            'TestModule'
        ]
    ]
];
