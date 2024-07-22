<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:lbo_notices/Resources/Private/Language/locallang_db.xlf:tx_lbonotices_domain_model_notice',
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
        'searchFields' => 'title,slug,description,level',
        'iconfile' => 'EXT:lbo_notices/Resources/Public/Icons/tx_lbonotices_domain_model_notice.svg',
        'security' => [
            'ignorePageTypeRestriction' => true
        ]
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, slug, teaser, description, level, pages,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_lbonotices_domain_model_notice',
                'foreign_table_where' => 'AND {#tx_lbonotices_domain_model_notice}.{#pid}=###CURRENT_PID### AND {#tx_lbonotices_domain_model_notice}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'slug' => [
            'label' => 'LLL:EXT:lbo_notices/Resources/Private/Language/locallang_db.xlf:tx_lbonotices_domain_model_notice.slug',
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
            'label' => 'LLL:EXT:lbo_notices/Resources/Private/Language/locallang_db.xlf:tx_lbonotices_domain_model_notice.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'teaser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lbo_notices/Resources/Private/Language/locallang_db.xlf:tx_lbonotices_domain_model_notice.teaser',
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
            'label' => 'LLL:EXT:lbo_notices/Resources/Private/Language/locallang_db.xlf:tx_lbonotices_domain_model_notice.description',
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
            'label' => 'LLL:EXT:lbo_notices/Resources/Private/Language/locallang_db.xlf:tx_lbonotices_domain_model_notice.level',
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
            'label' => 'LLL:EXT:lbo_notices/Resources/Private/Language/locallang_db.xlf:tx_lbonotices_domain_model_notice.pages',
            'l10n_mode' => 'exclude',
            'config' => [
                'type' => 'group',
                'allowed' => 'pages',
                'size' => 3,
                'maxitems' => 50,
                'minitems' => 0
            ]
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'passthrough',
            ]
        ]
    ],
];
