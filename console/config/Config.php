<?php

namespace Console\Config;

class Config
{


    //Get config
    public static function get(string $config)
    {
        return require_once ROOT . "/console/config/{$config}.php";
    }
}
