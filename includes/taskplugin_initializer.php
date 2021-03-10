<?php

namespace taskplugin\includes;

use taskplugin\includes\setting\Setting;

class TaskPluginInitializer {

    protected static $instance = null; 

    function __construct() {
        $this->includes();
        $this->actions();
        $this->init();
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function actions() {
        new Setting;
    }

    protected function init() {
    }

    protected function includes() {
        include_once TASK_PLUGIN_PATH . '/includes/setting/setting.php';
    }
}