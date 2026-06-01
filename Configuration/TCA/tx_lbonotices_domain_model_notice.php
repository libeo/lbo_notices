<?php
return [
    'ctrl' => [
        'title' => 'lbo_notices.db:tx_lbonotices_domain_model_notice',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:lbo_notices/Resources/Public/Icons/tx_lbonotices_domain_model_notice.svg',
        'security' => [
            'ignorePageTypeRestriction' => true
        ]
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, slug, teaser, description, level, pages,
            --div--;frontend.ttc:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'slug' => [
            'label' => 'lbo_notices.db:tx_lbonotices_domain_model_notice.slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                    'fieldSeparator' => '/',
                    'prefixParentPageSlug' => true,
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => ''
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'lbo_notices.db:tx_lbonotices_domain_model_notice.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'teaser' => [
            'exclude' => true,
            'label' => 'lbo_notices.db:tx_lbonotices_domain_model_notice.teaser',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],

        ],
        'description' => [
            'exclude' => true,
            'label' => 'lbo_notices.db:tx_lbonotices_domain_model_notice.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],

        ],
        'level' => [
            'exclude' => true,
            'label' => 'lbo_notices.db:tx_lbonotices_domain_model_notice.level',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0]
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'pages' => [
            'label' => 'lbo_notices.db:tx_lbonotices_domain_model_notice.pages',
            'l10n_mode' => 'exclude',
            'config' => [
                'type' => 'group',
                'allowed' => 'pages',
                'size' => 3,
                'maxitems' => 50,
                'minitems' => 0
            ]
        ],
    ],
];
