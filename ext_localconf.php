<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function (): void {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'LboNotices',
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
            'LboNotices',
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

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['lbo_notices'] =
    \Libeo\LboNotices\Hooks\FrontendHooks::class . '->clearCachePostProc';
