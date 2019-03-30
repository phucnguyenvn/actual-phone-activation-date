<?php
/*
 *
 * Run command:
 * # phpunit ActivationDateTest
 *
 */
use PHPUnit\Framework\TestCase;

include_once __DIR__ . "/../src/Models/PhoneNumbers.php";

class ActivationDateTest extends TestCase
{
    public function testSortDate(){
        $param = [
            0 =>
                [
                    'activationDate' => '2016-09-01',
                    'deactivationDate' => '2016-12-01'
                ],
            1 =>
                [
                    'activationDate' => '2016-03-01',
                    'deactivationDate' => '2016-05-01'
                ],
            2 =>
                [
                    'activationDate' => '2016-06-01',
                    'deactivationDate' => '2016-09-01'
                ]
        ];
        $phone = new PhoneNumbers('0987000001', $param);
        $phone->sortDate();
        $expectedResponse = [
            0 =>
                [
                    'activationDate' => '2016-09-01',
                    'deactivationDate' => '2016-12-01'
                ],
            1 =>
                [
                    'activationDate' => '2016-06-01',
                    'deactivationDate' => '2016-09-01'
                ],
            2 =>
                [
                    'activationDate' => '2016-03-01',
                    'deactivationDate' => '2016-05-01'
                ]
        ];
        $this->assertEquals($expectedResponse, $phone->getDate());
    }

    public function testGetActualActivationDate(){
        $param = [
            0 =>
                [
                    'activationDate' => '2016-03-01',
                    'deactivationDate' => '2016-05-01'
                ],
            1 =>
                [
                    'activationDate' => '2016-01-01',
                    'deactivationDate' => '2016-03-01'
                ],
            2 =>
                [
                    'activationDate' => '2016-12-01',
                    'deactivationDate' => ''
                ],
            3 =>
                [
                    'activationDate' => '2016-09-01',
                    'deactivationDate' => '2016-12-01'
                ],
            4 =>
                [
                    'activationDate' => '2016-06-01',
                    'deactivationDate' => '2016-09-01'
                ]
        ];
        $phone = new PhoneNumbers('0987000001', $param);
        $actualActivationDate = $phone->getActualActivationDate();
        $expectedResponse = [
            'phoneNumber'  => '0987000001',
            'actualActivationDate' => '2016-06-01'
        ];
        $this->assertEquals($expectedResponse, $actualActivationDate);
    }
}