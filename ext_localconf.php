<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Libeo.LboNotices',
            'List',
            [
                \Libeo\LboNotices\Controller\NoticeController::class => 'list'
            ],
            // non-cacheable actions
            [
                \Libeo\LboNotices\Controller\NoticeController::class => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Libeo.LboNotices',
            'Displaynotice',
            [
                \Libeo\LboNotices\Controller\NoticeController::class => 'list, show'
            ],
            // non-cacheable actions
            [
                \Libeo\LboNotices\Controller\NoticeController::class => ''
            ]
        );
    }
);
