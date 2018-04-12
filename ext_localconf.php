<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'PAGEmachine.Ats',
    'Jobs',
    [
        'Job' => 'list, show',
        'Application\\Form' => 'form, updateForm',
        'Application\\PersonalData' => 'editPersonalData, updatePersonalData',
        'Application\\Qualifications' => 'editQualifications, updateQualifications',
        'Application\\AdditionalData' => 'editAdditionalData, updateAdditionalData',
        'Application\\Upload' => 'editUpload, saveUpload, updateUpload, removeUpload',
        'Application\\Submit' => 'showSummary, submit',
    ],
    [
        'Application\\Form' => 'form, updateForm',
        'Application\\PersonalData' => 'editPersonalData, updatePersonalData',
        'Application\\Qualifications' => 'editQualifications, updateQualifications',
        'Application\\AdditionalData' => 'editAdditionalData, updateAdditionalData',
        'Application\\Upload' => 'editUpload, saveUpload, updateUpload, removeUpload',
        'Application\\Submit' => 'showSummary, submit',
    ]
);

if (TYPO3_MODE === 'BE') {
    $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['ats'] = \PAGEmachine\Ats\Hook\DataHandlerJobGroups::class;
}

// Marker replacements (CKEDITOR --> Fluid) in both mail and pdf context.
// Useful for defining shortcuts for ViewHelpers or translations.
// You can add your own markers here, however they need to be added in Resources/Public/JavaScript/CKEditorSetup.js as well
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['replacemarkers']['default'] = [
    'application.salutation' => 'f:translate(key:"tx_ats.message.salutation.{application.salutation}",extensionName:"ats")',
];

//Only used for mails
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['replacemarkers']['mail'] = [
    'backenduser.signature' => 'backenduser.tx_ats_email_signature',
];

//Only used for pdfs
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['replacemarkers']['pdf'] = [
    'backenduser.signature' => 'backenduser.tx_ats_pdf_signature',
];

// Add ckeditor template preset
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['ats_templates'] = 'EXT:ats/Configuration/RTE/Templates.yaml';


//TypeConverters for uploaded files
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(PAGEmachine\Ats\Property\TypeConverter\UploadedFileReferenceConverter::class);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(PAGEmachine\Ats\Property\TypeConverter\ObjectStorageConverter::class);

//Signal Slot for limiting static language select viewhelpers
/** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
    \SJBR\StaticInfoTables\ViewHelpers\Form\SelectViewHelper::class,
    'getItems',
    \PAGEmachine\Ats\Slots\StaticInfoTables\SelectViewHelperSlot::class,
    'filterLanguageItems'
);

//Define workflows
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['workflows']['defaultworkflow'] = \PAGEmachine\Ats\Workflow\DefaultWorkflowConfiguration::get();
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['workflows']['simpleworkflow'] = \PAGEmachine\Ats\Workflow\SimpleWorkflowConfiguration::get();

//Set workflow
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['activeWorkflow'] = 'defaultworkflow';



//Load Extension Manager settings into EXTCONF for easier usage

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['emSettings'] = [];

if (!empty($_EXTCONF)) {
    $typoScriptService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Service\TypoScriptService::class);
    $extensionManagementConfig = $typoScriptService->convertTypoScriptArrayToPlainArray(unserialize($_EXTCONF));
    unset($typoScriptService);

    foreach ($extensionManagementConfig as $key => $value) {
      //Merge instance settings
        if (is_array($value) && isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats'][$key])) {
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['emSettings'][$key] = array_merge($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['emSettings'][$key], $extensionManagementConfig[$key]);
        } else {
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ats']['emSettings'][$key] = $extensionManagementConfig[$key];
        }
    }
}

// Access configuration, if EXT:extbase_acl is available

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('extbase_acl')) {
    // Add all backend controller actions to this array.
    // This is a temporary solution to make them accessible by the role configuration API.
    // The API runs its preparations before ext_tables.php is loaded, so no module configuration is available
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase_acl']['protectedControllerActions'][\PAGEmachine\Ats\Controller\Backend\ApplicationController::class] = [
        'listAll',
        'listMine',
        'show',
        'edit',
        'removeUpload',
        'update',
        'editStatus',
        'updateStatus',
        'notes',
        'addNote',
        'close',
        'confirmClose',
        'reply',
        'sendReply',
        'invite',
        'sendInvitation',
        'acknowledge',
        'sendAcknowledgement',
        'reject',
        'sendRejection',
        'rating',
        'ratingPerso',
        'addRating',
        'backToPerso',
        'sendBackToPerso',
        'clone',
        'confirmClone',
        'history',
    ];

    //Copy array for archived application controller
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase_acl']['protectedControllerActions'][\PAGEmachine\Ats\Controller\Backend\ArchivedApplicationController::class] = [
        'listAll',
        'show',
        'edit',
        'removeUpload',
        'update',
        'editStatus',
        'updateStatus',
        'notes',
        'addNote',
        'history',
        'clone',
        'confirmClone',
        'listPool',
        'moveToPool',
        'updateMoveToPool',
    ];

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase_acl']['protectedControllerActions'][\PAGEmachine\Ats\Controller\Backend\StatisticsController::class] = [
        'statistics',
        'export',
        'getCsv',
    ];

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase_acl']['protectedControllerActions'][\PAGEmachine\Ats\Controller\Backend\NotificationApplicationController::class] = [
        'listAll',
        'show',
        'edit',
        'removeUpload',
        'update',
        'editStatus',
        'updateStatus',
        'notes',
        'addNote',
        'history',
        'clone',
        'confirmClone',
        'newMassNotification',
        'sendMassNotification',
        'downloadPdf',
    ];

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase_acl']['protectedPartials']['ats'] = [
        'Backend\\Application\\ListNew',
        'Backend\\Application\\ListInProgress',
        'Backend\\Application\\ListDeadlineExceeded',
        'Backend\\Application\\ListArchived',
        'Backend\\Application\\ListNotification',
    ];
}
