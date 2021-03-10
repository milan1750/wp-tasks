<?php

namespace taskplugin\includes\setting;

class Setting {

    function __construct() {
        add_action( 'admin_init', array( $this, 'task_settings_init' ) );
    }

    public function task_settings_init() {
        // register a new setting for "reading" page
        register_setting( 'reading', 'task_setting_name' );
     
        // register a new section in the "reading" page
        add_settings_section(
            'task_settings_section',
            'Task Settings Section', array($this, 'task_settings_section_callback'),
            'reading'
        );

        // register a new field in the "wporg_settings_section" section, inside the "reading" page
        add_settings_field(
            'task_settings_field',
            'Task Setting Visibility (Yes/No)', array( $this, 'task_settings_field_callback'),
            'reading',
            'task_settings_section'
        );
    }
    
    // section content
    function task_settings_section_callback() {
        echo '<p>This is the plugin task setting section.</p>';
    }
     
    // field content
    function task_settings_field_callback() {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        // get the value of the setting we've registered with register_setting()
        $setting = get_option('task_setting_name');
        // output the field
        ?>
        <input type="text" name="task_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
        <?php
    }

}   