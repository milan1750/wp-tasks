<?php

namespace taskplugin\includes\setting;

class Setting {

    function __construct() {
        add_action( 'admin_init', array( $this, 'task_settings_init' ) );
        add_action( 'admin_init', array($this, 'task_settings_init' ) );
        add_action( 'admin_menu', array( $this, 'task_options_page' ) );
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

        // register a new field in the "task_settings_section" section, inside the "reading" page
        add_settings_field(
            'task_settings_field',
            'Task Setting Visibility (Yes/No)', array( $this, 'task_settings_field_callback'),
            'reading',
            'task_settings_section'
        );

        // Register a new setting for "task" page.
        register_setting( 'task', 'task_options' );
    
        // // Register a new section in the "task" page.
        add_settings_section(
            'task_section_developers',
            __( 'The Matrix has you.', 'task' ), array( $this, 'task_section_developers_callback' ),
            'task'
        );
    
        // Register a new field in the "task_section_developers" section, inside the "task" page.
        add_settings_field(
            'task_field_pill', // As of WP 4.6 this value is used only internally.
                                    // Use $args' label_for to populate the id inside the callback.
                __( 'Pill', 'task' ),
            array( $this, 'task_field_pill_cb' ),
            'task',
            'task_section_developers',
            array(
                'label_for'         => 'task_field_pill',
                'class'             => 'task_row',
                'task_custom_data' => 'custom',
            )
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

    
 
/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function task_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'task' ); ?></p>
    <?php
}
 
/**
 * Pill field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function task_field_pill_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'task_options' );
    ?>
    <select
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['task_custom_data'] ); ?>"
            name="task_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
        <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'red pill', 'task' ); ?>
        </option>
        <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'blue pill', 'task' ); ?>
        </option>
    </select>
    <p class="description">
        <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'task' ); ?>
    </p>
    <p class="description">
        <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'task' ); ?>
    </p>
    <?php
}
 
/**
 * Add the top level menu page.
 */
function task_options_page() {
    add_menu_page(
        'Task',
        'Task Options',
        'manage_options',
        'task',
        array($this, 'task_options_page_html')
    );
}
 
 
/**
 * Register our task_options_page to the admin_menu action hook.
 */
 
 
/**
 * Top level menu callback function
 */
function task_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
 
    // add error/update messages
 
    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'task_messages', 'task_message', __( 'Settings Saved', 'task' ), 'updated' );
    }
 
    // show error/update messages
    settings_errors( 'task_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "task"
            settings_fields( 'task' );
            // output setting sections and their fields
            // (sections are registered for "task", each field is registered to a specific section)
            do_settings_sections( 'task' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

}   