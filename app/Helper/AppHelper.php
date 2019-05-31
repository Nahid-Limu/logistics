<?php
namespace App\Helper;
class AppHelper{
    public static function instance()
    {
        return new AppHelper();
    }

    function checkIsAValidDate($myDateString){
        return (bool)strtotime($myDateString);
    }

}