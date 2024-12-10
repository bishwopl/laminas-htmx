<?php

namespace Htmx;

return [
    'htmx' => [
        'compressOutput' => false
    ],
    'view_manager' => [
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/empty'  => __DIR__ . '/../view/layout/layout-empty.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'assetic_configuration' => [
        'default' => [
            'assets' => [
                '@htmx',
                '@htmx_addon_js',
            ],
        ],
        'modules' => [
            'htmx' => [
                'root_path' => __DIR__ . '/../assets',
                'collections' => [
                    'bootstrap_css' => [
                        'assets' => [
                            'css/style.css',
                            'css/bootstrap.min.css'
                        ],
                        'filters' => [
                            'CssRewriteFilter' => [
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ]
                        ],
                    ],
                    'bootstrap_js' => [
                        'assets' => [
                            'js/bootstrap.min.js',
                        ],
                    ],
                    'htmx' => [
                        'assets' => [
                            'htmx/htmx.js',
                        ],
                    ],
                    'htmx_addon_js' => [
                        'assets' => [
                            'js/htmx-addons.js',
                        ],
                    ],
                    'base_images' => [
                        'assets' => [
                            'img/*.png',
                            'img/*.ico',
                            'img/*.svg',
                            'img/*.gif',
                        ],
                        'options' => [
                            'move_raw' => true,
                        ]
                    ],
                ],
            ],
        ],
    ],
];
