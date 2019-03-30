<?php

class PhoneNumbers
{
    private $phoneNumber;
    private $date;

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    function __construct($phoneNumber, $date)
    {
        $this->phoneNumber = $phoneNumber;
        $this->date = $date;
    }

   /**
    * Find and return Actual Activation of Current User.
    * 
    * @return array phoneNumber & actualActivationDate
    */
    public function getActualActivationDate(){
        $this->sortDate();
        
        $date = $this->date;
        $actualActivationDate = null;

        for($i = 0; $i < count($date); $i++){
            $actualActivationDate = $date[$i]['activationDate'];
            if($actualActivationDate == (isset($date[$i+1]['deactivationDate']) ? $date[$i+1]['deactivationDate'] : NULL)){
                $actualActivationDate = $date[$i+1]['activationDate'];
            }else {
                break;
            }
        }
        
        return [
            'phoneNumber' => $this->phoneNumber,
            'actualActivationDate' => $actualActivationDate
        ];
    }

    /**
     * Sort the list of usage period by ACTIVATION_DATE
     */
    public function sortDate(){
        usort($this->date, function($a, $b) {
            return $b['activationDate'] <=> $a['activationDate'];
        });
    }
}