<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Keizer.' . $_EXTKEY,
    'Display',
    ['Faq' => 'list'],
    []
);
