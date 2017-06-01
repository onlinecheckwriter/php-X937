<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit39256cae5d53867bcd6979f81e230bde
{
    public static $prefixLengthsPsr4 = array (
        'X' => 
        array (
            'X937\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'X937\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'X937\\Fields\\Amount' => __DIR__ . '/../..' . '/Fields/Amount.php',
        'X937\\Fields\\DateTime' => __DIR__ . '/../..' . '/Fields/DateTime.php',
        'X937\\Fields\\DateTime\\Date' => __DIR__ . '/../..' . '/Fields/DateTime/Date.php',
        'X937\\Fields\\DateTime\\Time' => __DIR__ . '/../..' . '/Fields/DateTime/Time.php',
        'X937\\Fields\\DepositAccountNumber' => __DIR__ . '/../..' . '/Fields/FieldTypes.php',
        'X937\\Fields\\Field' => __DIR__ . '/../..' . '/Fields/Field.php',
        'X937\\Fields\\FieldGeneric' => __DIR__ . '/../..' . '/Fields/FieldGeneric.php',
        'X937\\Fields\\FieldPhoneNumber' => __DIR__ . '/../..' . '/Fields/FieldPhoneNumber.php',
        'X937\\Fields\\FieldReserved' => __DIR__ . '/../..' . '/Fields/FieldReserved.php',
        'X937\\Fields\\FieldRoutingNumber' => __DIR__ . '/../..' . '/Fields/FieldRoutingNumber.php',
        'X937\\Fields\\FieldUser' => __DIR__ . '/../..' . '/Fields/FieldUser.php',
        'X937\\Fields\\ItemSequenceNumber' => __DIR__ . '/../..' . '/Fields/FieldTypes.php',
        'X937\\Fields\\Name' => __DIR__ . '/../..' . '/Fields/FieldTypeName.php',
        'X937\\Fields\\NameContact' => __DIR__ . '/../..' . '/Fields/FieldTypeName.php',
        'X937\\Fields\\NameInstitution' => __DIR__ . '/../..' . '/Fields/FieldTypeName.php',
        'X937\\Fields\\NamePayee' => __DIR__ . '/../..' . '/Fields/FieldTypeName.php',
        'X937\\Fields\\NamePayorAccount' => __DIR__ . '/../..' . '/Fields/FieldTypeName.php',
        'X937\\Fields\\NameSecurity' => __DIR__ . '/../..' . '/Fields/FieldTypeName.php',
        'X937\\Fields\\Predefined\\FieldCashLetterType' => __DIR__ . '/../..' . '/Fields/Predefined/FieldCashLetterType.php',
        'X937\\Fields\\Predefined\\FieldCollectionType' => __DIR__ . '/../..' . '/Fields/Predefined/FieldCollectionType.php',
        'X937\\Fields\\Predefined\\FieldDocType' => __DIR__ . '/../..' . '/Fields/Predefined/FieldDocType.php',
        'X937\\Fields\\Predefined\\FieldFedWorkType' => __DIR__ . '/../..' . '/Fields/Predefined/FieldFedWorkType.php',
        'X937\\Fields\\Predefined\\FieldPredefined' => __DIR__ . '/../..' . '/Fields/Predefined/FieldPredefined.php',
        'X937\\Fields\\Predefined\\FieldResend' => __DIR__ . '/../..' . '/Fields/Predefined/FieldResend.php',
        'X937\\Fields\\Predefined\\FieldReturnReason' => __DIR__ . '/../..' . '/Fields/Predefined/FieldReturnReason.php',
        'X937\\Fields\\Predefined\\FieldSpecificationLevel' => __DIR__ . '/../..' . '/Fields/Predefined/FieldSpecificationLevel.php',
        'X937\\Fields\\Predefined\\FieldTestFile' => __DIR__ . '/../..' . '/Fields/Predefined/FieldTestFile.php',
        'X937\\Fields\\Predefined\\FieldVariableSize' => __DIR__ . '/../..' . '/Fields/Predefined/FieldVariableSize.php',
        'X937\\Fields\\Predefined\\ImageInfo\\FieldImageInfo' => __DIR__ . '/../..' . '/Fields/Predefined/ImageInfo/FieldImageInfo.php',
        'X937\\Fields\\Predefined\\ImageInfo\\FieldImageInfoQuality' => __DIR__ . '/../..' . '/Fields/Predefined/ImageInfo/FieldImageInfoQuality.php',
        'X937\\Fields\\Predefined\\ImageInfo\\FieldImageInfoUsability' => __DIR__ . '/../..' . '/Fields/Predefined/ImageInfo/FieldImageInfoUsability.php',
        'X937\\Fields\\Predefined\\ImageView\\Compression' => __DIR__ . '/../..' . '/Fields/Predefined/ImageView/Compression.php',
        'X937\\Fields\\Predefined\\ImageView\\Format' => __DIR__ . '/../..' . '/Fields/Predefined/ImageView/Format.php',
        'X937\\Fields\\Predefined\\ImageView\\ImageView' => __DIR__ . '/../..' . '/Fields/Predefined/ImageView/ImageView.php',
        'X937\\Fields\\Predefined\\RecordType' => __DIR__ . '/../..' . '/Fields/Predefined/RecordType.php',
        'X937\\Fields\\Predefined\\ViewSide' => __DIR__ . '/../..' . '/Fields/Predefined/ViewSide.php',
        'X937\\Fields\\SizeBytes' => __DIR__ . '/../..' . '/Fields/SizeBytes.php',
        'X937\\Fields\\VariableLength\\Binary\\BinaryData' => __DIR__ . '/../..' . '/Fields/VariableLength/Binary/BinaryData.php',
        'X937\\Fields\\VariableLength\\Binary\\DigitalSignature' => __DIR__ . '/../..' . '/Fields/VariableLength/Binary/DigitalSignature.php',
        'X937\\Fields\\VariableLength\\Binary\\ImageData' => __DIR__ . '/../..' . '/Fields/VariableLength/Binary/ImageData.php',
        'X937\\Fields\\VariableLength\\ImageKey' => __DIR__ . '/../..' . '/Fields/VariableLength/ImageKey.php',
        'X937\\Fields\\VariableLength\\VariableLength' => __DIR__ . '/../..' . '/Fields/VariableLength/VariableLength.php',
        'X937\\Record\\AccountTotalsDetail' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\BoxSummary' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\BundleControl' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\BundleHeader' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\CashLetterControl' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\CashLetterHeader' => __DIR__ . '/../..' . '/Record/CashLetterHeader.php',
        'X937\\Record\\CheckDetail' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\CheckDetailAddendumA' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\CheckDetailAddendumC' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\Factory' => __DIR__ . '/../..' . '/Record/Factory.php',
        'X937\\Record\\FileControl' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\FileHeader' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\Generic' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\ImageViewAnalysis' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\ImageViewDetail' => __DIR__ . '/../..' . '/Record/ImageViewDetail.php',
        'X937\\Record\\NonHitTotalsDetail' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\Record' => __DIR__ . '/../..' . '/Record/Record.php',
        'X937\\Record\\ReturnAddendumA' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\ReturnAddendumB' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\ReturnAddendumD' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\ReturnRecord' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\RoutingNumberSummary' => __DIR__ . '/../..' . '/Record/RecordTypes.php',
        'X937\\Record\\VariableLength\\CheckDetailAddendumB' => __DIR__ . '/../..' . '/Record/VariableLength/CheckDetailAddendumB.php',
        'X937\\Record\\VariableLength\\ImageViewData' => __DIR__ . '/../..' . '/Record/VariableLength/ImageViewData.php',
        'X937\\Record\\VariableLength\\VariableLength' => __DIR__ . '/../..' . '/Record/VariableLength/VariableLength.php',
        'X937\\Record\\VariableLength\\X937RecordReturnAddendumC' => __DIR__ . '/../..' . '/Record/VariableLength/ReturnAddendumC.php',
        'X937\\Validator\\AbstractValidator' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\Validator' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorDate' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorInterface' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorRoutingNumber' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorSize' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorTypeAlphabetic' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorTypeAlphameric' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorTypeBlank' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorTypeNumeric' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorUsageManditory' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Validator\\ValidatorValueEnumerated' => __DIR__ . '/../..' . '/Validator.php',
        'X937\\Writer\\AbstractWriter' => __DIR__ . '/../..' . '/Writer/AbstractWriter.php',
        'X937\\Writer\\Factory' => __DIR__ . '/../..' . '/Writer/Factory.php',
        'X937\\Writer\\FieldInterface' => __DIR__ . '/../..' . '/Writer/FieldInterface.php',
        'X937\\Writer\\Field\\BinaryAbstract' => __DIR__ . '/../..' . '/Writer/Field/BinaryAbstract.php',
        'X937\\Writer\\Field\\Binary\\Base64' => __DIR__ . '/../..' . '/Writer/Field/Binary/Base64.php',
        'X937\\Writer\\Field\\Binary\\Binary' => __DIR__ . '/../..' . '/Writer/Field/Binary/Binary.php',
        'X937\\Writer\\Field\\Formated' => __DIR__ . '/../..' . '/Writer/Field/Formated.php',
        'X937\\Writer\\Field\\None' => __DIR__ . '/../..' . '/Writer/Field/None.php',
        'X937\\Writer\\Field\\Raw' => __DIR__ . '/../..' . '/Writer/Field/Raw.php',
        'X937\\Writer\\Field\\Signifigant' => __DIR__ . '/../..' . '/Writer/Field/Signifigant.php',
        'X937\\Writer\\Flat' => __DIR__ . '/../..' . '/Writer/Flat.php',
        'X937\\Writer\\Human' => __DIR__ . '/../..' . '/Writer/Human.php',
        'X937\\Writer\\Image' => __DIR__ . '/../..' . '/Writer/Image.php',
        'X937\\Writer\\WriterInterface' => __DIR__ . '/../..' . '/Writer/WriterInterface.php',
        'X937\\Writer\\X937Writer' => __DIR__ . '/../..' . '/Writer/X937Writer.php',
        'X937\\Writer\\XML' => __DIR__ . '/../..' . '/Writer/XML.php',
        'X937\\X937File' => __DIR__ . '/../..' . '/File.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit39256cae5d53867bcd6979f81e230bde::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit39256cae5d53867bcd6979f81e230bde::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit39256cae5d53867bcd6979f81e230bde::$classMap;

        }, null, ClassLoader::class);
    }
}