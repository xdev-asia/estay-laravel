<?php

namespace App\Http;

class CustomValidator {

    // Validating Business hours
    public function businessHours($attribute, $value, $parameters, $validator){
        return true;
    }

    public function phoneNumber($attribute, $value, $parameters, $validator){
        return true;
    }

    public function website($attribute, $value, $parameters, $validator){
        if(preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $value))
            return true;
        return false;
    }

}