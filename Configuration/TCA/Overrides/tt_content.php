<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'koning_faq',
    'Display',
    'LLL:EXT:koning_faq/Resources/Private/Language/locallang_be.xlf:plugin.title'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['koningfaq_display'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('koningfaq_display', 'FILE:EXT:koning_faq/Configuration/FlexForm/Display.xml');
