<?php
/*
Plugin Name: CTR Widget
Plugin URI: http://authoritywebsiteincome.com/ctrwidget/
Description: Adds a "cloud box", "floating widget" "scrolling widget" to a website with an easy to edit html area.
Version: 1.0
Author: Jon Haver
Author URI: https://plus.google.com/106545056878915394778
*/

class CTRWidget {

    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/
    
    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    public function __construct() {
        // Load plugin text domain
        add_action( 'init', array( $this, 'plugin_textdomain' ) );

        // Load admin panel
        require_once plugin_dir_path(__FILE__).'classes/admin.php';

        // Handle the widget
        require_once plugin_dir_path(__FILE__).'classes/widget.php';

        // Register scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

        // Settings link on plugins list
        add_filter( 'plugin_action_links', array(&$this, 'plugin_action_links'), 10, 2 );
    }

    /**
     * Loads the plugin text domain for translation
     */
    public function plugin_textdomain() {
        $domain = 'ctr-widget';
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
        load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
    }

    /**
     * Registers and enqueues scripts.
     */
    public function register_scripts() {
        wp_enqueue_script( 'ctr-widget-script', plugins_url( 'ctr-widget/js/ctr-widget.js' ), array( 'jquery'), '1.0' );
    }

    /**
     * Quick link to the Post Snippets Settings page from the Plugins page.
     *
     * @return  Array with all the plugin's action links
     */
    function plugin_action_links( $links, $file ) {
        if ( $file == 'ctr-widget/ctr-widget.php' ) {
            $links[] = '<a href="options-general.php?page=ctr-widget.php">'.__('Settings', 'ctr-widget').'</a>';
         }
        return $links;
    }
}

$CTRWidget = new CTRWidget();