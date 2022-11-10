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
    'version' => '1.2.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
