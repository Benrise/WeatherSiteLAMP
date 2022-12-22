<?php

namespace App\Services;

class Page
{
    public static function part($part_name){
        require_once 'composer/views/templates/' . $part_name . ".php";
    }
}