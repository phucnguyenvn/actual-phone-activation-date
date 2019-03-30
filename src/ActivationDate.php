<?php

include_once __DIR__ . "./Models/PhoneNumbers.php";

class ActivationDate
{
   /**
    * reads CSV file and return phone number data from given file path
    * 
    * @param string $inputFilePath
    * @return array $phoneNumberData
    */
    public static function extractPhoneNumberData($inputFilePath){
        $csvFile = fopen($inputFilePath, "r");
        $phoneNumberData = [];
        if($csvFile){
            try {
                fgets($csvFile); //Ignore the first line which contain CSV header (PHONE_NUMBER,ACTIVATION_DATE,DEACTIVATION_DATE)
                while (($line = fgets($csvFile)) !== false) {
                    // process the line read.
                    $lineArray = explode(',', trim($line));
                    $phoneNumberData[$lineArray[0]][] = [
                        'activationDate' => $lineArray[1],
                        'deactivationDate' => $lineArray[2]
                    ];
                }
                fclose($csvFile);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return $phoneNumberData;
    }

    /**
    * write CSV file from given phoneNumberData and outputFilePath
    * 
    * @param string $outputFilePath
    * @param array $phoneNumberData
    * @return void
    */
    public static function writeCsvFile($outputFilePath,$phoneNumberData){
        $csvFile = fopen($outputFilePath, "a");

        fputcsv($csvFile, $phoneNumberData);
        fclose($csvFile);
    }

}

