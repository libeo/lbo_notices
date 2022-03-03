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

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['get_cache_timeout']['lbo_notices'] =
    \Libeo\LboNotices\Hooks\FrontendHooks::class . '->determineCacheTimeout';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['lbo_notices'] =
    \Libeo\LboNotices\Hooks\FrontendHooks::class . '->clearCachePostProc';
