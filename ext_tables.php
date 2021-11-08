<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
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

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
            'tx_lbonotices_domain_model_notice',
            'EXT:lbo_notices/Resources/Private/Language/locallang_csh_tx_lbonotices_domain_model_notice.xlf'
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_lbonotices_domain_model_notice');
    }
);
