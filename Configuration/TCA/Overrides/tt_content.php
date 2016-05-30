<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'koning_faq',
    'Faq',
    'LLL:EXT:koning_faq/Resources/Private/Language/locallang_be.xlf:plugin.title'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['koningfaq_faq'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('koningfaq_faq', 'FILE:EXT:koning_faq/Configuration/FlexForm/Faq.xml');
