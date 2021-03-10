<?php

namespace taskplugin\includes;

class TaskPluginInitializer {

    protected static $instance = null; 

    function __construct() {
        $this->actions();
        $this->init();
        $this->includes();
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function actions() {
    }

    protected function init() {
    }

    protected function includes() {
    }
}