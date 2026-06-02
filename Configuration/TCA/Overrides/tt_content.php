<?php

defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'LboNotices',
    'List',
    'Notices active list'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'LboNotices',
    'Show',
    'Display detail of notice'
);
