<?php

defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'LboNotices',
    'List',
    'Notices active list'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'LboNotices',
    'Displaynotice',
    'Display detail of notice'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('lbo_notices', 'Configuration/TypoScript', 'Notices');
