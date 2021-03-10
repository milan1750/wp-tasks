<?php

namespace taskplugin\includes;

class TaskPluginInitializer {

    protected static $instance = null; 

    function __construct() {
        // echo "Constructor running for Task Plugin Initializer";
    }

    public static function instance() {
        if(!self::$instance) {
            self::$instance = self::class; 
        }
        return self::$instance;
    }
}