<?php

return [
    'frontend' => [
        'notice-redirect' => [
            'target' => \Libeo\LboNotices\Middleware\Redirect::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ],
    ]
];
