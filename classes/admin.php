<?php

class CTRWidgetAdmin
{
    private $page_title  = 'CTR Widget Options';
    private $menu_title  = 'CTR Widget';
    private $menu_slug   = 'ctr-widget.php';
    private $option_name = 'ctr_widget';

    public function __construct()
    {
        add_action( 'admin_menu', array(&$this,'register_menu') );
    }

    /**
     * The Admin Page.
     */
    public function register_menu() {
        if ( current_user_can('manage_options') ) {
            // If user can manage options, display the admin page
            $option_page = add_options_page( $this->page_title, $this->menu_title, 'administrator', $this->menu_slug, array(&$this, 'options_page') );
            add_action( 'admin_init', array($this,'register_settings' ));
        }
    }

    /**
     * The options Admin page.
     * For users with manage_options capability.
     */
    public function options_page()
    {
        require_once plugin_dir_path(__FILE__).'../views/admin.php';
    }

    public function register_settings() {
        add_settings_section(
            'widget_setup_section',
            __('Widget Setup', 'ctr-widget'),
            array( $this, 'widget_setup_section_callback'),
            'ctr_widget'
        );
        add_settings_field(   
            'sidebar',
            __('Sidebar', 'ctr-widget'),
            array( $this, 'sidebar_callback' ),
            'ctr_widget',
            'widget_setup_section',
            array(
                __('Select sidebar for the Widget.', 'ctr-widget')
            )
        );  
        add_settings_field(   
            'align',
            __('Align', 'ctr-widget'),
            array( $this, 'align_callback' ),
            'ctr_widget',
            'widget_setup_section',
            array(
                __('', 'ctr-widget')
            )
        );  
        add_settings_field(   
            'widget',
            __('Widget HTML', 'ctr-widget'),
            array( $this, 'widget_callback' ),
            'ctr_widget',
            'widget_setup_section',
            array(
                __('The HTML displayed in the widget goes here.', 'ctr-widget')
            )
        );  

        add_settings_section(
            'suggestions_section',
            __('Want suggestions for what should go in the CTR widget?', 'ctr-widget'),
            array( $this, 'suggestions_section_callback'),
            'ctr_widget'
        );

        // Register the fields with WordPress  
        register_setting(  
            'ctr_widget',  
            'ctr_widget'
        ); 
    }

    public function widget_setup_section_callback()
    {
        echo '<p>';
        printf('CTR Widget allows for a "floating widget" or "scrolling widget" to be displayed at the bottom of your sidebar and as a reader scrolls down past the end of the sidebar this block will remain!<br/> This has been shown to increase conversions by over 200%%.', 'ctr-widget');
        echo '</p>';
    }

    public function sidebar_callback($args)
    {
        $options = get_option($this->option_name);
        $id = 'sidebar';

        $html = "<select id=\"{$id}\" name=\"{$this->option_name}[{$id}]\">";
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $selected = ($options[$id]==$sidebar['id']) ? 'selected="selected"' : '';  
            $html .= "<option value='".$sidebar['id']."' {$selected}>";
            $html .= $sidebar['name'];
            $html .= "</option>";
        }
        $html .= '</select>';

        echo $html;
    }

    public function align_callback($args)
    {
        $options = get_option($this->option_name);
        $id = 'align';
        $choices = array(__('Left', 'ctr-widget'), __('Center', 'ctr-widget'), __('Right', 'ctr-widget'));

        $html = "<select id=\"{$id}\" name=\"{$this->option_name}[{$id}]\">";
        foreach($choices as $item) {
            $selected = ($options[$id]==$item) ? 'selected="selected"' : '';  
            $html .= "<option value='{$item}' {$selected}>$item</option>";  
        }  
        $html .= '</select>';
        echo $html;
    }

    public function widget_callback($args)
    {
        $options = get_option($this->option_name);
        $id = 'widget_html';
        $html = "<textarea id=\"{$id}\" name=\"{$this->option_name}[{$id}]\" rows=\"8\" cols=\"80\">";
        $html .= $options[$id];
        $html .= '</textarea>';
        echo $html;
    }

    public function suggestions_section_callback()
    {
        echo '<p>'.__('Improve CTR with Split Testing?', 'ctr-widget');
        echo ' <a href="http://authoritywebsiteincome.com/ctrwidget/splittesting">'.__('See Tutorial', 'ctr-widget').' &raquo;</a></p>';
        echo '<p>'.__('Grow your subscribers with Email Integration?', 'ctr-widget');
        echo ' <a href="http://authoritywebsiteincome.com/ctrwidget/email">'.__('See Tutorial', 'ctr-widget').' &raquo;</a></p>';
        echo '<p>'.__('Copy Templates.', 'ctr-widget');
        echo ' <a href="http://authoritywebsiteincome.com/ctrwidget/templates">'.__('Get Here', 'ctr-widget').' &raquo;</a></p>';
    }
}

$CTRWidgetAdmin = new CTRWidgetAdmin();
