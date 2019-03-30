<?php

include_once __DIR__ . "./ActivationDate.php";

$inputFilePath = __DIR__."/../input.csv";
$outputFilePath = __DIR__."/../output.csv";

$phoneNumberData = ActivationDate::extractPhoneNumberData($inputFilePath);

$result = array();
if(file_exists($outputFilePath)) unlink($outputFilePath);
ActivationDate::writeCsvFile($outputFilePath, ['PHONE_NUMBER','REAL_ACTIVATION_DATE']);

foreach ($phoneNumberData as $phoneNumber => $date){
    $phone = new PhoneNumbers($phoneNumber, $date);
    $actualActivationDate = $phone->getActualActivationDate();
    ActivationDate::writeCsvFile($outputFilePath, $actualActivationDate);
}

echo "\nSuccessfully generate output.csv file";