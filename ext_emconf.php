<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Notices',
    'description' => 'Use to display different level of notices in different pages of the website.',
    'category' => 'plugin',
    'author' => 'Pierre Boivin',
    'author_email' => 'pierre.boivin@libeo.com',
    'state' => 'stable',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '12.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
